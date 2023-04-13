<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Formulario de artículos</title>
</head>

<body>

	<?php

	include "funciones.php";

	/* Comprobar acceso por usuario con permisos */
	if (isset($_COOKIE['userLoggedIn'])) {
		$userAcces = $_COOKIE['userLoggedIn'];
		echo '<br>Tipo de usuario: ' . $userAcces . '<br><br>';

		if ($userAcces == 'registrado' || $userAcces == 'autorizado') {
			$autorizado = true;
		} else {
			echo '<br>No tiene permisos de acceso.';
			$autorizado = false;
		}
	} else {
		$autorizado = false;
		echo "<h2> No tiene permisos para estar aquí </h2>";
		echo "<a href = 'index.php'> Volver al index </a>";
	}
	if ($autorizado) {
		if (isset($_GET['accion'])) {

			$acciones = $_GET['accion']; // Localizar la acción.

			if ($acciones == 'editar') {
				/*formulario($id, $nombre, $coste, $precio, $categoria, "Editar");*/
				formulario("Editar");
			} else if ($acciones == 'annadir') {
				formulario("Añadir");
				/*echo "<br>Accion Añadir!!";*/
				/*formulario($id, $nombre, $coste, $precio, $categoria, "Añadir");*/
			} else if ($acciones == 'borrar') {
				echo "<br>Accion Borrar!!";
				formulario("Borrar");
			}
		}

		/* 
		 * Formulario de la acción annadir 
		 */
		if (isset($_GET['sendForm'])) {
			$accion = $_GET['sendForm'];
			$nombre = $_GET['nombre'];
			$coste = $_GET['coste'];
			$precio = $_GET['precio'];
			$categoria = $_GET['categoria'];
			echo 'la accion es ' . $accion;
			switch ($accion) {
				case 'Editar':
					$id = $_GET['id'];
					$consulta_realizada = editarProducto($id, $nombre, $coste, $precio, $categoria);
					if ($consulta_realizada) echo "<h2>Producto actualizado de forma satisfactoria</h2>";
					else echo "<br>Error en la Actualización<br>";
					break;
				case 'Añadir':
					echo "<br>Acción añadir del subformulario<br>";
					if (anadirProducto($nombre, $coste, $precio, $categoria))
						echo "<h2>Producto añadido de forma satisfactoria</h2>";
					else echo "<br>Error añadiendo registro<br>";
					break;
				case 'Borrar':
					$id = $_GET['id'];
					echo "<br>Acción borrar del subformulario<br>";
					if (borrarProducto($id))
						echo "<h2>Producto eliminado de forma satisfactoria</h2>";
					else echo "<br>Error eliminando registro<br>";
					break;
				default:
					break;
			}
		}
		echo "<a href = 'articulos.php'> Volver al listado de articulos.</a>";
	}

	function formulario($tipo)
	{

		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$datos = getProducto($id);
			$nombre = $datos['name'];
			$coste = $datos['cost'];
			$precio = $datos['price'];
			$categoria = $datos['category_id'];
		} else {
			$id = NULL;
			$nombre = "";
			$coste = "";
			$precio = "";
			$categoria = "PANTALÓN";
		}

		// Etiquetas e inputs del formulario.
		if ($tipo == 'Borrar') $readOnly = 'readonly';
		else $readOnly = '';
		echo "	<form action = '#' method = 'get'>";
		if ($id) echo "<label>ID </label>		<input type = 'text' name = 'id' size = '5' value = '$id' readonly>	<br>";
		echo "         <label>Nombre </label>	<input type = 'text' name = 'nombre' size = '20' value = '$nombre' $readOnly>	<br>
					   <label>Coste </label>	<input type = 'text' name = 'coste' size = '12' value = '$coste' $readOnly>	<br>
					   <label>Precio </label>	<input type = 'text' name = 'precio' size = '11' value = '$precio' $readOnly><br>
			";
		
		pintaCategorias($categoria);
		echo "
					   <input type = 'submit' name = 'sendForm' value = '$tipo'>
				</form>
			<br>
			";
	}
	?>
</body>

</html>