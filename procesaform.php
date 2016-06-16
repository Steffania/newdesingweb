<?php
	if (($_POST['nombre'] != '') && ($_POST['mail'] != '') && ($_POST['mensaje'] != ''))
	{
		$para = "cabanasmburucuyapoty@gmail.com";
		$asunto = "Contacto Cabanas Mburucuya Poty";
		$mensaje = "Nombre: ".$_POST['nombre']."\r\n";
		$mensaje .= "E-mail: ".$_POST['mail']."\r\n";
		$mensaje .= "Celular: ".$_POST['celular']."\r\n";
		$mensaje .= "Consulta: ".$_POST['mensaje']."\r\n";
		$cabeceras = "MIME-Version: 1.0 \r\n";
		$cabeceras .= "Content-type: text/html; charset=iso-8859-1 \r\n";
		$cabeceras .= 'From: '.$_POST['mail']."\r\n".'Reply-To: '.$_POST['mail']."\r\n".'X-Mailer: PHP/'.phpversion();
		if (mail($para,$asunto,$mensaje,$cabeceras))
		{
			header('Location: index.html');
		}else
		{
			header('Location: index.html');
		}
	}else
	{
		
		header('Location: index.html');
	}
?>