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
	$conn = crearConexion();
	$consulta =	"select * from category";
	$resultado = mysqli_query($conn, $consulta);
	cerrarConexion($conn);
	return $resultado;
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
	$conexion = crearConexion();
	$consulta = "SELECT id FROM category WHERE name='$ID'";
	$resultado = mysqli_fetch_assoc(mysqli_query($conexion, $consulta));
	cerrarConexion($conexion);
	return $resultado;
}


function getProductos($orden)
{
	// Completar...	
	$conn = crearConexion();

	$consulta =	"SELECT product.id, product.name, product.cost,	product.price, category.name as categoria FROM product 
	inner join category on product.category_id = category.id order by " . $orden;
	$resultado = mysqli_query($conn, $consulta);
	cerrarConexion($conn);
	return $resultado;
}

function anadirProducto($nombre, $coste, $precio, $categoria)
{
	// Completar...	
	/*
	 * Aquí transformamos el nombre de la catagoria recibido ($categoria->PANTALON,CAMISA,JERSEY,CHAQUETA)
	 * a su correspondiente ID de la tabla category.
	 * PANTALÓN 1
	 * CAMISA 2
	 * JERSEY 3
	 * CHAQUETA 4
	*/
	$id_categoria = getProducto($categoria);
	$categoria = $id_categoria['id'];

	/*
	 * A continución añadimos el producto en la base de datos.
	*/
	$conexion = crearConexion();
	$consulta = "INSERT INTO product (Name, Cost, Price, Category_ID) 
				VALUES ('$nombre' , '$coste' , '$precio' , '$categoria');";

	$resultado = mysqli_query($conexion, $consulta);

	if ($resultado)
		echo "<br>Registro agregado correctamente. ";

	cerrarConexion($conexion);
}


function borrarProducto($id)
{
	// Completar...	
}


function editarProducto($id, $nombre, $coste, $precio, $categoria)
{
	// Completar...	
	echo '<br>productos a editar: ';
	echo '<br>ID No se puede editar.';
	echo '<br>Nombre '.$nombre;
	echo '<br>Coste '. $coste;
	echo '<br>Precio '. $precio;
	echo '<br>Categoria '. $categoria;
}
