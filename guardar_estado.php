<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['estado'])) {
   include_once 'model/conexion.php';
    $id = $_POST['id'];
    $nuevoEstado = $_POST['estado'];

    // Realizar la actualización en la base de datos
    try {
        $sentencia = $bd->prepare("UPDATE persona SET estado = ? WHERE id = ?");
        $resultado = $sentencia->execute([$nuevoEstado, $id]);
        if ($resultado) {
            $respuesta = array('success' => true);
        } else {
            $respuesta = array('success' => false, 'error' => 'Error en la actualización');
        }
    } catch (PDOException $e) {
        $respuesta = array('success' => false, 'error' => $e->getMessage());
    }

    header('Content-Type: application/json');
    echo json_encode($respuesta);
}
