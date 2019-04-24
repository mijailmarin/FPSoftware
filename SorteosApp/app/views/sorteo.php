<?php include 'partials/head.php';?>
<?php include 'partials/menu.php';?>
		
<div class="container d-flex w-100 h-100 mx-auto flex-column animated flipInX">		
	<div class="row">
		<div class="col-12">
			<div class="d-flex align-items-center p-3">
				<span style="font-size: 70px;">
					<i class="p-3 fas fa-dice text-light animated bounce delay-1s"></i>
				</span>
				<div>
					<h1 class="mb-0 text-light">Sorteos App | <span class="label label-info"><?php print $_SESSION["usuario"]["privilegio"] == 1 ? 'Administrador' : 'Usuario'; ?></h1>
					<small class="text-light">Nombre: <b><?php print $_SESSION["usuario"]["nombre"].' '.$_SESSION["usuario"]["apellido"];?></b><br>Correo: <b><?php print $_SESSION["usuario"]["correo"];?></b></small>
					<span class="d-block"><a class="text-custom1" href="/sorteo_c<?php print $_SESSION["usuario"]["id"]?>"><i class="fas fa-plus-circle text-custom1"></i> Crear Sorteo</a></span>
					<span class="d-block"><a class="text-custom1" href="/logout"><i class="fas fa-sign-out-alt text-custom1"></i> Cerrar sesión</a></span>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">	
			<?php if($sorteo == null){?>
			<div class="media text-muted m-2 pt-3 px-3 rounded bg-light">
				<p>No existe ningun sorteo creado.</p>
			</div>
			<?php }else{?>
			<?php foreach($sorteo as $misSorteos) {?>
			<div class="media text-muted m-2 pt-3 px-3 rounded bg-light">		
				<span style="font-size: 42px;">
					<i class="fas fa-clipboard-list text-custom2 animated pulse delay-2s"></i>
				</span>	
				<span class="px-3 py-3 float-left">
					<h3 class="media-body pb-3 border-gray text-custom2">Id. <?php echo $misSorteos[0]?></h3>						
				</span>		
				<span class="px-3 py-3 float-left">
					<p><b class="text-custom2">TITULO</b><br><?php echo $misSorteos['titulo']?></p>				
				</span>	
				<span class="px-3 py-3 float-left">
					<p><b class="text-custom2">TOTAL PARTICIPANTES</b><br><?php echo $misSorteos['participantes']?></p>				
				</span>
				<span class="px-3 py-3 float-left">
					<p><b class="text-custom2">TICKET GANADOR</b><br><?php echo $misSorteos['ganador']?></p>				
				</span>
				<span class="px-3 py-3 float-left">
					<p><b class="text-custom2">FECHA</b><br><?php echo $misSorteos['fecha_registro']?></p>				
				</span>	
				<span class="px-3 py-3 float-right">				
					<p><a class="text-custom2" href="/sorteo_d<?php echo $misSorteos[0]?>"><i class="fas fa-trash text-custom2"></i> <b>Eliminar</b></a></p>				
				</span>			
			</div>
			<?php } } ?>			
		</div>	
	</div>
	<div class="row">
		<div class="col-12">
			<footer class="row mt-auto p-3 justify-content-center align-items-center animated fadeIn delay-1s">
				<div class="inner text-center">
					<p class="text-muted">&copy; 2019. Sorteos App<br><small>desarrollado por <a href="https://github.com/fernandocalmet" class="text-muted">CMD Pruebas SW</a></small></p>
				</div>
			</footer>
		</div>
	</div>
</div>
<?php include 'partials/footer.php';?>