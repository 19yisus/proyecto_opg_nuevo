<!DOCTYPE html>
<html lang="en">
<?php $this->Head(); ?>

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
              <h2 class="fw-bold text-start my-auto text-dark">Gestión de Asignación de Estudiantes</h3>
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
              <!-- <button type="button" class="btn btn-sm btn-primary" @click="LimpiarForm" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="margin-bottom: 10px">
                <i class="fa-regular fa-user"></i> AGREGAR
              </button> -->
            </div>
            <div class="col ">
              <table class="table border table-sm" id="datatable">
                <thead>
                  <tr>
                    <!-- <th class="text-center" scope="col">N°</th> -->
                    <th class="text-center" scope="col">Cedula</th>
                    <th class="text-center" scope="col">Nombre/Apellidos</th>
                    <th class="text-center" scope="col">Seccion</th>
                    <th class="text-center" scope="col">Estatus Asignación</th>
                    <th class="text-center" scope="col">Estatus Estudiante</th>
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
      <div class="modal modal-lg fade" id="staticBackdrop" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header  bg-hero-azul fw-bold">
              <h5 class="modal-title" id="staticBackdropLabel">Registro Estudiantes</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" @submit.preventDefault="SendData" id="Formulario" class="needs-validation" name="formulario" novalidate>
              <div class="col-md-12 mx-auto rounded border d-flex justify-content-between mt-2 row">
                <h5 class="text-start col-md-4">Pensum: </h5>
                <h5 class="text-end col-md-4">Periodo: {{des_periodo}}</h5>
              </div>
              <input type="hidden" name="id_periodo" v-model="id_periodo">
              <div class="modal-body row " style="padding: 0 70px;">

                <div class="col-md-6" style="margin:0; padding:5px;">

                  <div class="input-group input-group-sm form-box-select" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Nacionalidad:</span>
                    <select class="form-select" @change="cedula = '' " :disabled="action == 'Asignacion'" v-model="nacionalidad" name="nacionalidad" id="nacionalidad" aria-label="Default select example" style="width: 50%;" required>
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
                    <input type="number" step="1" v-bind:disabled="nacionalidad == '' " name="cedula" :readonly="action == 'Update' || action == 'Asignacion'" v-model="cedula" v-bind:maxlength="[ nacionalidad == 'V' ? 8: 6 ]" class="form-control form-control-sm" id="cedula" required placeholder="Ingrese la cédula del estudiante" style="width:70%;">
                    <span class="error-text">Cedula incorrecta</span>
                  </div>
                </div>

                <div class="col-md-6 " style="margin:0; padding:5px;">
                  <div class="input-group input-group-sm form-box" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Nombres:</span>
                    <input type="text" name="nombre" disabled v-model="nombre" maxlength="20" class="form-control form-control-sm" id="nombre" required placeholder="Ingrese el nombre del estudiante" style="width:70%;" disabled>
                    <span class="error-text">Nombre no valido</span>
                  </div>
                </div>

                <div class="col-md-6 " style="margin:0; padding:5px;">
                  <div class="input-group input-group-sm form-box" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Apellidos:</span>
                    <input type="text" name="apellido" disabled v-model="apellido" maxlength="20" class="form-control form-control-sm" id="apellido" required placeholder="Ingrese el apellido del estudiante" style="width:70%;" disabled>
                    <span class="error-text">Apellido no valido</span>
                  </div>
                </div>

                <div class="col-md-6 " style="margin:0; padding:5px;">
                  <div class="input-group input-group-sm form-box form-box-fecha" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Fecha de Nacimiento:</span>
                    <input type="date" :max="fecha_maxima" name="fecha_n_persona" disabled v-model="fecha_n" class="form-control form-control-sm" id="fecha_n_persona" placeholder="dd/mm/aaaa" required style="width:50%;" disabled>
                    <span class="error-text">Formato o fecha inválida</span>
                  </div>

                </div>

                <div class="col-md-6 " style="margin:0; padding:5px;">
                  <div class="input-group input-group-sm form-box" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Lugar de Nacimiento:</span>
                    <input type="text" name="direccion_n_persona" disabled v-model="lugar_n" class="form-control form-control-sm" id="direccion_persona" placeholder="Ingrese el lugar de nacimiento" required style="width:50%;" disabled>
                    <span class="error-text">Rellene el campo correctamente</span>
                  </div>
                </div>

                <div class="col-md-6" style="margin:0; padding:5px;">
                  <div class="input-group input-group-sm form-box form-box-select" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Seguimiento:</span>
                    <input type="number" min="1" max="6" maxlength="1" :readonly="action == 'Update' || action == 'Asignacion' " minlength="1" name="seguimiento_estudiante" class="form-control form-control-sm" id="" v-model="seguimiento" placeholder="Año">
                    <select name="id_seccion" v-model="id_seccion" id="seccion" class="form-select" :disabled="desactivado" aria-label="Default select example" required disabled>
                      <option value="0">Seleccione una opción</option>
                      <option :value="item.idSeccion" v-for="item in secciones">{{item.id_seccion}}</option>
                    </select>
                    <span class="error-text">Selecciona año y sección</span>
                    <!-- <input type="text" class="form-control form-control-sm" id="" placeholder="Seccion"> -->
                  </div>
                </div>

                <!-- <div class="col-md-2"></div> -->

                <div class="col-md-6" style="margin:0; padding:5px;">
                  <div class="input-group input-group-sm form-box" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Dirección:</span>
                    <input type="text" name="direccion" disabled v-model="direccion" maxlength="100" class="form-control form-control-sm" id="direccion" placeholder="Ingrese la dirección" required style="width:70%;" disabled>
                    <span class="error-text">Direccion inválida</span>
                  </div>
                </div>
                <div class="col-md-4" style="margin:0; padding: 5px;">
                  <label for="">Sexo</label>
                  <div class="d-flex">
                    <div class="form-check">
                      <input type="radio" name="sexo" disabled v-model="sexo" value="F" id="radio" class="form-check-input" required>
                      <label for="">F</label>
                    </div>
                    <div class="form-check pl-2">
                      <input type="radio" name="sexo" disabled v-model="sexo" value="M" id="radio1" class="form-check-input" required>
                      <label for="">M</label>
                    </div>
                  </div>
                </div>

                <div class="modal-footer mx-auto">
                  <input type="hidden" name="ope" v-model="action">
                  <button type="submit" :disabled="ifPeriodo || desactivado" class="btn btn-sm btn-primary" id="btn-g">
                    <i class="fa-regular fa-circle-check"></i> GUARDAR
                  </button>
                  <button type="button" class="btn btn-sm btn-danger" id='btn-sm' data-bs-dismiss="modal">
                    <i class="fa-regular fa-circle-xmark"></i> SALIR
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
          estatus: "",
          nacionalidad: "",
          cedula: "",
          nombre: "",
          apellido: "",
          fecha_n: "",
          lugar_n: "",
          seguimiento: "",
          id_seccion: "",
          direccion: "",
          sexo: "",
          id_periodo: "",
          id_periodoFiltro: "",
          secciones: [],
          periodosFiltro: [],
          formulario_valido: false,
          desactivado: false,
          fecha_maxima: "",
          action: "Save",
        }
      },
      methods: {
        SendData(e) {

          e.preventDefault();
          // if(!$("#Formulario").valid()) return false;
          let form = new FormData(e.target);
          if (!this.formulario_valido) return false;

          fetch("./Controllers/EstudiantesController.php", {
            method: "POST",
            body: form
          }).then(res => res.json()).then(result => {


            $("#datatable").DataTable().ajax.reload(null, false);
            this.ToggleModal();
            this.LimpiarForm();
            ViewAlert(result.mensaje, result.estado);
            this.periodo_activo();
          }).catch(Error => console.error(Error))
        },
        async GetData(id) {
          this.desactivado = false;
          await fetch(`./Controllers/EstudiantesController.php?ope=ConsultOne&&id=${id}`)
            .then(res => res.json()).then(async ({
              data
            }) => {

              console.log(data)
              if (data[0] != undefined) {
                this.nacionalidad = data.nacionalidad_persona
                this.cedula = data.cedula_estudiante
                this.nombre = data.nombre_persona
                this.apellido = data.apellido_persona
                this.fecha_n = moment(data.fecha_n_persona).format("D/MM/YYYY")
                this.lugar_n = data.direccion_n_persona
                this.direccion = data.direccion_persona
                this.sexo = data.sexo_persona

                if (parseInt(data.seguimiento_estudiante) == 7) {
                  this.desactivado = true;
                  ViewAlert("Este estudiante ya no puede ser asignado, ya culmnó", "error");
                  this.action = "Save";
                  return false;
                } else {
                  this.seguimiento = data.seguimiento_estudiante
                  this.action = "Update";
                  await this.consultarSecciones(data.seguimiento_estudiante)

                  setTimeout(() => {
                    this.id_seccion = data.id_seccion
                  }, 100)
                }
              }

            }).catch(error => console.error(error))
        },
        async Asignacion(id) {
          await this.GetData(id);
          setTimeout(() => {
            this.action = "Asignacion";
          }, 100)
        },
        async ChangeState(id) {
          this.cedula = id;
          this.action = "ChangeStatus";
          this.nacionalidad = "V";

          setTimeout(async () => {
            let form = new FormData(document.getElementById("Formulario"));
            await fetch(`./Controllers/EstudiantesController.php`, {
              method: "POST",
              body: form
            }).then(res => res.json()).then(result => {
              ViewAlert(result.mensaje, result.estado);
              $("#datatable").DataTable().ajax.url(`./Controllers/EstudiantesController.php?ope=ConsulAll&&id_periodo=${this.id_periodo}`).load();
              this.action = "Save";
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
        ToggleModal() {
          $("#staticBackdrop").modal("hide");
          $("body").removeClass("modal-open");
          $(".modal-backdrop").remove();
        },
        LimpiarForm() {
          this.estatus = ""
          this.nacionalidad = ""
          this.cedula = ""
          this.nombre = ""
          this.apellido = ""
          this.fecha_n = ""
          this.lugar_n = ""
          this.seguimiento = ""
          this.id_seccion = ""
          this.direccion = ""
          this.sexo = ""
          this.action = "Save";
        },
        async consultarSecciones(anio) {
          const res = await fetch(`./Controllers/SeccionController.php?ope=ConsultPorAnio&&anio=${anio}`)
            .then(res => res.json()).then(({
              data
            }) => {
              return data;
            }).catch(error => console.error(error));
          if (res.length == 0) {
            ViewAlert("No hay secciones registradas en el año ingresado", "error");
            return false;
          }
          this.secciones = res;
        },
        async GetPeriodoEscolar() {
          const res = await fetch(`./Controllers/PeriodoController.php?ope=ConsultPeriodoActivo`)
            .then(res => res.json()).then(({
              data
            }) => {
              return data;
            }).catch(error => console.error(error));
          if (res.length == 0) {
            ViewAlert("No hay un periodo escolar activo", "error");
            return false;
          }
          this.id_periodo = res.id_periodo_escolar;
          this.fecha_maxima = res.fecha_inicio;
        },
      },
      computed: {
        ifPeriodo() {
          if (this.id_periodo == "") return true;
          return false;
        },
        async ConsultCedula(newCedula) {
          console.log(newCedula)
          if (newCedula.length >= 7) {
            await fetch(`./Controllers/EstudiantesController.php?ope=ConsultOne&&id=${newCedula}`)
              .then(response => response.json())
              .then(result => {
                console.log(result)
              }).catch(error => console.error(error))
          }
        }
      },
      watch: {
        seguimiento(newAnio) {
          if (newAnio != '') this.consultarSecciones(newAnio);
          else this.secciones = [];
        },
        id_periodoFiltro(periodo) {
          if (periodo != '') {
            $("#datatable").DataTable().ajax.url(`./Controllers/EstudiantesController.php?ope=ConsulAll&&id_periodo=${periodo}`).load();
          }
        }
      },
      async mounted() {
        await this.periodo_activo();
        await this.GetPeriodoEscolar();
      }
    }).mount("#App_vue");

    const CambiarEstatus = (e) => app.ChangeState(e.dataset.id)
    const Consult = (e) => app.GetData(e.dataset.id)
    const asignacion = (e) => app.Asignacion(e.dataset.id);

    document.querySelector(".modal").addEventListener("hide.bs.modal", () => app.desactivado = false)

    $("#datatable").DataTable({
      ajax: {
        url: "./Controllers/EstudiantesController.php?ope=ConsulAll",
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
          data: "id_seccion",
          render: function(data, type, row) {
            return row.id_seccion
          }
        },
        {
          data: "estatus_asig_estu",
          render: function(data) {
            return data == 1 ? "Activo" : "Inactivo";
          }
        },
        {
          data: "estatus_estudiante",
          render: function(data) {
            return data == 1 ? "Activo" : "Inactivo";
          }
        },
        {
          defaultContent: '',
          render: function(data, type, row) {
            let classStatus = row.estatus_estudiante == 1 ? 'success' : 'danger';
            let btns = '';
            // || row.id_seccion != ''
            if (row.estatus_asig_estu == 1 ) {
              btns = ``;
            } else {
              btns = `
                <div class="">
                  <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onClick="asignacion(this)" data-id='${row.cedula_estudiante}' class="btn btn-sm btn-info">
                    <i class="fa-regular fa-user"></i>
                  </button>
                </div>`;
            }

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

    let radio = document.getElementById("radio");
    let radio1 = document.getElementById('radio1');
    let nacionalidad = document.getElementById("nacionalidad");
    let tiempoFuera = null;
    let nacionalidadValida = false;
    let cedulaValida = false;
    let nombreValida = false;
    let apellidoValida = false;
    let fechaValida = false;
    let lugarNValida = false;
    let direccionValida = false;
    let seguimientoValida = false;
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
      let button = document.querySelector('#btn-g');
      button.addEventListener('click', e => {
        validacion(box, boxInput);
        // let cedulaValida = false;
        // let nombreValida = false;
        // let apellidoValida = false;
        // let lugarNValida = false;
        // let direccionValida = false;
        let seguimientoValida = false;
        let seccionValida = false;
        // let radioValida = false;
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

      // if (boxInput != null & boxInput.name == "fecha_n_persona") {
      //   console.log('Validacion fecha inicio')

      //   if (!moment(boxInput.value).isValid()) {
      //     app.formulario_valido = false
      //     mostrarError(true, box);
      //     fechaValida = false;
      //     document.querySelector('#direccion_persona').disabled = true;
      //     return false
      //   }

      //   /* Comprobar que el año no sea superior al actual*/
      //   if (moment(boxInput.value).isAfter(moment(boxInput.max)) || moment(boxInput.value).isBefore(moment(boxInput.min))) {
      //     app.formulario_valido = false
      //     mostrarError(true, box);
      //     fechaIValida = false;
      //     document.querySelector('#direccion_persona').disabled = true;
      //     return false
      //   } else {
      //     app.formulario_valido = true
      //     mostrarError(false, box);
      //     fechaValida = true;
      //     document.querySelector('#direccion_persona').disabled = false;
      //     return true
      //   }
      // }
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
          document.querySelector('#direccion_persona').disabled = true;
          document.querySelector('#direccion_persona').value = "";
          document.querySelector('#direccion').disabled = true;
          document.querySelector('#direccion').value = "";

        } else {
          console.log(box);
          mostrarError(false, box);
          nacionalidadValida = true;
        }
      }
      if (boxSelect.name == 'id_seccion') {
        if (boxSelect.value == "") {
          mostrarError(true, box);
          seccionValida = false;
        } else {
          console.log(box);
          mostrarError(false, box);
          seccionValida = true;
        }
      }
    }

    async function validacion(box, boxInput) {
      // if (boxInput != null && boxInput.name == "cedula") {
      //   let cedulaRepetida = false;

        // if (boxInput.value.length >= 7) {
        //   await fetch(`./Controllers/EstudiantesController.php?ope=VerificarCedula&&id=${boxInput.value}`)
        //     .then(response => response.json())
        //     .then(result => {
        //       if (result.data.cedula_persona) {
        //         alert("Esta cedula ya esta registrada")
        //         cedulaRepetida = true;
        //         document.querySelector('#nombre').disabled = false;
        //       } else {
        //         document.querySelector('#nombre').disabled = true;
        //         document.querySelector('#nombre').value = "";
        //         document.querySelector('#apellido').disabled = true;
        //         document.querySelector('#apellido').value = "";
        //         document.querySelector('#fecha_n_persona').disabled = true;
        //         document.querySelector('#fecha_n_persona').value = "";
        //         document.querySelector('#direccion_persona').disabled = true;
        //         document.querySelector('#direccion_persona').value = "";
        //         document.querySelector('#direccion').disabled = true;
        //         document.querySelector('#direccion').value = "";
        //         cedulaRepetida = false;
        //       }
        //     }).catch(error => console.error(error))
        // } else cedulaRepetida = false;

        // if (boxInput.value.length < 7 || boxInput.value.length > 8) {
        //   console.error('Campo vacío o cédula inválida')
        //   mostrarError(true, box);
        //   cedulaValida = false;
        //   document.querySelector('#nombre').disabled = true;
        //   document.querySelector('#nombre').value = "";
        //   document.querySelector('#apellido').disabled = true;
        //   document.querySelector('#apellido').value = "";
        //   document.querySelector('#fecha_n_persona').disabled = true;
        //   document.querySelector('#fecha_n_persona').value = "";
        //   document.querySelector('#direccion_persona').disabled = true;
        //   document.querySelector('#direccion_persona').value = "";
        //   document.querySelector('#direccion').disabled = true;
        //   document.querySelector('#direccion').value = "";
        // } else if (isNaN(boxInput.value)) {
        //   console.error(`${boxInput.value} no es un numero`);
        //   mostrarError(true, box);
        //   cedulaValida = false
        //   document.querySelector('#nombre').disabled = true;
        //   document.querySelector('#nombre').value = "";
        //   document.querySelector('#apellido').disabled = true;
        //   document.querySelector('#apellido').value = "";
        //   document.querySelector('#fecha_n_persona').disabled = true;
        //   document.querySelector('#fecha_n_persona').value = "";
        //   document.querySelector('#direccion_persona').disabled = true;
        //   document.querySelector('#direccion_persona').value = "";
        //   document.querySelector('#direccion').disabled = true;
        //   document.querySelector('#direccion').value = "";
        // } else if (cedulaRepetida) {
        //   console.error(`${boxInput.value} Ya esta registrado`);
        //   mostrarError(true, box);
        //   cedulaValida = false;
        //   document.querySelector('#nombre').disabled = true;
        //   document.querySelector('#nombre').value = "";
        //   document.querySelector('#apellido').disabled = true;
        //   document.querySelector('#apellido').value = "";
        //   document.querySelector('#fecha_n_persona').disabled = true;
        //   document.querySelector('#fecha_n_persona').value = "";
        //   document.querySelector('#direccion_persona').disabled = true;
        //   document.querySelector('#direccion_persona').value = "";
        //   document.querySelector('#direccion').disabled = true;
        //   document.querySelector('#direccion').value = "";
        // } else {
        //   mostrarError(false, box);
        //   cedulaValida = true;
        //   document.querySelector('#nombre').disabled = false;
        // }
      // }
      // if (boxInput != null && boxInput.name == "nombre") {
      //   const letrasEspeciales = ["@", "/", "%", "#", ".", "*", "$", "!", ",", "?", "¿", "¡", "&", "-", "_", "(", ")", "{", "}", "[", "]", "'", '"', "=", "´", "+", ":", ";", "|", "°", "¬"];
      //   const numeros = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];
      //   let contieneLetraEspecial = 0;
      //   let contieneNumeros = 0;

      //   for (let i = 0; i < boxInput.value.length; i++) {
      //     for (let j = 0; j < letrasEspeciales.length; j++) {
      //       if (boxInput.value[i] === letrasEspeciales[j]) {
      //         contieneLetraEspecial++;
      //       }
      //     }
      //   }

      //   for (let i = 0; i < boxInput.value.length; i++) {
      //     for (let j = 0; j < numeros.length; j++) {
      //       if (boxInput.value[i] === numeros[j]) {
      //         contieneNumeros++;
      //       }
      //     }
      //   }
      //   console.log("validacion nombre")
      //   if (boxInput.value == '' || boxInput.value == ' ' || boxInput.value.length < 3 || contieneNumeros > 0 || contieneLetraEspecial > 0) {
      //     mostrarError(true, box);
      //     nombreValida = false;
      //     document.querySelector('#apellido').disabled = true;
      //     document.querySelector('#apellido').value = "";
      //     document.querySelector('#fecha_n_persona').disabled = true;
      //     document.querySelector('#fecha_n_persona').value = "";
      //     document.querySelector('#direccion_persona').disabled = true;
      //     document.querySelector('#direccion_persona').value = "";
      //     document.querySelector('#direccion').disabled = true;
      //     document.querySelector('#direccion').value = "";
      //   } else {
      //     mostrarError(false, box);
      //     nombreValida = true;
      //     document.querySelector('#apellido').disabled = false;
      //   }
      // }
      // if (boxInput != null && boxInput.name == "apellido") {
      //   const letrasEspeciales = ["@", "/", "%", "#", ".", "*", "$", "!", ",", "?", "¿", "¡", "&", "-", "_", "(", ")", "{", "}", "[", "]", "'", '"', "=", "´", "+", ":", ";", "|", "°", "¬"];
      //   const numeros = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];
      //   let contieneLetraEspecial = 0;
      //   let contieneNumeros = 0;

      //   for (let i = 0; i < boxInput.value.length; i++) {
      //     for (let j = 0; j < letrasEspeciales.length; j++) {
      //       if (boxInput.value[i] === letrasEspeciales[j]) {
      //         contieneLetraEspecial++;
      //       }
      //     }
      //   }

      //   for (let i = 0; i < boxInput.value.length; i++) {
      //     for (let j = 0; j < numeros.length; j++) {
      //       if (boxInput.value[i] === numeros[j]) {
      //         contieneNumeros++;
      //       }
      //     }
      //   }
      //   console.log("validacion apellido")
      //   if (boxInput.value == '' || boxInput.value == ' ' || boxInput.value.length < 3 || contieneNumeros > 0 || contieneLetraEspecial > 0) {
      //     mostrarError(true, box);
      //     apellidoValida = false;
      //     document.querySelector('#fecha_n_persona').disabled = true;
      //     document.querySelector('#fecha_n_persona').value = "";
      //     document.querySelector('#direccion_persona').disabled = true;
      //     document.querySelector('#direccion_persona').value = "";
      //     document.querySelector('#direccion').disabled = true;
      //     document.querySelector('#direccion').value = "";

      //   } else {
      //     mostrarError(false, box);
      //     apellidoValida = true;
      //     document.querySelector('#fecha_n_persona').disabled = false;
      //   }
      // }






      // if (boxInput != null & boxInput.name == "fecha_n_persona") {
      //   const DATE_REGEX = /^(0[1-9]|[1-2]\d|3[01])(\/)(0[1-9]|1[012])\2(\d{4})$/
      //   const CURRENT_DATE = app.fecha_maxima
      //   // const CURRENT_YEAR = new Date().getFullYear();
      //   console.log('Validacion fecha de nacimiento')
      //   if (boxInput.value.length == 2) boxInput.value = boxInput.value + '/';
      //   if (boxInput.value.length == 5) boxInput.value = boxInput.value + '/';

      //   if (!boxInput.value.match(DATE_REGEX)) {
      //     mostrarError(true, box);
      //     fechaValida = false;
      //     return false
      //   }
      //   /* Comprobar los días del mes */
      //   const day = parseInt(boxInput.value.split('/')[0])
      //   const month = parseInt(boxInput.value.split('/')[1])
      //   const year = parseInt(boxInput.value.split('/')[2])

      //   const CURRENT_DAY = parseInt(CURRENT_DATE.split('-')[2])
      //   const CURRENT_MONTH = parseInt(CURRENT_DATE.split('-')[1])
      //   const CURRENT_YEAR = parseInt(CURRENT_DATE.split('-')[0])

      //   const monthDays = new Date(year, month, 0).getDate()
      //   if (day > monthDays) {
      //     mostrarError(true, box);
      //     fechaValida = false;
      //     return false
      //   }

      //   /* Comprobar que el año no sea superior al actual*/
      //   if (year > CURRENT_YEAR) {
      //     if (month > CURRENT_MONTH) {
      //       mostrarError(true, box);
      //       fechaValida = false;
      //       return false
      //     }
      //     mostrarError(true, box);
      //     fechaValida = false;
      //     return false
      //   } else {
      //     mostrarError(false, box);
      //     fechaValida = true;
      //     return true
      //   }
      // }

      // if (boxInput != null && boxInput.name == "direccion_n_persona") {
      //   console.log("validacion lugar de nacimiento")
      //   if (boxInput.value.length <= 3) {
      //     console.log("validacion lugar nacimiento");
      //     mostrarError(true, box);
      //     lugarNValida = false;
      //     document.querySelector('#direccion').disabled = true;
      //     document.querySelector('#direccion').value = "";
      //   } else {
      //     mostrarError(false, box);
      //     lugarNValida = true;
      //     document.querySelector('#direccion').disabled = false;
      //     document.querySelector('#direccion').value = "";
      //   }
      // }
      // if (boxInput != null && boxInput.name == "direccion") {
      //   console.log("validacion direccion")
      //   if (boxInput.value.length < 3 || boxInput.value == "" || boxInput.value == null) {
      //     mostrarError(true, box);
      //     direccionValida = false;
      //   } else {
      //     mostrarError(false, box);
      //     direccionValida = true;
      //   }
      // }

      // if (boxInput != null && boxInput.name == "seguimiento_estudiante") {
      //   console.log("validacion seguimiento")
      //   if (boxInput.value > 6 || boxInput.value < 1) {
      //     mostrarError(true, box);
      //     seguimientoValida = false;
      //   } else {
      //     mostrarError(false, box);
      //     seguimientoValida = true;
      //   }
      // }


      // if (radio.checked || radio1.checked) {
      //   radioValida = true;
      // }

      if (app.action == "Asignacion" && seccionValida) {
        app.formulario_valido = true;
        return false;
      }

      if (SeguimientoValida && seccionValida) {
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


    // $("#nombre, #apellido").bind('keypress', function(event) {
    //   var regex = new RegExp("^[a-zA-Z ]+$");
    //   var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    //   if (!regex.test(key)) {
    //     event.preventDefault();
    //     return false;
    //   }
    // });
  </script>
</body>

</html>