<?php
	require('../mail/conexion.php');

	if (isset($_POST["fname"])) {
		$nombre = $_POST["fname"];
		$idDocumento = mt_rand(100,999);
		$email = $_POST["email"];
		$telefono = $_POST["phone"];
		$direccion = $_POST["direccionEnvio"];
		$fechaRegistro = date('Y-m-d');
		$compras = 0;
		$ultimaCompra = "0000-00-00 00:00:00";
		$evento = $_POST["tipoEvento"];
		$numeroBanquete = $_POST["numeroBanquetes"];
		$seleccionarBanquete = $_POST["banquete"];
		$mComentario = $_POST["message"];
		$fechaEvento = $_POST["fechaEvento"];
		$fechaAcceso = date('Y-m-d H:i:s');

		$sqlConsulta = "INSERT INTO contratos (id_nombre, id_documento, id_correo, id_telefono, id_direccion, id_fechaRegistro, id_compras, id_ultima_compra, tipoDeEvento, numeroDeBanquetes, selBanquete, comentario, fechaDelEvento, id_fecha) VALUES ('$nombre','$idDocumento','$email','$telefono','$direccion','$fechaRegistro','$compras','$ultimaCompra','$evento','$numeroBanquete','$seleccionarBanquete','$mComentario','$fechaEvento','$fechaAcceso')";
		$sqlCopia = "INSERT INTO clientes (nombre, documento, email, telefono, direccion, fecha_nacimiento, compras, ultima_compra, fecha) VALUES ('$nombre','$idDocumento','$email','$telefono','$direccion','$fechaRegistro','$compras','$ultimaCompra','$fechaAcceso')";

		if(mysqli_query($conn, $sqlConsulta)) {
			if(mysqli_query($conn, $sqlCopia)) {
				echo '<h3 class="registroCorrecto">¡Registro correcto. Tus datos se han enviado!</h3>';
				header("refresh:5;url=../index.php");
			} else {
				echo "Error" . $sqlCopia . "<br>" . mysqli_error($conn);
			}
		} else {
			echo "Error" . $sqlConsulta . "<br>" . mysqli_error($conn);
		}

		/*Copiar datos de la tabla Contratos a la tabla Clientes*/


		mysqli_close($conn);
	} else {
		echo "No se ha enviado nada";
	}
?>