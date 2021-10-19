$(document).ready(function () {

    $('#icono').iconpicker();
    $("div.iconpicker-popover").removeClass('fade');

    $('#desplegar').iconpicker({
        templates: {
            search: '<input type="search" class="form-control iconpicker-search" placeholder="Escribe para buscar" />'
        }
        }).on('iconpickerUpdated', function(e) {
            $('#icono').attr('value', e.iconpickerValue);
        });

     $('.seleccionar').select2(); 
       
     $(function () {
        bsCustomFileInput.init();
      });

 


});