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

			// Array asociativo usado para validar que categoria debe de estar SELECTED en el SELECT del formulario.
			$prendas = [1 => "PANTALÓN", 2 => "CAMISA", 3 => "JERSEY", 4 => "CHAQUETA"];

			$acciones = $_GET['accion']; // Localizar la accion 

			if ($acciones == 'editar') {
				$id = $_GET['id'];
				$datos = getProducto($id);
				$nombre = $datos['name'];
				$coste = $datos['cost'];
				$precio = $datos['price'];
				$categoria = $datos['category_id'];
				// Etiquetas e inputs del formulario.
				echo "
				<form action = '#' method = 'get'>
					<label>ID </label>		<input type = 'text' name = 'id' size = '5' value = '$id' readonly>	<br>
					<label>Nombre </label>	<input type = 'text' name = 'nombre' size = '20' value = '$nombre'>		<br>
					<label>Coste </label>	<input type = 'text' name = 'coste' size = '12' value = '$coste'>		<br>
					<label>Precio </label>	<input type = 'text' name = 'precio' size = '11' value = '$precio'>		<br>
				";

				/*
 			* En este bloque de código llamamos a la funcio getCategorias(), la cual devuelve una tabla con todas las categorias.
 			* Las va insertando en las opciones del SELECT y activa la que coincida con la categoría que estamos editando.
 			*********************************************************************************************************************
			*/
				echo "
					<label> Categoria </label>
					<select name = 'categoria'>
				";
				$categorias = getCategorias(); /* Optiene las catagorias de la table category */
				while ($resultado = mysqli_fetch_assoc($categorias)) {
					$nombreCategoria = $resultado['name'];
					if ($nombreCategoria == $prendas[$categoria])
						echo "<option selected> $nombreCategoria </option>";
					else
						echo "<option> $nombreCategoria </option>";
				}

				echo "	</select>
					<br>
					<br>
					<input type = 'submit' name = 'sendForm' value = 'Actualizar'>
				</form>
			<br>
			<a href = 'index.php'> Volver al inicio.</a>
			";
			}
		}

		/* 
		 * Formulario de la acción annadir 
		 */
		if (isset($_GET['sendForm'])) {
			$id = $_GET['id'];
			$accion = $_GET['sendForm'];
			$nombre = $_GET['nombre'];
			$coste = $_GET['coste'];
			$precio = $_GET['precio'];
			$categoria = $_GET['categoria'];
			echo 'la accion es ' . $accion;
			switch ($accion) {
				case 'Actualizar':
					echo "<br>Accion Actualizar!!";
					$consulta_realizada = editarProducto($id, $nombre, $coste, $precio, $categoria);
					break;
		/*		case 'Añadir':
					$nombre = $_GET['nombre'];
					$coste = $_GET['coste'];
					$precio = $_GET['precio'];
					$categoria = $_GET['categoria'];
					anadirProducto($nombre, $coste, $precio, $categoria);
					echo 'la accion fue ' . $accion;
					break;*/
				default:
					break;
			}
		}
	}
	?>
</body>

</html>