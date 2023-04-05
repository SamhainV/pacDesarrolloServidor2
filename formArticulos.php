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
		echo '<br>Tipo de usuario ' . $userAcces . '<br><br>';
		if ($userAcces == 'registrado' || $userAcces == 'autorizado') {
			$autorizado = true;
		} else {
			echo '<br>No tiene permisos de acceso.';
			$autorizado = false;
		}
	}
	if ($autorizado) {
		$acciones = $_GET['accion']; /* Localizar la accion */
		if ($acciones == 'annadir') {

			echo "&#9484";
			for ($i = 0; $i < 10; $i++)
				echo "&#9472";

			echo "
			<form action = '#'>
			<label>&#9474&nbsp&nbsp&nbspNombre </label><input type='text' name='nombre' size='20'><br>&#9474<br>
			<label>&#9474&nbsp&nbsp&nbspCoste </label><input type='text' name='coste' size='22'><br>&#9474<br>
			<label>&#9474&nbsp&nbsp&nbspPrecio </label><input type='text' name='precio' size='21'><br>&#9474<br>
			<label>&#9474&nbsp&nbsp&nbspCategoria </label><input type='text' name='categoria' size='18'><br>&#9474<br>
			";
/*			&#9474&nbsp&nbsp&nbsp<input type='submit' name='sendForm' value='Añadir'>*/
			echo "&#9474";
			for ($i = 0; $i < 50; $i++)
				echo "&nbsp";
			echo "<input type='submit' name='sendForm' value='Añadir'>
			</form>
			";
			
			echo "&#9492";
			for ($i = 0; $i < 10; $i++)
				echo "&#9472";

		}
	}

	?>


</body>

</html>