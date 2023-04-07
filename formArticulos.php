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
			if ($acciones == 'annadir') {
				echo "
					<form action = '#' methos='get'>
					<label>ID </label><input type='text' name='nombre' size='5' readonly><br><br>
					<label>Nombre </label><input type='text' name='nombre' size='20'><br><br>
					<label>Coste </label><input type='text' name='coste' size='12'><br><br>
					<label>Precio </label><input type='text' name='precio' size='11'><br><br>
					<label>Categoria:</label>
					";
				echo "<select name='categoria'>";
				$categorias = getCategorias(); /* Optiene las catagorias de la table category */
				while ($resultado = mysqli_fetch_assoc($categorias))
					echo "<option>" . $resultado['name'] . "</option>";
				echo "</select>";
				echo "
					<br><br>
					<input type='submit' name='sendForm' value='Añadir'>
					<a href='index.php'> Volver al inicio.</a>
					</form>
					";
			} else if ($acciones == 'editar') {
				/* El $id no se puede editar */
				echo 'Vamos a editar';
				editarProducto($id, $nombre, $coste, $precio, $categoria);
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

			switch ($accion) {
				case 'annadir':
					$nombre = $_GET['nombre'];
					$coste = $_GET['coste'];
					$precio = $_GET['precio'];
					$categoria = $_GET['categoria'];
					anadirProducto($nombre, $coste, $precio, $categoria);
					break;
				default:
					break;
			}
		}
	}
	?>
</body>

</html>