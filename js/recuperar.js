/*Funcion para que aparesca el mensaje rellene los campos vacios*/
$(document).ready(function(){
    $('#aviso').hide();
    $('#aviso1').hide();
    $('#form-recuperar').submit(e=>{
        let correo = $('#email-recuperar').val();
        if(correo==''){
            $('#aviso').show();
            $('#aviso').text('Rellene todos los campos');
        }
        else{
            $('#aviso').hide();
            let funcion ='verificar';
            $.post('../controlador/recuperar.php',{funcion,correo},(response)=>{
               //Para borrar los espacios en blanco(if)
                response=response.trim();
                if(response=='encontrado'){
                let funcion ='recuperar';
                $('#aviso').hide();
                $.post('../controlador/recuperar.php',{funcion,correo},(response2)=>{
                   $('#aviso').hide();
                    $('#aviso1').hide();

                    response2=response2.trim();
                    if(response2=='enviado'){
                        $('#aviso1').show();
                        $('#aviso1').text('se restablecio la contraseña');
                        $('#form-recuperar').trigger('reset');


                    }
                    else{

                        $('#aviso').show();
                        $('#aviso').text('No se pudo restablecer');
                        $('#form-recuperar').trigger('reset');
                    }



                })
            }
                else{
                    $('#aviso').hide();
                    $('#aviso1').hide();
                    $('#aviso').show();
                    $('#aviso').text('Su correo no se encuentra asociado en el sistema');


                }


                })

        }
        e.preventDefault();

    })


})
