<?php

	if (isset($_POST['user']) && isset($_POST['mail'])){

        $user = $_POST['user'];
        $email = $_POST['mail'];
		$dsn = 'mysql:host=localhost;dbname=Gamers;';
		$usuario = 'root';
		$contraseña = '';

        unset($_POST);

        try{
            $conexion = new PDO($dsn,$usuario,$contraseña);

            $consulta = $conexion->prepare("SELECT usuario FROM usuarios WHERE usuario=:u");
            $consulta->bindParam(":u",$user);

            //Lanzamos la consulta
            if ($consulta->execute()){
                if ($consulta->rowCount()){
                    echo "El nombre de usuario ya existe. Inténtelo de nuevo";
                }else{

                    //Si el usuario no existe, entonces se almacenará en la BBDD
                    $consulta = $conexion->prepare("INSERT INTO usuarios (usuario,email) VALUES (:u,:e)");
                    $consulta->bindParam(":u",$user);
                    $consulta->bindParam(":e",$email);
                    if ($consulta->execute()){
                        //Pues la inserción ha sido correcta
                        echo "$user se registró correctamente en nuestra BBDD";
                        //Si la ejecución se realizó correctamente enviamos 2 correos, uno al usuario y otro
						//al propio administrador
                        if (include('correo.php')){
							enviarCorreo($user, $email);
							$admin='Administrador';
							$email= '765839278764cr@gmail.com';						
							enviarCorreoAdmin($email,$admin,$user);
                        }                        
                    }else {
                        //Si se produce algun error a la hora de insertar al nuevo usuario en nuestra BBDD
                        echo "Error de conexión con la BBDD";
                    }
                }
            }else{
                //Hay fallos en la consulta
                //Este error lo podemos retornar al AJAX
                echo "ErrorBBDD";
            }
            //Se cierra la consulta
            $consulta->closeCursor();
            //Se cierra la conexion
            $conexion = null;
        }catch(PDOException $e){
            echo 'Falló la conexión: ' . $e->getMessage();
        }

    }else{
        //Hemos llegado aqui mediante la url
        //redireccionamos al registro.html
        header('Location:index.html');
    }

?>