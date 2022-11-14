<!DOCTYPE html>
<html lang="en">
<?php $this->Head(); ?>

<body>
  <div class="col-md-12" id="App_vue">
    <div class="row">
      <!-- CONTENEDOR DE NAVBAR -->
      <?php $this->Navbar(); ?>
      <!-- CONTENEDOR DE TABLA Y BUSCADOR -->
      <div class="col-md-12">

      <div class="col-md-12 mx-auto px-2">
        <div class="col-md-3 p-3 card ml-3 bg-hero mt-2">
          <h5 class="fw-bold text-light text-center my-auto">Periodo: {{des_periodo}}</h5>
        </div>
        </div>
        

        <div class="col-md-8 mx-auto " style="margin-top:5%;">

          <!-- input de busqueda -->
          <div class="col-md-12 mx-auto">
            <div class="col-md-7 mx-auto">
              <h3 class="fw-bold text-center text-success">Gestión de Materias</h3>
            </div>
          </div>
          <div class="col-md-12 row justify-content-end" style="margin: 0; padding: 0;">
    

           
           <!-- <div class="col-md-2 justify-content-end" style="margin: 0; padding: 0;">
              <button type="button" class="btn btn-sm btn-primary" @click="LimpiarForm" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="margin-bottom: 10px">
                <i class="fa-regular fa-user"></i> AGREGAR
              </button>
            </div> -->
          </div>

          <!-- contenedor de la tabla -->
          <div class="col-md-12 card p-2 shadow">
            <div class="col ">
              <table class="table border" id="datatable">
                <thead>
                  <tr>
                    <th class="text-center" scope="col">N°</th>
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
            <div class="modal-header">
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
                <div class="col-md-6">
                  <label class="form-label">Pensum</label>
                  <select class="form-select form-select-sm" name="id_pensum" v-model="id_pensum" required aria-label="Default select example">
                    <option value="" selected>Seleccionar</option>
                    <option v-for="item in pensums" :value="item.id">{{ item.cod_pensum }} {{ (item.anios_abarcados == 'B') ? 'Basica' : 'Diversificado' }}</option>
                  </select>
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
          id: "",
          des_materia: "",
          id_periodo: "",
          id_pensum: "",
          estatus: "",
          formulario_valido: false,
          pensums: [],
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
            this.id = "";
            this.des_materia = "";
            this.estatus = "";
            $("#datatable").DataTable().ajax.reload(null, false);
            this.ToggleModal();
            ViewAlert(result.mensaje, result.estado);
            this.formulario_valido = false;
            this.periodo_activo();
          }).catch(Error => console.error(Error))
        },
        async GetData(id) {
          await fetch(`./Controllers/MateriasController.php?ope=ConsultOne&&id=${id}`)
            .then(res => res.json()).then(({
              data
            }) => {
              this.id = data.id_materia;
              this.des_materia = data.des_materia;
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
              this.pensums = data;
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
      async mounted() {
        await this.periodo_activo();
        await this.getPemsun();
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
          data: "id_materia"
        },
        {
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
          render(data){
            if(data == "B") return "Basico";
            if(data == "D") return "Diversificado";
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
        } else {
          console.log('Materia')
          mostrarError(false, box);
          materiaValida = true;
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