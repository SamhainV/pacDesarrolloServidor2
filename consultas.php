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



function asociativo()
{
	$conexion = crearConexion();
	$consulta =     "select id, name from category";
	$resultado = mysqli_query($conexion, $consulta);
	$datos = array();
	while ($valores = mysqli_fetch_assoc($resultado))
		$datos[$valores['id']] = $valores['name'];

	cerrarConexion($conexion);
	return $datos;
}



function getCategorias()
{
	// Completar...	
	$conexion = crearConexion();
	$consulta =	"select id, name from category";
	$valores = mysqli_query($conexion, $consulta);

	cerrarConexion($conexion);
	return $valores;
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
	$consulta = "SELECT name, cost, price, category_id  FROM product WHERE id=$ID";
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
	/*$id_categoria = getProducto($categoria);*/
	$resultado = getCategorias();
	/*var_dump($resultado);*/
	$categoria = $resultado['id'];

	/*
	 * A continución añadimos el producto en la base de datos.
	*/
	$conexion = crearConexion();
	$consulta = "INSERT INTO product (Name, Cost, Price, Category_ID) 
				VALUES ('$nombre' , '$coste' , '$precio' , $categoria);";

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

	$conn = crearConexion();

	$prendas = ["PANTALÓN" => 1, "CAMISA" => 2, "JERSEY" => 3,"CHAQUETA" => 4];

	echo "<br>funcion editar producto<br>";
	echo "<br>id " .$id;
	echo "<br>id " .$nombre;
	echo "<br>id " .$coste;
	echo "<br>id " .$precio;
	echo "<br>id " .$categoria;

	$mysql_query = "UPDATE product SET name = '$nombre', cost = $coste, price = $precio, category_id = $prendas[$categoria] WHERE id = $id";
	$resultado = mysqli_query($conn, $mysql_query);

	echo "<br>" . $mysql_query. " resultado de la consulta " . $resultado;
	cerrarConexion($conn);
}
