<?php 

	function crearConexion() {
		// Cambiar en el caso en que se monte la base de datos en otro lugar
		$host = "localhost";
		$user = "AntonioIII";
		$pass = "AntonioIII";
		$baseDatos = "pac_dwes";

		// Completar...
		$conexion = mysqli_connect($host, $user, $pass, $baseDatos);
		
		return $conexion;
	}


	function cerrarConexion($conexion) {
		// Completar...
		mysqli_close($conexion);
	}


?>