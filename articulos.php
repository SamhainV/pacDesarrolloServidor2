<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Articulos</title>
</head>

<body>

	<a href="index.php"> Volver al index.php</a>
	<?php
	include "funciones.php";
	if (isset($_COOKIE['userLoggedIn'])) {  // Comprobando si el acceso fue realizado por el usuario superadmin le
		$userAcces = $_COOKIE['userLoggedIn'];
		echo '<br>Tipo de usuario ' . $userAcces;
		if ($userAcces == 'registrado' || $userAcces == 'autorizado') {
			/*echo '<br>usuario apto lara listar ' . $userAcces;*/
			$autorizado = true;
		} else {
			echo '<br>No tiene permisos de acceso.';
			$autorizado = false;
		}

		if ($autorizado) {
			$conn = crearConexion();
			$consulta =	"SELECT product.id, product.name, product.cost, product.price, product.category_id FROM product";
			$resultado = mysqli_query($conn, $consulta);
			echo "
			<h1>Lista de artículos</h1>
			<table border='1' cellpadding='5' cellspacing='0'>
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>Coste</th>
					<th>Precio</th>
					<th>Categoria</th>
					<th>Acciones</th>
				</tr>
				";
			while ($elementos = mysqli_fetch_array($resultado)) {
				echo '<tr>';
				echo "<td>" . $elementos['id'] . "</td>";
				echo "<td>" . $elementos['name'] . "</td>";
				echo "<td>" . $elementos['cost'] . "</td>";
				echo "<td>" . $elementos['price'] . "</td>";
				echo "<td>" . $elementos['category_id'] . "</td>";
				echo '</tr>';
			}
			echo "</table>";
		}
	}
	?>

</body>

</html>