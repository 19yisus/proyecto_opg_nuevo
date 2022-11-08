<!DOCTYPE html>
<html lang="en">
<?php $this->Head(); ?>

<body>
  <div class="col-md-12" id="App_vue">
    <div class="row">
      <!-- CONTENEDOR DE NAVBAR -->
      <?php $this->Navbar(); ?>
      <!-- CONTENEDOR DE TABLA Y BUSCADOR -->
      <div class="col-md-12">

        <div class="col-md-8 mx-auto " style="margin-top:5%;">

          <!-- input de busqueda -->
          <div class="col-md-12 row " style="margin: 0; padding: 0;">
            <div class="col-md-3" style="margin: 0; padding: 0;">
              <h6 class="fw-bold text-danger">Periodo: {{des_periodo}}</h6>
            </div>

            <div class="col-md-7">
              <h3 class="fw-bold text-success">Gestión de Pensum</h3>
            </div>
            <div class="col-md-2 justify-content-end" style="margin: 0; padding: 0;">
              <button type="button" class="btn btn-sm btn-primary" @click="LimpiarForm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <i class="fa-regular fa-user"></i> AGREGAR
              </button>
            </div>
          </div>

          <!-- contenedor de la tabla -->
          <div class="col-md-12 ">
            <div class="col ">
              <table class="table border" id="datatable">
                <thead>
                  <tr>
                    <th class="text-center" scope="col">Código</th>
                    <th class="text-center" scope="col">Años que abarca</th>
                    <th class="text-center" scope="col">Perido Escolar</th>
                    <th class="text-center" scope="col">Estatus del pensum</th>
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
      <div class="modal fade modal-lg" id="staticBackdrop" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Registro Pensum</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" @submit.preventDefault="SendData" id="Formulario" class="needs-validation">
              <div class="modal-body row ">
                <input type="hidden" name="id" v-model="id" v-if="id != '' ">
                <input type="hidden" name="id_periodo" v-model="id_periodo">
                <div class="col-6">
                  <label class="form-label">Código: </label>
                  <input type="text" minlength="5" maxlength="5" v-model="cod_pensum" name="cod_pensum" class="form-control form-control-sm" required id="" placeholder="Código del pensum">
                </div>
                <div class="col-6">
                  <label class="form-label">Periodo Escolar: </label>
                  <input type="text" minlength="1" maxlength="30" v-model="des_periodo" name="periodoescolar" class="form-control form-control-sm" required id="" readonly placeholder="Descripción del periodo">
                </div>
                <div class="col-12">
                  <label for="" class="form-label">Años que abarca este pensum</label>
                  <div class="d-flex justify-content-around mx-2">
                    <div class="form-check">
                      <input type="radio" name="anios_abarcados" v-bind:checked="anios_abarcados == 'B'" id="" value="B" class="form-check-input">
                      <small class="form-check-label">Basica</small>
                    </div>
                    <div class="form-check">
                      <input type="radio" name="anios_abarcados" v-bind:checked="anios_abarcados == 'D'" id="" value="D" class="form-check-input">
                      <small class="form-check-label">Diversificado</small>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal-footer mx-auto">
                <input type="hidden" name="ope" v-model="action">
                <button type="submit" class="btn btn-sm btn-primary" v-bind:disabled="action != 'Save'" :disabled="id_periodo == '' ">
                  <i class="fa-regular fa-circle-check"></i>GUARDAR
                </button>
                <button type="button" @click="LimpiarForm" class="btn btn-sm btn-danger" data-bs-dismiss="modal">
                  <i class="fa-regular fa-circle-xmark"></i>SALIR
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="modal_consulta" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Consulta Pensum</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row ">
              <div class="col-md-6">
                <label class="form-label">Año del Pensum</label>
                <select disabled class="form-select form-select-sm" v-model="anio" required aria-label="Default select example">
                  <option value="" selected>Seleccionar</option>
                  <option value="1">1er Año</option>
                  <option value="2">2do Año</option>
                  <option value="3">3er Año</option>
                  <option value="4">4to Año</option>
                  <option value="5">5to Año</option>
                  <option value="6">6to Año</option>
                </select>
              </div>
              <div class="col-6">
                <label class="form-label">Periodo Escolar: </label>
                <input type="text" minlength="1" maxlength="30" v-model="periodo_escolar_consultado" name="periodoescolar" class="form-control form-control-sm" required id="" readonly placeholder="Descripción del periodo">
              </div>
            </div>

            <div class="modal-footer mx-auto">
              <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">
                <i class="fa-regular fa-circle-xmark"></i>SALIR
              </button>
            </div>
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
          anio: "",
          cod_pensum: "",
          anios_abarcados: "",
          periodo_escolar_consultado: "",
          estatus: "",
          id_periodo: "",
          action: "Save",
        }
      },
      methods: {
        SendData(e) {

          e.preventDefault();
          // if(!$("#Formulario").valid()) return false;
          let form = new FormData(e.target);

          fetch("./Controllers/PensumController.php", {
            method: "POST",
            body: form
          }).then(res => res.json()).then(result => {
            
            this.id = "";
            this.estatus = "";
            $("#datatable").DataTable().ajax.reload(null, false);
            this.ToggleModal();
            ViewAlert(result.mensaje, result.estado);
            this.periodo_activo();
            this.LimpiarForm();
          }).catch(Error => console.error(Error))
        },
        async GetData(id) {
          this.action = "Consult";
          await fetch(`./Controllers/PensumController.php?ope=ConsultOne&&id=${id}`)
            .then(res => res.json()).then(({
              data
            }) => {

              this.materias_select = [];
              this.cod_pensum = data.cod_pensum;
              this.anios_abarcados = data.anios_abarcados;
              this.periodo_escolar_consultado = data.periodoescolar;
            }).catch(error => console.error(error))
        },
        async ChangeState(id) {
          this.id = id;
          this.action = "ChangeStatus";

          setTimeout(async () => {
            let form = new FormData(document.getElementById("Formulario"));
            await fetch(`./Controllers/PensumController.php`, {
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
              if (data[0] != undefined) {
                this.id_periodo = data.id_periodo_escolar
                this.des_periodo = data.periodoescolar;
              } else {
                this.id_periodo = "";
                this.des_periodo = "No hay Periodo Escolar Activo";
              }
            }).catch(Error => console.error(Error))
        },
        ToggleModal() {
          $("#staticBackdrop").modal("hide");
          $("body").removeClass("modal-open");
          $(".modal-backdrop").remove();
        },
        LimpiarForm() {
          this.id = "";
          this.anios_abarcados = "";
          this.cod_pensum = "";
          this.estatus = "";
          this.action = "Save";
        },
      },
      async mounted() {
        await this.periodo_activo();
      }
    }).mount("#App_vue");

    const CambiarEstatus = (e) => app.ChangeState(e.dataset.id)
    const Consult = (e) => app.GetData(e.dataset.id)

    $("#datatable").DataTable({
      ajax: {
        url: "./Controllers/PensumController.php?ope=ConsulAll",
        dataSrc: "data"
      },
      columns: [{
          data: "cod_pensum"
        },
        {
          data: "anios_abarcados",
          render(data) {
            if (data == "B") return "Basica";
            else return "Diversificado"
          }
        },
        {
          data: "periodoescolar"
        },
        {
          data: "estatus_pensum",
          render: function(data) {
            return data == 1 ? "Activo" : "Inactivo"
          }
        },
        {
          defaultContent: '',
          render: function(data, type, row) {
            let classStatus = row.estatus_pensum == 1 ? 'success' : 'danger';
            let btns = `
              <div class="">
                <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onClick="Consult(this)" data-id='${row.id}' class="btn btn-sm btn-info">
                  <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                      
                <button type="button" onClick="CambiarEstatus(this)" data-id='${row.id}' class="btn btn-sm btn-${classStatus}">
                  <i class="fas fa-power-off"></i>
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