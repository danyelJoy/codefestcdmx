$(document).ready(function(){
    //Crear nuevo y editar
    $('#guardar-registro').on('submit', function(e){
        e.preventDefault();

        let datos = $(this).serializeArray();        

        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            success: function(data){
                console.log(data);
                let resultado = data;
                if(resultado.respuesta === 'exito'){
                    Swal(
                        'Registro creado correctamente!',
                        'Presiona click!',
                        'success'
                        )
                } else {
                    Swal(                        
                        'Oops...',
                        'Algo salio mal vuelve a intentar!',
                        'error'                   
                      );
                }
            }
        })
    });

    //Guardar archivo cuando tenga imagen
    $('#guardar-registro-archivo').on('submit', function(e){
        e.preventDefault();

        let datos = new FormData(this);        

        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            contentType: false,
            processData: false,
            async: true,
            cache: false,
            success: function(data){
                console.log(data);
                let resultado = data;
                if(resultado.respuesta === 'exito'){
                    Swal(
                        'Registro creado correctamente!',
                        'Presiona click!',
                        'success'
                        )
                } else {
                    Swal(                        
                        'Oops...',
                        'Algo salio mal vuelve a intentar!',
                        'error'                   
                      );
                }
            }
        })
    });


//Eliminar registro
    $('.borrar_registro').on('click', function(e){
        e.preventDefault();
        let id = $(this).attr('data-id');
        let tipo = $(this).attr('data-tipo');
        //console.log('ID' +id);
        Swal({
            title: 'Estás seguro?',
            text: "Este cambio no se podra revertir!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar!',
            cancelButtonText: 'Cancelar'
        }).then(function() {
                $.ajax({
                    type: 'post',
                    data:{
                        'id': id,
                        'registro' : 'eliminar'
                    },
                    url: 'modelo-' +tipo+ '.php',
                    success:function(data){
                        let resultado = JSON.parse(data);
                        if(resultado.respuesta == 'exito'){
                            Swal(
                                'Eliminado!',
                                'El registro fue eliminado.',
                                'success'
                                )
                                jQuery('[data-id="'+resultado.id_eliminado+'"]').parents('tr').remove();
                        } else {
                            Swal(                        
                                'Oops...',
                                'Algo salio mal vuelve a intentar!',
                                'error'                   
                                );
                        }                        
                    }        
                })
        });                

    });


});