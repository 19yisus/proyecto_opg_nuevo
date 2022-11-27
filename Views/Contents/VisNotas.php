<!DOCTYPE html>
<html lang="en">
<?php 
  $this->Head(); 
  require_once("Models/PeriodoModel.php");
  $mod = new PeriodoModel();
  $res = $mod->GetActivo('algo');
  if(!isset($res['id_periodo_escolar'])) header("Location: ./VisPeriodo?no existe periodo activo, debes de registrar uno");
?>

<body>
  <div class="col-md-12 bg-hero-azul h-100" id="App_vue">
    <div class="row">
      <!-- CONTENEDOR DE NAVBAR -->
      <?php $this->Navbar(); ?>
      <!-- CONTENEDOR DE TABLA Y BUSCADOR -->
      <div class="col-md-12">
        <div class="col-md-12  mt-2 py-2 mx-auto px-2">
          <div class="col-md-12 border bg-light rounded py-2 mx-auto 2 d-flex justify-content-between row">
            <div class="col-md-7 my-auto px-3  ">
              <h2 class="fw-bold text-start my-auto text-dark">Gestión de Notas</h3>
            </div>
            <div class="col-md-2 p-3 card bg-primary ">
              <h5 class="fw-bold text-light text-center my-auto">Periodo: {{des_periodo}}</h5>
            </div>
          </div>
        </div>

        <div class="col-md-12 mx-auto px-2 ">

          <!-- input de busqueda -->

          <!-- contenedor de la tabla -->
          <div class="col-md-12 card p-2 shadow ">
            <div class="col-md-12 d-flex justify-content-between container-fluid row " style="margin: 0; padding: 0;">
              <div class="col-md-5" style="margin: 0; padding: 0;">
                <div class="input-group input-group-sm mb-3">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Año/Seccion:</span>
                  <select class="form-select" v-model="id_seccion" aria-label="Default select example">
                    <option value="" selected>Seleccionar</option>
                    <option :value="item.idSeccion" v-for="item in seccionesFiltro">{{item.id_seccion}}</option>
                  </select>
                </div>

              </div>
              <div class="col-md-5 d-flex justify-content-end">
                <form action="./Controllers/CreatePdfEstudiantes.php" method="POST" target="__blank">
                  <input type="hidden" name="id_seccion" v-model="id_seccion">
                  <input type="hidden" name="id_periodo" v-model="id_periodo">
                  <button type="submit" class="btn btn-danger" v-bind:disabled="id_seccion == '' || id_periodo == ''">
                    Reporte por sección
                    <i class="fas fa-file-pdf"></i>
                  </button>
                </form>
              </div>
            </div>
            <form action="./VisCreatePdfNotas" method="GET" target="__blank" id="Form_pdf">
              <input type="hidden" name="cedula" v-model="cedula_estudiante">
            </form>
            <div class="col ">
              <table class="table border" id="datatable">
                <thead>
                  <tr>
                    <th class="text-center" scope="col">N°</th>
                    <th class="text-center" scope="col">Nombre y Apellido</th>
                    <th class="text-center" scope="col">Periodo escolar</th>
                    <th class="text-center" scope="col">Estado</th>
                    <th class="text-center" scope="col">Opciones</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- <tr v-for="(data, index) in datos">
                    <td class="text-center">{{ index }}</td>
                    <td class="text-center">{{ data.ano_seguimiento }}</td>
                    <td class="text-center">"{{ data.id_seccion }}"</td>
                    <td class="text-center">{{ data.estatus_seccion }}</td>
                    <td class="text-center">
                      <button type="button" @click="GetData(data.id_seccion)" class="btn btn-sm btn-info">
                        <i class="fa-solid fa-magnifying-glass"></i>
                      </button>
                      <button type="button" class="btn btn-sm btn-dark">
                        <i class="fa-solid fa-gear"></i>
                      </button>
                      <button type="button" @click="ChangeState(data.id_seccion)" class="btn btn-sm btn-warning">
                        <i class="fa-regular fa-trash-can"></i>
                      </button>
                    </td>
                  </tr> -->
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
              <h6 class="modal-title" id="staticBackdropLabel">Registro notas - Estudiante: {{nombre}} CI: {{cedula}} - Periodo Escolar: {{periodo}}</h6>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!--
               <div class="input-group input-group-sm">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Small</span>
                  <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div> 
              -->
            <form action="#" @submit.preventDefault="SendData" id="Formulario" class="needs-validation" novalidate>
              <input type="hidden" name="id_seccion" v-model="id_seccion">
              <input type="hidden" name="id_periodo" v-model="id_periodo">
              <input type="hidden" name="cedula" v-model="cedula">
              <input type="hidden" name="observacion" value="no">
              <input type="hidden" name="estatus_notas" value="1">
              <div class="modal-body row" style="padding: 0 70px ;">
                <div class="container">
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="text-center" scope="col">Materia</th>
                        <!-- <th class="text-center" scope="col">Lapso 1</th>
                        <th class="text-center" scope="col">Lapso 2</th>
                        <th class="text-center" scope="col">Lapso 3</th> -->
                        <th class="text-center" scope="col">Nota Final</th>
                        <th v-if="recuperacion" class="text-center" scope="col">Rec. 1</th>
                        <th v-if="recuperacion" class="text-center" scope="col">Rec. 2</th>
                        <th v-if="recuperacion" class="text-center" scope="col">Rec. 3</th>
                        <th v-if="recuperacion" class="text-center" scope="col">Rec. 4</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="item in materias">
                        <input type="hidden" name="id_nota[]" :value="item.idNota">
                        <input type="hidden" name="id_materia[]" :value="item.materia_id">
                        <input type="hidden" name="des_materia[]" :value="item.des_materia">
                        <td class="text-center">{{item.des_materia}}</td>
                        <!-- <td class="text-center">
                          <input max="20" min="1" @keypress="validar" :value="item.nota_lapso1" :disabled="item.estatus_nota == 0" name="nota1[]" type="number" class="form-control form-control-sm" id="" placeholder="">
                        </td>
                        <td class="text-center">
                          <input max="20" min="1" @keypress="validar" maxlength="2" :value="item.nota_lapso2" :disabled="item.estatus_nota == 0" name="nota2[]" type="number" class="form-control form-control-sm" id="" placeholder="">
                        </td>
                        <td class="text-center">
                          <input max="20" min="1" @keypress="validar" maxlength="2" :value="item.nota_lapso3" :disabled="item.estatus_nota == 0" name="nota3[]" type="number" class="form-control form-control-sm" id="" placeholder="">
                        </td> -->
                        <td class="text-center">
                          <input max="20" min="1" maxlength="2" @keypress="validar" :value="item.nota_final" :disabled="item.estatus_nota == 0" name="nota4[]" type="number" class="form-control form-control-sm" id="" placeholder="">
                        </td>

                        <td v-if="item.nota_final < 10 && item.nota_final != null" class="text-center">
                          <input :value="item.recuperativo_1" :disabled="item.estatus_nota == 0" name="rp1[]" type="number" max="20" min="0" maxlength="2" class="form-control form-control-sm" id="" placeholder="">
                        </td>
                        <input v-else type="hidden" name="rp1[]" value="0" :disabled="item.estatus_nota == 0">

                        <td v-if="item.nota_final < 10 && item.nota_final != null" class="text-center"> <input :value="item.recuperativo_2" :disabled="item.estatus_nota == 0" name="rp2[]" type="number" max="20" min="0" maxlength="2" class="form-control form-control-sm" id="" placeholder=""></td>
                        <input v-else type="hidden" name="rp2[]" value="0" :disabled="item.estatus_nota == 0">

                        <td v-if="item.nota_final < 10 && item.nota_final != null" class="text-center"> <input :value="item.recuperativo_3" :disabled="item.estatus_nota == 0" name="rp3[]" type="number" max="20" min="0" maxlength="2" class="form-control form-control-sm" id="" placeholder=""></td>
                        <input v-else type="hidden" name="rp3[]" value="0" :disabled="item.estatus_nota == 0">

                        <td v-if="item.nota_final < 10 && item.nota_final != null" class="text-center"> <input :value="item.recuperativo_4" :disabled="item.estatus_nota == 0" name="rp4[]" type="number" max="20" min="0" maxlength="2" class="form-control form-control-sm" id="" placeholder="">
                        </td>
                        <input v-else type="hidden" name="rp4[]" value="0" :disabled="item.estatus_nota == 0">
                      </tr>
                    </tbody>
                  </table>
                </div>
                <input type="hidden" name="id" v-model="id" v-if="id != '' ">
              </div>
              <div class="modal-footer mx-auto">
                <input type="hidden" name="ope" v-model="action">
                <button type="submit" value="Aprobar" class="btn btn-sm btn-success" v-if="aprobar">
                  <i class="fa-regular fa-circle-check"></i>Promocionar
                </button>
                <button type="submit" value="Save" :disabled="!boton_desactivado" class="btn btn-sm btn-primary">
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
          estatus: "",
          id_seccion: "",
          id_periodo: "",
          seccionesFiltro: "",
          cedula: "",
          nombre: "",
          periodo: "",
          seccion: "",
          materias: [],
          cedula_estudiante: "",
          recuperacion: false,
          aprobar: true,
          boton_desactivado: true,
          action: "Save",
        }
      },
      methods: {
        getPdf(cedula) {
          this.cedula_estudiante = cedula;
          setTimeout(() => {
            document.getElementById("Form_pdf").submit();
          }, 100)
        },
        validar(e) {
          setTimeout(() => {
            if (parseInt(e.target.value) > 20) e.target.value = 20;
            if (parseInt(e.target.value) <= 0) e.target.value = 1;
          }, 100);
        },
        SendData(e) {
          this.action = e.submitter.value;
          e.preventDefault();
          // if(!$("#Formulario").valid()) return false;

          setTimeout(() => {
            let form = new FormData(e.target);
            fetch("./Controllers/NotasController.php", {
              method: "POST",
              body: form
            }).then(res => res.json()).then(result => {
              $("#datatable").DataTable().ajax.reload(null, false);
              /* this.ToggleModal(); */
              ViewAlert(result.mensaje, result.estado);
              this.periodo_activo();
              this.GetData(this.cedula);
            }).catch(Error => console.error(Error))
          }, 100);
        },
        async GetData(cedula) {
          this.materias = [];
          this.aprobar = true;
          this.boton_desactivado = true;
          this.recuperacion = false;

          await fetch(`./Controllers/NotasController.php?ope=ConsultDatosAcademicos&&cedula=${cedula}`)
            .then(res => res.json()).then((res) => {
              if (res.mensaje) {
                ViewAlert(res.mensaje, res.estado);

                setTimeout(() => {
                  this.ToggleModal();
                }, 200)
                return false;
              }

              let data = res.data;
              this.recuperacion = false;
              this.aprobar = true;
              this.seccion = data.estudiante.idSeccion;
              this.periodo = data.estudiante.periodoescolar;
              this.id_periodo = data.estudiante.id_periodo_escolar;
              this.nombre = data.estudiante.nombre_persona + ' ' + data.estudiante.apellido_persona;
              this.cedula = data.estudiante.cedula_persona;
              this.materias = data.materias;

              data.materias.forEach(item => {
                if (item.nota_final != null && parseInt(item.nota_final) < 10) this.recuperacion = true;
                if (item.nota_final != null && parseInt(item.nota_final) < 10) {
                  if (item.recuperativo_1 != null && parseInt(item.recuperativo_1) < 10) {
                    if (item.recuperativo_2 != null && parseInt(item.recuperativo_2) < 10) {
                      if (item.recuperativo_3 != null && parseInt(item.recuperativo_3) < 10) {
                        if (item.recuperativo_4 != null && parseInt(item.recuperativo_4) < 10) {
                          this.aprobar = false;
                        }
                      }
                    }
                  }
                }

                if (item.nota_final == null) this.aprobar = false;
                if (item.estatus_nota == "0") {
                  this.aprobar = false;
                  this.boton_desactivado = false;
                }

              });

            }).catch(error => console.error(error))
        },
        async consultarSecciones() {
          const res = await fetch(`./Controllers/SeccionController.php?ope=ConsulAll`)
            .then(res => res.json()).then(({
              data
            }) => {
              return data;
            }).catch(error => console.error(error));
          this.seccionesFiltro = res.filter(item => item.estatus_seccion == '1');
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
          this.des_materia = "";
          this.estatus = "";
          this.action = "Save";
        }
      },
      watch: {
        id_seccion(seccion) {
          $("#datatable").DataTable().ajax.url(`./Controllers/NotasController.php?ope=ConsulAll&&idSeccion=${this.id_seccion}`).load();
        }
      },
      async mounted() {
        await this.periodo_activo();
        await this.consultarSecciones()

      }
    }).mount("#App_vue");

    const ConsultPdf = (e) => {
      app.getPdf(e.dataset.cedula)
    }
    const Consult = async (e) => {
      await app.GetData(e.dataset.id)
    }




    $("#datatable").DataTable({
      ajax: {
        url: `./Controllers/NotasController.php?ope=ConsulAll&&id_seccion=${app.id_seccion}`,
        dataSrc: "data"
      },
      columns: [{
          data: "cedula_estudiante"
        },
        {
          data: "nombre_persona",
          render: function(data, type, row) {
            let nombres = `${row.nombre_persona} ${row.apellido_persona}`;
            return nombres;
          }
        },
        {
          data: "periodoescolar"
        },
        {
          data: "estatus_estudiante",
          render: function(data) {
            return data == 1 ? "Activo" : "Inactivo"
          }
        },
        {
          defaultContent: '',
          render: function(data, type, row) {
            let btns = `
              <div class="btn-group">                      
                <button type="button" onClick="Consult(this)" data-seguimiento='${row.seguimiento_estudiante}' data-id='${row.cedula_estudiante}' class="btn btn-sm btn-primary" data-bs-toggle="modal"
                  data-bs-target="#staticBackdrop">CARGAR
                </button>
                <button type="button" onClick="ConsultPdf(this)" data-cedula='${row.cedula_estudiante}' class="btn btn-sm btn-danger"><i class="fas fa-file-pdf"></i></button>
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

  <!-- <script src="./views/js/Seccion/index.js"></script> -->
</body>

</html>