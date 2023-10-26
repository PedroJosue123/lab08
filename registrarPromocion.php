<?php
//print_r($_POST);
if (empty($_POST["txtPromocion"])) {
    header('Location: index.php');
    exit();
}

include_once 'model/conexion.php';
$promocion = $_POST["txtPromocion"];
$codigo = $_POST["codigo"];


$sentencia = $bd->prepare("INSERT INTO promociones(promocion,id_persona) VALUES (?,?);");
$resultado = $sentencia->execute([$promocion,$codigo ]);

if ($resultado === TRUE) {
    header('Location: agregarPromocion.php?codigo='.$codigo);
} 