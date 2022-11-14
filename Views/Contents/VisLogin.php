<!DOCTYPE html>
<html lang="en">

<?php
if ($this->SessionActive()) header("Location: ./VisInicio");
$this->Head();
?>

<body>
	<div class="col-md-12">
		<div class="row">
			<nav class="navbar bg-dark fixed-top">
				<div class="container-fluid">
					<button class=" btn btn-outline-warning" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
						<span class="text-light">INGRESAR</span>
					</button>

					<form action="./Controllers/AuthController.php" method="POST" name="formulario" class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
						<div class="col-md-6 mx-auto mt-4">
							<img class="img-fluid" src="./Views/includes/img.png" alt="">
						</div>
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
								<button type="submit" name="ope" value="Login" class="btn btn-primary mx-auto">ENTRAR</button>
							</div>
						</div>
					</form>
				</div>
			</nav>
		</div>
		<header class="hero">
			<section class="hero__container">
				<div class="hero__texts">
					<h1 class="hero__title"> Oscar picon giacopini</h1>
					<p class="hero__paragraph"> La U.E.N. “Oscar Picón Giacopini” es una casa de estudio del municipio Agua Blanca, fue fundada el 16 de septiembre del año 1973. Dicho nombre lo lleva con orgullo en honor al Lic. En Diplomacia y Educación: Oscar Picón Giacopini. </p>
					<a href="#" class="hero__cta"> Mas </a>
				</div>

				<figure class="hero__picture">
					<img src="./Views/includes/img.png" class="hero__img" alt="">
				</figure>
			</section>
			<div class="hero__wave"></div>
		</header>

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