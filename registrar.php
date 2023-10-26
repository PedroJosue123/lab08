<?php
//print_r($_POST);
if (empty($_POST["oculto"]) || empty($_POST["txtNombres"]) || empty($_POST["txtApPaterno"]) || empty($_POST["txtApMaterno"]) || empty($_POST["txtDireccion"]) || empty($_POST["txtCelular"])) {
    header('Location: index.php?mensaje=falta');
    exit();
}

include_once 'model/conexion.php';
$nombres = $_POST["txtNombres"];
$ap_paterno = $_POST["txtApPaterno"];
$ap_materno = $_POST["txtApMaterno"];
$direccion = $_POST["txtDireccion"];
$celular = $_POST["txtCelular"];

$sentencia = $bd->prepare("INSERT INTO persona(nombres,apellido_paterno,apellido_materno,Direccion,celular) VALUES (?,?,?,?,?);");
$resultado = $sentencia->execute([$nombres, $ap_paterno, $ap_materno, $direccion, $celular]);
if ($resultado === TRUE) {
    header('Location: administrador.php?mensaje=registrado');
} else {
    header('Location: administrador.php?mensaje=error');
    exit();
}

