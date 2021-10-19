$(document).ready(function(){


//Login Admin
    $('#login-admin').on('submit', function(e){
        e.preventDefault();

        let datos = $(this).serializeArray();

        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            success: function(data){
                let resultado = data;
                if(resultado.respuesta == 'exito'){
                    Swal({
                        title:'Gracias!',
                        text:'Login correcto ' +resultado.usuario+ ' !',
                        icon:'success'
                        })
                        setTimeout(function(){
                            window.location.href = 'admin-area.php'

                        }, 2000)
                } else {
                    Swal({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!'                     
                        });
                }
            }
        })
    });
});