<!DOCTYPE html>
<html lang="en">
<?php

$this->Head();
// require_once("./Models/InstitucionModel.php");
// $mod = new InstitucionModel();
// $datos_institucion = $mod->GetActivo();
// if (!isset($datos_institucion[0])) header("Location: ./VisInstitucion?codigo=400&&mensaje=no existen datos de la institución activo, debes de registrar uno");

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
              <div class="col-md-7 d-flex justify-content-end">
                <form action="./Controllers/CreatePdfEstudiantes.php" method="POST" target="__blank">
                  <input type="hidden" name="ope" v-model='ope'>
                  <input type="hidden" name="id_seccion" v-model="id_seccion">
                  <input type="hidden" name="id_periodo" v-model="id_periodo">
                  <button type="submit" class="btn btn-sm btn-danger mx-2" @click="ope = '1'" v-bind:disabled="id_seccion == '' || id_periodo == ''">
                    Reporte por sección F.
                    <i class="fas fa-file-pdf"></i>
                  </button>
                  <button type="submit" class="btn btn-sm btn-danger" @click="ope = '2'" v-bind:disabled="id_seccion == '' || id_periodo == ''">
                    Reporte por sección R.
                    <i class="fas fa-file-pdf"></i>
                  </button>
                  <button type="submit" class="btn btn-sm btn-danger" @click="ope = '3'" v-bind:disabled="id_seccion == '' || id_periodo == ''">
                    Reporte por sección M.P
                    <i class="fas fa-file-pdf"></i>
                  </button>
                </form>
              </div>
            </div>
            <form action="./VisCreatePdfNotas" method="GET" target="__blank" id="Form_pdf">
              <input type="hidden" name="cedula" v-model="cedula_estudiante">
              <input type="hidden" name="periodo" v-model="id_periodo">
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
              <input type="hidden" name="id_plantel" v-model="id_plantel">
              <div class="modal-body row" style="padding: 0 70px ;">
                <div class="row">
                  <div class="col-12 my-2">
                    <!-- <div class="form-control">
                      <label for="">Seleccione el plantel {{nuevo_plantel}} y {{notas_externas}} de las notas</label>

                    </div> -->

                    <div class="input-group input-group-sm form-box form-box-select" style="display:flex; flex-wrap: wrap;">
                      <span class="input-group-text" id="inputGroup-sizing-sm">Seleccione el plantel de las notas:</span>
                      <input type="text" name="des_plantel" id="" v-model="des_plantel" readonly class="form-control form-control-sm">
                      <!-- <select name="id_plantel" id="" class="form-control" v-model="id_plantel" @change="sel_Plantel()">
                        <option value="">Seleccione una opcion</option>
                        <option v-for="item in planteles" :value="item.id_institucion">{{item.des_institucion}} {{item.entidad_federal}}</option>
                      </select> -->
                      <!-- <span class="error-text">Selecciona año y sección</span> -->
                    </div>
                  </div>
                  <!-- <div class="col-12 my-2">
                    <div class="form-control">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="no" v-bind:checked="plantel_noregistrado" @change="check_nuevoPlantel()" v-model="plantel_noregistrado">
                        <small class="form-check-label">El plantel no esta registrado?</small>
                      </div>
                    </div>
                  </div> -->
                </div>
                <div class="container">

                  <table class="table" v-show="notas_externas == false">
                    <thead>
                      <tr>
                        <th class="text-center" scope="col">Materia</th>
                        <th class="text-center" scope="col">Nota Final</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="item in materias">
                        <input type="hidden" name="id_nota[]" :value="item.idNota">
                        <input type="hidden" name="id_materia[]" :value="item.materia_id">
                        <input type="hidden" name="des_materia[]" :value="item.des_materia">
                        <td class="text-center">{{item.des_materia}}</td>
                        <td class="text-center">
                          <input max="20" min="1" maxlength="2" @keypress="validar" :value="item.nota_final" :disabled="item.estatus_nota == 0" name="nota4[]" type="number" class="form-control form-control-sm" id="" placeholder="">
                        </td>

                        <td v-if="item.nota_final < 10 && item.nota_final != null" class="text-center">
                          <input :value="item.recuperativo_1" :disabled="item.estatus_nota == 0" name="rp1[]" type="number" @keypress="validar" max="20" min="1" maxlength="2" class="form-control form-control-sm" id="" placeholder="">
                        </td>
                        <input v-else type="hidden" name="rp1[]" value="1" :disabled="item.estatus_nota == 0">

                        <td v-if="item.nota_final < 10 && item.nota_final != null" class="text-center">
                          <input :value="item.recuperativo_2" :disabled="item.estatus_nota == 0" name="rp2[]" type="number" @keypress="validar" max="20" min="1" maxlength="2" class="form-control form-control-sm" id="" placeholder="">
                        </td>
                        <input v-else type="hidden" name="rp2[]" value="1" :disabled="item.estatus_nota == 0">

                        <td v-if="item.nota_final < 10 && item.nota_final != null" class="text-center">
                          <input :value="item.recuperativo_3" :disabled="item.estatus_nota == 0" name="rp3[]" type="number" @keypress="validar" max="20" min="1" maxlength="2" class="form-control form-control-sm" id="" placeholder="">
                        </td>
                        <input v-else type="hidden" name="rp3[]" value="1" :disabled="item.estatus_nota == 0">

                        <td v-if="item.nota_final < 10 && item.nota_final != null" class="text-center">
                          <input :value="item.recuperativo_4" :disabled="item.estatus_nota == 0" name="rp4[]" type="number" @keypress="validar" max="20" min="1" maxlength="2" class="form-control form-control-sm" id="" placeholder="">
                        </td>
                        <input v-else type="hidden" name="rp4[]" value="1" :disabled="item.estatus_nota == 0">
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
                <button type="submit" value="Reprobar" @click="this.action = 'Reprobar'" class="btn btn-sm btn-warning" v-if="if_reprobar">
                  <i class="fa-regular fa-circle-check"></i>Reprobar
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
      <!-- Registro de planteles -->
      <div class="modal modal-md fade" id="staticBackdrop2" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title" id="staticBackdropLabel">Registro del plantel</h6>
            </div>
            <form action="#" @submit.preventDefault="SendDataPlantel" id="Formulario_plantel" class="needs-validation" novalidate>

              <div class="modal-body row " style="padding: 0 70px ;">
                <!-- <input type="hidden" name="id" v-model="id" v-if="id != '' "> -->
                <div class="col-md-12 " style="margin:0; padding:5px;">
                  <div class="input-group input-group-sm form-group form-box" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Nombre del plantel:</span>
                    <input type="text" minlength="1" maxlength="30" v-model="des_institucion" name="des_institucion" class="form-control form-control-sm" required id="des_materia" placeholder="Nombre del plantel" style="width:70%; text-transform:uppercase;">
                    <span class="error-text">Rellene el campo correctamente</span>
                  </div>
                </div>
                <div class="col-md-12 " style="margin:0; padding:5px;">
                  <div class="input-group input-group-sm form-group form-box" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Localidad del plantel:</span>
                    <input type="text" minlength="1" maxlength="30" v-model="entidad_federal" name="entidad_federal" class="form-control form-control-sm" required id="des_materia" placeholder="Ubicacion del plantel" style="width:70%; text-transform:uppercase;">
                    <span class="error-text">Rellene el campo correctamente</span>
                  </div>
                </div>

              </div>
              <div class="modal-footer mx-auto">
                <input type="hidden" name="ope" v-model="action">
                <button type="submit" value="Save" class="btn btn-sm btn-primary">
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

      <!-- Registro de notas externas -->
      <div class="modal modal-xl fade" id="staticBackdrop3" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title" id="staticBackdropLabel">Registro de notas externas</h6>
            </div>
            <form action="#" @submit.preventDefault="SendNotasExternas" id="Formulario_notasExternas" class="needs-validation" novalidate>

              <div class="modal-body " style="padding: 0 70px ;">
                <div class="row">
                  <h5>
                    Estas registrando notas externas de este estudiante, las cuales corresponden a año {{notas_externas_desde}},
                    debes de asegurarte de que los datos ingresados sean los correctos, ya que este registro solo se puede realizar una vez
                  </h5>
                </div>
                <div class="row">
                  <div class="col-12 my-2">
                    <div class="input-group input-group-sm form-box" style="display:flex; flex-wrap: wrap;">
                      <span class="input-group-text" id="inputGroup-sizing-sm">Año de las materias</span>
                      <input type="hidden" name="ext_anio" v-model="notas_externas_desde">
                      <input type="hidden" name="cedula_estudiante" v-model="cedula">
                      <input type="text" name="ext_periodo" class="form-control form-control-sm" id="ext_periodo" required placeholder="Ingrese el periodo escolar de estas notas">
                      <!-- <span class="error-text">Cedula incorrecta</span> -->
                    </div>
                  </div>
                  <!-- <div class="col-12 my-2">
                    <div class="input-group input-group-sm form-box" style="display:flex; flex-wrap: wrap;">
                      <span class="input-group-text" id="inputGroup-sizing-sm">Seccion</span>
                      <input type="text" name="ext_seccion" class="form-control form-control-sm" id="ext_seccion" required placeholder="Ingrese la sección en la que cursó estas materias">
                    </div>
                  </div> -->
                </div>
                <div class="row">
                  <div class="col-12 my-2">
                    <div class="input-group input-group-sm form-box form-box-select" style="display:flex; flex-wrap: wrap;">
                      <span class="input-group-text" id="inputGroup-sizing-sm">Seleccione el plantel de las notas:</span>
                      <select name="ext_plantel" id="ext_plantel" class="form-select" aria-label="Default select example" required>
                        <option value="">Seleccione una opcion</option>
                        <option v-for="item in planteles" :value="item.id_institucion">{{item.des_institucion}} {{item.entidad_federal}}</option>
                      </select>
                      <!-- <span class="error-text">Selecciona año y sección</span> -->
                    </div>
                  </div>
                  <div class="col-12 my-2" v-show="id_plantel == ''">
                    <div class="form-group">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="no" v-bind:checked="plantel_noregistrado" @change="check_nuevoPlantel()" v-model="plantel_noregistrado">
                        <small class="form-check-label">El plantel no esta registrado?</small>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <table class="table">
                    <thead>
                      <th>Materia</th>
                      <th>Nota final</th>
                    </thead>
                    <tbody>
                      <tr v-for="materia in cantidad_materias">
                        <td class="text-center">
                          <input name="ext_materia[]" type="text" class="form-control form-control-sm" id="" placeholder="">
                        </td>
                        <td class="text-center">
                          <input max="20" min="1" maxlength="2" @keypress="validar" name="ext_nota[]" type="number" class="form-control form-control-sm" id="" placeholder="">
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="modal-footer mx-auto">
                <input type="hidden" name="ope" v-model="action">
                <button type="submit" value="Save" class="btn btn-sm btn-primary">
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
            // 
            notas_externas_desde: '',
            notas_externas_hasta: '',
            notas_externas: false,
            cantidad_materias: 0,
            id_plantel: "",
            des_plantel: "",
            plantel_noregistrado: false,
            entidad_federal: '',
            des_institucion: '',
            planteles: [{
              id_institucion: ''
            }],
            nuevo_plantel: true,
            recuperacion: false,
            aprobar: true,
            ope: '',
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
          check_nuevoPlantel() {
            if (this.plantel_noregistrado) {
              $('#staticBackdrop').modal('hide')
              $('#staticBackdrop3').modal('hide')
              $('#staticBackdrop2').modal('show')
            }
          },
          sel_Plantel() {
            if (this.id_plantel != '') this.nuevo_plantel = false;
            else this.nuevo_plantel = true;
          },
          validar(e) {
            setTimeout(() => {
              if (parseInt(e.target.value) > 20) e.target.value = 20;
              if (parseInt(e.target.value) <= 0) e.target.value = 1;
            }, 100);
          },
          async obtener_externas() {
            await fetch("./Controllers/InstitucionController.php?ope=externas")
              .then(res => res.json()).then(result => {
                this.planteles = result.data
              }).catch(Error => console.error(Error))
          },
          async obtener_interno() {
            await fetch("./Controllers/InstitucionController.php?ope=interno")
              .then(res => res.json()).then(result => {
                this.id_plantel = result.data.id_institucion;
                this.des_plantel = result.data.des_institucion;
              }).catch(Error => console.error(Error))
          },
          SendNotasExternas(e) {
            this.action = 'Save_notasExternas';
            e.preventDefault();
            setTimeout(() => {
              let form = new FormData(e.target);
              fetch("./Controllers/NotasController.php", {
                method: "POST",
                body: form
              }).then(res => res.json()).then(result => {
                $("#datatable").DataTable().ajax.reload(null, false);
                this.notas_externas_desde = '';
                this.notas_externas_hasta = '';
                this.notas_externas = false;
                this.cantidad_materias = 0;
                /* this.ToggleModal(); */
                ViewAlert(result.mensaje, result.estado);
                this.periodo_activo();
                this.GetData(this.cedula);
                // this.obtener_externas();
              }).catch(Error => console.error(Error))
            }, 100);
          },
          SendDataPlantel(e) {
            this.action = 'save_externo';
            e.preventDefault();
            $('#staticBackdrop2').modal('hide')
            this.plantel_noregistrado = false;
            // if(!$("#Formulario").valid()) return false;

            setTimeout(() => {
              let form = new FormData(e.target);
              fetch("./Controllers/InstitucionController.php", {
                method: "POST",
                body: form
              }).then(res => res.json()).then(result => {
                $("#datatable").DataTable().ajax.reload(null, false);
                /* this.ToggleModal(); */
                ViewAlert(result.mensaje, result.estado);
                this.periodo_activo();
                this.GetData(this.cedula);
                this.obtener_externas();
                if (this.notas_externas == false) $('#staticBackdrop').modal('show');
                else $('#staticBackdrop3').modal('show')
              }).catch(Error => console.error(Error))
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
            $('#staticBackdrop2').modal('hide');
            $('#staticBackdrop3').modal('hide');
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
                this.recuperacion = false;
                this.aprobar = true;
                let data = res.data;

                this.nombre = data.estudiante.nombre_persona + ' ' + data.estudiante.apellido_persona;
                this.cedula = data.estudiante.cedula_persona;

                if (data.notas_externas) {
                  this.notas_externas = true;
                  this.notas_externas_desde = data.notas_externas.desde;
                  this.notas_externas_hasta = data.notas_externas.hasta;
                  this.cantidad_materias = parseInt(data.notas_externas.cant_materias);
                  ViewAlert(data.notas_externas.mensaje, "error");

                  setTimeout(() => {
                    $("#staticBackdrop").modal('hide');
                    $("#staticBackdrop3").modal('show');
                  }, 700)
                  return false;
                } else {
                  this.notas_externas = false;
                }

                this.seccion = data.estudiante.idSeccion;
                this.periodo = data.estudiante.periodoescolar;
                this.id_periodo = data.estudiante.id_periodo_escolar;
                this.materias = data.materias;
                this.id_plantel = (data.materias[0].plantel != null) ? data.materias[0].plantel : this.id_plantel;

                if (data.materias[0].nota_final != null) this.nuevo_plantel = false;
                else this.nuevo_plantel = true;

                data.materias.forEach(item => {
                  if (item.nota_final != null && parseInt(item.nota_final) < 10) {
                    this.recuperacion = true;
                  }
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
        computed: {
          if_reprobar() {
            if (this.aprobar == false && this.boton_desactivado == true) {
              if (this.recuperacion == true) {
                let reprobar = true;
                this.materias.forEach(item => {
                  if (parseInt(item.recuperativo_1) > 10 && item.estatus_nota == '1') reprobar = false;
                  if (parseInt(item.recuperativo_2) > 10 && item.estatus_nota == '1') reprobar = false;
                  if (parseInt(item.recuperativo_3) > 10 && item.estatus_nota == '1') reprobar = false;
                  if (parseInt(item.recuperativo_4) > 10 && item.estatus_nota == '1') reprobar = false;
                })

                return reprobar;
              }
            }

            return false;
          }
        },
        async mounted() {
          await this.periodo_activo();
          await this.consultarSecciones()
          await this.obtener_externas()
          await this.obtener_interno();

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