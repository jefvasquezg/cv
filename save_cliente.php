<?php

$nombre_cliente = htmlspecialchars($_REQUEST['nombre_cliente']);
$identificacion = htmlspecialchars($_REQUEST['identificacion']);
$tipo_identificacion = htmlspecialchars($_REQUEST['tipo_identificacion']);
$email = htmlspecialchars($_REQUEST['email']);
$telefono = htmlspecialchars($_REQUEST['telefono']);
$direccion = htmlspecialchars($_REQUEST['direccion']);
$contacto_cliente = htmlspecialchars($_REQUEST['contacto_cliente']);

include '../clientes/conexion/conn.php';
$conf= new Configuracion();
$conf->conectar();

$sql = "insert into clientes (nombre_cliente,identificacion,tipo_identificacion,email,telefono,direccion,contacto_cliente) values ('$nombre_cliente','$identificacion','$tipo_identificacion','$email','$telefono','$direccion','$contacto_cliente')";
$query = mysqli_query($conf->conectar(),$sql);
echo json_encode(array(
	'nombre_cliente' => $nombre_cliente,
	'identificacion' => $identificacion,
	'tipo_identificacion' => $tipo_identificacion,
	'email' => $email,
	'telefono' => $telefono,
	'direccion' => $direccion,
	'contacto_cliente' => $contacto_cliente
));
?>