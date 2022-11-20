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
              <h2 class="fw-bold text-start my-auto text-dark">Gestión de Periodos Escolares</h3>
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
              <table class="table table-sm border" id="datatable">
                <thead>
                  <tr>
                    <th scope="col">N°</th>
                    <th scope="col">Descripción del periodo</th>
                    <th scope="col">Fecha de inicio</th>
                    <th scope="col">Fecha de cierre</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Opciones</th>
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
          <div class="modal-content ">
            <div class="modal-header bg-hero-azul fw-bold">
              <h5 class="modal-title" id="staticBackdropLabel">Registro Periodo</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" @submit.preventDefault="SendData" id="Formulario" class="needs-validation px-2" novalidate>
              <div class="col-md-12 mx-auto rounded border d-flex justify-content-between mt-2 row">
                <h5 class="text-start col-md-4">Pensum: </h5>
                <h5 class="text-end col-md-4">Periodo: {{des_periodo}}</h5>
              </div>
              <div class="modal-body row py-2 " style="padding: 0 70px ;">
                <input type="hidden" name="id" v-model="id" v-if="id != '' ">

                <div class="col-md-6 " style="margin:0; padding:5px;">
                  <div class="input-group input-group-sm form-box" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Fecha de inicio:</span>
                    <input type="date" min="1987-01-01" max="1998-12-31" v-model="fecha_inicio" name="fecha_inicio" class="form-control form-control-sm" required placeholder="dd/mm/aaaa" id="" style="width:50%;">
                    <span class="error-text">Formato o fecha inválida</span>
                  </div>
                </div>
                <div class="col-md-6 " style="margin:0; padding:5px;">
                  <div class="input-group input-group-sm form-box" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Fecha de cierre:</span>
                    <input type="date" readonly v-model="fechaCierre" name="fecha_cierre" class="form-control form-control-sm" required placeholder="dd/mm/aaaa" id="" style="width:50%;">
                    <span class="error-text">Formato o fecha inválida</span>
                  </div>
                </div>
                <div class="col-md-12 " style="margin:0; padding:5px;">
                  <div class="input-group input-group-sm">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Descripción: </span>
                    <input type="text" minlength="1" maxlength="30" v-model="periodo" name="periodoescolar" class="form-control form-control-sm" required id="" readonly placeholder="Descripción del periodo">
                  </div>
                </div>
              </div>
              <div class="modal-footer mx-auto">
                <input type="hidden" name="ope" v-model="action">
                <button type="submit" class="btn btn-sm btn-primary">
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
          periodoescolar: this.periodo,
          fecha_inicio: "",
          fecha_cierre: "",
          estatus: "",
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
          fetch("./Controllers/PeriodoController.php", {
            method: "POST",
            body: form
          }).then(res => res.json()).then(result => {

            this.id = "";
            this.periodoescolar = "";
            this.fecha_inicio = "";
            this.fecha_cierre = "";
            $("#datatable").DataTable().ajax.reload(null, false);
            this.ToggleModal();
            this.periodo_activo();
            ViewAlert(result.mensaje, result.estado);
          }).catch(Error => console.error(Error))
        },
        async GetData(id) {
          await fetch(`./Controllers/PeriodoController.php?ope=ConsultOne&&id=${id}`)
            .then(res => res.json()).then(({
              data
            }) => {
              this.id = data.id_periodo_escolar;
              this.periodoescolar = data.periodoescolar;
              this.fecha_inicio = data.fecha_inicio;
              this.fecha_cierre = data.fecha_cierre;

              this.action = "Update";
            }).catch(error => console.error(error))
        },
        ChangeState(id) {
          this.id = id;
          this.action = "ChangeStatus";

          setTimeout(() => {
            let form = new FormData(document.getElementById("Formulario"));
            fetch(`./Controllers/PeriodoController.php`, {
              method: "POST",
              body: form
            }).then(res => res.json()).then(result => {
              ViewAlert(result.mensaje, result.estado);
              $("#datatable").DataTable().ajax.reload(null, false);
              this.action = "Save";
              this.periodo_activo();
            }).catch(error => console.error(error))
          }, 100);
        },
        async periodo_activo() {
          await fetch(`./Controllers/PeriodoController.php?ope=ConsultPeriodoActivo`)
            .then(res => res.json()).then(({
              data
            }) => {
              if (data[0] != undefined) this.des_periodo = data.periodoescolar;
              else this.des_periodo = "No hay Periodo Escolar Activo";
            }).catch(Error => console.error(Error))
        },
        ToggleModal() {
          $("#staticBackdrop").modal("hide");
          $("body").removeClass("modal-open");
          $(".modal-backdrop").remove();
        },
        LimpiarForm() {
          this.id = "";
          this.periodoescolar = "";
          this.fecha_inicio = "";
          this.fecha_cierre = "";
          this.estatus = "";
          this.action = "Save";
        }
      },
      computed: {
        periodo() {
          let fechas;
          if (this.fecha_inicio != "") {
            fechas = `${moment(this.fecha_inicio).format("YYYY")}-${moment(this.fecha_inicio).add(1,"y").format("YYYY")}`;
          }
          return fechas;
        },
        fechaCierre() {
          if (this.fecha_inicio != '') {
            return moment([moment(this.fecha_inicio).add(1, 'y').format("YYYY"), 6, 28]).format("YYYY-MM-DD")
          } else return '';
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
        url: "./Controllers/PeriodoController.php?ope=ConsulAll",
        dataSrc: "data"
      },
      columns: [{
          data: "id_periodo_escolar"
        },
        {
          data: "periodoescolar"
        },
        {
          data: "fecha_inicio",
          render: function(data) {
            return moment(data).format("DD/MM/YYYY")
          }
        },
        {
          data: "fecha_cierre",
          render: function(data) {
            return moment(data).format("DD/MM/YYYY")
          }
        },
        {
          data: "estatus_periodo_escolar",
          render: function(data) {
            return data == 1 ? "Activo" : "Inactivo"
          }
        },
        {
          defaultContent: '',
          render: function(data, type, row) {
            let classStatus = row.estatus_periodo_escolar == 1 ? 'success' : 'danger';
            let btns = `
              <div class="d-flex justify-content-center">
                <button type="button" onClick="CambiarEstatus(this)" data-id='${row.id_periodo_escolar}' class='btn btn-sm mx-auto btn-${classStatus}'>
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
    let fechaIValida = false;
    let fechaCValida = false;

    document.querySelectorAll('.form-box').forEach((box) => {
      const boxInput = box.querySelector('input');

      boxInput.addEventListener("keypress", (event) => {
        clearTimeout(tiempoFuera);
        tiempoFuera = setTimeout(() => {
          console.log(`input ${boxInput.name} value: `, boxInput.value)
          validacion(box, boxInput, null)

        });
      });
    });

    function validacion(box, boxInput) {
      if (boxInput != null & boxInput.name == "fecha_inicio") {
        console.log('Validacion fecha inicio')

        if (!moment(boxInput.value).isValid()) {
          app.formulario_valido = false
          mostrarError(true, box);
          fechaValida = false;
          return false
        }

        /* Comprobar que el año no sea superior al actual*/
        if (moment(boxInput.value).isAfter(moment(boxInput.max)) || moment(boxInput.value).isBefore(moment(boxInput.min))) {
          app.formulario_valido = false
          mostrarError(true, box);
          fechaIValida = false;
          return false
        } else {
          app.formulario_valido = true
          mostrarError(false, box);
          fechaValida = true;
          return true
        }
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