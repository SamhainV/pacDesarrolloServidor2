<?php

include "consultas.php";

/* Pintar categoria */
function pintaCategorias($defecto)
{
	// Completar...	
}


function pintaTablaUsuarios()
{
	// Completar...	
	$resultado_consulta = getListaUsuarios();
	echo "<br>
	<form method='post' action='#'>
		<input type='submit' name='Cambiar' value='Cambiar permisos'>
	</form>
	<br>
	<table border='1' cellpadding='5' cellspacing='0'>
		<th> Nombre </th>
		<th> Email </th>
		<th> Enabled </th>
	";

	while ($elementos = mysqli_fetch_array($resultado_consulta)) {
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
}

/* ésta es. mirar minuto 37. getProductos() *************/
function pintaProductos($orden)
{
	// Completar...	

	$conn = crearConexion();

	$consulta =	"SELECT product.id, product.name, product.cost,	product.price, category.name as categoria FROM product 
	inner join category on product.category_id = category.id order by " . $orden;
	$resultado = mysqli_query($conn, $consulta);

	echo "
			<!--<h1>Lista de artículos </h1>-->
			<table border='1' cellpadding='5' cellspacing='0'>
				<tr>
					<th><a href='articulos.php?orden=id'>ID</a></th>
					<th><a href='articulos.php?orden=name'>Nombre</a></th>
					<th><a href='articulos.php?orden=cost'>Coste</a></th>
					<th><a href='articulos.php?orden=price'>Precio</a></th>
					<th><a href='articulos.php?orden=categoria'>Categoria</a></th>
					<th>Acciones</th>
				</tr>
				";

	while ($elementos = mysqli_fetch_assoc($resultado)) {
		echo '<tr>';
		echo "<td>" . $elementos['id'] . "</td>";
		echo "<td>" . $elementos['name'] . "</td>";
		echo "<td>" . $elementos['cost'] . "</td>";
		echo "<td>" . $elementos['price'] . "</td>";
		echo "<td>" . $elementos['categoria'] . "</td>";


		if ($management = getPermisos() == 1) { /* Si los permisos management están activos */
			echo "<td>" . "<a href='formArticulos.php?accion=editar'>Editar</a>
		                   <a href='formArticulos.php?accion=borrar'>Borrar</a>" .
				"</td>";
		} else {
			echo "<td>Permisos Editar/Borrar Desactivados. Management " . ($management ? '1' : '0') . "</td>";
		}
		echo '</tr>';
	}
	echo "</table>";
}
