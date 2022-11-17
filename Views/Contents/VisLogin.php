<!DOCTYPE html>
<html lang="en">
<style>
	#intro {
		background-image: url(./Views/Contents/indio.jpg);
		height: 100vh;
		background-repeat: no-repeat;
		background-size: 100% 100%;
	}

	/* Height for devices larger than 576px */
	@media (min-width: 992px) {
		#intro {
			margin-top: -58.59px;
		}
	}

	.navbar .nav-link {
		color: #fff !important;
	}
</style>

<?php
if ($this->SessionActive()) header("Location: ./VisInicio");
$this->Head();
?>

<body>
	<div class="col-md-12">
		<!-- <div class="row">
			<nav class="navbar bg-dark fixed-top">
				<div class="container-fluid">
					<button class=" btn btn-outline-warning" type="button" data-bs-toggle="offcanvas"
						data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
						<span class="text-light">INGRESAR</span>
					</button>

					<form  class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
					
					<div class="offcanvas-header">
							<h5 class="offcanvas-title mx-auto" id="offcanvasNavbarLabel">Inico</h5>
							<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
						</div>
						<div class="offcanvas-body">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label"><i class="fa-solid fa-user mx-1"></i>Usuario:</label>
								<input type="text" name="usuario" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
							</div>
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label"><i class="fa-solid fa-lock mx-1"></i>Contraseña</label>
								<input type="password" name="password" class="form-control" id="exampleFormControlInput1" placeholder="123@#Aa.,">
							</div>

							<div class="d-flex">
								<button  class="btn btn-primary mx-auto">ENTRAR</button>
							</div>
						</div>
					</form>
				</div>
			</nav>
		</div> -->
		<nav class="navbar navbar-expand-lg navbar-dark d-none d-lg-block" style="z-index: 2000;">
			<div class="container-fluid">
				<!-- Navbar brand -->
				<a class="navbar-brand nav-link" href="#">
					<strong>Unidad Educativa Nacional Oscar Picon Giacopini</strong>
				</a>
				<button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarExample01" aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
					<i class="fas fa-bars"></i>
				</button>

			</div>
		</nav>

		<div id="intro" class="bg-image shadow-2-strong">
			<div class="mask d-flex align-items-center h-100" style="background-color: rgb(0 0 0 / 40%);">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-xl-4 col-md-6">
							<form action="./Controllers/AuthController.php" method="POST" name="formulario" class="bg-white justify-content-center rounded-5 shadow-5-strong p-5">
								<div class="col-md-6 mx-auto mt-2">
									<img class="img-fluid" src="./Views/includes/img.png" alt="">
								</div>
								<!-- Email input -->
								<div class="form-outline mb-4">
									<label class="form-label" for="form1Example1">Usuario:</label>
									<input type="text" name="usuario" class="form-control form-control-sm" id="exampleFormControlInput1" placeholder="name@example.com">


								</div>

								<!-- Password input -->
								<div class="form-outline mb-4">
									<label class="form-label" for="form1Example2">Contraseña</label>
									<input type="password" name="password" class="form-control form-control-sm" id="exampleFormControlInput1" placeholder="123@#Aa.,">

								</div>



								<!-- Submit button -->
								<button type="submit" name="ope" value="Login" class="col-md-12 btn text-center mx-auto btn-primary ">Ingresar</button>
							</form>
						</div>
					</div>
				</div>
			</div>
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