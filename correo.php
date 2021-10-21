<?php
//sleep(5); 
    require 'Exception.php';
    require 'PHPMailer.php';
    require 'SMTP.php';

    use PhpMailer\PhpMailer\PhpMailer;
    use PhpMailer\PhpMailer\Exception;
    use PhpMailer\PhpMailer\SMTP;

  
  function enviarCorreo($user, $email){
  	 $mail = new PhpMailer(true);
  	 try{
  	 	$mail->SMTPDebug = SMTP::DEBUG_SERVER;
  	 	$mail->isSMTP();
  	 	$mail->Host = 'smtp.gmail.com';
  	 	$mail->SMTPAuth = true;
  	 	$mail->Username = '765839278764cr@gmail.com';
  	 	$mail->Password = 'Sparky84';
  	 	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
  	 	$mail->Port       = 465;


  	 	//////////////////////////////////////////////


  	 	$mail->setFrom('765839278764cr@gmail.com', 'Administrador Web'); 
   		$mail->addAddress($email, $user);     
    	//$mail->addReplyTo('454556464646465461694y@gmail.com', 'AdminCorreo6787%');

    	$mail->isHTML(true);                                   
    	$mail->Subject = "Correo de Bienvenida para $user";
    	$mail->Body    = "
            <h1>Bienvenido a nuestra COMUNIDAD!!!</h1>
            
            <p>Hola $user gracias por unirte a mi página</p>
            ";
    
    $mail->send();
    echo "CORREO";


  	} catch(Exception $e){

  	}
  } 
  function enviarCorreoAdmin($email,$admin,$usuario){
    
    
    $mail = new PhpMailer(true);
    try{
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = '765839278764cr@gmail.com';
        $mail->Password = 'Sparky84';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
        $mail->Port       = 465;


        //////////////////////////////////////////////


        $mail->setFrom('765839278764cr@gmail.com', 'Administrador Web'); 
        $mail->addAddress($email, $admin);
     //$mail->addReplyTo('454556464646465461694y@gmail.com', 'AdminCorreo6787%');

     $mail->isHTML(true);                                   
     $mail->Subject = "El usuario: $user dejo un comentario en la web";
     $mail->Body    = "
         <h1>Tienes un nuevo comentario!!!</h1>
         
         <p>El usuario $user acaba de dejar un comentario en la web ...</p>
         ";
 
    $mail->send();
    echo "CORREO";

    } catch(Exception $e){

    }
} 
?>