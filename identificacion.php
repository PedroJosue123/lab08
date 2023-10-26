<?php
   include_once 'model/conexion.php';

   $usuario = $_POST['txtusuario'];
   $contrasena = $_POST['txtcontrasena'];
   $sentencia = $bd->prepare("SELECT * FROM usuarios WHERE usuario = :usuario AND contraseña = :contrasena");
   $sentencia->bindParam(':usuario', $usuario, PDO::PARAM_STR);
   $sentencia->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
   $sentencia->execute();
   $persona = $sentencia->fetchAll(PDO::FETCH_OBJ);

   if ($persona) {
      header('Location: administrador.php');
   } else {
      header('Location: iniciarsesion.php?mensaje=error');
    
   }
   ?>

      
   
