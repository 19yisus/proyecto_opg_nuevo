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

        <div class="col-md-8 mx-auto " style="margin-top:5%;">

          <!-- input de busqueda -->
          <div class="col-md-12 row " style="margin: 0; padding: 0;">
            <div class="col-md-3" style="margin: 0; padding: 0;">
              <h6 class="fw-bold text-danger">Periodo: {{des_periodo}}</h6>
            </div>

            <div class="col-md-7"></div>
            <div class="col-md-2 justify-content-end" style="margin: 0; padding: 0;">
              <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                data-bs-target="#staticBackdrop">
                <i class="fa-regular fa-user"></i> AGREGAR
              </button>
            </div>
          </div>

          <!-- contenedor de la tabla -->
          <div class="col-md-12 ">
            <div class="col ">
              <table class="table border" id="datatable">
                <thead>
                  <tr>
                    <th class="text-center" scope="col">Seccion</th>
                    <th class="text-center" scope="col">Año</th>
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
      <div class="modal fade" id="staticBackdrop" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Registro Seccion</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!--
               <div class="input-group input-group-sm">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Small</span>
                  <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div> 
              -->
            <form action="#" @submit.preventDefault="SendData" id="Formulario" class="needs-validation" novalidate>
              <div class="modal-body row " style="padding: 0 70px ;">
                <input type="hidden" name="id" v-model="id" v-if="id != '' ">
                <div class="col-md-12 " style="margin:0; padding:5px;">
                  <div class="input-group input-group-sm form-box" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Año:</span>
                    <input type="text" min="1" max="6" v-model="anio" name="anio" class="form-control form-control-sm" required id="" placeholder="1 - 6" style="width:70%;">
                    <span class="error-text">Campo vacío o año inválido</span>
                  </div>
                </div>
                <div class="col-md-12 " style="margin:0; padding:5px;">
                  <div class="input-group input-group-sm form-box" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Seccion:</span>
                    <input type="text" v-model="seccion" maxlength="1" name="seccion" class="form-control form-control-sm" id="" placeholder="A - Z" required style="width:70%;">
                    <span class="error-text">Campo vacío o dato inválido</span>
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
      data(){
        return{
          des_periodo:"actual",
          id: "",
          anio: "",
          seccion: "",
          estatus: "",
          datos: [],
          formulario_valido: false,
          action: "Save",
        }
      },
      methods:{
        SendData(e){
          e.preventDefault();
          // if(!$("#Formulario").valid()) return false;
          let form = new FormData(e.target);
          if(!this.formulario_valido) return false;

          fetch("./Controllers/SeccionController.php",{
            method: "POST",
            body: form
          }).then( res => res.json()).then( result => {
            this.id = "";
            this.anio = "";
            this.seccion = "";
            this.ToggleModal();
            $("#datatable").DataTable().ajax.reload(null,false);
            ViewAlert(result.mensaje, result.estado);
            this.periodo_activo();
          }).catch(Error => console.error(Error))
        },
        async GetData(id){
          await fetch(`./Controllers/SeccionController.php?ope=ConsultOne&&id=${id}`)
          .then( res => res.json()).then( ({data}) => {
            this.action = "Update";
          }).catch( error => console.error(error))
        },
        async ChangeState(id){
          this.id = id;
          this.action = "ChangeStatus";
          
          setTimeout( async () => {
            let form = new FormData(document.getElementById("Formulario"));
            await fetch(`./Controllers/SeccionController.php`,{
              method: "POST",
              body: form
            }).then( res => res.json()).then( result => {
              ViewAlert(result.mensaje, result.estado);
              $("#datatable").DataTable().ajax.reload(null,false);
              this.action = "Save";
            }).catch( error => console.error(error))  
          }, 100);
        },
        async periodo_activo(){
          await fetch(`./Controllers/PeriodoController.php?ope=ConsultPeriodoActivo`)
          .then( res => res.json()).then( ({data}) => {
            if(data[0] != undefined) this.des_periodo = data.periodoescolar; else this.des_periodo = "No hay Periodo Escolar Activo";
          }).catch( Error => console.error(Error))
        },
        ToggleModal(){
          $("#staticBackdrop").modal("hide");
          $("body").removeClass("modal-open");
          $(".modal-backdrop").remove();
        }
        ,
        async GetDatos(){
          await fetch("./Controllers/SeccionController.php?ope=ConsulAll")
          .then( res => res.json()).then( ({data}) => {
            this.datos = data;
          }).catch( error => console.error(error))  
        }
      },
      async mounted(){
        await this.periodo_activo();
        await this.GetDatos();
      }
    }).mount("#App_vue");

    const CambiarEstatus = (e) => {
      app.ChangeState(e.dataset.id)
    }
  
    $("#datatable").DataTable({
      ajax:{
        url: "./Controllers/SeccionController.php?ope=ConsulAll",
        dataSrc: "data"
      },
      columns:[
        { data: "id_seccion"},
        { data: "ano_seguimiento"},
        { data: "estatus_seccion",
          render: function(data){
            return data == 1 ? "Activo" : "Inactivo"
          }
        },
        { defaultContent: '',
          render: function(data, type, row){
            // <button type="button" class="btn btn-sm btn-dark">
            //       <i class="fa-solid fa-gear"></i>
            //     </button>
            let btns = `
              <div class="">
                <button type="button" @click="GetData(${row.id_seccion})" class="btn btn-sm btn-info">
                  <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                                      
                <button type="button" onClick="CambiarEstatus(this)" data-id='${row.id_seccion}' class="btn btn-sm btn-warning">
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
      language:{
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
        validacion(box, boxInput,null)

        });
      });

      let button = document.querySelector('#btn-g');
      button.addEventListener('click', e =>{
        validacion(box, boxInput);
        // app.ToggleModal();
        let seccionValida = false;        
      })
    });

      function validacion(box, boxInput){
        if(boxInput!= null && boxInput.name == "anio"){
          console.log("validacion anio")
          if (boxInput.value > 6 || boxInput.value < 1){
              mostrarError(true, box);
              anioValida = false;
          }
          else if (isNaN(boxInput.value)) {
            console.error(`${boxInput.value} no es un numero`);
            mostrarError(true, box);
            numero = false
        }
          else{
              mostrarError(false, box);
              anioValida = true;
          }
        }
        if(boxInput!= null && boxInput.name == "seccion"){
          const letrasEspeciales = ["@", "/", "%", "#", ".", "*", "$", "!", ",", "?", "¿", "¡", "&", "-", "_", "(", ")", "{", "}", "[", "]", "'", '"', "=", "´", "+", ":", ";", "|", "°", "¬", " "];
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
          console.log("validacion seccion")
          if (boxInput.value < 1 || contieneLetraEspecial > 0 || contieneNumeros > 0){
              mostrarError(true, box);
              seccionValida = false;
          }
          else{
              boxInput.value = boxInput.value.toUpperCase();
              mostrarError(false, box);
              seccionValida = true;
          }
        }
        let button = document.querySelector('#btn-g');
        if(anioValida && seccionValida){
          app.formulario_valido = true;
          // button.addEventListener('click', e =>{
          //   app.ToggleModal();
          // })
          // app.ToggleModal();
        }else{
          app.formulario_valido = false;
          // button.addEventListener('click', e =>{
          //   app.preventDefault();
          // });
          
        }
      }
      function mostrarError(check, box){
        // console.log("MOSTRAR ERROR");
        if(check){
            box.classList.remove('div-error');
            box.classList.add('form-error');
        }  
        else{
            box.classList.add('div-error');
            box.classList.remove('form-error');
        }
      }

  </script>
</body>
</html>