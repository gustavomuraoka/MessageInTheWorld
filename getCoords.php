<?php
	$con = new mysqli("127.0.0.1","root","","maps");

	$result = $con->query("SELECT * FROM coordenadas");

	$resultado = array();

	while($row = $result->fetch_assoc()){
		$resultado[] = array("texto" =>$row["texto"], "x" => $row["x"], "y" => $row["y"]);
	}

	echo json_encode($resultado);
?>


