(function(){
    "use strict";

    let regalo = document.getElementById('regalo');

    document.addEventListener('DOMContentLoaded', function(){

        //Campos datos usuario
        let nombre = document.getElementById('nombre');
        let apellido = document.getElementById('apellido');
        let email = document.getElementById('email');
       
        //Campos pases  
        let pase_dia = document.getElementById('pase_dia');
        let pase_dosdias = document.getElementById('pase_dosdias');
        let pase_completo = document.getElementById('pase_completo');

        //Botones y divs
        let calcular = document.getElementById('calcular');
        let errorDiv = document.getElementById('error');
        let botonRegistro = document.getElementById('btnRegistro');
        let lista_productos = document.getElementById('lista-productos');
        let suma = document.getElementById('suma-total');
        
        //Extras
        let etiquetas = document.getElementById('etiquetas');
        let camisas = document.getElementById('camisa_evento')

        botonRegistro.disabled = true;
        
        if(document.getElementById('calcular')){

        
        calcular.addEventListener('click', calcularMontos);
        pase_dia.addEventListener('blur',mostrarDias);
        pase_dosdias.addEventListener('blur',mostrarDias);
        pase_completo.addEventListener('blur',mostrarDias);

        nombre.addEventListener('blur', validarCampos);
        apellido.addEventListener('blur', validarCampos);
        email.addEventListener('blur', validarCampos);
        email.addEventListener('blur', validarMail);

        let formulario_editar = document.getElementsByClassName('editar-registrado');
        if(formulario_editar.length > 0){
            if(pase_dia.value || pase_dosdias.value || pase_completo.value){
                mostrarDias();
            }
        }

       

        
        function validarCampos(){
            if(this.value == ''){
                errorDiv.style.display = 'block';
                errorDiv.innerHTML = "Este campo es obligatorio";
                this.style.border = '1px solid red';
                errorDiv.style.border = '1px solid red';
            } else {
                errorDiv.style.display = 'none';
                this.style.border = '1px solid #cccccc';
            }            
        }

        function validarMail(){
            if(this.value.indexOf("@") > -1){
                errorDiv.style.display = 'none';
                this.style.border = '1px solid #cccccc';
            }else {
                errorDiv.style.display = 'block';
                errorDiv.innerHTML = "El correo no es valido";
                this.style.border = '1px solid red';
                errorDiv.style.border = '1px solid red';
            }
        }

        function calcularMontos(e) {
            e.preventDefault();
            if(regalo.value === '') {
                alert("Debes elegir un regalo");
                regalo.focus();
            }else {
                let boletosDia = parseInt(pase_dia.value, 10) || 0,
                    boletosDosDias = parseInt(pase_dosdias.value,10) || 0,
                    boletoCompleto= parseInt(pase_completo.value,10) || 0,
                    cantEtiquetas = parseInt(etiquetas.value,10) || 0,
                    cantCamisas = parseInt(camisas.value, 10) || 0 ;

                let totalPagar = (boletosDia * 150) + (boletosDosDias * 250) + (boletoCompleto * 300) + ((cantCamisas*150) * .93) + (cantEtiquetas * 70);
                
                let listadoProductos = [];
                
                if(boletosDia >=1){
                    listadoProductos.push(boletosDia + ' Pases por día');
                }
                if(boletosDosDias>= 1){
                    listadoProductos.push(boletosDosDias + ' Pases por 2 días');
                }                
                if(boletoCompleto>=1){
                    listadoProductos.push(boletoCompleto + ' Pases por todos los días');
                }
                if(cantCamisas>=1){
                    listadoProductos.push(cantCamisas + ' Camisas');
                }
                if(cantEtiquetas>=1){
                    listadoProductos.push(cantEtiquetas + ' Etiquetas');
                }                
                lista_productos.style.display ="block"; 
                lista_productos.innerHTML = '';
                for(let i = 0; i < listadoProductos.length; i++){
                    lista_productos.innerHTML += listadoProductos[i] + '</br>';
                }
                suma.innerHTML ="$ " + totalPagar.toFixed(2);
                
                botonRegistro.disabled = false;
                document.getElementById('total_pedido').value = totalPagar;
            }           
        }
        function mostrarDias(){
           let boletosDia = parseInt(pase_dia.value, 10) || 0,
               boletosDosDias = parseInt(pase_dosdias.value,10) || 0,
               boletoCompleto= parseInt(pase_completo.value,10) || 0;

            let diasElegidos = [];

            if(boletosDia > 0){
                diasElegidos.push('viernes');
            }
            if(boletosDosDias > 0){
                diasElegidos.push('viernes','sabado');
            }
            if(boletoCompleto > 0){
                diasElegidos.push('viernes','sabado','domingo');
            }
            for(let i = 0; i <diasElegidos.length; i++){
                document.getElementById(diasElegidos[i]).style.display= 'block';
            }
        }

        }
    }); // DOM CONTENT LOADED

})();