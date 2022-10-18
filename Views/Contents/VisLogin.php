<!DOCTYPE html>
<html lang="en">
	<style>
		.bg-login{
			height:70vw;
			background-image:url(./Views/includes/opg.png);
		}
	</style>

<?php 
	if($this->SessionActive()) header("Location: ./VisInicio");
	$this->Head(); 
?>
<body>
	<div class="col-md-12">
		<div class="row">
			<nav class="navbar bg-dark fixed-top">
				<div class="container-fluid">
					<button class=" btn btn-outline-warning" type="button" data-bs-toggle="offcanvas"
						data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
						<span class="text-light">INGRESAR</span>
					</button>

					<form action="./Controllers/AuthController.php" method="POST" name="formulario" class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
						<div class="offcanvas-header">
							<h5 class="offcanvas-title mx-auto" id="offcanvasNavbarLabel">Inico/Registro</h5>
							<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
						</div>
						<div class="offcanvas-body">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Usuario:</label>
								<input type="text" name="usuario" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
							</div>
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Contraseña</label>
								<input type="password" name="password" class="form-control" id="exampleFormControlInput1" placeholder="123@#Aa.,">
							</div>

							<div class="d-flex">
								<button type="submit" name="ope" value="Login" class="btn btn-outline-success mx-auto">ENTRAR</button>
							</div>
						</div>
					</form>
				</div>
			</nav>
		</div>
		<div class='row bg-login'>
		
		</div>

	</div>
	<?php $this->Script(); ?>
	<script>
		const envio = (valueBtn) => {
			document.getElementsByName("ope").value = valueBtn;
			document.getElementsByName("formulario").submit();
		}
	</script>
</body>

</html>
