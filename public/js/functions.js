

$(function () {

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


    $('.botonMenos').on('click', function () {

        $(this).closest('.row').next('.nuevoProducto').remove();
        $(this).closest('.row').next('.nuevaCantidad').remove();
    });


    $('.botonMas').on('click', function () {

        let cantidad = "<div class='col-md-2 nuevaCantidad'> <input id='' min='1' type='number' class='form-control @error('cantidad') s-invalid @enderror' name='cantidad[]' value='{{ old('cantidad') }}' autocomplete='cantidad' autofocus> </div > ";

        let nuevoProducto = $(this).closest('.row').children('.inputProductos').clone().addClass('nuevoProducto');

        $(this).closest('.row').after(cantidad);
        $(this).closest('.row').after(nuevoProducto);

        // let select = $(this).closest('.row').children('.inputProductos').children().children('option');

        // let valor = null;

        // $.each(select, function (index, value) {

        //     if ($(this).is(':selected')) {
        //         valor = $(this).val();
        //     }

        //     if ($(this).val() == valor) {
        //         $(this).prop('disabled', true);
        //         alert($(this).val());
        //     }
        //     alert($('option:selected', this.index).text());
        // });

        // let contador = 1;

        // $('option').each(function () {
        //     if ($(this).val() == valor) {
        //         $(this).attr('disabled', 'disabled');

        //         // alert($(this).val());
        //     }
        // });

        // for (let index = 0; index < select.length; index++) {

        //     if (select[index].value == valor) {

        //         alert(select[index].value);
        //     }
        // }
        // cambiar();
    });

    // function cambiar() {

    //     $('select').on('change', function () {
    //         let valor = $(this).val();
    //         alert($(this).val());

    //         if ($('option').val() == valor) {
    //             $(this).attr('disabled', 'disabled');
    //             // alert($(this).val());
    //         }
    //     });
    // }

    // cambiar();

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

    $('.notificacionSucces').delay(3000).fadeOut(3000);

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
});