



$(function () {

    // INICIO HABILITAR BOTON FINALIZAR

    function habilitarBotonFinalizar() {

        $('form').each(function () {

            let cantidadProductosTerminados = $(this).find('input[type=checkbox]:checked').length;

            let cantidadProductos = $(this).find('input[type=checkbox]').length;

            if (cantidadProductosTerminados == cantidadProductos) {

                $(this).find('.botonFinalizarComanda').removeClass('disabled');
            } else {
                $(this).find('.botonFinalizarComanda').addClass('disabled');
            }
        });
    }

    habilitarBotonFinalizar();

    // FIN HABILITAR BOTON FINALIZAR



    // INICIO COMPLETAR PRODUCTOS

    function completarProductos() {

        $('input:checkbox').on('change', function () {

            let estadoProducto = 0;
            let comandasProductosID = $(this).val();

            if ($(this).is(':checked')) {
                $(this).next().addClass('tachado');
                estadoProducto = 1;
            } else {
                $(this).next().removeClass('tachado');
            }

            let url = $(this).closest('form').attr('action');

            let urlProducto = url + `/${comandasProductosID}/${estadoProducto}`

            $.ajax({
                url: urlProducto,
                type: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function () {
                    habilitarBotonFinalizar();
                    $('.notificacionEditarProducto').each(function () {
                        if ($(this).closest('form').attr('action') == url) {
                            $(this).hide();
                        }
                    });
                },
                error: function (xhr, status) {

                    let audio = document.createElement("audio");
                    audio.src = "http://127.0.0.1:8000/sounds/errorComanda.wav";
                    audio.play();

                    $('.notificacionEditarProducto').each(function () {
                        if ($(this).closest('form').attr('action') == url) {
                            $(this).show();
                        }
                    });
                },
            });
        });
    }

    completarProductos();

    // FIN COMPLETAR PRODUCTOS



    // INICIO FINALIZAR COMANDA

    function finalizarComanda(url, cardBorrar) {

        $('.botonFinalizar').on('click', function (e) {

            let boton = $(this);

            $('#spinFinalizarComanda').show();

            let urlEstado = "";
            let estadoComanda = "";

            estadoComanda = '/cerrada';

            urlEstado = url + estadoComanda;

            $.ajax({

                url: urlEstado,
                type: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (resultado) {

                    let audio = document.createElement("audio");
                    audio.src = "http://127.0.0.1:8000/sounds/finalizarComanda.wav";
                    audio.play();

                    boton.attr('disabled', 'disabled');

                    $('#spinFinalizarComanda').hide();

                    $('#notificacionCancelarSuccess').show();

                    $.ajax({

                        type: "GET",
                        url: url,
                        success: function (resultado) {

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

                            for (let i = 0; i < obj.productosComanda.length; i++) {

                                switch (obj.productosComanda[i].categoria) {
                                    case 'entrantes': entrantes += '<div><br>' + obj.productosComanda[i].nombre + ' x ' + obj.productosComanda[i].cantidad + '</div>';
                                        break;
                                    case 'primeros': primeros += '<div><br>' + obj.productosComanda[i].nombre + ' x ' + obj.productosComanda[i].cantidad + '</div>';
                                        break;
                                    case 'segundos': segundos += '<div><br>' + obj.productosComanda[i].nombre + ' x ' + obj.productosComanda[i].cantidad + '</div>';
                                        break;
                                    case 'postres': postres += '<div><br>' + obj.productosComanda[i].nombre + ' x ' + obj.productosComanda[i].cantidad + '</div>';
                                        break;
                                    case 'bebidas': bebidas += '<div><br>' + obj.productosComanda[i].nombre + ' x ' + obj.productosComanda[i].cantidad + '</div>';
                                        break;
                                }
                            }

                            if (obj.comanda.estado == 'en curso') {
                                estado = 'bodyComandasEnCurso'
                            } else {
                                estado = 'bodyComandasCerradas'
                            }

                            let formulario = `
                        <form method="GET" action="http://127.0.0.1:8000/comanda/${obj.comanda.id}" class="formShowComanda" >
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
                                <div class="card-body bodyComandas ${estado}">`

                            if (entrantes != "") {
                                formulario += `
                                    <strong class="categoriaProducto">
                                        <img class="iconIzquierda" src="http://127.0.0.1:8000/images/entrantes.png" alt="">
                                        Entrantes:</strong>${entrantes}<br>`

                            }
                            if (primeros != "") {
                                formulario += `
                                    <strong class="categoriaProducto"> 
                                        <img class="iconIzquierda" src="http://127.0.0.1:8000/images/primeros.png" alt="">
                                        Primeros:</strong>${primeros} <br>`
                            }
                            if (segundos != "") {
                                formulario += `
                                    <strong class="categoriaProducto">
                                        <img class="iconIzquierda" src="http://127.0.0.1:8000/images/segundos.png" alt="">
                                        Segundos:</strong>${segundos}<br>`
                            }
                            if (postres != "") {
                                formulario += `
                            <strong class="categoriaProducto">
                                <i class="fa-solid fa-ice-cream"></i> Postres: </strong>${postres} <br>`
                            }
                            if (bebidas != "") {
                                formulario += `
                            <strong class="categoriaProducto"><i class="fa-solid fa-wine-glass"></i>
                                Bebidas:</strong>${bebidas}<br>`
                            }
                            if (comentarios != "") {
                                formulario += `
                            ${comentarios}`
                            }

                            cardBorrar.fadeOut(2000, function () {
                                $('#comandasCerradas').append(formulario);
                            });


                        },
                        error: function (xhr, status) {

                            let audio = document.createElement("audio");
                            audio.src = "http://127.0.0.1:8000/sounds/errorComanda.wav";
                            audio.play();

                            $('#notificacionEditarError').show().text('No se pudo actualizar correctamente la comanda');
                            $('.notificacionCrearComanda').delay(2000).fadeOut(2000);
                            $('#spinEditarComanda').hide();
                        },
                    });
                }
            });

        });
    }

    // FIN FINALIZAR COMANDA



    // INICIO SHOW FINALIZAR COMANDA

    function showFinalizarComanda() {

        $('.botonFinalizarComanda').each(function (e) {

            $(this).on('click', function (e) {

                $('#finalizarComandaContent').empty();

                let url = $(this).closest('form').attr('action');
                let cardBorrar = $(this).closest('form');

                let id = "";

                for (let i = url.length - 1; i >= 0; i--) {
                    if (url[i] != '/') {
                        id += url[i];
                    } else {
                        break;
                    }
                }

                id = id.split('').reverse().join('');

                let formulario = `

                    <div class="col-md-auto" id="crearComanda">
                        <div class="card cardCrear cardEditar" id="cardCrear">
                            <div class="card-header">
                                <h6 class="" id="tituloFinalizarComanda"><i class="fa-solid fa-check-double"></i> Finalizar Comanda</h6>
                            </div>
                            <div class="card-body" id="bodyCrearComanda">         

                                <h6 style="display:none" class="alert alert-success notificacionCrearComanda" id="notificacionCancelarSuccess">Comanda Finalizada correctamente</h6>

                                <h6 style="display:none" class="alert alert-danger notificacionCrearComanda mb-3" id="notificacionCancelarError">Ha habido un fallo a la hora de asignar en curso la comanda</h6>

                                <div class="row justify-content-center">
                                    <i class="fas fa-spinner fa-spin text-center" id="spinFinalizarComanda" style="display:none!important"></i>
                                </div>                                        
                                
                                <div class="row mb-1 mt-1 botonesCancelarComandas">
                                    <div class="col-md-12 mb-1 mt-1 justify-content-center ">
                                        <div class="justify-content-center">
                                            ¿Deseas finalizar la comnada <img class="orderList" src="http://127.0.0.1:8000/images/comanda.png"> Nº <strong>${id}</strong>? 
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-success botonFinalizar enCurso">
                                                Finalizar
                                            </button>
                                            <button type="submit" class="btn btn-secondary botonShowComanda" name="showComanda"  data-bs-dismiss="modal">
                                                Cerrar
                                            </button>
                                        </div>
                                    </div>
                                </div>                                       
                            </div>
                        </div>
                    </div>`;

                $('#finalizarComandaContent').append(formulario);

                finalizarComanda(url, cardBorrar);
            });

        });
    }

    showFinalizarComanda();

    // FIN SHOW FINALIZAR COMANDA



    // INICIO COCINAR COMANDA

    function cocinarComanda(url, cardBorrar) {

        $('.botonCocinar').on('click', function (e) {

            let boton = $(this);

            $('#spinCancelComanda').show();

            let urlEstado = "";
            let estadoComanda = "";

            estadoComanda = '/curso';

            urlEstado = url + estadoComanda;

            $.ajax({
                url: urlEstado,
                type: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (resultado) {

                    let audio = document.createElement("audio");
                    audio.src = "http://127.0.0.1:8000/sounds/cocinarComanda.wav";
                    audio.play();

                    boton.attr('disabled', 'disabled');

                    $('#spinCancelComanda').hide();

                    $('#notificacionCancelarSuccess').show();

                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function (resultado) {

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

                            for (let i = 0; i < obj.productosComanda.length; i++) {

                                switch (obj.productosComanda[i].categoria) {
                                    case 'entrantes': entrantes += `<div><br><input class='form-check-input' type='checkbox' value='${obj.comandasProductos[i].id}' id='flexCheckDefault'> <span>` + obj.productosComanda[i].nombre + ' x ' + obj.productosComanda[i].cantidad + "</span></div>";
                                        break;

                                    case 'primeros': primeros += `<div><br><input class='form-check-input' type='checkbox' value='${obj.comandasProductos[i].id}' id='flexCheckDefault'> <span>` + obj.productosComanda[i].nombre + ' x ' + obj.productosComanda[i].cantidad + "</span></div>";
                                        break;
                                    case 'segundos': segundos += `<div><br><input class='form-check-input' type='checkbox' value='${obj.comandasProductos[i].id}' id='flexCheckDefault'> <span>` + obj.productosComanda[i].nombre + ' x ' + obj.productosComanda[i].cantidad + "</span></div>";
                                        break;
                                    case 'postres': postres += `<div><br><input class='form-check-input' type='checkbox' value='${obj.comandasProductos[i].id}' id='flexCheckDefault'> <span>` + obj.productosComanda[i].nombre + ' x ' + obj.productosComanda[i].cantidad + "</span></div>";
                                        break;
                                    case 'bebidas': bebidas += `<div><br><input class='form-check-input' type='checkbox' value='${obj.comandasProductos[i].id}' id='flexCheckDefault'> <span>` + obj.productosComanda[i].nombre + ' x ' + obj.productosComanda[i].cantidad + "</span></div>";
                                        break;
                                }
                            }

                            estado = 'bodyComandasEnCurso'

                            let formulario = `
                            <form method="GET" action="http://127.0.0.1:8000/comanda/${obj.comanda.id}" class="formShowComanda" >
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h6 class="alert alert-danger notificacionEditarProducto mb-3" style="display: none"
                                            id="notificacionCrearError">Error al
                                            actualizar el producto
                                        </h6>
                                        <strong><img src="http://127.0.0.1:8000/images/mesa.png" alt=""> Mesa:</strong>
                                        ${obj.comanda.mesa}
                                        <span class="textoDerecha"><strong>
                                                <img class="orderList" src="http://127.0.0.1:8000/images/comanda.png">
                                                Nº Comanda:</strong>
                                                ${obj.comanda.id}</span>
                                        <br><strong><i class="fa-solid fa-clock iconClock"></i></strong>
                                        <span class="fechaFormateada">${hora}:${minutos}:${segundosFecha} - ${dia}/${mes}/${anio}</span>
                                    </div>
                                    <div class="card-body bodyComandas ${estado}">`

                            if (entrantes != "") {
                                formulario += `
                                        <strong class="categoriaProducto">
                                            <img class="iconIzquierda" src="http://127.0.0.1:8000/images/entrantes.png" alt="">
                                            Entrantes:</strong>${entrantes}<br>`

                            }
                            if (primeros != "") {
                                formulario += `
                                        <strong class="categoriaProducto"> 
                                            <img class="iconIzquierda" src="http://127.0.0.1:8000/images/primeros.png" alt="">
                                            Primeros:</strong>${primeros} <br>`
                            }
                            if (segundos != "") {
                                formulario += `
                                        <strong class="categoriaProducto">
                                            <img class="iconIzquierda" src="http://127.0.0.1:8000/images/segundos.png" alt="">
                                            Segundos:</strong>${segundos}<br>`
                            }
                            if (postres != "") {
                                formulario += `
                                <strong class="categoriaProducto">
                                    <i class="fa-solid fa-ice-cream"></i> Postres: </strong>${postres} <br>`
                            }
                            if (bebidas != "") {
                                formulario += `
                                <strong class="categoriaProducto"><i class="fa-solid fa-wine-glass"></i>
                                    Bebidas:</strong>${bebidas}<br>`
                            }
                            if (comentarios != "") {
                                formulario += `
                                ${comentarios}`
                            }
                            formulario += `
                                        <div class="row mb-1 mt-1 botonesComandas">
                                            <div class="col-md-12 offset-md-3 mb-1 mt-1 justify-content-center">
                                                <button type="submit" class="btn btn-success botonFinalizarComanda"
                                                    data-bs-toggle="modal" data-bs-target="#finalizarComanda">
                                                    Finalizar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form > `;

                            cardBorrar.fadeOut(2000, function () {
                                showFinalizarComanda();
                                formShowComanda();
                                completarProductos();
                                habilitarBotonFinalizar();
                            });

                            cardBorrar.remove();

                            $('#comandasEnCurso').append(formulario).fadeIn(2000);

                            $('form').each(function () {
                                if ($(this).attr('action') == `http://127.0.0.1:8000/comanda/${obj.comanda.id}`) {
                                    $(this).hide();
                                    $(this).fadeIn(2000);
                                }
                            });
                        },
                        error: function (xhr, status) {

                            let audio = document.createElement("audio");
                            audio.src = "http://127.0.0.1:8000/sounds/errorComanda.wav";
                            audio.play();

                            $('#notificacionEditarError').show().text('No se pudo actualizar correctamente la comanda');
                            $('.notificacionCrearComanda').delay(2000).fadeOut(2000);
                            $('#spinEditarComanda').hide();
                        },
                    });
                }
            });
        });
    }

    // FIN COCINAR COMANDA


    // INICIO SHOW COCINAR COMANDA

    function showCocinarComanda() {

        $('.botonCocinarComanda').each(function () {

            $(this).on('click', function () {

                $('#cocinarComandaContent').empty();

                let url = $(this).closest('form').attr('action');
                let cardBorrar = $(this).closest('form');

                let id = "";

                for (let i = url.length - 1; i >= 0; i--) {
                    if (url[i] != '/') {
                        id += url[i];
                    } else {
                        break;
                    }
                }

                id = id.split('').reverse().join('');

                let formulario = `

                    <div class="col-md-auto" id="crearComanda">
                        <div class="card cardCrear cardEditar" id="cardCrear">
                            <div class="card-header">
                                <h6 class="" id="tituloCocinarComanda"><i class="fa-solid fa-fire-burner"></i> Cocinar Comanda</h6>
                            </div>
                            <div class="card-body" id="bodyCrearComanda">         

                                <h6 style="display:none" class="alert alert-success notificacionCrearComanda" id="notificacionCancelarSuccess">Comanda asignada En Curso correctamente</h6>

                                <h6 style="display:none" class="alert alert-danger notificacionCrearComanda mb-3" id="notificacionCancelarError">Ha habido un fallo a la hora de asignar en curso la comanda</h6>

                                <div class="row justify-content-center">
                                    <i class="fas fa-spinner fa-spin text-center" id="spinCancelComanda" style="display:none!important"></i>
                                </div>                                        
                                
                                <div class="row mb-1 mt-1 botonesCancelarComandas">
                                    <div class="col-md-12 mb-1 mt-1 justify-content-center ">
                                        <div class="justify-content-center">
                                            ¿Deseas cocinar la comnada <img class="orderList" src="http://127.0.0.1:8000/images/comanda.png"> Nº <strong>${id}</strong>? 
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-primary botonCocinar abierta">
                                                Cocinar
                                            </button>
                                            <button type="submit" class="btn btn-secondary botonShowComanda" name="showComanda"  data-bs-dismiss="modal">
                                                Cerrar
                                            </button>
                                        </div>
                                    </div>
                                </div>                                       
                            </div>
                        </div>
                    </div>`;

                $('#cocinarComandaContent').append(formulario);

                cocinarComanda(url, cardBorrar);
            });
        });
    }

    showCocinarComanda();

    // FIN SHOW COCINAR COMANDA



    // INICIO SHOW CANCELAR COMANDA

    function showCancelarComanda() {

        $('.botonShowCancelar').each(function () {

            $(this).on('click', function () {

                $('#cancelComandaContent').empty();

                let url = $(this).closest('form').attr('action');
                let cardBorrar = $(this).closest('form');

                let id = "";

                for (let i = url.length - 1; i >= 0; i--) {
                    if (url[i] != '/') {
                        id += url[i];
                    } else {
                        break;
                    }
                }

                id = id.split('').reverse().join('');

                let formulario = `

                    <div class="col-md-auto" id="crearComanda">
                        <div class="card cardCrear cardEditar" id="cardCrear">
                            <div class="card-header">
                                <h6 class="" id="tituloCancelarComanda"><i class="fa-solid fa-ban"></i> Cancelar Comanda</h6>
                            </div>
                            <div class="card-body" id="bodyCrearComanda">         

                                <h6 style="display:none" class="alert alert-success notificacionCrearComanda" id="notificacionCancelarSuccess">Comanda cancelada correctamente</h6>

                                <h6 style="display:none" class="alert alert-danger notificacionCrearComanda mb-3" id="notificacionCancelarError">Ha habido un fallo a la hora de cancelar la comanda</h6>

                                <div class="row justify-content-center">
                                    <i class="fas fa-spinner fa-spin text-center" id="spinCancelComanda" style="display:none!important"></i>
                                </div>                                        
                                
                                <div class="row mb-1 mt-1 botonesCancelarComandas">
                                    <div class="col-md-12 mb-1 mt-1 justify-content-center ">
                                        <div class="justify-content-center">
                                            ¿Deseas cancelar la comnada <img class="orderList" src="http://127.0.0.1:8000/images/comanda.png"> Nº <strong>${id}</strong>? 
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-danger botonCancelar">
                                                Cancelar
                                            </button>
                                            <button type="submit" class="btn btn-secondary botonShowComanda" name="showComanda"  data-bs-dismiss="modal">
                                                Cerrar
                                            </button>
                                        </div>
                                    </div>
                                </div>                                       
                            </div>
                        </div>
                    </div>`;

                $('#cancelComandaContent').append(formulario);

                cancelarComanda(url, cardBorrar);
            });

        });
    }

    showCancelarComanda();

    // FIN SHOW CANCELAR COMANDA


    // INICIO CANCELAR COMANDA

    function cancelarComanda(url, cardBorrar) {

        $('.botonCancelar').on('click', function () {

            let boton = $(this);
            $('#spinCancelComanda').show();

            $.ajax({

                url: url,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (resultado) {

                    let audio = document.createElement("audio");
                    audio.src = "http://127.0.0.1:8000/sounds/cancelarComanda.wav";
                    audio.play();

                    boton.attr('disabled', 'disabled');

                    $('#spinCancelComanda').hide();

                    $('#notificacionCancelarSuccess').show();
                    $('#notificacionCancelarSuccess').fadeOut(2000);

                    cardBorrar.fadeOut(2000);

                }
            });
        });
    }

    // FIN CANCELAR COMANDA


    // INICIO AJAX SHOW COMANDA

    function formShowComanda() {

        $(".formShowComanda").on('submit', function (e) {

            e.preventDefault();

            $('#spinEditarComanda').show();

            $('option').each(function () {
                if ($(this).val() != 0) {
                    $(this).removeAttr('disabled');
                }
            });

            var form = $(this);
            var url = form.attr('action');

            $.ajax({

                type: "GET",
                url: url,
                data: form.serialize(),
                beforeSend: function () {

                },
                success: function (resultado) {

                    let obj = JSON.parse(resultado);

                    $('#showComandaContent').empty();

                    let fecha = new Date(obj.comanda.created_at);
                    let anio = fecha.getFullYear();
                    let mes = fecha.getMonth() + 1;
                    if (mes < 10) {
                        mes = '0' + mes;
                    }
                    let dia = fecha.getDate();
                    if (dia < 10) {
                        dia = '0' + dia;
                    }
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

                    let entrantes = "";
                    let primeros = "";
                    let segundos = "";
                    let postres = "";
                    let bebidas = "";
                    let comentarios = "";
                    let estado = "";

                    if (obj.comanda.comentarios == null) {

                        comentarios = "";
                    } else {
                        comentarios = obj.comanda.comentarios;
                    }

                    let arrayPrimeros = $.map(obj.primeros, function (value, index) {
                        return [value];
                    });

                    let arraySegundos = $.map(obj.segundos, function (value, index) {
                        return [value];
                    });

                    let arrayPostres = $.map(obj.postres, function (value, index) {
                        return [value];
                    });

                    let arrayBebidas = $.map(obj.bebidas, function (value, index) {
                        return [value];
                    });


                    for (let i = 0; i < obj.entrantes.length; i++) {
                        entrantes += `<option value="${obj.entrantes[i].id}">${obj.entrantes[i].nombre}</option>`;
                    }
                    for (let i = 0; i < arrayPrimeros.length; i++) {
                        primeros += `<option value="${arrayPrimeros[i].id}">${arrayPrimeros[i].nombre}</option>`;
                    }
                    for (let i = 0; i < arraySegundos.length; i++) {
                        segundos += `<option value="${arraySegundos[i].id}">${arraySegundos[i].nombre}</option>`;
                    }
                    for (let i = 0; i < arrayPostres.length; i++) {
                        postres += `<option value="${arrayPostres[i].id}">${arrayPostres[i].nombre}</option>`;
                    }
                    for (let i = 0; i < arrayBebidas.length; i++) {
                        bebidas += `<option value="${arrayBebidas[i].id}">${arrayBebidas[i].nombre}</option>`;
                    }

                    let entrantesComanda = "";
                    let primerosComanda = "";
                    let segundosComanda = "";
                    let postresComanda = "";
                    let bebidasComanda = "";

                    for (let i = 0; i < obj.productosComanda.length; i++) {

                        if (obj.productosComanda[i].categoria == 'entrantes') {

                            entrantesComanda +=
                                `<div class="col-md-5 inputProductos nuevoProducto nuevoProductoEditar" id="colEntrantes">
                                    <select id="selectEntrantes" name="productos[]" class="form-control">
                                        <option value="0" >Elige un entrante</option>`;

                            for (let j = 0; j < obj.entrantes.length; j++) {

                                entrantesComanda += `<option value="${obj.entrantes[j].id}" `;
                                if (obj.entrantes[j].nombre == obj.productosComanda[i].nombre) {
                                    entrantesComanda += ` selected `;
                                }
                                entrantesComanda += `>${obj.entrantes[j].nombre}</option>`;
                            }

                            entrantesComanda +=
                                `</select>
                                </div>
                                <div class="col-md-2 nuevaCantidad">
                                    <input id="" min="1" type="number"
                                        class="form-control"
                                        name="cantidad[]" value="${obj.productosComanda[i].cantidad}" autofocus>                                
                                </div>`;
                        }
                    }

                    for (let i = 0; i < obj.productosComanda.length; i++) {

                        if (obj.productosComanda[i].categoria == 'primeros') {

                            primerosComanda +=
                                `<div class="col-md-5 inputProductos nuevoProducto nuevoProductoEditar" id="colPrimeros">
                                    <select id="selectPrimeros" name="productos[]" class="form-control">
                                        <option value="0" >Elige un primero</option>`;

                            for (let j = 0; j < arrayPrimeros.length; j++) {

                                primerosComanda += `<option value="${arrayPrimeros[j].id}" `;
                                if (arrayPrimeros[j].nombre == obj.productosComanda[i].nombre) {
                                    primerosComanda += ` selected `;
                                }
                                primerosComanda += `>${arrayPrimeros[j].nombre}</option>`;
                            }

                            primerosComanda +=
                                `</select>
                                </div>
                                <div class="col-md-2 nuevaCantidad">
                                    <input id="" min="1" type="number"
                                        class="form-control"
                                        name="cantidad[]" value="${obj.productosComanda[i].cantidad}" autofocus>                                
                                </div>`;
                        }
                    }

                    for (let i = 0; i < obj.productosComanda.length; i++) {

                        if (obj.productosComanda[i].categoria == 'segundos') {

                            segundosComanda +=
                                `<div class="col-md-5 inputProductos nuevoProducto nuevoProductoEditar" id="colSegundos">
                                    <select id="selectSegundos" name="productos[]" class="form-control">
                                        <option value="0" >Elige un segundo</option>`;

                            for (let j = 0; j < arraySegundos.length; j++) {

                                segundosComanda += `<option value="${arraySegundos[j].id}" `;
                                if (arraySegundos[j].nombre == obj.productosComanda[i].nombre) {
                                    segundosComanda += ` selected `;
                                }
                                segundosComanda += `>${arraySegundos[j].nombre}</option>`;
                            }

                            segundosComanda +=
                                `</select>
                                </div>
                                <div class="col-md-2 nuevaCantidad">
                                    <input id="" min="1" type="number"
                                        class="form-control"
                                        name="cantidad[]" value="${obj.productosComanda[i].cantidad}" autofocus>                                
                                </div>`;
                        }
                    }

                    for (let i = 0; i < obj.productosComanda.length; i++) {

                        if (obj.productosComanda[i].categoria == 'postres') {

                            postresComanda +=
                                `<div class="col-md-5 inputProductos nuevoProducto nuevoProductoEditar" id="colPostres">
                                    <select id="selectPostres" name="productos[]" class="form-control">
                                        <option value="0" >Elige un postre</option>`;

                            for (let j = 0; j < arrayPostres.length; j++) {

                                postresComanda += `<option value="${arrayPostres[j].id}" `;
                                if (arrayPostres[j].nombre == obj.productosComanda[i].nombre) {
                                    postresComanda += ` selected `;
                                }
                                postresComanda += `>${arrayPostres[j].nombre}</option>`;
                            }

                            postresComanda +=
                                `</select>
                                </div>
                                <div class="col-md-2 nuevaCantidad">
                                    <input id="" min="1" type="number"
                                        class="form-control"
                                        name="cantidad[]" value="${obj.productosComanda[i].cantidad}" autofocus>                                
                                </div>`;
                        }
                    }

                    for (let i = 0; i < obj.productosComanda.length; i++) {

                        if (obj.productosComanda[i].categoria == 'bebidas') {

                            bebidasComanda +=
                                `<div class="col-md-5 inputProductos nuevoProducto nuevoProductoEditar" id="colBebidas">
                                    <select id="selectBebidas" name="productos[]" class="form-control">
                                        <option value="0" >Elige un postre</option>`;

                            for (let j = 0; j < arrayBebidas.length; j++) {

                                bebidasComanda += `<option value="${arrayBebidas[j].id}" `;
                                if (arrayBebidas[j].nombre == obj.productosComanda[i].nombre) {
                                    bebidasComanda += ` selected `;
                                }
                                bebidasComanda += `>${arrayBebidas[j].nombre}</option>`;
                            }

                            bebidasComanda +=
                                `</select>
                                </div>
                                <div class="col-md-2 nuevaCantidad">
                                    <input id="" min="1" type="number"
                                        class="form-control"
                                        name="cantidad[]" value="${obj.productosComanda[i].cantidad}" autofocus>                                
                                </div>`;
                        }
                    }

                    let formulario = `
                        <div class="col-md-auto" id="crearComanda">
                            <div class="card cardCrear cardEditar" id="cardCrear">
                                <div class="card-header">
                                    <h6 class="" id="tituloCrearComanda"><i class="fa-solid fa-pen-to-square"></i> Editar Comanda</h6>
                                </div>
                                <div class="card-body" id="bodyCrearComanda">                                    
                                    <h6 style="display:none" class="alert alert-success notificacionSucces"></h6>
                                    <h6 style="display:none" class="alert alert-success notificacionCrearComanda" id="notificacionEditarSuccess"></h6>
                                    <h6 style="display:none" class="alert alert-danger notificacionCrearComanda mb-3" id="notificacionEditarError"></h6>
                                    <div  class="row justify-content-center ">
                                        <i style="display:none" class="fas fa-spinner fa-spin text-center" id="spinEditarComanda"></i>
                                    </div>

                                    <form  method="POST" action="http://127.0.0.1:8000/comanda/${obj.comanda.id}" class="" id="formEditarComanda">
                                        
                                        <strong><i class="fa-solid fa-clock iconClock"></i></strong>
                                        <span class="fechaFormateada">${hora}:${minutos}:${segundosFecha} - ${dia}/${mes}/${anio}</span>
                                        <span class="textoDerecha"><img class="orderList" src="http://127.0.0.1:8000/images/comanda.png">
                                        <strong>Nº Comanda: </strong>${obj.comanda.id}</span>
                                        <p></p>

                                        <div class="row mb-4">
                                            <label for="mesa" class="col-md-9 col-form-label text-md-start"><strong>
                                                    <img src="http://127.0.0.1:8000/images/mesa.png" alt="">
                                                    Nº Mesa </strong></label>

                                            <div class="col-md-2 cantidad numeroMesa">
                                                <input id="mesa" min="1" max="6" type="number"
                                                    class="form-control" name="mesa" required
                                                    autocomplete="mesa" autofocus value="${obj.comanda.mesa}">                                    
                                            </div>
                                        </div>    

                                        <div class="row mb-3" id="rowEntrantes">
                                            <label for="entrantes" id="labelEntrantes" class="col-md-3 col-form-label text-md-start"><strong><img class="iconIzquierda" src="http://127.0.0.1:8000/images/entrantes.png" alt=""> Entrantes</strong></label>

                                            <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMas botonMasEditar">
                                                <i class="fa-solid fa-circle-plus botonRedondo" id="botonAgregarEntrante"></i>
                                            </button>
                                            <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMenos">
                                                <i class="fa-solid fa-circle-minus botonRedondo" id="botonQuitarEntrante"></i>
                                            </button>

                                            <div class="col-md-5 inputProductos" id="colEntrantes">
                                                <select id="selectEntrantes" name="productos[]" class="form-control">
                                                    <option value="0" selected>Elige un entrante</option>
                                                    ${entrantes}
                                                </select>
                                            </div>

                                            <div class="col-md-2 cantidad">
                                                <input id="" min="1" type="number" class="form-control" name="cantidad[]" autofocus>                                    
                                            </div>
                                        </div>

                                        ${entrantesComanda}

                                        <div class="row mb-3" id="rowPrimeros">
                                            <label for="primeros" id="labelPrimeros" class="col-md-3 col-form-label text-md-start"><strong><img class="iconIzquierda" src="http://127.0.0.1:8000/images/primeros.png" alt=""> Primeros</strong></label>

                                            <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMas botonMasEditar">
                                                <i class="fa-solid fa-circle-plus botonRedondo" id="botonAgregarEntrante"></i>
                                            </button>
                                            <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMenos">
                                                <i class="fa-solid fa-circle-minus botonRedondo" id="botonQuitarEntrante"></i>
                                            </button>

                                            <div class="col-md-5 inputProductos" id="colPrimeros">
                                                <select id="selectPrimeros" name="productos[]"
                                                    class="form-control">
                                                    <option value="0" selected>Elige un primero</option>
                                                    ${primeros}
                                                </select>
                                            </div>

                                            <div class="col-md-2 cantidad">
                                                <input id="" min="1" type="number" class="form-control" name="cantidad[]" autofocus>                                    
                                            </div>
                                        </div>

                                        ${primerosComanda}

                                        <div class="row mb-3" id="rowSegundos">
                                            <label for="segundos" id="labelSegundos" class="col-md-3 col-form-label text-md-start"><strong><img class="iconIzquierda" src="http://127.0.0.1:8000/images/segundos.png" alt=""> Segundos</strong></label>

                                            <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMas botonMasEditar">
                                                <i class="fa-solid fa-circle-plus botonRedondo" id="botonAgregarSegundo"></i>
                                            </button>
                                            <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMenos">
                                                <i class="fa-solid fa-circle-minus botonRedondo" id="botonQuitarSegundo"></i>
                                            </button>

                                            <div class="col-md-5 inputProductos" id="colSegundos">
                                                <select id="selectsegundos" name="productos[]" class="form-control">
                                                    <option value="0" selected>Elige un segundo</option>
                                                    ${segundos}
                                                </select>
                                            </div>

                                            <div class="col-md-2 cantidad">
                                                <input id="" min="1" type="number" class="form-control" name="cantidad[]" autofocus>                                    
                                            </div>
                                        </div>

                                        ${segundosComanda}

                                        <div class="row mb-3" id="rowPostres">
                                            <label for="postres" id="labelPostres" class="col-md-3 col-form-label text-md-start"><strong><i class="fa-solid fa-ice-cream"></i> Postres</strong></label>

                                            <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMas botonMasEditar">
                                                <i class="fa-solid fa-circle-plus botonRedondo" id="botonAgregarPostre"></i>
                                            </button>
                                            <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMenos">
                                                <i class="fa-solid fa-circle-minus botonRedondo" id="botonQuitarPostre"></i>
                                            </button>

                                            <div class="col-md-5 inputProductos" id="colPostres">
                                                <select id="selectPostres" name="productos[]" class="form-control">
                                                    <option value="0" selected>Elige un postre</option>
                                                    ${postres}
                                                </select>
                                            </div>

                                            <div class="col-md-2 cantidad">
                                                <input id="" min="1" type="number" class="form-control" name="cantidad[]" autofocus>                                    
                                            </div>
                                        </div>

                                        ${postresComanda}

                                        <div class="row mb-3" id="rowBebidas">
                                            <label for="bebidas" id="labelBebidas" class="col-md-3 col-form-label text-md-start"><strong><i
                                            class="fa-solid fa-wine-glass"></i> Bebidas</strong></label>

                                            <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMas botonMasEditar">
                                                <i class="fa-solid fa-circle-plus botonRedondo" id="botonAgregarPostre"></i>
                                            </button>
                                            <button type="button" class="btn sinFocus col-md-1 botonMasMenos botonMenos">
                                                <i class="fa-solid fa-circle-minus botonRedondo" id="botonQuitarPostre"></i>
                                            </button>

                                            <div class="col-md-5 inputProductos" id="colBebidas">
                                                <select id="selectBebidas" name="productos[]" class="form-control">
                                                    <option value="0" selected>Elige un postre</option>
                                                    ${bebidas}
                                                </select>
                                            </div>

                                            <div class="col-md-2 cantidad">
                                                <input id="" min="1" type="number" class="form-control" name="cantidad[]" autofocus>                                    
                                            </div>
                                        </div>

                                        ${bebidasComanda}


                                        <div class="row mb-3">
                                            <label for="comentarios" class="col-md-3 col-form-label text-md-start" id="comentarioLabel"><strong><i class="fa-solid fa-comment"></i> Comentarios</strong></label>

                                            <div class="col-md-8">
                                                <textarea id="comentarioInput" min="1" max="6" class="form-control" name="comentarios" autocomplete="comentarios" autofocus>${comentarios}</textarea>
                                            </div>
                                        </div>

                                        <div class="row mb-0 justify-content-center">
                                            <div class="col-md-12 offset-md-6">
                                                <button type="submit" class="btn btn-primary" id="botonEditarComanda">
                                                    Confirmar
                                                </button>

                                                <button type="reset" class="btn btn-danger btnResetComanda">
                                                    Limpiar
                                                </button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>`;

                    $('#showComandaContent').append(formulario);
                    agregarQuitarProductos();
                    animacionBotonMasMenos();
                    editarComanda();
                },
                error: function (xhr, status) {

                    let audio = document.createElement("audio");
                    audio.src = "http://127.0.0.1:8000/sounds/errorComanda.wav";
                    audio.play();

                    $('#notificacionEditarError').show().text('Se debe rellenar correctamente la comanda');
                    $('.notificacionCrearComanda').delay(2000).fadeOut(2000);
                    $('#spinEditarComanda').hide();
                },
            });
        });
    };

    formShowComanda();
    // FIN AJAX SHOW COMANDA


    // INICIO AJAX EDITAR COMANDA

    function editarComanda() {

        $("#formEditarComanda").on('submit', function (e) {

            $('#spinEditarComanda').show();

            e.preventDefault();

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
                type: "PATCH",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: form.serialize(),
                beforeSend: function () {

                },
                success: function (resultado) {

                    let audio = document.createElement("audio");
                    audio.src = "http://127.0.0.1:8000/sounds/editarComanda.wav";
                    audio.play();

                    $('#notificacionEditarSuccess').show().text('Comanda editada correctamente');
                    $('.notificacionCrearComanda').delay(2000).fadeOut(2000);
                    $('#spinEditarComanda').hide();

                    let obj = JSON.parse(resultado);

                    let fecha = new Date(obj.comanda.created_at);
                    let anio = fecha.getFullYear();
                    let mes = fecha.getMonth() + 1;
                    if (mes < 10) {
                        mes = '0' + mes;
                    }
                    let dia = fecha.getDate();
                    if (dia < 10) {
                        dia = '0' + dia;
                    }
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

                    let entrantes = "";
                    let primeros = "";
                    let segundos = "";
                    let postres = "";
                    let bebidas = "";
                    let comentarios = "";
                    let estado = "";

                    if (obj.comanda.comentarios == null) {

                        comentarios = "";
                    } else {
                        comentarios = `<strong><i class='fa-solid fa-comment'></i> Comentarios: </strong> ${obj.comanda.comentarios} <br>`;
                    }

                    for (let i = 0; i < obj.productosCompleto.length; i++) {

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
                    }

                    if (obj.comanda.estado == 'en curso') {
                        estado = 'bodyComandasEnCurso'
                    } else {
                        estado = 'bodyComandasAbiertas'
                    }

                    let formulario = `
                    <form method="GET" action="http://127.0.0.1:8000/comanda/${obj.comanda.id}" class="formShowComanda" >
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
                            <div class="card-body bodyComandas ${estado}">
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
                                        <button type="submit" class="btn btn-primary botonShowComanda" name="showComanda" data-bs-toggle="modal" data-bs-target="#showComanda">
                                        Editar 
                                        </button>
                                        <button type="submit" class="btn btn-danger botonShowCancelar" data-bs-toggle="modal"
                                            data-bs-target="#cancelComanda">
                                            Cancelar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>`;

                    $('form').each(function () {

                        if ($(this).attr('action') == `http://127.0.0.1:8000/comanda/${obj.comanda.id}` && $(this).attr('method') == 'GET') {

                            $(this).replaceWith(formulario);
                            quitarCategoriasProductosVacios();
                        }
                    });

                    showCancelarComanda();
                    formShowComanda();
                },
                error: function (xhr, status) {

                    let audio = document.createElement("audio");
                    audio.src = "http://127.0.0.1:8000/sounds/errorComanda.wav";
                    audio.play();

                    $('#notificacionEditarError').show().text('Se debe rellenar correctamente la comanda');
                    $('.notificacionCrearComanda').delay(2000).fadeOut(2000);
                    $('#spinEditarComanda').hide();
                },
            });

            $('option').each(function () {

                if ($(this).is(':selected') && $(this).val() != 0) {

                    let valor = $(this).val();

                    $('option').each(function () {

                        if ($(this).val() == valor && !$(this).attr('disabled', 'disabled')) {
                        }
                    });
                }
            });
        });
    }

    $('#showComandaContent').empty();

    editarComanda();

    // FIN AJAX EDITAR COMANDA



    // INICIO AJAX CREAR COMANDA

    $("#formCrearComanda").on('submit', function (e) {

        $('#spinCrearComanda').show();

        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');

        let contadorProductos = 0;
        let contadorCantidades = 0;

        $('#formCrearComanda').children().children().children().children('option').each(function () {
            if ($(this).is(':selected') && $(this).val() != 0) {
                contadorProductos++;
            }
        });

        let cantidades = $('#formCrearComanda').children().children('.cantidad').children('input');

        for (let i = 1; i < cantidades.length; i++) {
            if (cantidades[i].value != '') {
                contadorCantidades++;
            }
        }

        if (contadorProductos != contadorCantidades || contadorProductos == 0 || contadorCantidades == 0) {

            let audio = document.createElement("audio");
            audio.src = "http://127.0.0.1:8000/sounds/errorComanda.wav";
            audio.play();

            $('#spinCrearComanda').hide();
            $('#notificacionCrearError').show();
            $('#notificacionCrearError').delay(2000).fadeOut(2000);

        } else {

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function (resultado) {

                    let audio = document.createElement("audio");
                    audio.src = "http://127.0.0.1:8000/sounds/crearComanda.wav";
                    audio.play();

                    $('#notificacionCrearSuccess').show().text('Comanda creada correctamente');
                    $('.notificacionCrearComanda').delay(2000).fadeOut(2000);
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
                    }

                    let formulario = `
                    <form method="GET" action="http://127.0.0.1:8000/comanda/${obj.comanda.id}" class="formShowComanda">
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
                                        <button type="submit" class="btn btn-primary botonShowComanda" name="showComanda"
                                            data-bs-toggle="modal" data-bs-target="#showComanda">
                                            Editar
                                        </button>
                                        <button type="submit" class="btn btn-danger botonShowCancelar" data-bs-toggle="modal"
                                            data-bs-target="#cancelComanda">
                                            Cancelar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>`;

                    $('#comandasAbiertas').append(formulario);
                    formShowComanda();
                    showCancelarComanda();
                    quitarCategoriasProductosVacios();
                },
                error: function (xhr, status) {

                    let audio = document.createElement("audio");
                    audio.src = "http://127.0.0.1:8000/sounds/errorComanda.wav";
                    audio.play();

                    $('#notificacionCrearError').show().text('Se debe rellenar correctamente la comanda');
                    $('.notificacionCrearComanda').delay(2000).fadeOut(2000);
                    $('#spinCrearComanda').hide();
                }
            });
        }
    });

    // FIN AJAX CREAR COMANDA 



    // INICIO BOTON RESET COMANDA

    $('.btnResetComanda').on('click', function (e) {
        $('option').each(function () {
        });
    });

    // FIN BOTON RESET COMANDA



    // INICIO FORMATEAR FECHA Y HORA

    function formatearFechaHora() {

        $('.fechaFormateada').each(function () {
            let fecha = new Date($(this).text());

            let anio = fecha.getFullYear();
            let mes = fecha.getMonth() + 1;
            if (mes < 10) {
                mes = '0' + mes;
            }
            let dia = fecha.getDate();
            if (dia < 10) {
                dia = '0' + dia;
            }
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
    }

    formatearFechaHora();

    // FIN FORMATEAR FECHA Y HORA



    // INICIO BOTONES AGREGAR/QUITAR PRODUCTOS

    function agregarQuitarProductos() {

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

            let cantidad = "<div class='col-md-2 nuevaCantidad'> <input id='' min='1' type='number' class='form-control' name='cantidad[]' autofocus> </div > ";

            let nuevoProducto = $(this).closest('.row').children('.inputProductos').clone().addClass('nuevoProducto');

            $(this).closest('.row').after(cantidad);
            $(this).closest('.row').after(nuevoProducto);

            $('option').each(function () {

                if ($(this).is(':selected') && $(this).val() != 0) {

                    let valor = $(this).val();

                    $('option').each(function () {
                    });
                }
            });
        });
    }

    agregarQuitarProductos();

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

    // COCINERO

    let estadoBotonAbiertasCocinero = true;

    $('#ocultarAbiertasCocinero').on('click', function () {


        if (estadoBotonAbiertasCocinero == true) {

            $('#comandasAbiertas').toggle(500);
            $('#ocultarAbiertasCocinero').animate({
                right: '-35px'

            }, 500);
            estadoBotonAbiertasCocinero = false;
        } else {
            $('#comandasAbiertas').toggle(500);
            $('#ocultarAbiertasCocinero').animate({
                right: '-12px'

            }, 500);
            estadoBotonAbiertasCocinero = true;
        }
    });

    let estadoBotonEnCursoCocinero = true;

    $('#ocultarEnCursoCocinero').on('click', function () {


        if (estadoBotonEnCursoCocinero == true) {

            $('#comandasEnCurso').toggle(500);
            $('#ocultarEnCursoCocinero').animate({
                right: '-42px'

            }, 500);
            estadoBotonEnCursoCocinero = false;
        } else {
            $('#comandasEnCurso').toggle(500);
            $('#ocultarEnCursoCocinero').animate({
                right: '-19px'

            }, 500);
            estadoBotonEnCursoCocinero = true;
        }
    });

    let estadoBotonCerradasCocinero = true;

    $('#ocultarCerradasCocinero').on('click', function () {

        if (estadoBotonCerradasCocinero == true) {

            $('#comandasCerradas').toggle(500);
            $('#ocultarCerradasCocinero').animate({
                right: '-42px'

            }, 500);
            estadoBotonCerradasCocinero = false;
        } else {
            $('#comandasCerradas').toggle(500);
            $('#ocultarCerradasCocinero').animate({
                right: '-20px'

            }, 500);
            estadoBotonCerradasCocinero = true;
        }
    });

    let estadoBotonCrearCocinero = true;

    $('#ocultarCanceladasCocinero').on('click', function () {

        if (estadoBotonCrearCocinero == true) {

            $('#comandasCanceladas').toggle(500);
            $('#ocultarCanceladasCocinero').animate({
                right: '-27px'
            }, 500);
            estadoBotonCrearCocinero = false;
        } else {
            $('#comandasCanceladas').toggle(500);
            $('#ocultarCanceladasCocinero').animate({
                right: '-10px'
            }, 500);
            estadoBotonCrearCocinero = true;
        }
    });

    // FIN BOTONES OCULTAR COMANDAS


    // INICIO ANIMACIÓN BOTONES AGREGAR/QUITAR PRODUCTOS

    function animacionBotonMasMenos() {

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

    }

    animacionBotonMasMenos();

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

    $('#botonCanceladas').on('click', function () {
        location.href = '#comandasCanceladas';
    });

    // FIN ANCHORS COMANDAS


    // INICIO OCULTAR ELEMENTOS

    $('.notificacionCrearComanda').hide();
    $('.fa-spin').hide();

    // FIN OUCLTAR ELEMENTOS


    // INICIO ANIMACIÓN QUITAR NOTIFICACIÓN COMANDA CREADA

    $('.notificacionCrearComanda').delay(2000).fadeOut(2000);

    // FIN ANIMACIÓN QUITAR NOTIFICACIÓN COMANDA CREADA


    // INICIO QUITAR CATEGORIAS PRODUCTOS VACÍOS

    function quitarCategoriasProductosVacios() {

        $('.categoriaProducto').each(function () {

            if ($(this).next().is('BR')) {
                $(this).remove();
                $(this).next().remove();
            }

            $('br').each(function () {
                if ($(this).next().is('BR')) {
                    $(this).remove();
                }
            });

            $('br').each(function () {
                if ($(this).prev().is('div') || $(this).parent().is('div')) {
                } else {

                    $(this).remove();
                }
            });
        });

    }

    quitarCategoriasProductosVacios();

    // FIN QUITAR CATEGORIAS PRODUCTOS VACÍOS

    formShowComanda();

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

    $('#notificacionCrearSuccess').delay(2000).fadeOut(2000);

    $('#notificacionCrearError').hide();


    // INICIO COOKIES

    function ocultarCookieBanner() {
        localStorage.setItem("cookieAceptada", "si");
        $("#cookieBanner").hide();
    }

    function mostrarCookieBanner() {
        $("#cookieBanner").show();
    }

    function cookieBanner() {

        let cookieAceptada = localStorage.getItem("cookieAceptada");

        if (cookieAceptada === null) {
            localStorage.setItem("cookieAceptada", "no");
            mostrarCookieBanner();
        }
        if (cookieAceptada === "no") {
            mostrarCookieBanner();
        }
    }

    cookieBanner();

    $('#botonCookie').on('click', ocultarCookieBanner);

    // FIN COOKIES

});