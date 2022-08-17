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
              <button type="button" class="btn btn-sm btn-primary" @click="LimpiarForm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
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
                    <th class="text-center" scope="col">N°</th>
                    <th class="text-center" scope="col">Año del pensum</th> 
                    <th class="text-center" scope="col">Perido Escolar</th> 
                    <th class="text-center" scope="col">Estatus del pensum</th> 
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
              <h5 class="modal-title" id="staticBackdropLabel">Registro Pensum</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!--
               <div class="input-group input-group-sm">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Small</span>
                  <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                </div> 
              -->
            <form action="#" @submit.preventDefault="SendData" id="Formulario" class="needs-validation">
              <div class="modal-body row ">
                <input type="hidden" name="id" v-model="id" v-if="id != '' ">
                <input type="hidden" name="id_periodo" v-model="id_periodo">
                <div class="col-md-6">
                  <label class="form-label">Año del Pensum</label>
                  <select name="anio" class="form-select form-select-sm" required aria-label="Default select example">
                    <option value="" selected>Seleccionar</option>
                    <option value="1">1er Año</option>
                    <option value="2">2do Año</option>
                    <option value="3">3er Año</option>
                    <option value="4">4to Año</option>
                    <option value="5">5to Año</option>
                    <option value="6">6to Año</option>
                  </select>
                </div>
                <div class="col-6"></div>
                <div class="col-md-6 py-1">
                  <label class="form-label">Materia 1<span class="text-danger">*</span></label>
                  <select v-model="materias.id_materia1" name="id_materia1" required @change="ValidaSelect" class="form-select form-select-sm" aria-label="Default select example">
                    <option value="" selected>Seleccionar</option>
                    <option :value="item.id_materia" v-for="item in lista_materias">{{item.des_materia}}</option>
                  </select>
                </div>
                <div class="col-md-6 py-1">
                  <label class="form-label">Materia 2<span class="text-danger">*</span></label>
                  <select v-model="materias.id_materia2" name="id_materia2" required @change="ValidaSelect" class="form-select form-select-sm" aria-label="Default select example">
                    <option selected>Seleccionar</option>
                    <option value="" selected>Seleccionar</option>
                    <option :value="item.id_materia" v-for="item in lista_materias">{{item.des_materia}}</option>
                  </select>
                </div>
                <div class="col-md-6 py-1">
                  <label class="form-label">Materia 3<span class="text-danger">*</span></label>
                  <select v-model="materias.id_materia3" name="id_materia3" required @change="ValidaSelect" class="form-select form-select-sm" aria-label="Default select example">
                    <option selected>Seleccionar</option>
                    <option value="" selected>Seleccionar</option>
                    <option :value="item.id_materia" v-for="item in lista_materias">{{item.des_materia}}</option>
                  </select>
                </div>
                <div class="col-md-6 py-1">
                  <label class="form-label">Materia 4<span class="text-danger">*</span></label>
                  <select v-model="materias.id_materia4" name="id_materia4" required @change="ValidaSelect" class="form-select form-select-sm" aria-label="Default select example">
                    <option selected>Seleccionar</option>
                    <option value="" selected>Seleccionar</option>
                    <option :value="item.id_materia" v-for="item in lista_materias">{{item.des_materia}}</option>
                  </select>
                </div>
                <div class="col-md-6 py-1">
                  <label class="form-label">Materia 5<span class="text-danger">*</span></label>
                  <select v-model="materias.id_materia5" name="id_materia5" required @change="ValidaSelect" class="form-select form-select-sm" aria-label="Default select example">
                    <option selected>Seleccionar</option>
                    <option value="" selected>Seleccionar</option>
                    <option :value="item.id_materia" v-for="item in lista_materias">{{item.des_materia}}</option>
                  </select>
                </div>
                <div class="col-md-6 py-1">
                  <label class="form-label">Materia 6<span class="text-danger">*</span></label>
                  <select v-model="materias.id_materia6" name="id_materia6" required @change="ValidaSelect" class="form-select form-select-sm" aria-label="Default select example">
                    <option selected>Seleccionar</option>
                    <option value="" selected>Seleccionar</option>
                    <option :value="item.id_materia" v-for="item in lista_materias">{{item.des_materia}}</option>
                  </select>
                </div>
                <div class="col-md-6 py-1">
                  <label class="form-label">Materia 7<span class="text-danger">*</span></label>
                  <select v-model="materias.id_materia7" name="id_materia7" required @change="ValidaSelect" class="form-select form-select-sm" aria-label="Default select example">
                    <option selected>Seleccionar</option>
                    <option value="" selected>Seleccionar</option>
                    <option :value="item.id_materia" v-for="item in lista_materias">{{item.des_materia}}</option>
                  </select>
                </div>
                <div class="col-md-6 py-1">
                  <label class="form-label">Materia 8<span class="text-danger">*</span></label>
                  <select v-model="materias.id_materia8" name="id_materia8" required @change="ValidaSelect" class="form-select form-select-sm" aria-label="Default select example">
                    <option selected>Seleccionar</option>
                    <option value="" selected>Seleccionar</option>
                    <option :value="item.id_materia" v-for="item in lista_materias">{{item.des_materia}}</option>
                  </select>
                </div>
                <div class="col-md-6 py-1">
                  <label class="form-label">Materia 9<span class="text-danger">*</span></label>
                  <select v-model="materias.id_materia9" name="id_materia9" required @change="ValidaSelect" class="form-select form-select-sm" aria-label="Default select example">
                    <option selected>Seleccionar</option>
                    <option value="" selected>Seleccionar</option>
                    <option :value="item.id_materia" v-for="item in lista_materias">{{item.des_materia}}</option>
                  </select>
                </div>
                <div class="col-md-6 py-1">
                  <label class="form-label">Materia 10<span class="text-danger">*</span></label>
                  <select v-model="materias.id_materia10" name="id_materia10" required @change="ValidaSelect" class="form-select form-select-sm" aria-label="Default select example">
                    <option selected>Seleccionar</option>
                    <option value="" selected>Seleccionar</option>
                    <option :value="item.id_materia" v-for="item in lista_materias">{{item.des_materia}}</option>
                  </select>
                </div>
                <div class="col-md-6 py-1">
                  <label class="form-label">Materia 11<span class="text-danger">*</span></label>
                  <select v-model="materias.id_materia11" name="id_materia11" required @change="ValidaSelect" class="form-select form-select-sm" aria-label="Default select example">
                    <option selected>Seleccionar</option>
                    <option value="" selected>Seleccionar</option>
                    <option :value="item.id_materia" v-for="item in lista_materias">{{item.des_materia}}</option>
                  </select>
                </div>
                <div class="col-md-6 py-1">
                  <label class="form-label">Materia 12<span class="text-danger">*</span></label>
                  <select v-model="materias.id_materia12" name="id_materia12" required @change="ValidaSelect" class="form-select form-select-sm" aria-label="Default select example">
                    <option selected>Seleccionar</option>
                    <option value="" selected>Seleccionar</option>
                    <option :value="item.id_materia" v-for="item in lista_materias">{{item.des_materia}}</option>
                  </select>
                </div>
              </div>

              <div class="modal-footer mx-auto">
                <input type="hidden" name="ope" v-model="action">
                <button type="submit" class="btn btn-sm btn-primary" :disabled="id_periodo == '' ">
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
          estatus: "",
          id_periodo: "",
          materias:{
            id_materia1: "",
            id_materia2: "",
            id_materia3: "",
            id_materia4: "",
            id_materia5: "",
            id_materia6: "",
            id_materia7: "",
            id_materia8: "",
            id_materia9: "",
            id_materia10: "",
            id_materia11: "",
            id_materia12: "",
          },
          lista_materias: [],
          action: "Save",
        }
      },
      methods:{
        SendData(e){

          e.preventDefault();
          // if(!$("#Formulario").valid()) return false;
          let form = new FormData(e.target);

          fetch("./Controllers/PensumController.php",{
            method: "POST",
            body: form
          }).then( res => res.json()).then( result => {
            this.id = "";
            this.estatus = "";
            $("#datatable").DataTable().ajax.reload(null,false);
            this.ToggleModal();
            ViewAlert(result.mensaje, result.estado);
            this.periodo_activo();
          }).catch(Error => console.error(Error))
        },
        async GetData(id){
          await fetch(`./Controllers/PensumController.php?ope=ConsultOne&&id=${id}`)
          .then( res => res.json()).then( ({data}) => {
            this.id = data.id_materia;
            this.des_materia = data.des_materia;
            this.action = "Update";
          }).catch( error => console.error(error))
        },
        async ChangeState(id){
          this.id = id;
          this.action = "ChangeStatus";
          
          setTimeout( async () => {
            let form = new FormData(document.getElementById("Formulario"));
            await fetch(`./Controllers/PensumController.php`,{
              method: "POST",
              body: form
            }).then( res => res.json()).then( result => {
              ViewAlert(result.mensaje, result.estado);
              $("#datatable").DataTable().ajax.reload(null,false);
              this.action = "Save";
            }).catch( error => console.error(error))  
          }, 100);
        },
        ValidaSelect(e){
          let selects = [
            "id_materia1","id_materia2","id_materia3","id_materia4","id_materia5","id_materia6","id_materia7","id_materia8","id_materia9",
            "id_materia10","id_materia11","id_materia12"
          ];
          // Desactiva la opcion seleccionada en los demas selects
          selects.forEach( item => {
            if(item != e.target.name){
              document.getElementsByName(item)[0].childNodes.forEach( itemx => {
                if(itemx.value == e.target.value && itemx.disabled == false){
                  itemx.disabled = true;
                }
              })
            }
          })
          // Activa la opcion que no este dentro de mi lista de codigos
          setTimeout( ()=>{
            // Creamos un array para hacer la comparación de codigos mucho mas sencilla
            let codigos = selects.map( s => {
              if(this.materias[s] != '') return this.materias[s]; return '0'
            })
            // Recorremos nuestro array de los name's de los selects, a su vez recorremos los options de esos selects en busca de los options desactivados, para luego ver si estos esta incluidos en nuestra lista de comparación ya previamente creada
            selects.forEach( itemy => {
              document.getElementsByName(itemy)[0].childNodes.forEach( itemz => {
                if(itemz.disabled == true && codigos.includes(itemz.value) == false) itemz.disabled = false;
              })
            })
          }, 100)
        },
        async periodo_activo(){
          await fetch(`./Controllers/PeriodoController.php?ope=ConsultPeriodoActivo`)
          .then( res => res.json()).then( ({data}) => {
            if(data[0] != undefined){
              this.id_periodo = data.id_periodo_escolar;
              this.des_periodo = data.periodoescolar; 
            }else this.des_periodo = "No hay Periodo Escolar Activo";
          }).catch( Error => console.error(Error))
        },
        ToggleModal(){
          $("#staticBackdrop").modal("hide");
          $("body").removeClass("modal-open");
          $(".modal-backdrop").remove();
        },
        LimpiarForm(){
          this.id = "";
          this.des_materia = "";
          this.estatus = "";
          this.materias = {
            id_materia1: "",
            id_materia2: "",
            id_materia3: "",
            id_materia4: "",
            id_materia5: "",
            id_materia6: "",
            id_materia7: "",
            id_materia8: "",
            id_materia9: "",
            id_materia10: "",
            id_materia11: "",
            id_materia12: "",
          };
          this.action = "Save";
        },
        async GetMaterias(){
          let lista = await fetch('./Controllers/MateriasController.php?ope=ConsulAll')
          .then( res => res.json()).then( ({data}) => data).catch( error => console.error(error))
          this.lista_materias = lista.filter( item => item.estatus_materia == "1");
        }
      },
      async mounted(){
        await this.periodo_activo();
        await this.GetMaterias();
      }
    }).mount("#App_vue");

    const CambiarEstatus = (e) => {
      app.ChangeState(e.dataset.id)
    }

    const Consult = (e) => {
      app.GetData(e.dataset.id)
    }

    $("#datatable").DataTable({
      ajax:{
        url: "./Controllers/PensumController.php?ope=ConsulAll",
        dataSrc: "data"
      },
      columns:[
        { data: "id" },
        { data: "ano"},
        { data: "periodoescolar"},
        { data: "estatus_pensum",
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
                <button type="button" disabled='disabled' data-bs-toggle="modal" data-bs-target="#staticBackdrop" onClick="Consult(this)" data-id='${row.id}' class="btn btn-sm btn-info">
                  <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                      
                <button type="button" onClick="CambiarEstatus(this)" data-id='${row.id}' class="btn btn-sm btn-warning">
                  <i class="fa-regular fa-trash-can"></i>
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

  </script>

  <!-- <script src="./views/js/Seccion/index.js"></script> -->
</body>
</html>