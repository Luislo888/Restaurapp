

$(function () {


    // INICIO AJAX

    $("#formEditarComanda").on('submit', function (e) {

        $('#spinEditarComanda').show();

        e.preventDefault();

        // $('input').each(function () {
        //     if ($(this).val() == '') {
        //         $(this).val(false);
        //     }
        // });


        $('option').each(function () {
            if ($(this).val() != 0) {
                $(this).removeAttr('disabled');
            }
        });

        $('select').each(function () {
            if ($(this).val() == 0) {
                $(this).val(null);
            }
        });

        var form = $(this);
        var url = form.attr('action');
        // alert(url);

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            beforeSend: function () {

            },
            success: function (resultado) {
                $('#notificacionEditarSuccess').show().text('Comanda editada correctamente');
                $('.notificacionCrearComanda').delay(3000).fadeOut(3000);
                $('#spinEditarComanda').hide();

                let obj = JSON.parse(resultado);

                let fecha = new Date(obj.comanda.created_at);
                let anio = fecha.getFullYear();
                let mes = fecha.getMonth() + 1;
                if (mes < 10) {
                    mes = '0' + mes;
                }
                let dia = fecha.getDate();
                let hora = fecha.getHours();
                let minutos = fecha.getMinutes();
                let segundosFecha = fecha.getSeconds();

                let entrantes = "";
                let primeros = "";
                let segundos = "";
                let postres = "";
                let bebidas = "";
                let comentarios = "";

                if (obj.comanda.comentarios == null) {

                    comentarios = "";
                } else {
                    comentarios = `<strong><i class='fa-solid fa-comment'></i> Comentarios: </strong> ${obj.comanda.comentarios} <br>`;
                }


                for (let i = 0; i < obj.productosCompleto.length; i++) {

                    // if (i == 0) {
                    //     switch (obj.productosCompleto[i].categoria) {
                    //         case 'entrantes': entrantes += '<br>' + obj.productosCompleto[i].nombre + ' x ' + obj.cantidad[i];
                    //             break;
                    //         case 'primeros': primeros += '<br>' + obj.productosCompleto[i].nombre + ' x ' + obj.cantidad[i];
                    //             break;
                    //         case 'segundos': segundos += '<strong>Segundos:</strong><br>' + obj.productosCompleto[i].nombre + ' x ' + obj.cantidad[i];
                    //             break;
                    //         case 'bebidas': bebidas += '<br>' + obj.productosCompleto[i].nombre + ' x ' + obj.cantidad[i];
                    //             break;
                    //         case 'postres': postres += '<br>' + obj.productosCompleto[i].nombre + ' x ' + obj.cantidad[i];
                    //             break;
                    //     }
                    // } else {

                    switch (obj.productosCompleto[i].categoria) {
                        case 'entrantes': entrantes += '<div><br>' + obj.productosCompleto[i].nombre + ' x ' + obj.cantidad[i] + '</div>';
                            break;
                        case 'primeros': primeros += '<div><br>' + obj.productosCompleto[i].nombre + ' x ' + obj.cantidad[i] + '</div>';
                            break;
                        case 'segundos': segundos += '<div><br>' + obj.productosCompleto[i].nombre + ' x ' + obj.cantidad[i] + '</div>';
                            break;
                        case 'postres': postres += '<div><br>' + obj.productosCompleto[i].nombre + ' x ' + obj.cantidad[i] + '</div>';
                            break;
                        case 'bebidas': bebidas += '<div><br>' + obj.productosCompleto[i].nombre + ' x ' + obj.cantidad[i] + '</div>';
                            break;
                    }
                    // }
                }

                let formulario = `
                <form method="GET" action="http://127.0.0.1:8000/comanda/${obj.comanda.id}" class="">
                    <div class="card mb-3">
                        <div class="card-header">
                            <strong><img src="http://127.0.0.1:8000/images/mesa.png" alt=""> Mesa:</strong>
                            ${obj.comanda.mesa}
                            <span class="textoDerecha"><strong>
                                    <img class="orderList" src="http://127.0.0.1:8000/images/comanda.png">
                                    Nº Comanda:</strong>
                                    ${obj.comanda.id}</span>
                            <br><strong><i class="fa-solid fa-clock iconClock"></i></strong>
                            <span class="fechaFormateada">${hora}:${minutos}:${segundosFecha} - ${dia}/${mes}/${anio}</span>
                        </div>
                        <div class="card-body bodyComandas bodyComandasAbiertas">
                            <strong class="categoriaProducto">
                                <img class="iconIzquierda" src="http://127.0.0.1:8000/images/entrantes.png" alt="">
                                Entrantes:</strong>${entrantes}<br>
                            <strong class="categoriaProducto"> <img class="iconIzquierda"
                                    src="http://127.0.0.1:8000/images/primeros.png" alt="">
                                Primeros:</strong>${primeros}<br>
                            <strong class="categoriaProducto"> <img class="iconIzquierda"
                                    src="http://127.0.0.1:8000/images/segundos.png" alt="">
                                Segundos:</strong>${segundos}<br>
                            <strong class="categoriaProducto">
                                <i class="fa-solid fa-ice-cream"></i> Postres:
                            </strong>${postres}<br>
                            <strong class="categoriaProducto"><i class="fa-solid fa-wine-glass"></i>
                                Bebidas:</strong>${bebidas}<br>
                                ${comentarios}
                            <div class="row mb-1 mt-1 botonesComandas">
                                <div class="col-md-12 offset-md-3 mb-1 mt-1 justify-content-center">
                                    <button type="submit" class="btn btn-primary" name="editarComanda">
                                        Editar
                                    </button>
                                    <button type="submit" class="btn btn-danger">
                                        Cancelar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>`;

                $('form').each(function () {

                    if ($(this).attr('action') == `http://127.0.0.1:8000/comanda/${obj.comanda.id}`) {
                        $(this).remove();
                    }
                });


                $('#comandasAbiertas').append(formulario);

                quitarCategoriasProductosVacios();
            },
            error: function (xhr, status) {
                $('#notificacionEditarError').show().text('Se debe rellenar correctamente la comanda');
                $('.notificacionCrearComanda').delay(3000).fadeOut(3000);
                $('#spinEditarComanda').hide();
            },
        });

        $('option').each(function () {

            if ($(this).is(':selected') && $(this).val() != 0) {

                let valor = $(this).val();

                $('option').each(function () {

                    if ($(this).val() == valor && !$(this).attr('disabled', 'disabled')) {

                        $(this).attr('disabled', 'disabled');
                    }
                });
            }
        });

    });

    // FIN AJAX


    // INICIO AJAX

    $("#formCrearComanda").on('submit', function (e) {


        $('#spinCrearComanda').show();

        e.preventDefault();

        // $('input').each(function () {
        //     if ($(this).val() == '') {
        //         $(this).val(false);
        //     }
        // });


        $('option').each(function () {
            if ($(this).val() != 0) {
                $(this).removeAttr('disabled');
            }
        });

        $('select').each(function () {
            if ($(this).val() == 0) {
                $(this).val(null);
            }
        });

        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            beforeSend: function () {

            },
            success: function (resultado) {
                $('#notificacionCrearSuccess').show().text('Comanda creada correctamente');
                $('.notificacionCrearComanda').delay(3000).fadeOut(3000);
                $('#spinCrearComanda').hide();
                let obj = JSON.parse(resultado);

                let fecha = new Date(obj.comanda.created_at);
                let anio = fecha.getFullYear();
                let mes = fecha.getMonth() + 1;
                if (mes < 10) {
                    mes = '0' + mes;
                }
                let dia = fecha.getDate();
                let hora = fecha.getHours();
                let minutos = fecha.getMinutes();
                let segundosFecha = fecha.getSeconds();

                let entrantes = "";
                let primeros = "";
                let segundos = "";
                let postres = "";
                let bebidas = "";
                let comentarios = "";

                if (obj.comanda.comentarios == null) {

                    comentarios = "";
                } else {
                    comentarios = `<strong><i class='fa-solid fa-comment'></i> Comentarios: </strong> ${obj.comanda.comentarios} <br>`;
                }


                for (let i = 0; i < obj.productosCompleto.length; i++) {

                    // if (i == 0) {
                    //     switch (obj.productosCompleto[i].categoria) {
                    //         case 'entrantes': entrantes += '<br>' + obj.productosCompleto[i].nombre + ' x ' + obj.cantidad[i];
                    //             break;
                    //         case 'primeros': primeros += '<br>' + obj.productosCompleto[i].nombre + ' x ' + obj.cantidad[i];
                    //             break;
                    //         case 'segundos': segundos += '<strong>Segundos:</strong><br>' + obj.productosCompleto[i].nombre + ' x ' + obj.cantidad[i];
                    //             break;
                    //         case 'bebidas': bebidas += '<br>' + obj.productosCompleto[i].nombre + ' x ' + obj.cantidad[i];
                    //             break;
                    //         case 'postres': postres += '<br>' + obj.productosCompleto[i].nombre + ' x ' + obj.cantidad[i];
                    //             break;
                    //     }
                    // } else {

                    switch (obj.productosCompleto[i].categoria) {
                        case 'entrantes': entrantes += '<div><br>' + obj.productosCompleto[i].nombre + ' x ' + obj.cantidad[i] + '</div>';
                            break;
                        case 'primeros': primeros += '<div><br>' + obj.productosCompleto[i].nombre + ' x ' + obj.cantidad[i] + '</div>';
                            break;
                        case 'segundos': segundos += '<div><br>' + obj.productosCompleto[i].nombre + ' x ' + obj.cantidad[i] + '</div>';
                            break;
                        case 'postres': postres += '<div><br>' + obj.productosCompleto[i].nombre + ' x ' + obj.cantidad[i] + '</div>';
                            break;
                        case 'bebidas': bebidas += '<div><br>' + obj.productosCompleto[i].nombre + ' x ' + obj.cantidad[i] + '</div>';
                            break;
                    }
                    // }
                }

                let formulario = `
                <form method="GET" action="http://127.0.0.1:8000/comanda/${obj.comanda.id}" class="">
                    <div class="card mb-3">
                        <div class="card-header">
                            <strong><img src="http://127.0.0.1:8000/images/mesa.png" alt=""> Mesa:</strong>
                            ${obj.comanda.mesa}
                            <span class="textoDerecha"><strong>
                                    <img class="orderList" src="http://127.0.0.1:8000/images/comanda.png">
                                    Nº Comanda:</strong>
                                    ${obj.comanda.id}</span>
                            <br><strong><i class="fa-solid fa-clock iconClock"></i></strong>
                            <span class="fechaFormateada">${hora}:${minutos}:${segundosFecha} - ${dia}/${mes}/${anio}</span>
                        </div>
                        <div class="card-body bodyComandas bodyComandasAbiertas">
                            <strong class="categoriaProducto">
                                <img class="iconIzquierda" src="http://127.0.0.1:8000/images/entrantes.png" alt="">
                                Entrantes:</strong>${entrantes}<br>
                            <strong class="categoriaProducto"> <img class="iconIzquierda"
                                    src="http://127.0.0.1:8000/images/primeros.png" alt="">
                                Primeros:</strong>${primeros}<br>
                            <strong class="categoriaProducto"> <img class="iconIzquierda"
                                    src="http://127.0.0.1:8000/images/segundos.png" alt="">
                                Segundos:</strong>${segundos}<br>
                            <strong class="categoriaProducto">
                                <i class="fa-solid fa-ice-cream"></i> Postres:
                            </strong>${postres}<br>
                            <strong class="categoriaProducto"><i class="fa-solid fa-wine-glass"></i>
                                Bebidas:</strong>${bebidas}<br>
                                ${comentarios}
                            <div class="row mb-1 mt-1 botonesComandas">
                                <div class="col-md-12 offset-md-3 mb-1 mt-1 justify-content-center">
                                    <button type="submit" class="btn btn-primary" name="editarComanda">
                                        Editar
                                    </button>
                                    <button type="submit" class="btn btn-danger">
                                        Cancelar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>`;

                $('#comandasAbiertas').append(formulario);

                quitarCategoriasProductosVacios();
            },
            error: function (xhr, status) {
                $('#notificacionCrearError').show().text('Se debe rellenar correctamente la comanda');
                $('.notificacionCrearComanda').delay(3000).fadeOut(3000);
                $('#spinCrearComanda').hide();
            },
        });

        $('option').each(function () {

            if ($(this).is(':selected') && $(this).val() != 0) {

                let valor = $(this).val();

                $('option').each(function () {

                    if ($(this).val() == valor && !$(this).attr('disabled', 'disabled')) {

                        $(this).attr('disabled', 'disabled');
                    }
                });
            }
        });

    });

    // FIN AJAX



    // INICIO BOTON RESET COMANDA

    $('.btnResetComanda').on('click', function (e) {
        $('option').each(function () {
            $(this).attr('disabled', false);
        });
    });

    // FIN BOTON RESET COMANDA



    // INICIO FORMATEAR FECHA Y HORA

    $('.fechaFormateada').each(function () {
        let fecha = new Date($(this).text());

        let anio = fecha.getFullYear();
        let mes = fecha.getMonth() + 1;
        if (mes < 10) {
            mes = '0' + mes;
        }
        let dia = fecha.getDate();
        let hora = fecha.getHours();
        if (hora < 10) {
            hora = '0' + hora;
        }
        let minutos = fecha.getMinutes();
        if (minutos < 10) {
            minutos = '0' + minutos;
        }
        let segundosFecha = fecha.getSeconds();
        if (segundosFecha < 10) {
            segundosFecha = '0' + segundosFecha;
        }

        $(this).text(hora + ':' + minutos + ':' + segundosFecha + ' - ' + dia + '/' + mes + '/' + anio);
    });

    // FIN FORMATEAR FECHA Y HORA



    // INICIO BOTONES AGREGAR/QUITAR PRODUCTOS

    $('.botonMenos').on('click', function () {

        $('option').each(function () {

            if ($(this).is(':selected') && $(this).val() != 0) {

                let valor = $(this).val();

                $('option').each(function () {

                    if ($(this).val() == valor) {

                        $(this).removeAttr('disabled');
                    }
                });
            }
        });

        $(this).closest('.row').next('.nuevoProducto').remove();
        $(this).closest('.row').next('.nuevaCantidad').remove();
    });


    $('.botonMas').on('click', function () {

        let cantidad = "<div class='col-md-2 nuevaCantidad'> <input id='' min='1' type='number' class='form-control @error('cantidad') s-invalid @enderror' name='cantidad[]' value='{{ old('cantidad') }}' autocomplete='cantidad' autofocus> </div > ";

        let nuevoProducto = $(this).closest('.row').children('.inputProductos').clone().addClass('nuevoProducto');

        $(this).closest('.row').after(cantidad);
        $(this).closest('.row').after(nuevoProducto);

        $('option').each(function () {

            if ($(this).is(':selected') && $(this).val() != 0) {

                let valor = $(this).val();

                $('option').each(function () {

                    if ($(this).val() == valor && !$(this).attr('disabled', 'disabled')) {

                        $(this).attr('disabled', 'disabled');
                        // $(this).attr('selected', 'selected');
                    }
                });
            }
        });


    });

    function cambiar(borrado = null) {

        var valorAnterior;
        $("select").not('#registrarRol').on('focus', function () {
            valorAnterior = this.value;
        }).on('change', function () {

            let valor = $(this).val();

            $('option').each(function () {
                if ($(this).val() == valor) {
                    $(this).attr('disabled', 'disabled');
                    // $(this).attr("selected", "selected");
                }

                if ($(this).val() == valorAnterior) {
                    $(this).removeAttr('disabled');
                }
                // if (borrado != null) {
                //     if ($(this).val() == borrado) {
                //         $(this).removeAttr('disabled');
                //     }
                // }

            });
            valorAnterior = this.value;
        });
    }

    $("select").on('focus', function () {
        cambiar();

    });

    // FIN BOTONES AGREGAR/QUITAR PRODUCTOS



    // INICIO BOTONES OCULTAR COMANDAS

    let estadoBotonCrear = true;

    $('#ocultarCrear').on('click', function () {


        if (estadoBotonCrear == true) {

            $('#crearComanda').toggle(500);
            $('#ocultarCrear').animate({
                right: '-27px'

            }, 500);
            estadoBotonCrear = false;
        } else {
            $('#crearComanda').toggle(500);
            $('#ocultarCrear').animate({
                right: '-10px'

            }, 500);
            estadoBotonCrear = true;
        }
    });

    let estadoBotonAbiertas = true;

    $('#ocultarAbiertas').on('click', function () {


        if (estadoBotonAbiertas == true) {

            $('#comandasAbiertas').toggle(500);
            $('#ocultarAbiertas').animate({
                right: '-35px'

            }, 500);
            estadoBotonAbiertas = false;
        } else {
            $('#comandasAbiertas').toggle(500);
            $('#ocultarAbiertas').animate({
                right: '-19px'

            }, 500);
            estadoBotonAbiertas = true;
        }
    });

    let estadoBotonEnCurso = true;

    $('#ocultarEnCurso').on('click', function () {


        if (estadoBotonEnCurso == true) {

            $('#comandasEnCurso').toggle(500);
            $('#ocultarEnCurso').animate({
                right: '-37px'

            }, 500);
            estadoBotonEnCurso = false;
        } else {
            $('#comandasEnCurso').toggle(500);
            $('#ocultarEnCurso').animate({
                right: '-21px'

            }, 500);
            estadoBotonEnCurso = true;
        }
    });

    let estadoBotonCerradas = true;

    $('#ocultarCerradas').on('click', function () {


        if (estadoBotonCerradas == true) {

            $('#comandasCerradas').toggle(500);
            $('#ocultarCerradas').animate({
                right: '-37px'

            }, 500);
            estadoBotonCerradas = false;
        } else {
            $('#comandasCerradas').toggle(500);
            $('#ocultarCerradas').animate({
                right: '-21px'

            }, 500);
            estadoBotonCerradas = true;
        }
    });

    // FIN BOTONES OCULTAR COMANDAS   


    // INICIO ANIMACIÓN BOTONES AGREGAR/QUITAR PRODUCTOS

    $('.fa-circle-plus').on('click', function () {

        $(this).removeClass('fa-circle-plus');
        $(this).css('margin-top', '-1px');
        $(this).css('margin-left', '-12px');
        $(this).addClass('fa-circle-plus30');

        $boton = $(this);

        const myInterval = setInterval(myTimer, 200);

        function myTimer() {
            $boton.css('margin-top', '-1px');
            $boton.css('margin-left', '-10px');
            $boton.removeClass('fa-circle-plus30').addClass('fa-circle-plus');
            clearInterval(myInterval);
        }
    });

    $('.fa-circle-minus').on('click', function () {

        $(this).removeClass('fa-circle-minus');
        $(this).css('margin-top', '-1px');
        $(this).css('margin-left', '-12px');
        $(this).addClass('fa-circle-minus30');

        $boton = $(this);

        const myInterval = setInterval(myTimer, 200);

        function myTimer() {
            $boton.css('margin-top', '-1px');
            $boton.css('margin-left', '-10px');
            $boton.removeClass('fa-circle-minus30').addClass('fa-circle-minus');
            clearInterval(myInterval);
        }
    });

    // FIN ANIMACIÓN BOTONES AGREGAR/QUITAR PRODUCTOS


    // INICIO ANCHORS COMANDAS

    $('#botonCrear').on('click', function () {
        location.href = '#crearComanda';
    });

    $('#botonAbiertas').on('click', function () {
        location.href = '#comandasAbiertas';
    });

    $('#botonCurso').on('click', function () {
        location.href = '#comandasEnCurso';
    });

    $('#botonCerradas').on('click', function () {
        location.href = '#comandasCerradas';
    });

    // FIN ANCHORS COMANDAS


    // INICIO OCULTAR ELEMENTOS

    $('.notificacionCrearComanda').hide();
    $('.fa-spin').hide();

    // FIN OUCLTAR ELEMENTOS


    // INICIO ANIMACIÓN QUITAR NOTIFICACIÓN COMANDA CREADA

    $('.notificacionCrearComanda').delay(3000).fadeOut(3000);

    // FIN ANIMACIÓN QUITAR NOTIFICACIÓN COMANDA CREADA

    // INICIO QUITAR CATEGORIAS PRODUCTOS VACÍOS

    function quitarCategoriasProductosVacios() {

        $('.categoriaProducto').each(function () {
            // alert($(this).next().prop('nodeName'));

            if ($(this).next().is('BR')) {
                $(this).remove();
                $(this).next().remove();
            }

            $('br').each(function () {
                if ($(this).next().is('BR')) {
                    $(this).remove();
                }
            });
        });

    }

    quitarCategoriasProductosVacios();

    // FIN QUITAR CATEGORIAS PRODUCTOS VACÍOS




    $('#botonCrearComanda').on('click', function () {
        $('option').each(function () {
            if ($(this).val() != 0) {
                $(this).removeAttr('disabled');
            }
        });
        $('select').each(function () {
            if ($(this).val() == 0) {
                $(this).val(null);
            }
        });
    });
});