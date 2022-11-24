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
              <h2 class="fw-bold text-start my-auto text-dark">Gestión de Secciones</h3>
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
              <table class="table border table-sm" id="datatable">
                <thead>
                  <tr>
                    <th class="text-center" scope="col">Seccion</th>
                    <th class="text-center" scope="col">Periodo Escolar</th>
                    <th class="text-center" scope="col">Estado</th>
                    <!--  <th class="text-center" scope="col">Opciones</th>
-->
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
            <div class="modal-header  bg-hero-azul fw-bold">
              <h5 class="modal-title" id="staticBackdropLabel">Registro Seccion</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!--
               <div class="input-group input-group-sm">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Small</span>
                  <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div> 
              -->


            <form action="#" @submit.preventDefault="SendData" method="POST" id="Formulario" class="needs-validation" novalidate autocomplete="off">
              <div class="col-md-12 mx-auto rounded border d-flex justify-content-between mt-2 row">
                <h5 class="text-start col-md-4">Pensum: </h5>
                <h5 class="text-end col-md-4">Periodo: {{des_periodo}}</h5>
              </div>
              <div class="modal-body row " style="padding: 0 70px ;">
                <input type="hidden" name="id" v-model="id" v-if="id != '' ">
                <input type="hidden" name="id_periodo" v-model="id_periodo">
                <input type="hidden" name="letras" :value="letras">

                <div class="col-6 col-sm-12" style="margin:0; padding:5px;">
                  <div class="input-group input-group-sm form-box" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Año:</span>
                    <input type="number" min="1" max="6" v-model="anio" name="anio" class="form-control form-control-sm" required id="" placeholder="1 - 6" style="width:70%;">
                    <span class="error-text">Campo vacío o año inválido</span>
                  </div>
                </div>
                <div class="col-md-6" style="margin:0; padding:5px;">
                  <div class="input-group input-group-sm form-box form-box-select" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Seccion (inicio):</span>
                    <select name="seccion_inicial" id="seccion_inicio" class="form-select" aria-label="Default select example" required>
                      <option value="">Seleccione una opción</option>
                      <option :value="item" v-for="(item, index) in letras" :key="index">{{item}}</option>
                    </select>
                    <span class="error-text">Selecciona año y sección</span>
                  </div>
                </div>
                <div class="col-md-6" style="margin:0; padding:5px;">
                  <div class="input-group input-group-sm form-box form-box-select" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Seccion (final):</span>
                    <select name="seccion_final" id="seccion_final" class="form-select" aria-label="Default select example" required>
                      <option value="">Seleccione una opción</option>
                      <option :value="item" v-for="(item, index) in letras" :key="index">{{item}}</option>
                    </select>
                    <span class="error-text">Selecciona año y sección</span>
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
          id_periodo: "",
          id: "",
          anio: "",
          seccion: "",
          estatus: "",
          datos: [],
          formulario_valido: false,
          action: "Save",
          letras: ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'V', 'W', 'X', 'Y', 'Z']
        }
      },
      methods: {
        SendData(e) {
          e.preventDefault();
          // if(!$("#Formulario").valid()) return false;
          let form = new FormData(e.target);
          if (!this.formulario_valido) return false;

          fetch("./Controllers/SeccionController.php", {
            method: "POST",
            body: form
          }).then(res => res.json()).then(result => {
            console.log(result)
            this.id = "";
            this.anio = "";
            this.seccion = "";
            this.ToggleModal();
            $("#datatable").DataTable().ajax.reload(null, false);
            ViewAlert(result.mensaje, result.estado);
            this.periodo_activo();
          }).catch(Error => console.error(Error))
        },
        async GetData(id) {
          await fetch(`./Controllers/SeccionController.php?ope=ConsultOne&&id=${id}`)
            .then(res => res.json()).then(({
              data
            }) => {
              this.action = "Update";
            }).catch(error => console.error(error))
        },
        async ChangeState(id) {
          this.id = id;
          this.action = "ChangeStatus";

          setTimeout(async () => {
            let form = new FormData(document.getElementById("Formulario"));
            await fetch(`./Controllers/SeccionController.php`, {
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
        async GetDatos() {
          await fetch("./Controllers/SeccionController.php?ope=ConsulAll")
            .then(res => res.json()).then(({
              data
            }) => {
              this.datos = data;
            }).catch(error => console.error(error))
        }
      },
      async mounted() {
        await this.periodo_activo();
        await this.GetDatos();
      }
    }).mount("#App_vue");

    const CambiarEstatus = (e) => {
      app.ChangeState(e.dataset.id)
    }

    $("#datatable").DataTable({
      ajax: {
        url: "./Controllers/SeccionController.php?ope=ConsulAll",
        dataSrc: "data"
      },
      columns: [
        {
          data: "id_seccion"
        },
        {
          data: "periodoescolar"
        },
        {
          data: "estatus_seccion",
          render: function(data) {
            return data == 1 ? "Activo" : "Inactivo"
          }
        },
        {
          defaultContent: '',
          render: function(data, type, row) {
            let classStatus = row.estatus_seccion == 1 ? 'success' : 'danger';
            //let btns = `
            //   <div class="d-flex justify-content-center">                                     
            //   <button type="button" onClick="CambiarEstatus(this)" data-id='${row.id_seccion}' class="btn btn-sm mx-auto btn-${classStatus}">
            //   <i class="fas fa-power-off"></i>
            //</button>
            //  </div>`;
            // return btns;
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
    let anioValida = false;
    let seccionValida = false;

    document.querySelectorAll('.form-box').forEach((box) => {
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
        validacion(box, boxInput);
        // app.ToggleModal();
        let seccionValida = false;
      })
    });

    function validacion(box, boxInput) {
      if (boxInput != null && boxInput.name == "anio") {
        console.log("validacion anio")
        if (boxInput.value > 6 || boxInput.value < 1) {
          mostrarError(true, box);
          anioValida = false;
        } else if (isNaN(boxInput.value)) {
          console.error(`${boxInput.value} no es un numero`);
          mostrarError(true, box);
          numero = false
        } else {
          mostrarError(false, box);
          anioValida = true;
        }
      }
      let button = document.querySelector('#btn-g');
      if (anioValida) {
        app.formulario_valido = true;
        // button.addEventListener('click', e =>{
        //   app.ToggleModal();
        // })
        // app.ToggleModal();
      } else {
        app.formulario_valido = false;
        // button.addEventListener('click', e =>{
        //   app.preventDefault();
        // });

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
</body>

</html>