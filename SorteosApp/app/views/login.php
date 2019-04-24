<?php include 'partials/head.php';?>
<div class="container d-flex w-100 h-100 mx-auto flex-column animated flipInX">		
	<div class="row">
		<div class="col">
			<form method="POST" class="form-signin was-validated">
				<div class="text-center mb-4">
					<span style="font-size: 80px;">
						<i class="fas fa-dice text-custom1 animated bounce delay-1s"></i>
					</span>
					<h1 class="mb-3 text-custom1">Sorteos App</h1>
					<p class="text-light">Bienvenido, ingresa tu <b>Correo</b> y <b>Contraseña</b> de usuario para conectarte.</p>
					<p>
						<?php 
						if(isset($errorMsgLogin)){
							echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errorMsgLogin.'</div>';
						}
						?>
					</p>
				</div>

				<div class="form-label-group">
					<input type="email" name="txtEmail" id="txtEmail" class="form-control is-invalid" placeholder="Correo electronico" autocomplete="off" required autofocus>
					<label for="txtEmail">Correo</label>
				</div>

				<div class="form-label-group">
					<input type="password" name="txtPassword" id="txtPassword" class="form-control is-invalid" placeholder="Contraseña" autocomplete="off" required>
					<label for="txtPassword">Contraseña</label>
				</div>

				<button class="btn btn-lg btn-warning btn-block" type="submit">Iniciar sesión</button>  
			</form>
			<br>
			<div class="text-center mb-4">
				<span class="text-light">¿Aun no estas registrado? <a class="text-custom1" href="/registro">Crear una cuenta</a>.</span>
			</div>
			
		</div>			
	</div> 

	<div class="row">
		<div class="col">
			<footer class="row mt-auto p-3 justify-content-center align-items-center animated fadeIn delay-1s">
				<div class="inner text-center">
					<p class="text-muted">&copy; 2019. Sorteos App<br><small>desarrollado por <a href="https://github.com/fernandocalmet" class="text-muted">CMD Pruebas SW</a></small></p>
				</div>
			</footer>
		</div>
	</div>

</div>
<?php include 'partials/footer.php';?>