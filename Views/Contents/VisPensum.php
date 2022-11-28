<!DOCTYPE html>
<html lang="en">
<?php
$this->Head();
require_once("./Models/InstitucionModel.php");
$mod = new InstitucionModel();
$datos_institucion = $mod->GetActivo();
if (!isset($datos_institucion[0])) header("Location: ./VisInstitucion?codigo=400&&mensaje=no existen datos de la institución activo, debes de registrar uno");

require_once("Models/PeriodoModel.php");
$mod = new PeriodoModel();
$res = $mod->GetActivo('algo');
if (!isset($res['id_periodo_escolar'])) header("Location: ./VisPeriodo?codigo=400&&mensaje=no existe periodo activo, debes de registrar uno");
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
              <h2 class="fw-bold text-start my-auto text-dark">Gestión de Pensum</h3>
            </div>
            <div class="col-md-2 p-3 card bg-primary ">
              <h5 class="fw-bold text-light text-center my-auto">Periodo: {{des_periodo}}</h5>
            </div>
          </div>
        </div>


        <div class="col-md-12 px-2 mx-auto  ">

          <!-- contenedor de la tabla -->
          <div class="col-md-12 card p-3 shadow ">
            <div class="col-md-12 d-flex justify-content-end" style="margin: 0; padding: 0;">
              <button type="button" class="btn btn-sm btn-primary" @click="LimpiarForm" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="margin-bottom: 10px">
                <i class="fa-regular fa-user"></i> AGREGAR
              </button>
            </div>

            <div class="col ">
              <table class="table table-sm border" id="datatable">
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
            <div class="modal-header bg-hero-azul fw-bold">
              <h5 class="modal-title" id="staticBackdropLabel">Registro Pensum</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- "./Controllers/PensumController.php" -->
            <form action="#" @submit.preventDefault="SendData" method="POST" id="Formulario" class="needs-validation">
              <div class="col-md-12 mx-auto rounded border d-flex justify-content-between mt-2 row">
                <h5 class="text-start col-md-8">Pensum: {{info_pensum_1}} | {{info_pensum_2}}</h5>
                <h5 class="text-end col-md-4">Periodo: {{des_periodo}}</h5>
              </div>
              <div class="modal-body row ">
                <input type="hidden" name="id" v-model="id" v-if="id != '' ">
                <input type="hidden" name="id_periodo" v-model="id_periodo">
                <div class="col-6">
                  <label class="form-label">Código: </label>
                  <input type="text" minlength="5" maxlength="5" v-model="cod_pensum" name="cod_pensum" class="form-control form-control-sm" required id="cod_pensum" placeholder="Código del pensum">
                  <span class="error-text">Rellene el campo correctamente</span>
                </div>
                <div class="col-6">
                  <label class="form-label">Periodo Escolar: </label>
                  <input type="text" minlength="1" maxlength="30" v-model="des_periodo" name="periodoescolar" class="form-control form-control-sm" required id="" readonly placeholder="Descripción del periodo">
                </div>
                <div class="col-12">
                  <label for="" class="form-label">Años que abarca este pensum</label>
                  <div class="d-flex justify-content-around mx-2">
                    <div class="form-check">
                      <input type="radio" name="anios_abarcados" v-model="anios_abarcados" v-bind:checked="anios_abarcados == 'B'" id="" value="B" class="form-check-input">
                      <small class="form-check-label">Basica</small>
                    </div>
                    <div class="form-check">
                      <input type="radio" name="anios_abarcados" v-model="anios_abarcados" v-bind:checked="anios_abarcados == 'D'" id="" value="D" class="form-check-input">
                      <small class="form-check-label">Diversificado</small>
                    </div>
                  </div>
                </div>
                <!-- <div v-for="(item, index) in materias" class="row my-1" v-show="action != 'Consult'">
                  <div class="col-6">
                    <div class="input-group input-group-sm form-box" style="display:flex; flex-wrap: wrap;">
                      <input type="hidden" name="id_materia[]" v-model="materias[index].id_materia">
                      <span class="input-group-text" id="inputGroup-sizing-sm">Descripción:</span>
                      <input type="text" v-bind:disabled="action == 'Consult' || action == 'Update'" name="materia[]" v-model="materias[index].des_materia" class="form-control form-control-sm" required id="" placeholder="descripción de la materia">
                      <span class="error-text">Campo vacío o año inválido</span>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="d-flex justify-content-around">
                      <div class="form-check">
                        <input type="checkbox" v-bind:disabled="anios_abarcados == 'D' || anios_abarcados == '' || action == 'Update'" v-bind:checked="materias[index].primero == 1" name="primero[]" id="" value="1" class="form-check-input">
                        <small class="form-check-label">1er</small>
                      </div>
                      <div class="form-check">
                        <input type="checkbox" v-bind:disabled="anios_abarcados == 'D' || anios_abarcados == '' || action == 'Update'" v-bind:checked="materias[index].segundo == 1" name="segundo[]" id="" value="1" class="form-check-input">
                        <small class="form-check-label">2do</small>
                      </div>
                      <div class="form-check">
                        <input type="checkbox" v-bind:disabled="anios_abarcados == 'D' || anios_abarcados == '' || action == 'Update'" v-bind:checked="materias[index].tercero == 1" name="tercero[]" id="" value="1" class="form-check-input">
                        <small class="form-check-label">3ro</small>
                      </div>
                      <div class="form-check">
                        <input type="checkbox" v-bind:disabled="anios_abarcados == 'B' || anios_abarcados == '' || action == 'Update'" v-bind:checked="materias[index].cuarto == 1" name="cuarto[]" id="" value="1" class="form-check-input">
                        <small class="form-check-label">4to</small>
                      </div>
                      <div class="form-check">
                        <input type="checkbox" v-bind:disabled="anios_abarcados == 'B' || anios_abarcados == '' || action == 'Update'" v-bind:checked="materias[index].quinto == 1" name="quinto[]" id="" value="1" class="form-check-input">
                        <small class="form-check-label">5to</small>
                      </div>
                      <div class="form-check">
                        <input type="checkbox" v-bind:disabled="anios_abarcados == 'B' || anios_abarcados == '' || action == 'Update'" v-bind:checked="materias[index].sexto == 1" name="sexto[]" id="" value="1" class="form-check-input">
                        <small class="form-check-label">6to</small>
                      </div>
                    </div>
                  </div>
                </div> -->
              </div>

              <div class="modal-footer mx-auto">
                <input type="hidden" name="ope" v-model="action">
                <!-- v-bind:disabled="action != 'Save'" -->
                <button type="submit" class="btn btn-sm btn-primary" :disabled="id_periodo == '' ">
                  <i class="fa-regular fa-circle-check"></i>GUARDAR
                </button>
                <!-- <button v-show="action == 'Save'" type="button" class="btn btn-sm btn-success" @click="aumentar">
                  <i class="fa-regular fa-circle-xmark"></i>Mas materias
                </button>
                <button v-show="action == 'Save'" type="button" class="btn btn-sm btn-warning" @click="materias.pop();" v-show="materias.length > 1">
                  <i class="fa-regular fa-circle-xmark"></i>Menos materias
                </button> -->
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
              <input type="hidden" name="ope" v-model="action">
              <button type="submit" class="btn btn-sm btn-primary" id="btn-g">
                <i class="fa-regular fa-circle-check"></i>GUARDAR
              </button>
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
          info_pensum_1: "",
          info_pensum_2: "",
          materias: [
            // {des_materia: "",primero: false,segundo: false,tercero: false,cuarto: false,quinto: false,sexto: false}
          ]
        }
      },
      methods: {
        SendData(e) {
          this.action = "Save"
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
            this.Get_pengums();
          }).catch(Error => console.error(Error))
        },
        // aumentar(materia = []) {

        //   if (materia['des']) {
        //     this.materias.push({
        //       id_materia: materia['id'],
        //       des_materia: materia['des'],
        //       primero: materia['primero'],
        //       segundo: materia['segundo'],
        //       tercero: materia['tercero'],
        //       cuarto: materia['cuarto'],
        //       quinto: materia['quinto'],
        //       sexto: materia['sexto']
        //     })
        //     return false;
        //   }
        //   this.materias.push({
        //     id_materia: "",
        //     des_materia: "",
        //     primero: false,
        //     segundo: false,
        //     tercero: false,
        //     cuarto: false,
        //     quinto: false,
        //     sexto: false
        //   })
        // },
        async GetData(id) {
          this.action = "Update";
          await fetch(`./Controllers/PensumController.php?ope=ConsultOne&&id=${id}`)
            .then(res => res.json()).then(({
              data
            }) => {
              let [pensum, materias] = data;
              // materias.forEach(item => {
              //   let list = [];
              //   list['id'] = item.id_materia;
              //   list['des'] = item.des_materia;
              //   list['primero'] = item.primero;
              //   list['segundo'] = item.segundo;
              //   list['tercero'] = item.tercero;
              //   list['cuarto'] = item.cuarto;
              //   list['quinto'] = item.quinto;
              //   list['sexto'] = item.sexto;

              //   this.aumentar(list);
              // });
              // this.materias_select = [];
              this.cod_pensum = pensum.cod_pensum;
              this.anios_abarcados = pensum.anios_abarcados;
              this.periodo_escolar_consultado = pensum.periodoescolar;
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
        await this.Get_pengums();
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

    let tiempoFuera = null;
    let codigoValida = false;

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
        console.log(document.getElementById("Formulario").cod_pensum)
        validacion(box, boxInput);
        // app.ToggleModal();
        codigoValida = false;
      })
    });



    function validacion(box, boxInput) {


      if (boxInput != null && boxInput.name == "cod_pensum") {
        if (boxInput.value.length < 1) {
          console.log('codigo')
          mostrarError(true, box);
          codigoValida = false;
        } else {
          console.log('codigo')
          mostrarError(false, box);
          codigoValida = true;
        }
      }

      console.log(codigoValida)
      if (codigoValida) {
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

    $("#cod_pensum").bind('keypress', function(event) {
      var regex = new RegExp("^[0-9]+$");
      var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
      if (!regex.test(key)) {
        event.preventDefault();
        return false;
      }
    });
  </script>
</body>

</html>