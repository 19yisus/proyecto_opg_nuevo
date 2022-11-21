<!-- <div class="col-md-12">
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
              <a class="list-group-item list-group-item-action" href="./VisInstitucion">Gestión datos de la institución</a>
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
</div> -->
<div class="col-md-12">
 <nav class="navbar bg-light shadow justify-content-between">

    <button class="btn btn-outline-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample" style="margin-left: 2%; position: relative;">
      <i class="fa-brands fa-elementor"></i> Menú
    </button>

    <div class="col d-flex justify-content-end px-2">
      <h5 class="text text-dark ml-4 my-auto"><i class="fas fa-user-alt mx-2"></i><?php echo $_SESSION['des_rol'] . "-" . $_SESSION['ced_usuario']; ?></h5>
    </div>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
      <div class="offcanvas-header bg-hero-azul m-1 text-dark rounded">
        <h5 class="offcanvas-title text-center" id="offcanvasExampleLabel"><i class="fa-brands fa-elementor mx-1"></i>Menu</h5>
        <button type="button" class="btn-close text-light" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="col-md-6 mx-auto mt-2">
                <img class="img-fluid" src="./Views/includes/img.png" alt="">
              </div>
      <ul class="list-group">
        <a class="list-group-item list-group-item-action fw-bold" href="./VisPrincipal"> <i class="fas fa-chart-line mx-2"></i> Inicio</a>
      </ul>
   
      <form action="./Controllers/AuthController.php" method="POST" id="cerrar">
        <input type="hidden" name="ope" value="Exit_sesion">
      </form>
      	

      <div class="accordion" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="heading4">
            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
            <i class="fas fa-cash-register mx-2"></i> Gestionar Registros
            </button>
          </h2>
          <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#accordionExample">
            <ul class="list-group">
            <a class="list-group-item list-group-item-action" href="./VisInstitucion"> <i class="fas fa-chalkboard-teacher mx-2"></i>Datos de la institución</a>  
            <a class="list-group-item list-group-item-action bg-light" href="./VisPeriodo"><i class="fas fa-calendar mx-2"></i>Periodo Escolar</a>
              <a class="list-group-item list-group-item-action bg-light" href="./VisPensum"><i class="fas fa-book-open mx-2"></i>Pensum</a>
              <a class="list-group-item list-group-item-action bg-light" href="./VisSeccion"><i class="fas fa-bars mx-2"></i>Secciones</a>
              <a class="list-group-item list-group-item-action bg-light" href="./VisMaterias"><i class="fas fa-atlas mx-2"></i>Materias</a>
              <a class="list-group-item list-group-item-action bg-light" href="./VisProfesor"><i class="fas fa-user-tie mx-2"></i>Profesores</a>
              <a class="list-group-item list-group-item-action bg-light" href="./VisEstudiantes"><i class="fas fa-user-edit mx-2"></i>Estudiantes</a>
           
            </ul>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="heading4">
            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
            <i class="fas fa-folder-minus mx-2"></i>Movimientos
            </button>
          </h2>
          <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6" data-bs-parent="#accordionExample">
            <ul class="list-group">
            <a class="list-group-item list-group-item-action" href="./VisAsignacionEstudiantes"> <i class="fas fa-chalkboard-teacher mx-2"></i>Asignar Estudiante</a>  
            <a class="list-group-item list-group-item-action" href="./VisInstitucion"> <i class="fas fa-chalkboard-teacher mx-2"></i>Asignar Materias a Profesor</a>  
           
            </ul>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="heading5">
            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
            <i class="far fa-file-pdf mx-2"></i>Reportes Academicos
            </button>
          </h2>
          <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#accordionExample">
            <ul class="list-group">
              <a class="list-group-item list-group-item-action bg-light" href="./VisNotas"><i class="fas fa-notes-medical mx-2"></i>Cargar Nota</a>
            </ul>
          </div>
        </div>
      </div>
      <ul class="list-group">
        <?php if ($_SESSION['id_rol'] == '1') { ?>
          <a class="list-group-item list-group-item-action fw-bold " href="./VisUsuarios"> <i class="fas fa-user-cog mx-2"></i> Configuración de usuarios</a>
        <?php } ?>
        <a class="list-group-item list-group-item-action text-danger fw-bold" href="#" onclick="document.getElementById('cerrar').submit();"><i class="fas fa-power-off mx-2"></i>Cerrar Sesión</a>
      </ul>
    </div>
  </nav>
 
</div>