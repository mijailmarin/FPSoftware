<?php include 'partials/head.php';?>
<?php include 'partials/menu.php';?>
<div class="container d-flex w-100 h-100 mx-auto flex-column animated flipInX">
	<div class="row">
		<div class="col">
			<form method="POST" class="form-signin was-validated">
				<div class="text-center mb-4">
					<span style="font-size: 80px;">
						<i class="fas fa-dice text-custom1 animated bounce delay-1s"></i>
					</span>
					<h1 class="mb-3 text-custom1">Sorteos App</h1>		
					<p class="text-light">Llenar el siguiente formulario para crear un nuevo Sorteo.</p>			
					<p>
						<?php 
						if(isset($errorMsgRegister)){
							echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errorMsgSorteo.'</div>';
						}
						?>
					</p>
				</div>

				<div class="form-label-group">
					<input type="text" name="txtTitulo" id="txtTitulo" class="form-control is-invalid" placeholder="" autocomplete="off" required autofocus>
					<label for="txtTitulo">Titulo del sorteo</label>
				</div>

				<div class="form-label-group">                    
                <input type="text" name="txtParticipantes" id="txtParticipantes" class="form-control is-invalid" placeholder="" autocomplete="off" required autofocus>			
                    <label for="txtParticipantes">Cantidad de tickets participantes</label>
				</div>
				
				<button class="btn btn-lg btn-warning btn-block" type="submit">Confirmar</button>
			</form>		
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