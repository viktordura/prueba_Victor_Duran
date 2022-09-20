<?php 

require_once("../configuracion/conexion.php");
require_once("../model/Empleados.php");
$Empleados = new Empleados();


$responseRoles = $Empleados->get_roles('roles');
$responseAreas = $Empleados->get_roles('areas');

$dataRol= Array();
$dataArea= Array();
$data= Array();

foreach($responseRoles as $row){
	$sub_array = array();
	$sub_array['id'] = $row["id"];
	$sub_array['nombre'] = $row["nombre"];
	$dataRol[] = $sub_array;
}

foreach($responseAreas as $row){
	$sub_array = array();
	$sub_array['id'] = $row["id"];
	$sub_array['nombre'] = $row["nombre"];
	$dataArea[] = $sub_array;
}

array_push($data, $dataRol);
array_push($data, $dataArea);


echo json_encode($data);








?>