<!DOCTYPE html>
<html lang="en">
<?php 
  $this->Head(); 
  // require_once("Models/PeriodoModel.php");
  // $mod = new PeriodoModel();
  // $res = $mod->GetActivo();
  // if(!isset($res[0])) header("Location: ./VisPeriodo?no existe periodo activo, debes de registrar uno");
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
              <h2 class="fw-bold text-start my-auto text-dark">Gestión de Datos de la Institución</h3>
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
              <table class="table border" id="datatable">
                <thead>
                  <tr>
                    <th class="text-center" scope="col">Código</th>
                    <th class="text-center" scope="col">Descripción</th>
                    <th class="text-center" scope="col">Dirección</th>
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
      <div class="modal fade modal-lg" id="staticBackdrop" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Registro datos de la institución</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" @submit.preventDefault="SendData" id="Formulario" class="needs-validation" novalidate autocomplete="off">
              <div class="modal-body row py-2" style="padding: 0 70px ;">
                <input type="hidden" name="id_institucion" v-model="id_institucion" v-if="id_institucion != '' ">
                <input type="hidden" name="id_periodo" v-model="id_periodo">
                <div class="col-md-12 mt-3">
                  <div class="input-group input-group-sm form-group form-box" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Código de la institución:</span>
                    <input type="text" minlength="1" maxlength="10" v-model="codigo_institucion" name="codigo_institucion" class="form-control form-control-sm" required id="des_materia" placeholder="Código de la institución" id="codigo_institucion" style="width:70%; text-transform:uppercase;">
                    <span class="error-text">Rellene el campo correctamente</span>
                  </div>
                </div>
                <div class="col-md-12 mt-3">
                  <div class="input-group input-group-sm form-group form-box" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Nombre de la institución:</span>
                    <input type="text" minlength="1" maxlength="60" v-model="des_institucion" name="des_institucion" class="form-control form-control-sm" id="des_institucion" required id="des_materia" placeholder="Nombre de la institución" style="width:70%; text-transform:uppercase;" v-bind:disabled="action == 'Save'">
                    <span class="error-text">Rellene el campo correctamente</span>
                  </div>
                </div>
                <div class="col-md-12 mt-3">
                  <div class="input-group input-group-sm form-group form-box" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Dirección de la institución:</span>
                    <input v-model="direccion_institucion" maxlength="120" name="direccion_institucion" class="form-control form-control-sm" id="direccion_institucion" cols="30" required rows="2" placeholder="Dirección de la institución" style="width:70%; text-transform:uppercase;" v-bind:disabled="action == 'Save'">
                    <span class="error-text">Rellene el campo correctamente</span>
                  </div>
                </div>
                <div class="col-md-12 mt-3">
                  <div class="input-group input-group-sm form-group form-box" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Municipio:</span>
                    <input v-model="municipio" maxlength="60" name="municipio" class="form-control form-control-sm" id="municipio" cols="30" required rows="2" placeholder="Dirección de la institución" style="width:70%; text-transform:uppercase;" v-bind:disabled="action == 'Save'">
                    <span class="error-text">Rellene el campo correctamente</span>
                  </div>
                </div>
                <div class="col-md-12 mt-3">
                  <div class="input-group input-group-sm form-group form-box" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Entidad Federal:</span>
                    <input v-model="entidad_federal" maxlength="60" name="entidad_federal" class="form-control form-control-sm" id="entidad_federal" cols="30" required rows="2" placeholder="Dirección de la institución" style="width:70%; text-transform:uppercase;" v-bind:disabled="action == 'Save'">
                    <span class="error-text">Rellene el campo correctamente</span>
                  </div>
                </div>
                <div class="col-md-12 mt-3">
                  <div class="input-group input-group-sm form-group form-box" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Zona Educativa:</span>
                    <input v-model="zona_educativa" maxlength="60" name="zona_educativa" class="form-control form-control-sm" id="zona_educativa" cols="30" required rows="2" placeholder="Dirección de la institución" style="width:70%; text-transform:uppercase;" v-bind:disabled="action == 'Save'">
                    <span class="error-text">Rellene el campo correctamente</span>
                  </div>
                </div>
                <div class="col-md-12 mt-3">
                  <div class="input-group input-group-sm form-group form-box" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Telefono de la institución:</span>
                    <input v-model="telefono" maxlength="11" name="telefono" class="form-control form-control-sm" id="telefono" cols="30" required rows="2" placeholder="Dirección de la institución" style="width:70%; text-transform:uppercase;" v-bind:disabled="action == 'Save'">
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
          id_institucion: "",
          codigo_institucion: "",
          des_institucion: "",
          direccion_institucion: "",
          municipio: "",
          entidad_federal: "",
          zona_educativa: "",
          telefono: "",
          formulario_valido: false,
          action: "Save",
        }
      },
      methods: {
        SendData(e) {

          e.preventDefault();
          // if(!$("#Formulario").valid()) return false;
          let form = new FormData(e.target);

          if (!this.formulario_valido) return false;
          fetch("./Controllers/InstitucionController.php", {
            method: "POST",
            body: form
          }).then(res => res.json()).then(result => {
            $("#datatable").DataTable().ajax.reload(null, false);
            this.LimpiarForm();
            this.ToggleModal();
            ViewAlert(result.mensaje, result.estado);
            this.formulario_valido = false;
            this.periodo_activo();
          }).catch(Error => console.error(Error))
        },
        async GetData(id) {
          await fetch(`./Controllers/InstitucionController.php?ope=ConsultOne&&id=${id}`)
            .then(res => res.json()).then(({
              data
            }) => {
              this.id_institucion = data.id_institucion;
              this.des_institucion = data.des_institucion;
              this.codigo_institucion = data.codigo_institucion;
              this.direccion_institucion = data.direccion_institucion;
              this.action = "Update";
            }).catch(error => console.error(error))
        },
        async periodo_activo() {
          await fetch(`./Controllers/PeriodoController.php?ope=ConsultPeriodoActivo`)
            .then(res => res.json()).then(({
              data
            }) => {
              if (data[0] != undefined) {
                this.des_periodo = data.periodoescolar;
              } else {
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
          this.id_institucion = "";
          this.des_institucion = "";
          this.codigo_institucion = "";
          this.direccion_institucion = "";
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
        url: "./Controllers/InstitucionController.php?ope=ConsulAll",
        dataSrc: "data"
      },
      columns: [{
          data: "codigo_institucion"
        },
        {
          data: "des_institucion",
          render(data) {
            return data.toUpperCase()
          }
        },
        {
          data: "direccion_institucion"
        },
        {
          data: "estatus_institucion",
          render(data){
            return (data == '1') ? "Activo" : "Inactivo";
          }
        },
        {
          defaultContent: '',
          render: function(data, type, row) {
            let btns = `
              <div class="d-flex justify-content-center">
                <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onClick="Consult(this)" data-id='${row.id_institucion}' class="btn btn-sm btn-info">
                  <i class="fa-solid fa-edit"></i>
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
    let descripcionValida = false;
    let direccionValida = false;
    let codigoValida = false;
    let municipioValida = false;
    let entidadFValida = false;
    let telefonoValida = false;
    let zonaEValida = false;
    let entidadEValida= false;






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
        console.log(document.getElementById("Formulario").des_institucion)
        validacion(box, boxInput);
        // app.ToggleModal();
            descripcionValida = false;
            direccionValida = false;
            codigoValida = false;
            municipioValida = false;
            entidadFValida = false;
            telefonoValida = false;
            zonaEValida = false;
            entidadEValida= false;
      })
    });

    function validacion(box, boxInput) {


      if (boxInput != null && boxInput.name == "codigo_institucion") {
        if (boxInput.value.length < 1) {
          console.log('codigo')
          mostrarError(true, box);
          codigoValida = false;
          document.querySelector('#direccion_institucion').value = ""
          document.querySelector("#direccion_institucion").disabled = true;
          document.querySelector('#des_institucion').disabled = true;
          document.querySelector('#des_institucion').value = '';
          document.querySelector('#municipio').disabled = true;
          document.querySelector('#municipio').value = '';
          document.querySelector('#entidad_federal').disabled = true;
          document.querySelector('#entidad_federal').value = '';
          document.querySelector('#zona_educativa').disabled = true;
          document.querySelector('#zona_educativa').value = '';
          document.querySelector('#telefono').disabled = true;
          document.querySelector('#telefono').value = '';
        } else {
          console.log('codigo')
          mostrarError(false, box);
          codigoValida = true;
          document.querySelector("#des_institucion").disabled = false;
        }
      }


      if (boxInput != null && boxInput.name == "des_institucion") {
        if (boxInput.value.length < 1) {
          console.log('descripcion')
          mostrarError(true, box);
          descripcionValida = false;
          document.querySelector('#des_institucion').disabled = true;
          document.querySelector('#des_institucion').value = '';
          document.querySelector('#municipio').disabled = true;
          document.querySelector('#municipio').value = '';
          document.querySelector('#entidad_federal').disabled = true;
          document.querySelector('#entidad_federal').value = '';
          document.querySelector('#zona_educativa').disabled = true;
          document.querySelector('#zona_educativa').value = '';
          document.querySelector('#telefono').disabled = true;
          document.querySelector('#telefono').value = '';
        } else {
          console.log('descripcion')
          mostrarError(false, box);
          descripcionValida = true;
          document.querySelector("#direccion_institucion").disabled = false;
        }
      }
      
      if (boxInput != null && boxInput.name == "direccion_institucion") {
        if (boxInput.value.length < 1) {
          console.log('direccion')
          mostrarError(true, box);
          direccionIValida = false;
          document.querySelector('#municipio').disabled = true;
          document.querySelector('#municipio').value = '';
          document.querySelector('#entidad_federal').disabled = true;
          document.querySelector('#entidad_federal').value = '';
          document.querySelector('#zona_educativa').disabled = true;
          document.querySelector('#zona_educativa').value = '';
          document.querySelector('#telefono').disabled = true;
          document.querySelector('#telefono').value = '';
        } else {
          console.log('direccion')
          mostrarError(false, box);
          document.querySelector('#municipio').disabled = false;
          direccionIValida = true;
        }
      }

      if (boxInput != null && boxInput.name == "municipio") {
        if (boxInput.value.length < 1) {
          console.log('municipio')
          mostrarError(true, box);
          municipioValida = false;
          document.querySelector('#entidad_federal').disabled = true;
          document.querySelector('#entidad_federal').value = '';
          document.querySelector('#zona_educativa').disabled = true;
          document.querySelector('#zona_educativa').value = '';
          document.querySelector('#telefono').disabled = true;
          document.querySelector('#telefono').value = '';
        } else {
          console.log('municipio')
          document.querySelector('#entidad_federal').disabled = false;
          mostrarError(false, box);
          municipioValida = true;
        }
      }

      if (boxInput != null && boxInput.name == "entidad_federal") {
        if (boxInput.value.length < 1) {
          console.log('entidad_federal')
          mostrarError(true, box);
          entidadFValida = false;
          document.querySelector('#zona_educativa').disabled = true;
          document.querySelector('#zona_educativa').value = '';
          document.querySelector('#telefono').disabled = true;
          document.querySelector('#telefono').value = '';
        } else {
          console.log('entidad_federal')
          document.querySelector('#zona_educativa').disabled = false;
          mostrarError(false, box);
          entidadFValida = true;
        }
      }

      if (boxInput != null && boxInput.name == "zona_educativa") {
        if (boxInput.value.length < 1) {
          console.log('zona_educativa')
          mostrarError(true, box);
          zonaEValida = false;
          document.querySelector('#telefono').disabled = true;
          document.querySelector('#telefono').value = '';
        
        }else{
          console.log('zona_educativa')
          document.querySelector('#telefono').disabled = false;
          mostrarError(false, box);
          zonaEValida = true;
        }
      }

      if (boxInput != null && boxInput.name == "telefono") {
        if (boxInput.value.length < 1) {
          console.log('telefono')
          mostrarError(true, box);
          telefonoValida = false;
        } else {
          console.log('telefono')
          mostrarError(false, box);
          telefonoValida = true;
        }
      }


      
      // direccionValida codigoValida
      // console.log(descripcionValida, codigoValida)
      // ARREGLAR VALIDACIONES
      if (true) {
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


    $("#des_institucion, #municipio, #zona_educativa, #entidad_federal").bind('keypress', function(event) {
      var regex = new RegExp("^[a-zA-Z ]+$");
      var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
      if (!regex.test(key)) {
        event.preventDefault();
        return false;
      }
    });

    $("#telefono").bind('keypress', function(event) {
      var regex = new RegExp("^[0-9]+$");
      var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
      if (!regex.test(key)) {
        event.preventDefault();
        return false;
      }
    });

    $("#direccion_institucion").bind('keypress', function(event) {
      var regex = new RegExp("^[a-zA-Z0-9 ]+$");
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