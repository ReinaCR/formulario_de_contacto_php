function ajax_post(){
    let usuario = document.getElementById("user").value;
    let email = document.getElementById("mail").value;
    let comentario = document.getElementById("coment").value;
    let salida = document.getElementById('salida');
    let respuesta;

    respuesta = new XMLHttpRequest();
    
    respuesta.open('POST','contactar.php',true);
    respuesta.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

    respuesta.send("user="+usuario+"&mail="+email,"&coment="+comentario);
    respuesta.onreadystatechange = function(){
        if (respuesta.readyState == 4){
            //salida.innerHTML = "<span>Esperando respuesta ...</span>";
            if (respuesta.status == 200){
                salida.innerHTML = "<span>Enviando correo a " +usuario+ ". Revise su bandeja de entrada</span>";
            }else{
                salida.innerHTML = "<span>Se ha producido algun error en la comunicación con el servidor</span>";
            }
        }
    }
} 