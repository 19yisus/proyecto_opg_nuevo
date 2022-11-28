<!DOCTYPE html>
<html lang="en">
<?php
$this->Head();
require_once("Models/PeriodoModel.php");
require_once("./Models/InstitucionModel.php");
$mod = new InstitucionModel();
$datos_institucion = $mod->GetActivo();
if (!isset($datos_institucion[0])) header("Location: ./VisInstitucion?codigo=400&&mensaje=no existen datos de la institución activo, debes de registrar uno");

$mod = new PeriodoModel();
$res = $mod->GetActivo('algo');
if (!isset($res['id_periodo_escolar'])) header("Location: ./VisPeriodo?codigo=400&&mensaje=no existe periodo activo, debes de registrar uno");
?>

<body>
  <div class="col-md-12 bg-hero-azul h-100" id="App_vue">
    <div class="row">
      <!-- CONTENEDOR DE NAVBAR -->
      <?php $this->Navbar(); ?>
      <!-- CONTENEDOR DE TABLA Y BUSCADOR -->
      <div class="col-md-12 px-2">
        <div class="col-md-12  mt-2 py-2 mx-auto px-2">
          <div class="col-md-12 border bg-light rounded py-2 mx-auto 2 d-flex justify-content-between row">
            <div class="col-md-7 my-auto px-3  ">
              <h2 class="fw-bold text-start my-auto text-dark">Reporte de Bitacora</h3>
            </div>
            <div class="col-md-2 p-3 card bg-primary ">
              <h5 class="fw-bold text-light text-center my-auto">Periodo: {{des_periodo}}</h5>
            </div>
          </div>
        </div>


        <div class="col-md-12 mx-auto px-2 overflow-scroll ">





          <!-- contenedor de la tabla -->
          <div class="col-md-12 card p-3 shadow ">
            <div class="col-md-12 row justify-content-between" style="margin: 0; padding: 0;">

              <!-- <div class="col-md-3">
                <div class="input-group input-group-sm mb-3 shadow">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Filtar Por:</span>
                  <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option value="0">Todo</option>
                    <option value="1">Periodo Escolar</option>
                    <option value="2">Pensum</option>
                    <option value="3">Secciones</option>
                    <option value="4">Materias</option>
                    <option value="5">Profesores</option>
                    <option value="6">Estudiantes</option>
                  </select>
                </div>
              </div> -->


            </div>
            <div class="col ">
              <table class="table border" id="datatable">
                <thead>
                  <tr>
                    <th class="text-center" scope="col">Nombre de la tabla</th>
                    <th class="text-center" scope="col">Descripcion</th>
                    <th class="text-center" scope="col">Fecha</th>
                    <th class="text-center" scope="col">Usuario</th>
                    <th class="text-center" scope="col">Rol</th>

                    <!-- <th class="text-center" scope="col">Opciones</th> -->
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
              <h5 class="modal-title" id="staticBackdropLabel">Información</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" @submit.preventDefault="SendData" id="Formulario" class="needs-validation" novalidate autocomplete="off">
              <div class="modal-body row py-2" style="padding: 0 70px ;">
                <input type="hidden" name="id_institucion" v-model="id_institucion" v-if="id_institucion != '' ">
                <input type="hidden" name="id_periodo" v-model="id_periodo">


              </div>
              <div class="modal-footer mx-auto">
                <input type="hidden" name="ope" v-model="action">

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
          id_periodo: "",
          // Arrays para el formulario
          secciones: [],
          materias: [],
          // Filtros
          id_periodoFiltro: "",
          periodosFiltro: [],
          formulario_valido: true,
          evitandoDobleSubmit: false,
          info_pensum_1: "",
          info_pensum_2: "",
          bucle: 1,
          fecha_maxima: "",
          action: "Save",
        }
      },
      methods: {
        async Get_pengums() {
          await fetch(`./Controllers/PensumController.php?ope=ConsulAll`)
            .then(res => res.json()).then(({
              data
            }) => {
              if (data[0]) {
                this.info_pensum_1 = `${data[0].cod_pensum} - ${data[0].anios_abarcados == 'B' ? 'Basica' : 'Diversificado'}`;
                if (data[1]) {
                  this.info_pensum_2 = `${data[1].cod_pensum} - ${data[1].anios_abarcados == 'B' ? 'Basica' : 'Diversificado'}`;
                }
              }
            }).catch(Error => console.error(Error))
        },
        async periodo_activo() {
          await fetch(`./Controllers/PeriodoController.php?ope=ConsulAll`)
            .then(res => res.json()).then(({
              data
            }) => {
              if (data[0] != undefined) this.periodosFiltro = data;
              else this.periodosFiltro = [];
            }).catch(Error => console.error(Error))

          await fetch(`./Controllers/PeriodoController.php?ope=ConsultPeriodoActivo`)
            .then(res => res.json()).then(({
              data
            }) => {
              if (data[0] != undefined) {
                this.id_periodo = data.id_periodo_escolar;
                this.des_periodo = data.periodoescolar;
              } else this.des_periodo = "No hay Periodo Escolar Activo";
            }).catch(Error => console.error(Error))
        },
        ToggleModal() {
          $("#staticBackdrop").modal("hide");
          $("body").removeClass("modal-open");
          $(".modal-backdrop").remove();
        },
        async GetPeriodoEscolar() {
          const res = await fetch(`./Controllers/PeriodoController.php?ope=ConsultPeriodoActivo`)
            .then(res => res.json()).then(({
              data
            }) => {
              return data;
            }).catch(error => console.error(error));
          this.id_periodo = res.id_periodo_escolar;
          this.fecha_maxima = moment(res.fecha_inicio).subtract(18, "years").format("YYYY-MM-DD");
        }
      },
      computed: {
        ifPeriodo() {
          if (this.id_periodo == "") return true;
          return false;
        }
      },
      async mounted() {
        await this.periodo_activo();
        await this.GetPeriodoEscolar();
        await this.Get_pengums();
      }
    }).mount("#App_vue");

    const CambiarEstatus = (e) => app.ChangeState(e.dataset.id)
    const Asignar = (e) => app.Asignar(e.dataset.id)
    const Consult = (e) => app.GetData(e.dataset.id)

    $("#datatable").DataTable({
      ajax: {
        url: "./Controllers/InstitucionController.php?ope=ConsulAll_bitacora",
        dataSrc: "data"
      },
      columns: [{
          data: "name_tabla"
        },
        {
          data: "descripcion",
        },
        {
          data: "fecha_hora",
          // render(data){
          //   return moment(data).format("")
          // }
        },
        {
          data: "usuario"
        },
        {
          data: "rol"
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

    const validarCampos = () => {
      app.id_seccion
      console.log(app.id_seccion);
    }
  </script>
</body>

</html>