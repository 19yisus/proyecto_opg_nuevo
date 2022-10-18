<!DOCTYPE html>
<html lang="en">
  <style>
    .text-anime {
    width: 0;
    overflow: hidden;
    white-space: nowrap;
    font-size: 3rem;
    margin: 0 auto;
    font-family: "Arial";
    border-right: 0.15em solid #18bdec;
    animation: typing 4s steps(38) 1s 1 normal both, blink 1s steps(1) infinite;
    color:#00398d;
    font-weight:bold;
    }
  @keyframes typing {
    from {
      width: 0;
    }
    to {
      width: 55%;    }
  }
  @keyframes blink {
    50% {
      border-color: transparent;
    }
  }


  </style>
<?php $this->Head(); ?>
<body>
  <div class="col-md-12" id="App_vue">
    <div class="row">
      <!-- CONTENEDOR DE NAVBAR -->
      <?php $this->Navbar(); ?>
      <!-- CONTENEDOR DE TABLA Y BUSCADOR -->
      <div class="col-md-12 py-5">
      	<h1 class=' text-center mt-5'>Bienvenido al Sistema de la</h1>
        <h1 class='text-anime text-center'>U.E.N. Oscar Picon Giacopini</h1>
        <img class='img-fluid' src="/opg.png" alt="">
      </div>

    </div>
  </div>

  <?php $this->Script(); ?>
</body>
</html>