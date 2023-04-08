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
		echo "<h2>No tiene permisos para estar aquí</h2>";
		echo "<a href='index.php'>Volver al index</a>";
	}
	if ($autorizado) {
		if (isset($_GET['accion'])) {
			$acciones = $_GET['accion']; /* Localizar la accion */
			if ($acciones == 'editar') {
				/* El $id no se puede editar */
				echo '<br>Vamos a editar el id ' . $_GET['id'];
				/*editarProducto($id, $nombre, $coste, $precio, $categoria);*/
			} else if ($acciones == 'borrar') {
				echo '<br>Vamos a borrar el id '. $_GET['id'];
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
				case 'Añadir':
					$nombre = $_GET['nombre'];
					$coste = $_GET['coste'];
					$precio = $_GET['precio'];
					$categoria = $_GET['categoria'];
					anadirProducto($nombre, $coste, $precio, $categoria);
					echo 'la accion fue ' . $accion;
					break;
				default:
					break;
			}
		}
	}
	?>
</body>

</html>