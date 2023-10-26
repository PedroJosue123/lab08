<?php
    print_r($_POST);
    if(!isset($_POST['codigo'])){
        header('Location: index.php?mensaje=error');
    }

    include_once 'model/conexion.php';
        $codigo=$_POST['codigo'];
        $nombres = $_POST["txtNombres"];
        $ap_paterno = $_POST["txtApPaterno"];
        $ap_materno = $_POST["txtApMaterno"];
        $direccion = $_POST["txtDireccion"];
        $celular = $_POST["txtCelular"];

    $sentencia = $bd->prepare("UPDATE persona SET nombres = ?, apellido_paterno = ?, apellido_materno = ?,Direccion = ?,celular = ? where id = ?;");
    $resultado = $sentencia->execute([$nombres, $ap_paterno, $ap_materno, $direccion, $celular,$codigo]);

    if ($resultado === TRUE) {
        header('Location: administrador.php?mensaje=editado');
    } else {
        header('Location: administrador.php?mensaje=error');
        exit();
    }
