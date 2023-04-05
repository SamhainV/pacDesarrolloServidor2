<?php

include "conexion.php";

function tipoUsuario($nombre, $correo)
{
	// Completar...

	$conn = crearConexion($nombre, $correo);

	if (esSuperadmin($nombre, $correo)) {
		$retorno = "superadmin";
	} else {
		$consulta = "SELECT full_name, email, enabled FROM user WHERE full_name = '$nombre' and email = '$correo'";
		$resultado = mysqli_query($conn, $consulta);

		if ($datos = mysqli_fetch_array($resultado)) {
			if ($datos["enabled"] == 0) {
				$retorno = "registrado";
			} else if ($datos["enabled"] == 1) {
				$retorno = "autorizado";
			}
		} else {
			$retorno = "no registrado";
		}
	}

	cerrarConexion($conn);
	return $retorno;
}


function esSuperadmin($nombre, $correo)
{
	// Completar...
	// Completar...
	$conn = crearConexion();
	$consulta =
		"SELECT user.id FROM user INNER JOIN setup ON 
		user.id = setup.superadmin_id WHERE 
		user.full_name = '$nombre' AND user.email = '$correo'";
	$resultado = mysqli_query($conn, $consulta);

	if ($datos = mysqli_fetch_array($resultado))
		$trueFalse = true;
	else
		$trueFalse = false;

	cerrarConexion($conn);
	return $trueFalse;
}


function getPermisos()
{
	// Completar...	
	$conn = crearConexion();
	$consulta = "SELECT management FROM setup";
	$resultado = mysqli_fetch_assoc(mysqli_query($conn, $consulta));
	cerrarConexion($conn);
	return $resultado["management"];
}

function cambiarPermisos()
{	
	// Completar...	
	$permisos = getPermisos();
	$conn = crearConexion();
	if (($permisos == 1)) {
		$consulta = "UPDATE setup SET management  = 0";
	} else if (($permisos == 0)) {
		$consulta = "UPDATE setup SET management = 1";
	}
	$resultado = mysqli_query($conn, $consulta);
	echo 'Resultado del cambio ' . $resultado;

	cerrarConexion($conn);
}


function getCategorias()
{
	// Completar...	
}

function getListaUsuarios()
{
	// Completar...	
	$conn = crearConexion();
	$consulta =	"SELECT user.id, user.email, user.full_name, user.enabled FROM user";
	$resultado = mysqli_query($conn, $consulta);

	cerrarConexion($conn);
	return $resultado;
}


function getProducto($ID)
{
	// Completar...	
}


function getProductos($orden)
{
	// Completar...	
}


function anadirProducto($nombre, $coste, $precio, $categoria)
{
	// Completar...	
}


function borrarProducto($id)
{
	// Completar...	
}


function editarProducto($id, $nombre, $coste, $precio, $categoria)
{
	// Completar...	
}
