<div class="col-md-12">
  <nav class="navbar bg-dark">

    <button class="btn btn-outline-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample" style="margin-left: 2%; position: relative;">
      <i class="fa-brands fa-elementor"></i> Menú
    </button>

    <div class="col-sm-4">
      <h5 class="text-bg-dark ml-4"><?php echo $_SESSION['des_rol'] . "-" . $_SESSION['ced_usuario']; ?></h5>
    </div>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <ul class="list-group">
        <a class="list-group-item list-group-item-action" href="./VisPrincipal">Inicio</a>
      </ul>
      <form action="./Controllers/AuthController.php" method="POST" id="cerrar">
        <input type="hidden" name="ope" value="Exit_sesion">
      </form>

      <div class="accordion" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="heading4">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
              Gestión Academica
            </button>
          </h2>
          <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#accordionExample">
            <ul class="list-group">
              <a class="list-group-item list-group-item-action" href="./VisPeriodo">Gestión de Periodo Escolar</a>
              <a class="list-group-item list-group-item-action" href="./VisPensum">Gestión de Pensum</a>
              <a class="list-group-item list-group-item-action" href="./VisSeccion">Gestión de Secciones</a>
              <a class="list-group-item list-group-item-action" href="./VisMaterias">Gestión de Materias</a>
              <a class="list-group-item list-group-item-action" href="./VisEstudiantes">Gestión de Estudiantes</a>
              <a class="list-group-item list-group-item-action" href="./VisProfesor">Gestión de Profesores</a>
            </ul>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="heading5">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
              Reportes Academicos
            </button>
          </h2>
          <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#accordionExample">
            <ul class="list-group">
              <a class="list-group-item list-group-item-action" href="./VisNotas">Cargar Nota</a>
            </ul>
          </div>
        </div>
      </div>
      <ul class="list-group">
        <?php if ($_SESSION['id_rol'] == '1') { ?>
          <a class="list-group-item list-group-item-action" href="./VisUsuarios">Configuración de usuarios</a>
        <?php } ?>
        <a class="list-group-item list-group-item-action" href="#" onclick="document.getElementById('cerrar').submit();">Cerrar Sesión</a>
      </ul>
    </div>
  </nav>
</div>