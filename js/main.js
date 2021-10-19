(function(){
    "use strict";


    document.addEventListener('DOMContentLoaded', function(){
        
        if(document.getElementById('mapa')){
        var map = L.map('mapa').setView([19.3936599,-99.1745879], 16);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([19.3936599,-99.1745879]).addTo(map)
            .bindPopup('CDMXWEBCAM.<br>Word Trade Center.')
            .openPopup();
        } 
     
    }); // DOM CONTENT LOADED

})();

$(function(){

    //Lettering
    $('.nombre-sitio').lettering();

    //Agregar clase a Menú

    $('.conferencia .navegacion-principal a:contains("Conferencia")').addClass('activo');
    $('.calendario .navegacion-principal a:contains("Calendario")').addClass('activo');
    $('.invitados .navegacion-principal a:contains("Invitados")').addClass('activo');

    //Menu fijo
    let windowHeight =$(window).height();
    let barraAltura = $('.barra').innerHeight();
   
    $(window).scroll(function(){
        let scroll = $(window).scrollTop();
        if(scroll > windowHeight){
            $('.barra').addClass('fixed');
            $('body').css({'margin-top': barraAltura+'px'});
        }else{
            $('.barra').removeClass('fixed');
            $('body').css({'margin-top': '0px'});   
        }
    });
     
    //Menu responsive
    $('.menu-movil').on('click', function(){
        $('.navegacion-principal').slideToggle();

    });

    
    // Programa de Conferencias
    $('.programa-evento .info-curso:first').show();
    $('.menu-programa a:first').addClass('activo');

    $('.menu-programa a').on('click', function(){
        $('.menu-programa a').removeClass('activo');
        $(this).addClass('activo');
        $('.ocultar').hide();
                
        let enlace = $(this).attr('href');
        $(enlace).fadeIn(2000);

        return false;
    });

    //Animaciones para los invitados
    let resumenLista =jQuery('.resumen-evento');
    if(resumenLista.length > 0) {
        $('.resumen-evento').waypoint(function(){
            $('.resumen-evento li:nth-child(1) p').animateNumber({ number: 6}, 1200);
            $('.resumen-evento li:nth-child(2) p').animateNumber({ number: 15}, 1200);
            $('.resumen-evento li:nth-child(3) p').animateNumber({ number: 4}, 1200);
            $('.resumen-evento li:nth-child(4) p').animateNumber({ number: 9}, 1200);
        }, {
            offset:'60%'
        });
    }
 
    
    //Cuenta regresiva
    $('.cuenta-regresiva').countdown('2021/12/11 09:00:00', function(e){
        $('#dias').html(e.strftime('%D'));
        $('#horas').html(e.strftime('%H'));
        $('#minutos').html(e.strftime('%M'));
        $('#segundos').html(e.strftime('%S'));
    });

    //Colorbox
    $('.invitado-info').colorbox({inline:true, with:"50%"});
});