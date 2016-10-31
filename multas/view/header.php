<!DOCTYPE html>
<html lang="es">
	<head>
		<title>UNIAJC - Sistemas de Información</title>
        
        <meta charset="utf-8" />
        
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.min.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
</head>

<body>
	
	<?php
		session_start();

		if (isset($_SESSION["rol"])) {
			//0 = admin, 1 = user
			if($_SESSION["rol"] == 0){
				require_once 'view/menu/menuAdmon.php';
			}
			
			if($_SESSION["rol"] == 1){
				require_once 'view/menu/menuUsuarios.php';
			}
		}
		//echo "<script> alert(" . $_SESSION["rol"] . ");</script>";
	 ?>
    <div class="container" style="padding-top:70px;">
	