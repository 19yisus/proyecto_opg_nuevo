<!DOCTYPE html>
<html lang="en">
<?php
if ($_SESSION['id_rol'] == '2') header("Location: ./VisInicio?codigo=400&mensaje=No tienes permisos para este modulo");
$this->Head();
require_once("./Models/AuthModel.php");
$mod = new AuthModel();
$preguntas = $mod->GetPreguntas();
?>

<body>
<div class="col-md-12 bg-hero-azul h-100" id="App_vue">
  <div class="row  h-100 " >
      <!-- CONTENEDOR DE NAVBAR -->
      <?php $this->Navbar(); ?>
      <!-- CONTENEDOR DE TABLA Y BUSCADOR -->
      <div class="col-md-12 px-2 overflow-scroll"  style="height:90%">
        <div class="col-md-12  mt-2 py-2 mx-auto px-2">
          <div class="col-md-12 border bg-light rounded py-2 mx-auto 2 d-flex justify-content-between row">
            <div class="col-md-7 my-auto px-3  ">
              <h2 class="fw-bold text-start my-auto text-dark">Gestión de Usuarios</h3>
            </div>
            <div class="col-md-2 p-3 card bg-primary ">
              <h5 class="fw-bold text-light text-center my-auto">Periodo: {{des_periodo}}</h5>
            </div>
          </div>
        </div>


        <div class="col-md-12 px-2 mx-auto  ">





          <!-- contenedor de la tabla -->
          <div class="col-md-12 card p-2 shadow">
            <div class="col ">
              <table class="table border" id="datatable">
                <thead>
                  <tr>
                    <th class="text-center" scope="col">N°</th>
                    <th class="text-center" scope="col">Usuarios</th>
                    <th class="text-center" scope="col">Rol</th>
                    <th class="text-center" scope="col">Estado</th>
                    <th class="text-center" scope="col">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal modal-xl fade" id="staticBackdrop" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Gestión de usuario</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!--
               <div class="input-group input-group-sm">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Small</span>
                  <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div> 
              -->
            <form action="#" @submit.preventDefault="SendData" id="Formulario" class="needs-validation" novalidate>
              <div class="modal-body row " style="padding: 0 70px ;">
                <input type="hidden" name="id" v-model="id" v-if="id != '' ">
                <div class="col-md-6 " style="margin:0; padding:5px;">
                  <div class="input-group input-group-sm form-group form-box" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Usuario:</span>
                    <input type="text" minlength="1" maxlength="30" v-model="usuario" name="usuario" class="form-control form-control-sm" required id="des_materia" placeholder="Cédula del usuario" style="width:70%; text-transform:uppercase;">
                    <span class="error-text">Rellene el campo correctamente</span>
                  </div>
                </div>
                <div class="col-md-6 " style="margin:0; padding:5px;">
                  <div class="input-group input-group-sm form-group form-box" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Contraseña:</span>
                    <input type="text" minlength="1" maxlength="30" v-model="password" name="password" class="form-control form-control-sm" required id="des_materia" placeholder="Contraseña" style="width:70%; text-transform:uppercase;">
                    <span class="error-text">Rellene el campo correctamente</span>
                  </div>
                </div>
                <div class="col-md-6 " style="margin:0; padding:5px;" v-if="action != 'Asignar' ">
                  <div class="input-group input-group-sm form-box-select" v-if="action != 'Asignar' " style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Pregunta (1):</span>
                    <select class="form-select" v-model="pregunta1" name="pregunta1" id="pregunta1" aria-label="Default select example" style="width: 50%;" required>
                      <option value="" selected>Seleccionar</option>
                      <?php foreach ($preguntas as $pg) { ?>
                        <option value="<?php echo $pg['id_pregun']; ?>"><?php echo $pg['des_pregun']; ?></option>
                      <?php } ?>
                    </select>
                    <span class="error-text">Selecciona tu nacionalidad</span>
                  </div>
                </div>
                <div class="col-md-6 " style="margin:0; padding:5px;">
                  <div class="input-group input-group-sm form-group form-box" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Respuesta (1):</span>
                    <input type="text" minlength="1" maxlength="30" v-model="respuesta1" name="respuesta1" class="form-control form-control-sm" required id="des_materia" placeholder="Respuesta 1" style="width:70%; text-transform:uppercase;">
                    <span class="error-text">Rellene el campo correctamente</span>
                  </div>
                </div>
                <div class="col-md-6 " style="margin:0; padding:5px;" v-if="action != 'Asignar' ">
                  <div class="input-group input-group-sm form-box-select" v-if="action != 'Asignar' " style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Pregunta (2):</span>
                    <select class="form-select" v-model="pregunta2" name="pregunta2" id="pregunta2" aria-label="Default select example" style="width: 50%;" required>
                      <option value="" selected>Seleccionar</option>
                      <?php foreach ($preguntas as $pg) { ?>
                        <option value="<?php echo $pg['id_pregun']; ?>"><?php echo $pg['des_pregun']; ?></option>
                      <?php } ?>
                    </select>
                    <span class="error-text">Selecciona tu nacionalidad</span>
                  </div>
                </div>
                <div class="col-md-6 " style="margin:0; padding:5px;">
                  <div class="input-group input-group-sm form-group form-box" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Respuesta (2):</span>
                    <input type="text" minlength="1" maxlength="30" v-model="respuesta2" name="respuesta2" class="form-control form-control-sm" required id="des_materia" placeholder="Respuesta 2" style="width:70%; text-transform:uppercase;">
                    <span class="error-text">Rellene el campo correctamente</span>
                  </div>
                </div>
              </div>
              <div class="modal-footer mx-auto">
                <input type="hidden" name="ope" v-model="action">
                <button type="submit" class="btn btn-sm btn-primary" id="btn-g">
                  <i class="fa-regular fa-circle-check"></i>GUARDAR
                </button>
                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">
                  <i class="fa-regular fa-circle-xmark"></i>SALIR
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php $this->Script(); ?>
  <script>
    const app = Vue.createApp({
      data() {
        return {
          des_periodo: "actual",
          id: "",
          usuario: "",
          password: "",
          pregunta1: "",
          respuesta1: "",
          pregunta2: "",
          respuesta2: "",
          estatus: "",
          formulario_valido: false,
          action: "Update",
        }
      },
      methods: {
        SendData(e) {

          e.preventDefault();
          // if(!$("#Formulario").valid()) return false;
          let form = new FormData(e.target);
          // if(!this.formulario_valido) return false;
          fetch("./Controllers/AuthController.php", {
            method: "POST",
            body: form
          }).then(res => res.json()).then(result => {
            this.LimpiarForm()
            $("#datatable").DataTable().ajax.reload(null, false);
            this.ToggleModal();
            ViewAlert(result.mensaje, result.estado);
            this.periodo_activo();

            setTimeout(() => document.getElementById('cerrar').submit(), 3000);
          }).catch(Error => console.error(Error))
        },
        async GetData(id) {
          await fetch(`./Controllers/AuthController.php?ope=ConsultOne&&id=${id}`)
            .then(res => res.json()).then(({
              data
            }) => {
              this.id = data.id;
              this.usuario = data.usuario;
              this.pregunta1 = data.pregunta1;
              this.pregunta2 = data.pregunta2;
              this.action = "Update";
            }).catch(error => console.error(error))
        },
        async ChangeState(id) {
          this.id = id;
          this.action = "ChangeStatus";

          setTimeout(async () => {
            let form = new FormData(document.getElementById("Formulario"));
            await fetch(`./Controllers/MateriasController.php`, {
              method: "POST",
              body: form
            }).then(res => res.json()).then(result => {
              ViewAlert(result.mensaje, result.estado);
              $("#datatable").DataTable().ajax.reload(null, false);
              this.action = "Save";
            }).catch(error => console.error(error))
          }, 100);
        },
        async periodo_activo() {
          await fetch(`./Controllers/PeriodoController.php?ope=ConsultPeriodoActivo`)
            .then(res => res.json()).then(({
              data
            }) => {
              if (data[0] != undefined) this.des_periodo = data.periodoescolar;
              else this.des_periodo = "No hay Periodo Escolar Activo";
            }).catch(Error => console.error(Error))
        },
        ToggleModal() {
          $("#staticBackdrop").modal("hide");
          $("body").removeClass("modal-open");
          $(".modal-backdrop").remove();
        },
        LimpiarForm() {
          this.id = ""
          this.usuario = ""
          this.password = ""
          this.pregunta1 = ""
          this.respuesta1 = ""
          this.pregunta2 = ""
          this.respuesta2 = ""
          this.estatus = ""
          this.action = "Save";
        }
      },
      async mounted() {
        await this.periodo_activo();
      }
    }).mount("#App_vue");

    const CambiarEstatus = (e) => app.ChangeState(e.dataset.id)
    const Consult = (e) => app.GetData(e.dataset.id)

    $("#datatable").DataTable({
      ajax: {
        url: "./Controllers/AuthController.php?ope=ConsulAll",
        dataSrc: "data"
      },
      columns: [{
          data: "id"
        },
        {
          data: "usuario",
          render(data) {
            return data.toUpperCase()
          }
        },
        {
          data: "rol",
          render(data) {
            return data.toUpperCase()
          }
        },
        {
          data: "estatus_usuario",
          render(data) {
            return data == 1 ? "Activo" : "Inactivo"
          }
        },
        {
          defaultContent: '',
          render: function(data, type, row) {
            // let classStatus = row.estatus_materia == 1 ? 'success' : 'danger';
            // <button type="button" onClick="CambiarEstatus(this)" data-id='${row.id_materia}' class="btn btn-sm btn-${classStatus}">
            //       <i class="fas fa-power-off"></i>
            //     </button>
            console.log(row)
            let btns = `
              <div class="">
                <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onClick="Consult(this)" data-id='${row.id}' class="btn btn-sm btn-info">
                  <i class="fa-solid fa-magnifying-glass"></i>
                </button>
              </div>`;
            return btns;
          }
        }
      ],
      paging: true,
      lengthChange: false,
      searching: true,
      ordering: true,
      info: true,
      autoWidth: false,
      responsive: true,
      language: {
        url: `./Views/js/DataTables.config.json`
      }
    });
  </script>
</body>

</html>