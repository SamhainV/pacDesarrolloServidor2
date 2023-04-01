<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Usuarios</title>
</head>

<body>

	<?php

	include "funciones.php";

	/*$sentencia = mysqli_prepare("SELECT * FROM usuarios WHERE id = ?");
	mysqli_stmt_bind_param($sentencia, "i", $id_usuario);
	mysqli_stmt_execute($sentencia);*/

	/* Comprobación de si el acceso fue realizado por el usuario superadmin */
	/* Para ello leemos el valor almacenado en la cookie */
	if (isset($_COOKIE['userLoggedIn'])) {  // Comprobando si el acceso fue realizado por el usuario superadmin le
		//echo "<br>La cookie existe.";
		//echo "el valor de la cookie es " . $_COOKIE['userLoggedIn'];
		echo '<br>Permisos Actuales: ';
		echo getPermisos();
		echo "<br>Cambiar permisos de la aplicación (management)<br>";
		if (isset($_POST['Cambiar'])) {
			echo "<br>boton cambiar pulsado... Llamando a la funcion cambiarPermisos()";
			cambiarPermisos();
			header("location:usuarios.php");
		}

		$conn = crearConexion();
		$consulta =	"SELECT user.id, user.email, user.full_name, user.enabled FROM user";
		$resultado = mysqli_query($conn, $consulta);
	?>
		<form method='post' action='#'>
			<input type='submit' name='Cambiar' value='Cambiar'>
		</form>
		<br>
		<table border='1' cellpadding='5' cellspacing='0'>
			<th> Nombre </th>
			<th> Email </th>
			<th> Enabled </th>
		<?php
		while ($elementos = mysqli_fetch_array($resultado)) {
			echo "<tr>";
			if (!$elementos['enabled']) {
				echo "<td>" . $elementos['full_name'] . "</td>";
				echo "<td>" . $elementos['email'] . "</td>";
				echo "<td>" . $elementos['enabled'] . "</td>";
			} else {
				echo "<td><b>" . $elementos['full_name'] . "</b></td>";
				echo "<td><b>" . $elementos['email'] . "</b></td>";
				echo "<td><b>" . $elementos['enabled'] . "</b></td>";
			}
			echo "</tr>";
		}
		echo "</table>";
		cerrarConexion($conn);
	} else
		echo '<br>Lo sentimos, pero no tiene permisos de acceso';
		?>
		<a href="index.php"> Volver al index.php</a>
</body>

</html>