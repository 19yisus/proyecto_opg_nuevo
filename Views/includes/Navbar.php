<div class="col-md-12">
  <nav class="navbar bg-dark">

    <button class="btn btn-outline-light" type="button" data-bs-toggle="offcanvas"
      data-bs-target="#offcanvasExample" aria-controls="offcanvasExample"
      style="margin-left: 2%; position: relative;">
      <i class="fa-brands fa-elementor"></i>
    </button>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
      aria-labelledby="offcanvasExampleLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>

      <form action="./Controllers/AuthController.php" method="POST" id="cerrar">
        <input type="hidden" name="ope" value="Exit_sesion">
      </form>

      <ul class="list-group">
        <a class="list-group-item list-group-item-action" href="./VisPeriodo">Periodo</a>
        <a class="list-group-item list-group-item-action" href="./VisSeccion">Seccion</a>
        <a class="list-group-item list-group-item-action" href="./VisMaterias">Materia</a>
        <a class="list-group-item list-group-item-action" href="./VisPensum">Pensum</a>
        <a class="list-group-item list-group-item-action" href="./VisEstudiantes">Estudiante</a>
        <a class="list-group-item list-group-item-action" href="./VisProfesor">Profesor</a>
        <a class="list-group-item list-group-item-action" href="./VisNotas">Cargar Nota</a>
        <a class="list-group-item list-group-item-action" href="#" onclick="document.getElementById('cerrar').submit();">Cerrar Sesión</a>
      </ul>

      <div class="accordion" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="heading4">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
              Gestion de Periodo
            </button>
          </h2>
          <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4"
            data-bs-parent="#accordionExample">
            <ul class="list-group">
              <a class="list-group-item list-group-item-action" href="#">Periodo en Curso</a>
            </ul>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="heading5">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
             Reportes Academicos
            </button>
          </h2>
          <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5"
            data-bs-parent="#accordionExample">
            <ul class="list-group">
              <a class="list-group-item list-group-item-action" href="#">Notas Estudiantiles</a>
            </ul>
          </div>
        </div>
      </div>


    </div>
  </nav>
</div>