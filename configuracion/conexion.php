<?php 



class Conexion {
	protected $dbh;
	protected $contrasena = "";
	protected $usuario = "root";
	protected $nombre_bd = "prueba_tecnica_dev";

	protected function Conexion(){
		try {
			
			$conexion =new PDO (
				'mysql:host=localhost;
				dbname='.$this->nombre_bd,
				$this->usuario,
				$this->contrasena,
				
			);

			return $conexion;	
		} catch (Exception $e) {
			print "¡Error BD!: " . $e->getMessage() . "<br/>";
			die();	
		}
	}
}
?>