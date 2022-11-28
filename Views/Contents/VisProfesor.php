<!DOCTYPE html>
<html lang="en">
<?php 
  $this->Head(); 
  require_once("Models/PeriodoModel.php");
  $mod = new PeriodoModel();
  $res = $mod->GetActivo('algo');
  if(!isset($res['id_periodo_escolar'])) header("Location: ./VisPeriodo?codigo=400&&mensaje=no existe periodo activo, debes de registrar uno");
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
              <h2 class="fw-bold text-start my-auto text-dark">Gestión de Profesores</h3>
            </div>
            <div class="col-md-2 p-3 card bg-primary ">
              <h5 class="fw-bold text-light text-center my-auto">Periodo: {{des_periodo}}</h5>
            </div>
          </div>
        </div>


        <div class="col-md-12 mx-auto px-2 ">

          <!-- contenedor de la tabla -->
          <div class="col-md-12 card p-3 shadow ">
            <div class="col-md-12 d-flex justify-content-end" style="margin: 0; padding: 0;">
              <button type="button" class="btn btn-sm btn-primary" @click="LimpiarForm" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="margin-bottom: 10px">
                <i class="fa-regular fa-user"></i> AGREGAR
              </button>
            </div>
            <div class="col ">
              <table class="table border table-sm" id="datatable">
                <thead>
                  <tr>
                    <!-- <th class="text-center" scope="col">N°</th> -->
                    <th class="text-center" scope="col">Cedula</th>
                    <th class="text-center" scope="col">Nombre/Apellidos</th>
                    <!-- <th class="text-center" scope="col">Seccion</th>
                    <th class="text-center" scope="col">Materia</th>
                    <th class="text-center" scope="col">Estatus Asignación</th> -->
                    <th class="text-center" scope="col">Estatus</th>
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
            <div class="modal-header bg-hero-azul fw-bold">
              <h5 class="modal-title" id="staticBackdropLabel">Registro Profesor</h5>
              <button type="button" @click="LimpiarForm" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!--
               <div class="input-group input-group-sm">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Small</span>
                  <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div> 
              -->
            <form action="#" @submit.preventDefault="SendData" id="Formulario" class="needs-validation" name="register" novalidate>
              <div class="col-md-12 mx-auto rounded border d-flex justify-content-between mt-2 row">
                <h5 class="text-start col-md-8">Pensum: {{info_pensum_1}} | {{info_pensum_2}}</h5>
                <h5 class="text-end col-md-4">Periodo: {{des_periodo}}</h5>
              </div>
              <input type="hidden" name="id_periodo" v-model="id_periodo">
              <div class="modal-body row " style="padding: 0 70px ;">

                <div class="col-md-6 " style="margin:0; padding:5px;" v-if="action != 'Asignar' ">
                  <div class="input-group input-group-sm form-box-select" v-if="action != 'Asignar' " style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Nacionalidad:</span>
                    <select class="form-select" @change="cedula = '' " v-model="nacionalidad" name="nacionalidad" id="nacionalidad" aria-label="Default select example" style="width: 50%;" required>
                      <option value="" selected>Seleccionar</option>
                      <option value="V">Venezolana</option>
                      <option value="E">Extranjera</option>
                    </select>
                    <span class="error-text">Selecciona tu nacionalidad</span>
                  </div>
                </div>
                <div class="col-md-6 " style="margin:0; padding:5px;">

                  <div class="input-group input-group-sm form-box" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Cédula:</span>
                    <input type="text" step="1" v-bind:disabled="nacionalidad == '' " name="cedula" v-model="cedula" v-bind:maxlength="[ nacionalidad == 'V' ? 8: 6 ]" class="form-control form-control-sm" id="cedula" required placeholder="Ingrese la cédula del profesor" :readonly="action == 'Asignar' " style="width:70%;">
                    <span class="error-text">Cedula incorrecta</span>
                  </div>


                </div>

                <div class="col-md-6 " style="margin:0; padding:5px;">

                  <div class="input-group input-group-sm form-box" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Nombres:</span>
                    <input type="text" name="nombre" v-model="nombre" maxlength="30" class="form-control form-control-sm" id="nombre" required placeholder="Ingrese el nombre del profesor" style="width:70%;" disabled>
                    <span class="error-text">Nombre no valido</span>
                  </div>


                </div>

                <div class="col-md-6 " style="margin:0; padding:5px;">

                  <div class="input-group input-group-sm form-box" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Apellidos:</span>
                    <input type="text" name="apellido" v-model="apellido" maxlength="30" class="form-control form-control-sm" id="apellido" required placeholder="Ingrese el apellido del profesor" style="width:70%;" disabled>
                    <span class="error-text">Apellido no valido</span>
                  </div>

                </div>

                <div class="col-md-6 " style="margin:0; padding:5px;" v-if="action != 'Asignar' ">

                  <div class="input-group input-group-sm form-box form-box-fecha" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Fecha de Nacimiento:</span>
                    <input type="date" :max="fecha_maxima" name="fecha_n_persona" v-model="fecha_n" class="form-control form-control-sm" id="fecha_n_persona" placeholder="dd/mm/aaaa" required style="width:50%;" disabled>
                    <span class="error-text">Formato o fecha inválida</span>
                  </div>

                </div>

                <div class="col-md-6 " style="margin:0; padding:5px;" v-if="action != 'Asignar' ">
                  <div class="input-group input-group-sm form-box" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Correo electronico:</span>
                    <input type="email" name="correo_persona" v-model="correo_persona" class="form-control form-control-sm" id="correo_persona" required placeholder="Ingrese el correo electronico" style="width: 50%;" disabled>
                    <span class="error-text">Correo inválido</span>
                  </div>
                </div>
                <!-- <div class="col-md-2"></div> -->

                <div class="col-md-6" style="margin:0; padding:5px;" v-if="action != 'Asignar' ">
                  <div class="input-group input-group-sm form-box" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Dirección:</span>
                    <input type="text" name="direccion" v-model="direccion" class="form-control form-control-sm" id="direccion" placeholder="Ingrese la dirección" required style="width:70%;" disabled>
                    <span class="error-text">Direccion inválida</span>
                  </div>
                </div>
                <div class="col-md-4" style="margin:0; padding: 5px;" v-if="action != 'Asignar' ">
                  <label for="">Sexo</label>
                  <div class="d-flex">
                    <div class="form-check">
                      <input type="radio" name="sexo" v-model="sexo" value="F" id="radio" class="form-check-input" required>
                      <label for="">F</label>
                    </div>
                    <div class="form-check pl-2">
                      <input type="radio" name="sexo" v-model="sexo" value="M" id="radio1" class="form-check-input" required>
                      <label for="">M</label>
                    </div>
                  </div>
                </div>

                <!-- <div v-if="action == 'Asignar' " class="row d-flex align-items-center" v-for="(item,index) in id_materia">
                  <div class="col-md-6" style="margin:0; padding:5px;">
                    <div class="input-group input-group-sm form-box form-box-select" style="display:flex; flex-wrap: wrap;">
                      <span class="input-group-text" id="inputGroup-sizing-sm">Asignación: {{(index+1)}}</span>
                      <input type="number" min="1" max="6" v-model="seguimiento[index]" max="6" maxlength="1" minlength="1" name="seguimiento_profesor[]" class="form-control form-control-sm" id="" @keypress="consultarSecciones" :data-index="index" placeholder="Año" style="width: 10%">
                      <select name="id_seccion[]" required @change="MateriaRepetida(index)" v-model="secciones[index]" id="" class="form-select" aria-label="Default select example" style="width: 10%">
                        <option value="" selected>Seleccione una opción</option>
                        <option :value="item.idSeccion" v-for="item in id_seccion[index]">{{item.id_seccion}}</option>
                      </select>
                      <span class="error-text">Selecciona año y sección</span>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="input-group input-group-sm form-box-select" style="display:flex; flex-wrap: wrap;">
                      <span class="input-group-text">Materia</span>
                      <select name="id_materia[]" required @change="MateriaRepetida(index)" v-model="materias[index]" id="" class="form-select" aria-label="Default select example" style="width: 50%;">
                        <option value="" selected>Seleccione una opción</option>
                        <option :value="item.id_materia" v-for="item in id_materia[index]">{{item.des_materia}}</option>
                      </select>
                      <span class="error-text">Seleccione una materia</span>
                    </div>
                  </div>
                </div> -->


                <div class="modal-footer mx-auto">
                  <!-- <div class="btn-group" v-if="action == 'Asignar' ">
                    <button class="btn btn-sm btn-success" @click="MasAsignacion">
                      <i class="fas fa-plus"></i>
                    </button>
                    <button class="btn btn-sm btn-danger" @click="MenosAsignacion" v-if="id_materia.length > 1">
                      -
                    </button>
                  </div> -->
                  <input type="hidden" name="ope" v-model="action">
                  <button type="submit" @click="evitandoDobleSubmit = true" class="btn btn-sm btn-primary" id="btn-g">
                    <i class="fa-regular fa-circle-check" :disabled="ifPeriodo"></i>GUARDAR
                  </button>
                  <button type="button" @click="LimpiarForm" class="btn btn-sm btn-danger" data-bs-dismiss="modal">
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
          nacionalidad: "",
          cedula: "",
          nombre: "",
          apellido: "",
          fecha_n: "",
          correo_persona: "",
          direccion: "",
          sexo: "",
          id_periodo: "",
          // id_seccion: "",
          // id_materia: "",
          // seguimiento: "",
          seguimiento: [],
          id_seccion: [
            [{
              id_seccion: ''
            }]
          ],
          id_materia: [{
            id_materia: ""
          }],
          // Arrays para el formulario
          secciones: [],
          materias: [],
          // Filtros
          id_periodoFiltro: "",
          periodosFiltro: [],
          formulario_valido: false,
          evitandoDobleSubmit: false,
          info_pensum_1:"",
          info_pensum_2:"",
          bucle: 1,
          fecha_maxima: "",
          action: "Save",
        }
      },
      methods: {
        MasAsignacion(e) {
          this.id_materia.push({
            id_materia: ''
          })
          this.id_seccion.push([{
            id_seccion: ''
          }])
          this.seguimiento.push('');
        },
        MenosAsignacion() {
          console.log(this.secciones)
          this.id_materia.pop()
          this.id_seccion.pop()
          this.seguimiento.pop()
          this.secciones.pop();
          this.materias.pop();
        },
        SendData(e) {

          e.preventDefault();
          // if(!$("#Formulario").valid()) return false;
          let form = new FormData(e.target);
          if (!this.formulario_valido) return false;

          if (!this.evitandoDobleSubmit) return false;
          fetch("./Controllers/ProfesorController.php", {
            method: "POST",
            body: form
          }).then(res => res.json()).then(result => {
            $("#datatable").DataTable().ajax.reload(null, false);
            this.ToggleModal();
            this.LimpiarForm();
            ViewAlert(result.mensaje, result.estado);
            this.periodo_activo();
            this.evitandoDobleSubmit = false;
          }).catch(Error => {
            console.error(Error)
          })
        },
        async GetData(id) {
          await fetch(`./Controllers/ProfesorController.php?ope=ConsultOne&&id=${id}`)
            .then(res => res.json()).then(({
              data
            }) => {
              let profesor = data.profesor;
              this.nacionalidad = profesor.nacionalidad_persona;
              this.cedula = profesor.cedula_persona;
              this.nombre = profesor.nombre_persona;
              this.apellido = profesor.apellido_persona;
              this.direccion = profesor.direccion;
              this.fecha_n = profesor.fecha_n_persona
              this.correo_persona = profesor.correo_persona;
              this.sexo = profesor.sexo_persona;

              if (data.Asignaciones[0] != undefined) {

                data.Asignaciones.forEach((item, index) => {
                  this.materias.push(item.id_materia);
                  this.secciones.push(item.id_seccion);
                  this.seguimiento.push(item.ano_seguimiento);

                  let obj = {
                    key: item.ano_seguimiento,
                    target: {
                      dataset: {
                        index: index
                      }
                    }
                  }

                  this.consultarSecciones(obj)
                })
              }
              this.action = "Update";
            }).catch(error => console.error(error))
        },
        async ChangeState(id) {
          this.cedula = id;
          this.action = "ChangeStatus";
          this.nacionalidad = "V";

          setTimeout(async () => {
            let form = new FormData(document.getElementById("Formulario"));
            await fetch(`./Controllers/ProfesorController.php`, {
              method: "POST",
              body: form
            }).then(res => res.json()).then(result => {
              ViewAlert(result.mensaje, result.estado);
              $("#datatable").DataTable().ajax.url(`./Controllers/ProfesorController.php?ope=ConsulAll&&id_periodo=${this.id_periodo}`).load();
            }).catch(error => console.error(error))
          }, 100);
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
        async Asignar(id) {
          await this.GetData(id);
          setTimeout(() => this.action = "Asignar", 100)
        },
        ToggleModal() {
          $("#staticBackdrop").modal("hide");
          $("body").removeClass("modal-open");
          $(".modal-backdrop").remove();
        },
        LimpiarForm() {
          this.estatus = "";
          this.nacionalidad = "";
          this.cedula = "";
          this.nombre = "";
          this.apellido = "";
          this.fecha_n = "";
          this.correo_persona = "";
          this.seguimiento = "";
          this.id_seccion = "";
          this.direccion = "";
          this.sexo = "";
          this.id_materia = "";
          this.action = "Save";

          this.seguimiento = []
          this.id_seccion = [
            [{
              id_seccion: ''
            }]
          ]
          this.id_materia = [{
            id_materia: ""
          }]
          this.secciones = []
          this.materias = []
        },
        async consultarSecciones(e) {
          let anio = e.key,
            index = e.target.dataset.index;
          const res = await fetch(`./Controllers/SeccionController.php?ope=ConsultPorAnio&&anio=${anio}`)
            .then(res => res.json()).then(({
              data
            }) => {
              return data;
            }).catch(error => console.error(error));

          this.consultarMaterias(e)
          if (res[0] != undefined) {
            this.id_seccion[index] = res;
          } else ViewAlert("No hay suficientes secciones registradas", "error");

        },
        async Get_pengums(){
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
        async consultarMaterias(e) {
          let anio = e.key,
            index = e.target.dataset.index;

          const res = await fetch(`./Controllers/PensumController.php?ope=ConsultPorAnio&&anio=${anio}`)
            .then(res => res.json()).then(({
              data
            }) => {
              console.log(data)
              return data;
            }).catch(error => console.error(error));

          if (res[0] != undefined) {
            let lista = res.filter(i => {
              if (i) return i;
            })
            this.id_materia[index] = lista;
          } else ViewAlert("No existe pensum para el año solicitado", "error");
        },
        async MateriaRepetida(index) {

          if (!this.secciones[index] && !this.materias[index]) return false;
          const res = await fetch(`./Controllers/ProfesorController.php?ope=MateriasRepetidas&&cedula=${this.cedula}&&materia=${this.materias[index]}&&seccion=${this.secciones[index]}`)
            .then(res => res.json()).then(({
              data
            }) => data)
            .catch(error => console.error(error));
          if (res[0]) {
            this.MenosAsignacion();
            ViewAlert("La materia seleccionada ya esta asginada", "error");
          }
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
      watch: {
        id_periodoFiltro(periodo) {
          if (periodo != '') {
            $("#datatable").DataTable().ajax.url(`./Controllers/ProfesorController.php?ope=ConsulAll&&id_periodo=${periodo}`).load();
          }
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
        url: "./Controllers/ProfesorController.php?ope=ConsulAll",
        dataSrc: "data"
      },
      columns: [{
          data: "cedula_profesor",
          render: function(data, type, row) {
            return `${row.nacionalidad_persona}-${data}`
          }
        },
        {
          data: "nombre_persona",
          render: function(data, type, row) {
            let nombres = `${row.nombre_persona} ${row.apellido_persona}`;
            return nombres;
          }
        },
        {
          data: "estatus_profesor",
          render: function(data) {
            return data == 1 ? "Activo" : "Inactivo";
          }
        },
        {
          defaultContent: '',
          render: function(data, type, row) {

            let classStatus = row.estatus_profesor == 1 ? 'success' : 'danger';
            let disabled = row.estatus_profesor == 1 ? '' : 'disabled="disabled"';
            let btns = '';
            btns = `
                <div class="">
                  <button type="button" ${disabled} data-bs-toggle="modal" data-bs-target="#staticBackdrop" onClick="Consult(this)" data-id='${row.cedula_profesor}' class="btn btn-sm btn-info">
                    <i class="fa-solid fa-magnifying-glass"></i>
                  </button>
                  
                  <button type="button" onClick="CambiarEstatus(this)" data-id='${row.cedula_profesor}' class="btn btn-sm btn-${classStatus}">
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

    let emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    let radio = document.getElementById("radio");
    let radio1 = document.getElementById('radio1');
    let nacionalidad = document.getElementById("nacionalidad");
    let tiempoFuera = null;
    let nacionalidadValida = false;
    let cedulaValida = false;
    let nombreValida = false;
    let apellidoValida = false;
    let correoValida = false;
    let direccionValida = false;
    let fechaValida = false;
    let seguimientoValida = false;
    let materiaValida = false;
    let seccionValida = false;
    let radioValida = false;




    document.querySelectorAll('.form-box').forEach((box) => {
      const boxInput = box.querySelector('input');
      boxInput.addEventListener("blur", (event) => {
        clearTimeout(tiempoFuera);
        tiempoFuera = setTimeout(() => {
          console.log(`input ${boxInput.name} value: `, boxInput.value)
          validacion(box, boxInput, null)
        });
      })
      radio.addEventListener('click', () => {
        validacion(box, 'sexo');
      })
      radio1.addEventListener('click', () => {
        validacion(box, 'sexo');
      })
      let button = document.querySelector('#btn-g');
      button.addEventListener('click', e => {
        validacion(box, boxInput);
        let cedulaValida = false;
        let nombreValida = false;
        let apellidoValida = false;
        let correoValida = false;
        let direccionValida = false;
        let seguimientoValida = false;
        let radioValida = false;
      })

    });


    document.querySelectorAll('.form-box-fecha').forEach((box) => {
      const boxInput = box.querySelector('input');
      boxInput.addEventListener("keypress", (event) => {
        clearTimeout(tiempoFuera);
        tiempoFuera = setTimeout(() => {
          console.log(`input ${boxInput.name} value: `, boxInput.value)
          validacionFecha(box, boxInput, null)
        });
      })
      let button = document.querySelector('#btn-g');
      button.addEventListener('click', e => {
        validacionFecha(box, boxInput);
        let fechaValida = false;
      })
    });


    document.querySelectorAll('.form-box-select').forEach((box) => {
      const boxSelect = box.querySelector('select');
      boxSelect.addEventListener("click", (event) => {
        clearTimeout(tiempoFuera);
        tiempoFuera = setTimeout(() => {
          console.log(`select ${boxSelect.name} value: `, boxSelect.value)
          validarSelect(box, boxSelect, null)
        }, 250);
      })
      let button = document.querySelector('#btn-g');
      button.addEventListener('click', e => {
        validarSelect(box, boxSelect)
        let seccionValida = false;
      })
    });


    function validacionFecha(box, boxInput) {

      if (boxInput != null & boxInput.name == "fecha_n_persona") {
        console.log('Validacion fecha inicio')

        if (!moment(boxInput.value).isValid()) {
          app.formulario_valido = false
          mostrarError(true, box);
          fechaValida = false;
          document.querySelector('#correo_persona').disabled = true;
          return false
        }

        /* Comprobar que el año no sea superior al actual*/
        if (moment(boxInput.value).isAfter(moment(boxInput.max)) || moment(boxInput.value).isBefore(moment(boxInput.min))) {
          app.formulario_valido = false
          mostrarError(true, box);
          fechaIValida = false;
          document.querySelector('#correo_persona').disabled = true;
          return false
        } else {
          app.formulario_valido = true
          mostrarError(false, box);
          fechaValida = true;
          document.querySelector('#correo_persona').disabled = false;
          return true
        }
      }
    }



    function validarSelect(box, boxSelect) {
      if (boxSelect.name == 'nacionalidad') {
        if (boxSelect.value == "") {
          mostrarError(true, box);
          nacionalidadValida = false;
          document.querySelector('#nombre').disabled = true;
          document.querySelector('#nombre').value = "";
          document.querySelector('#apellido').disabled = true;
          document.querySelector('#apellido').value = "";
          document.querySelector('#fecha_n_persona').disabled = true;
          document.querySelector('#fecha_n_persona').value = "";
          document.querySelector('#correo_persona').disabled = true;
          document.querySelector('#correo_persona').value = "";
          document.querySelector('#direccion').disabled = true;
          document.querySelector('#direccion').value = "";

        } else {
          console.log(box);
          mostrarError(false, box);
          nacionalidadValida = true;
        }
      }
      // if (boxSelect.name == 'id_seccion') {
      //   if (boxSelect.value == "") {
      //     mostrarError(true, box);
      //     seccionValida = false;
      //   } else {
      //     console.log(box);
      //     mostrarError(false, box);
      //     seccionValida = true;
      //   }
      // }
      // if (boxSelect.name == 'id_materia') {
      //   if (boxSelect.value == "") {
      //     mostrarError(true, box);
      //     materiaValida = false;
      //   } else {
      //     console.log(box);
      //     mostrarError(false, box);
      //     materiaValida = true;
      //   }
      // }
    }


    async function validacion(box, boxInput) {

      if (boxInput != null && boxInput.name == "cedula") {
        let cedulaRepetida = false;

        if (boxInput.value.length >= 7) {
          await fetch(`./Controllers/EstudiantesController.php?ope=VerificarCedula&&id=${boxInput.value}`)
            .then(response => response.json())
            .then(result => {
              if (result.data.cedula_persona) {
                alert("Esta cedula ya esta registrada")
                cedulaRepetida = true;
                document.querySelector('#nombre').disabled = false;
              } else {
                document.querySelector('#nombre').disabled = true;
                document.querySelector('#nombre').value = "";
                document.querySelector('#apellido').disabled = true;
                document.querySelector('#apellido').value = "";
                document.querySelector('#fecha_n_persona').disabled = true;
                document.querySelector('#fecha_n_persona').value = "";
                document.querySelector('#correo_persona').disabled = true;
                document.querySelector('#correo_persona').value = "";
                document.querySelector('#direccion').disabled = true;
                document.querySelector('#direccion').value = "";
                cedulaRepetida = false;
              }
            }).catch(error => console.error(error))
        } else cedulaRepetida = false;

        if (boxInput.value.length < 7 || boxInput.value.length > 8) {
          console.error('Campo vacío o cédula inválida')
          mostrarError(true, box);
          cedulaValida = false;
          document.querySelector('#nombre').disabled = true;
          document.querySelector('#nombre').value = "";
          document.querySelector('#apellido').disabled = true;
          document.querySelector('#apellido').value = "";
          document.querySelector('#fecha_n_persona').disabled = true;
          document.querySelector('#fecha_n_persona').value = "";
          document.querySelector('#correo_persona').disabled = true;
          document.querySelector('#correo_persona').value = "";
          document.querySelector('#direccion').disabled = true;
          document.querySelector('#direccion').value = "";

        } else if (isNaN(boxInput.value)) {
          console.error(`${boxInput.value} no es un numero`);
          mostrarError(true, box);
          document.querySelector('#nombre').disabled = true;
          document.querySelector('#nombre').value = "";
          document.querySelector('#apellido').disabled = true;
          document.querySelector('#apellido').value = "";
          document.querySelector('#fecha_n_persona').disabled = true;
          document.querySelector('#fecha_n_persona').value = "";
          document.querySelector('#correo_persona').disabled = true;
          document.querySelector('#correo_persona').value = "";
          document.querySelector('#direccion').disabled = true;
          document.querySelector('#direccion').value = "";
          cedulaValida = false;
        } else if (cedulaRepetida) {
          console.error(`${boxInput.value} Ya esta registrado`);
          mostrarError(true, box);
          document.querySelector('#nombre').disabled = true;
          document.querySelector('#nombre').value = "";
          document.querySelector('#apellido').disabled = true;
          document.querySelector('#apellido').value = "";
          document.querySelector('#fecha_n_persona').disabled = true;
          document.querySelector('#fecha_n_persona').value = "";
          document.querySelector('#correo_persona').disabled = true;
          document.querySelector('#correo_persona').value = "";
          document.querySelector('#direccion').disabled = true;
          document.querySelector('#direccion').value = "";
        } else {
          mostrarError(false, box);
          cedulaValida = true;
          document.querySelector('#nombre').disabled = false;
        }
      }

      if (boxInput != null && boxInput.name == "nombre") {
        console.log("validacion nombre")
        console.group("NOMBRE");
        console.log(boxInput.value)
        console.groupEnd();
        const letrasEspeciales = ["@", "/", "%", "#", ".", "*", "$", "!", ",", "?", "¿", "¡", "&", "-", "_", "(", ")", "{", "}", "[", "]", "'", '"', "=", "´", "+", ":", ";", "|", "°", "¬"];
        const numeros = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];
        let contieneLetraEspecial = 0;
        let contieneNumeros = 0;

        for (let i = 0; i < boxInput.value.length; i++) {
          for (let j = 0; j < letrasEspeciales.length; j++) {
            if (boxInput.value[i] === letrasEspeciales[j]) {
              contieneLetraEspecial++;
            }
          }
        }

        for (let i = 0; i < boxInput.value.length; i++) {
          for (let j = 0; j < numeros.length; j++) {
            if (boxInput.value[i] === numeros[j]) {
              contieneNumeros++;
            }
          }
        }

        if (boxInput.value == '' || boxInput.value == ' ' || boxInput.value.length < 3 || contieneNumeros > 0 || contieneLetraEspecial > 0) {
          mostrarError(true, box);
          nombreValida = false;
          document.querySelector('#apellido').disabled = true;
          document.querySelector('#apellido').value = "";
          document.querySelector('#fecha_n_persona').disabled = true;
          document.querySelector('#fecha_n_persona').value = "";
          document.querySelector('#correo_persona').disabled = true;
          document.querySelector('#correo_persona').value = "";
          document.querySelector('#direccion').disabled = true;
          document.querySelector('#direccion').value = "";
        } else {
          mostrarError(false, box);
          nombreValida = true;
          document.querySelector('#apellido').disabled = false;
        }
      }
      if (boxInput != null && boxInput.name == "apellido") {
        console.log("validacion apellido")
        console.group("APELLIDO");
        console.log(boxInput.value)
        console.groupEnd();
        const letrasEspeciales = ["@", "/", "%", "#", ".", "*", "$", "!", ",", "?", "¿", "¡", "&", "-", "_", "(", ")", "{", "}", "[", "]", "'", '"', "=", "´", "+", ":", ";", "|", "°", "¬"];
        const numeros = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];
        let contieneLetraEspecial = 0;
        let contieneNumeros = 0;

        for (let i = 0; i < boxInput.value.length; i++) {
          for (let j = 0; j < letrasEspeciales.length; j++) {
            if (boxInput.value[i] === letrasEspeciales[j]) {
              contieneLetraEspecial++;
            }
          }
        }

        for (let i = 0; i < boxInput.value.length; i++) {
          for (let j = 0; j < numeros.length; j++) {
            if (boxInput.value[i] === numeros[j]) {
              contieneNumeros++;
            }
          }
        }


        if (boxInput.value == '' || boxInput.value == ' ' || boxInput.value.length < 3 || contieneNumeros > 0 || contieneLetraEspecial > 0) {
          mostrarError(true, box);
          apellidoValida = false;
          document.querySelector('#fecha_n_persona').disabled = true;
          document.querySelector('#fecha_n_persona').value = "";
          document.querySelector('#correo_persona').disabled = true;
          document.querySelector('#correo_persona').value = "";
          document.querySelector('#direccion').disabled = true;
          document.querySelector('#direccion').value = "";
        } else {
          mostrarError(false, box);
          apellidoValida = true;
          document.querySelector('#fecha_n_persona').disabled = false;
        }
      }


      if (boxInput != null && boxInput.name == "correo_persona") {
        console.log("validacion correo")
        if (emailRegex.test(boxInput.value)) {
          console.log("validacion lugar nacimiento");
          mostrarError(false, box);
          correoValida = true;
          document.querySelector('#direccion').disabled = false;
        } else {
          mostrarError(true, box);
          correoValida = false;
          document.querySelector('#direccion').disabled = true;
          document.querySelector('#direccion').value = "";
        }
      }
      if (boxInput != null && boxInput.name == "direccion") {
        console.log("validacion direccion")
        if (boxInput.value.length < 3 || boxInput.value == "" || boxInput.value == null) {
          mostrarError(true, box);
          direccionValida = false;
        } else {
          mostrarError(false, box);
          direccionValida = true;
        }
      }

      // if (boxInput != null && boxInput.name == "seguimiento_profesor") {
      //   console.log("validacion seguimiento")
      //   if (boxInput.value > 6 || boxInput.value < 1) {
      //     mostrarError(true, box);
      //     seguimientoValida = false;
      //   } else {
      //     mostrarError(false, box);
      //     seguimientoValida = true;
      //   }
      // }
      let button = document.querySelector('#btn-g');

      if (radio.checked || radio1.checked) {
        radioValida = true;
      }
      // seguimientoValida && && seccionValida

      // if (app.action == "Asignar") {
      //   let materias = true,
      //     secciones = true;
      //   app.id_materia.forEach(item => {
      //     if (item.id == '') materias = false;
      //   })
      //   app.id_seccion.forEach(item => {
      //     if (item == '') secciones = false;
      //   })

      //   if (app.seguimiento != '' && materias && secciones) app.formulario_valido = true;
      //   else {
      //     app.formulario_valido = false;
      //     alert("Debes de llenar todos los datos faltantes (secciones y materias)");
      //   }
      //   return false;
      // }

      if (cedulaValida && nombreValida && apellidoValida && correoValida && fechaValida && direccionValida && nacionalidadValida && radioValida) {
        app.formulario_valido = true;
      } else app.formulario_valido = false;
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

    $("#nombre, #apellido").bind('keypress', function(event) {
      var regex = new RegExp("^[a-zA-Z ]+$");
      var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
      if (!regex.test(key)) {
        event.preventDefault();
        return false;
      }
    });

    $("#cedula").bind('keypress', function(event) {
      var regex = new RegExp("^[0-9]+$");
      var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
      if (!regex.test(key)) {
        event.preventDefault();
        return false;
      }
    });


  </script>

  <!-- <script src="./views/js/Seccion/index.js"></script> -->
</body>

</html>