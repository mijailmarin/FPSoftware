<?php include 'partials/head.php';?>
<?php include 'partials/menu.php';?>
<section class="main-content">
<div >
		<h1>Campus Virtual | <span class="label label-info"><?php echo $_SESSION["usuario"]["privilegio"] == 1 ? 'Docente' : 'Estudiante'; ?></h1>
		<p>ID: <b><?php echo $_SESSION["usuario"]["id"]?></b><br>Nombre: <b><?php echo $_SESSION["usuario"]["nombre"].' '.$_SESSION["usuario"]["apellido"];?></b><br>Correo: <b><?php echo $_SESSION["usuario"]["correo"];?></b></h1>		
	</div>


<?php include 'partials/footer.php';?>