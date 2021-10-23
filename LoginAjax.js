function validar(){

    let user = document.getElementById('user'); 
    let email = document.getElementById('mail');
    let PPD = document.getElementById("PPD");
    let errores = document.getElementsByClassName('errorForm');

    //Ahora borramos los errores que se hayan producido
    errores[0].innerHTML = "";
    errores[1].innerHTML = "";
    errores[2].innerHTML = "";

    //Ahora validamos los campos del formulario
    if (user.validity.valid && email.validity.valid && PPD.checked){
        //Si todo esta correcto, llamamos a la funcion AJAX
        ajax_post(user,email);
    }else{
        //Si se produce algun fallo, se lo hacemos saber al usuario mediante errores
        if (!user.validity.valid){
            //Cuando el usuario no es correcto
            document.getElementsByClassName('errorForm')[0].innerHTML = "ERROR: Usuario no valido";            
        }
        if (!email.validity.valid){
            //Cuando el email no es el correcto
            document.getElementsByClassName('errorForm')[1].innerHTML = "ERROR: Correo no valido";
        }
        if (!PPD.checked){
            //Cuando el check de Privacidad no esta seleccionado
            document.getElementsByClassName('errorForm')[2].innerHTML = "ERROR: Acepte la Politica de Privacidad";
        }
    }
}

function ajax_post(user,mail){
    let usuario = user.value;
    let email = mail.value;
    let comentario = document.getElementById("coment").value;
    let salida = document.getElementById('salida');
    let respuesta;

    salida.innerHTML = "<div class='loader'></div><br><span class='correcto'>Enviando correo a " +usuario+ ".</span>";


    respuesta = new XMLHttpRequest();
    
    respuesta.open('POST','contactar.php',true);
    respuesta.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

    respuesta.send("user="+usuario+"&mail="+email,"&coment="+comentario);
    respuesta.onreadystatechange = function(){

        if (respuesta.readyState == 4){
            //salida.innerHTML="<span>Enviando correo a " +usuario+ ".</span>";
            if (respuesta.status == 200){
                salida.innerHTML = "<span class='correcto'>Correo enviado. Revise su bandeja de entrada</span>";
            }else{
                salida.innerHTML = "<span>Se ha producido algun error en la comunicación con el servidor</span>";
            }
        }
    }
} 