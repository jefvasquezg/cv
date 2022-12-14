<?php
    
    include '../clientes/conexion/conn.php';
	$conf= new Configuracion();
	$conf->conectar();

	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$itemid = isset($_POST['itemid']) ? mysqli_real_escape_string($conf->conectar(),$_POST['itemid']): '';
    $productid = isset($_POST['productid']) ? mysqli_real_escape_string($conf->conectar(),$_POST['productid']): '';
	$offset = ($page-1)*$rows;
	$result = array();

	if ($itemid =="")
		$var=false;
	if ($itemid !="")
		$var=true;	

	$sql = "SELECT count(*)  FROM clientes where activo=1";
	$resultado= $conf->generarConsulta($sql);
	$result["total"] = $resultado;

	switch($var){
		case true:
			$sql="SELECT * FROM clientes where activo=1 and $itemid like '$productid%' limit $offset,$rows";
			$resultado= $conf->generarConsulta2($sql);
			$result["rows"] = $resultado;
			echo json_encode($result);
		break;
		case false:
			$sql="SELECT * FROM clientes where activo=1 limit $offset,$rows";
			$resultado= $conf->generarConsulta2($sql);
			$result["rows"] = $resultado;
			echo json_encode($result);
		break;
	}

	
	
	$conf->desconectarDb();

?>