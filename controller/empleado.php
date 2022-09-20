<?php 
error_reporting (E_ALL);

set_error_handler(function () 
{
	throw new Exception("Error");
});

require_once("../configuracion/conexion.php");
require_once("../model/Empleados.php");

$Empleados = new Empleados();

switch($_GET["flag"]){
	case "listar":
	$lista = ListarEmpleado($Empleados);
	echo $lista;
	break;

	case "guardar":
	$guardar = guardarEmpleado($Empleados);
	break;

	case "eliminar":
	$eliminar = eliminarEmpleado($Empleados);
	break;

	case 'ver':
	$ver = verEmpleado($Empleados);
	break;

	case "actualizar":
	$actualizar = actualizarEmpleado($Empleados);
	break;
}


function ListarEmpleado($Empleados){

	try{

		$response = $Empleados->get_empleados();

		$data= Array();

		foreach($response as $row){
			$sub_array = array();
			$sub_array[] = $row["id"];
			$sub_array[] = $row["nombre"];
			$sub_array[] = $row["email"];
			$sub_array[] = $row["sexo"];
			$sub_array[] = $row["boletin"];
			$sub_array[] = $row["descripcion"];
			$sub_array[] = $row["area"];
			$sub_array[] = '<button type="button" onClick="editar('.$row["id"].');" class="btn btn-outline-warning btn-icon"><div> <i class="bi bi-pencil-square"></i></div></button>';
			$sub_array[] = '<button type="button" onClick="eliminar('.$row["id"].');" class="btn btn-outline-danger btn-icon"><div><i class="bi bi-trash"></i></div></button>';


			$data[] = $sub_array;
		}

		return json_encode($data);

	}catch(Exception $e){

		print "¡Error BD!: " . $e->getMessage() . "<br/>";
		die();	
	}

}

function guardarEmpleado($Empleados){

	( empty($_POST["boletin"]) )  ? $_POST["boletin"] = 0 : $_POST["boletin"] = $_POST["boletin"];  

	if ( empty($_POST["nombre"]) && empty($_POST["email"]) && empty($_POST["area_id"]) && empty($_POST["boletin"]) && empty($_POST["descripcion"]) ) {

		echo json_encode(array('id' => 1,'msm' => 'Validar los campos' ));
		
	}else{
		
		$id = $Empleados->insertar_empleado($_POST["nombre"],$_POST["email"],$_POST["sexo"],$_POST["area_id"],$_POST["boletin"],$_POST["descripcion"]);

		foreach ($_POST["roles"] as $key => $value) {
			$Empleados->insertar_roles($id,$value);  
		}

		echo json_encode(array('id' => 0,'msm' => 'Ingreso exitoso' ));
	}
	

	

}

function eliminarEmpleado($Empleados){
	try {
		$empleado = $Empleados->obtener_empleado($_POST["value"]);

		if(is_array($empleado)==true and count($empleado)>0){

			$Empleados->eliminar_empleado($_POST["value"]);
		} 
		
	} catch (Exception $e) {
		
		return json_encode('Excepción capturada: ',  $e->getMessage());
	}
}

function verEmpleado($Empleados){
	$empleado 	    = $Empleados->obtener_empleado($_POST["value"]);
	$responseRoles  = $Empleados->get_roles('roles');
	$responseAreas  = $Empleados->get_roles('areas');
	$responseRolEmp = $Empleados->obtener_empleado_rol($_POST["value"]);

	$dataRol  = Array();
	$dataArea = Array();
	$dataEmpl = Array();
	$dataRoEm = Array();
	$data 	  = Array();

	foreach($responseRolEmp as $row){
		$sub_array = array();
		$sub_array['id']     = $row["id"];
		$sub_array['nombre'] = $row["nombre"];
		$dataRoEm[] 	     = $sub_array;
	}

	foreach($responseRoles as $row){
		$sub_array = array();
		$sub_array['id']     = $row["id"];
		$sub_array['nombre'] = $row["nombre"];
		$dataRol[] 			 = $sub_array;
	}

	foreach($responseAreas as $row){
		$sub_array = array();
		$sub_array['id'] 	 = $row["id"];
		$sub_array['nombre'] = $row["nombre"];
		$dataArea[]			 = $sub_array;
	}

	if(count($empleado) > 0){

		foreach($empleado as $row){
			$sub_array = array();
			$sub_array["id"] 	      = $row["id"];
			$sub_array["nombre"]  	  = $row["nombre"];
			$sub_array["email"]   	  = $row["email"];
			$sub_array["sexo"] 	  	  = $row["sexo"];
			$sub_array["boletin"] 	  = $row["boletin"];
			$sub_array["descripcion"] = $row["descripcion"];
			$sub_array["area"]		  = $row["area"];
			$sub_array["area_id"]	  = $row["area_id"];
			$dataEmpl[] 			  = $sub_array;
		}
		
	}

	array_push($data, $dataRol);
	array_push($data, $dataArea);
	array_push($data, $dataEmpl);
	array_push($data, $dataRoEm);

	echo json_encode($data);
}

function actualizarEmpleado($Empleados){
	
	( empty($_POST["boletin"]) )  ? $_POST["boletin"] = 0 : $_POST["boletin"] = $_POST["boletin"];  

	$Empleados->actualizar_empleado($_POST["nombre"],$_POST["email"],$_POST["sexo"],$_POST["area_id"],$_POST["boletin"],$_POST["descripcion"],$_POST["id"]); 

	$Empleados->eliminar_empleado_rol($_POST["id"]);  

	foreach ($_POST["roles"] as $key => $value) {
		$Empleados->insertar_roles($_POST["id"],$value);  
	}
}





?>