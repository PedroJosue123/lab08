<?php
if (!isset($_GET['codigo'])) {
    header('Location: index.php?mensaje=error');
    exit();
}

include 'model/conexion.php';
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("SELECT pro.promocion , pro.id_persona, per.nombres , per.apellido_paterno ,per.apellido_materno , per.Direccion, per.celular
  FROM promociones pro 
  INNER JOIN persona per ON per.id = pro.id_persona 
  WHERE pro.id = ?;");
$sentencia->execute([$codigo]);
$persona = $sentencia->fetch(PDO::FETCH_OBJ);

    $url = 'https://api.green-api.com/waInstance7103868066/SendMessage/72c24a4cbacd4536b4f12b95f50d8b8edce834c410ab4bce82';
    $data = [
        "chatId" => "51".$persona->celular."@c.us",
        "message" =>  'Estimado(a) '.strtoupper($persona->nombres).' '.strtoupper($persona->apellido_paterno).' '.strtoupper($persona->apellido_materno).' su producto a salio del almacen y se entregado dentro de '.strtoupper($persona->promocion).' Horas'
    ];
    $options = array(
        'http' => array(
            'method'  => 'POST',
            'content' => json_encode($data),
            'header' =>  "Content-Type: application/json\r\n" .
                "Accept: application/json\r\n"
        )
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result);
    header('Location: agregarPromocion.php?codigo='.$persona->id_persona);
?>