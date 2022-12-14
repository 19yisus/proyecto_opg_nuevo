<!DOCTYPE html>
<html lang="en">
<?php
// require_once("./Models/InstitucionModel.php");
// $mod = new InstitucionModel();
// $datos_institucion = $mod->GetActivo();
// if (!isset($datos_institucion[0])) header("Location: ./VisInstitucion?codigo=400&&mensaje=no existen datos de la institución activo, debes de registrar uno");

require_once("Models/PeriodoModel.php");
$mod = new PeriodoModel();
$res = $mod->GetActivo('algo');
if (!isset($res['id_periodo_escolar'])) header("Location: ./VisPeriodo?codigo=400&&mensaje=no existe periodo activo, debes de registrar uno");
$this->Head();
?>

<body>
  <div class="col-md-12 bg-hero-azul h-100" id="App_vue">
    <div class="row  h-100 ">
      <!-- CONTENEDOR DE NAVBAR -->
      <?php $this->Navbar(); ?>
      <!-- CONTENEDOR DE TABLA Y BUSCADOR -->
      <div class="col-md-12 px-2 overflow-scroll" style="height:90%">
        <div class="col-md-12  mt-2 py-2 mx-auto px-2">
          <div class="col-md-12 border bg-light rounded py-2 mx-auto 2 d-flex justify-content-between row">
            <div class="col-md-7 my-auto px-3  ">
              <h2 class="fw-bold text-start my-auto text-dark">Gestión de Materias</h3>
            </div>
            <div class="col-md-2 p-3 card bg-primary ">
              <h5 class="fw-bold text-light text-center my-auto">Periodo: {{des_periodo}}</h5>
            </div>
          </div>
        </div>


        <div class="col-md-12 px-2 mx-auto  ">

          <!-- contenedor de la tabla -->
          <div class="col-md-12 card h-75 overflow-scroll p-3 shadow ">
            <div class="col-md-12 d-flex justify-content-end" style="margin: 0; padding: 0;">
              <button type="button" class="btn btn-sm btn-primary" @click="LimpiarForm" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="margin-bottom: 10px">
                <i class="fa-regular fa-user"></i> AGREGAR
              </button>
            </div>
            <div class="col ">
              <table class="table border table-sm" id="datatable">
                <thead>
                  <tr>
                    <th class="text-center" scope="col">Descripción</th>
                    <th class="text-center" scope="col">Perido Escolar</th>
                    <th class="text-center" scope="col">Pensum</th>
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
      <div class="modal fade modal-lg" id="staticBackdrop" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header  bg-hero-azul ">
              <h5 class="modal-title" id="staticBackdropLabel">Registro Materias</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!--
               <div class="input-group input-group-sm">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Small</span>
                  <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div> 
              -->
            <form action="#" @submit.preventDefault="SendData" id="Formulario" class="needs-validation" novalidate autocomplete="off">
              <div class="col-md-12 mx-auto rounded border d-flex justify-content-between mt-2 row">
                <h5 class="text-start col-md-8">Pensum: {{info_pensum_1}} | {{info_pensum_2}}</h5>
                <h5 class="text-end col-md-4">Periodo: {{des_periodo}}</h5>
              </div>
              <div class="modal-body row py-2" style="padding: 0 70px ;">
                <input type="hidden" name="id" v-model="id" v-if="id != '' ">
                <input type="hidden" name="id_periodo" v-model="id_periodo">
                <div class="col-md-6 mt-3">
                  <div class="input-group input-group-sm form-group form-box" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Descripción:</span>
                    <input type="text" minlength="1" maxlength="30" v-model="des_materia" name="des_materia" class="form-control form-control-sm" required id="des_materia" placeholder="Descripción de la materia" style="width:70%; text-transform:uppercase;">
                    <span class="error-text">Rellene el campo correctamente</span>
                  </div>
                </div>
                <div class="col-md-6 mt-3">
                  <div class="input-group input-group-sm form-group form-box" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Pensum:</span>
                    <select class="form-select form-select-sm" name="id_pensum" @change="ValidaPensum" v-model="id_pensum" required aria-label="Default select example" disabled>
                      <option value="" selected>Seleccionar</option>
                      <option v-for="item in pensums" :data-anio="item.anios_abarcados" :value="item.id">{{ item.cod_pensum }} {{ (item.anios_abarcados == 'B') ? 'Basica' : 'Diversificado' }}</option>
                    </select>

                  </div>
                </div>

                <div class="col-12 mt-2">
                  <label for="">Años abarcados</label>
                  <div class="d-flex justify-content-around">
                    <div class="form-check">
                      <input type="checkbox" v-bind:disabled="tipo_pensum == 'D'" v-bind:checked="primero == 1 && primero != ''" name="primero" id="primero" value="1" class="form-check-input">
                      <small class="form-check-label">1er</small>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" v-bind:disabled="tipo_pensum == 'D'" v-bind:checked="segundo == 1 && segundo != ''" name="segundo" id="segundo" value="1" class="form-check-input">
                      <small class="form-check-label">2do</small>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" v-bind:disabled="tipo_pensum == 'D'" v-bind:checked="tercero == 1 && tercero != ''" name="tercero" id="tercero" value="1" class="form-check-input">
                      <small class="form-check-label">3ro</small>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" v-bind:disabled="tipo_pensum == 'B'" v-bind:checked="cuarto == 1 && cuarto != ''" name="cuarto" id="cuarto" value="1" class="form-check-input">
                      <small class="form-check-label">4to</small>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" v-bind:disabled="tipo_pensum == 'B'" v-bind:checked="quinto == 1 && quinto != ''" name="quinto" id="quinto" value="1" class="form-check-input">
                      <small class="form-check-label">5to</small>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" v-bind:disabled="tipo_pensum == 'B'" v-bind:checked="sexto == 1 && sexto != ''" name="sexto" id="sexto" value="1" class="form-check-input">
                      <small class="form-check-label">6to</small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer mx-auto">
                <input type="hidden" name="ope" v-model="action">
                <button type="submit" class="btn btn-sm btn-primary" v-bind:disabled="registro_btn_disabled" id="btn-g">
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
          des_materia: "",
          id_periodo: "",
          id_pensum: "",
          estatus: "",
          primero: "",
          segundo: "",
          tercero: "",
          cuarto: "",
          quinto: "",
          sexto: "",
          formulario_valido: false,
          registro_btn_disabled: true,
          tipo_pensum: "",
          pensums: [],
          info_pensum_1: "",
          info_pensum_2: "",
          action: "Save",
        }
      },
      methods: {
        SendData(e) {
          e.preventDefault();
          // if(!$("#Formulario").valid()) return false;
          let form = new FormData(e.target);

          if (!this.formulario_valido) return false;
          fetch("./Controllers/MateriasController.php", {
            method: "POST",
            body: form
          }).then(res => res.json()).then(result => {

            $("#datatable").DataTable().ajax.reload(null, false);
            this.ToggleModal();
            ViewAlert(result.mensaje, result.estado);
            this.formulario_valido = false;
            this.LimpiarForm();
            this.periodo_activo();
          }).catch(Error => console.error(Error))
        },
        ValidaPensum(e) {
          let pensum = this.pensums.filter(item => {
            if (item.id == e.target.value) return item;
          })[0]

          this.tipo_pensum = pensum.anios_abarcados;
        },
        async Get_pengums() {
          await fetch(`./Controllers/PensumController.php?ope=ConsulActivos`)
            .then(res => res.json()).then(({
              data
            }) => {
              if (data[0]) {
                this.registro_btn_disabled = false;
                this.info_pensum_1 = `${data[0].cod_pensum} - ${data[0].anios_abarcados == 'B' ? 'Basica' : 'Diversificado'}`;
                if (data[1]) {
                  this.info_pensum_2 = `${data[1].cod_pensum} - ${data[1].anios_abarcados == 'B' ? 'Basica' : 'Diversificado'}`;
                }
              } else {
                this.registro_btn_disabled = true;
              }
            }).catch(Error => console.error(Error))
        },
        async GetData(id) {
          await fetch(`./Controllers/MateriasController.php?ope=ConsultOne&&id=${id}`)
            .then(res => res.json()).then(({
              data
            }) => {
              this.id = data.id_materia;
              this.des_materia = data.des_materia;
              this.id_pensum = data.id_pensum_ma;
              this.primero = data.primero;
              this.segundo = data.segundo;
              this.tercero = data.tercero;
              this.cuarto = data.cuarto;
              this.quinto = data.quinto;
              this.sexto = data.sexto;
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
              if (data[0] != undefined) {
                this.id_periodo = data.id_periodo_escolar
                this.des_periodo = data.periodoescolar;
              } else {
                this.id_periodo = "";
                this.des_periodo = "No hay Periodo Escolar Activo";
              }
            }).catch(Error => console.error(Error))
        },
        async getPemsun() {
          await fetch(`./Controllers/PensumController.php?ope=ConsulAll`)
            .then(res => res.json()).then(({
              data
            }) => {
              let res = data.filter(item => {
                if (item.estatus_pensum == '1') return item;
              });
              this.pensums = res;
            }).catch(Error => console.error(Error))
        },
        ToggleModal() {
          $("#staticBackdrop").modal("hide");
          $("body").removeClass("modal-open");
          $(".modal-backdrop").remove();
        },
        LimpiarForm() {
          this.id = "";
          this.des_materia = "";
          this.id_pensum = "";
          this.primero = ""
          this.segundo = ""
          this.tercero = ""
          this.cuarto = ""
          this.quinto = ""
          this.sexto = ""

          document.getElementById("primero").checked = false;
          document.getElementById("segundo").checked = false;
          document.getElementById("tercero").checked = false;
          document.getElementById("cuarto").checked = false;
          document.getElementById("quinto").checked = false;
          document.getElementById("sexto").checked = false;
          this.action = "Save";
        }
      },
      async mounted() {
        await this.periodo_activo();
        await this.getPemsun();
        await this.Get_pengums();
      }
    }).mount("#App_vue");

    const CambiarEstatus = (e) => app.ChangeState(e.dataset.id)
    const Consult = (e) => app.GetData(e.dataset.id)

    $("#datatable").DataTable({
      ajax: {
        url: "./Controllers/MateriasController.php?ope=ConsulAll",
        dataSrc: "data"
      },
      columns: [{
          data: "des_materia",
          render(data) {
            return data.toUpperCase()
          }
        },
        {
          data: "periodoescolar"
        },
        {
          data: "anios_abarcados",
          render(data) {
            if (data == "B") return "Basico";
            if (data == "D") return "Diversificado";
          }
        },
        {
          data: "estatus_materia",
          render(data) {
            return data == 1 ? "Activo" : "Inactivo"
          }
        },
        {
          defaultContent: '',
          render: function(data, type, row) {
            let classStatus = row.estatus_materia == 1 ? 'success' : 'danger';
            let btns = `
              <div class="d-flex justify-content-center">
                <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onClick="Consult(this)" data-id='${row.id_materia}' class="btn btn-sm btn-info">
                  <i class="fa-solid fa-edit"></i>
                </button>
                
                <!-- <button type="button" onClick="CambiarEstatus(this)" data-id='${row.id_materia}' class="btn btn-sm btn-${classStatus}">
                  <i class="fas fa-power-off"></i>
                </button> -->
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

    let tiempoFuera = null;
    let materiaValida = false;

    document.querySelectorAll('.form-box').forEach((box) => {
      app.formulario_valido = false;
      const boxInput = box.querySelector('input');

      boxInput.addEventListener("blur", (event) => {
        clearTimeout(tiempoFuera);
        tiempoFuera = setTimeout(() => {
          console.log(`input ${boxInput.name} value: `, boxInput.value)
          validacion(box, boxInput, null)
        });
      });

      let button = document.querySelector('#btn-g');
      button.addEventListener('click', e => {
        console.log(document.getElementById("Formulario").des_materia)
        validacion(box, boxInput);
        // app.ToggleModal();
        materiaValida = false;
      })
    });



    function validacion(box, boxInput) {

      if (boxInput != null && boxInput.name == "des_materia") {
        if (boxInput.value.length < 1) {
          console.log('Materia')
          mostrarError(true, box);
          materiaValida = false;
          document.querySelector('select').value = "";
          document.querySelector('select').disabled = true;
        } else {
          console.log('Materia')
          mostrarError(false, box);
          materiaValida = true;
          document.querySelector('select').disabled = false;
        }
      }

      if (materiaValida) {
        app.formulario_valido = true;


      } else {
        app.formulario_valido = false;
      }

    }

    function mostrarError(check, box) {
      // console.log("MOSTRAR ERROR");
      if (check) {
        box.classList.remove('div-error');
        box.classList.add('form-error');
      } else {
        box.classList.add('div-error');
        box.classList.remove('form-error');
      }
    }
  </script>

  <!-- <script src="./views/js/Seccion/index.js"></script> -->
</body>

</html>