

$(function () {


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
        location.href = '#anchorCrearComanda';
    });

    $('#botonAbiertas').on('click', function () {
        location.href = '#anchorComandasAbiertas';
    });

    $('#botonCurso').on('click', function () {
        location.href = '#anchorComandasEnCurso';
    });

    $('#botonCerradas').on('click', function () {
        location.href = '#anchorComandasCerradas';
    });
});