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

            <div class="col-md-7">
              <h3 class="fw-bold text-success">Gestión de Pensum</h3>
            </div>
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
                <div class="col-6">
                  <label class="form-label">Periodo Escolar: </label>
                  <input type="text" minlength="1" maxlength="30" v-model="des_periodo" name="periodoescolar" class="form-control form-control-sm" required id="" readonly placeholder="Descripción del periodo">
                </div>

                <input type="hidden" name="id_materia[]" :value="e.id_materia" v-for="e in materias_select">
                
                <div class="col-md-6 py-1" v-for="(i, index) in materias_select">
                  <label class="form-label">Materia {{i.num}}<span class="text-danger">*</span></label>
                  <select :name="i.name_campo" value="" v-model="i.id_materia" required @change="ValidaSelect" class="form-select form-select-sm" aria-label="Default select example">
                    <option value="" selected>Seleccionar</option>
                    <option :value="item.id_materia" v-for="item in lista_materias">{{item.des_materia}}</option>
                  </select>
                </div>
              </div>

              <div class="modal-footer mx-auto">
                <input type="hidden" name="ope" v-model="action">
                <button type="button" @click="AgregarMaterias" v-if="materias_select.length < 12" class="btn btn-sm btn-success">Agregar</button>
                <button type="button" @click="QuitarMaterias" v-if="materias_select.length > 1" class="btn btn-sm btn-warning">Quitar</button>
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

      <!-- Modal -->
      <div class="modal fade" id="modal_consulta" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Consulta Pensum</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row ">
              <div class="col-md-6">
                <label class="form-label">Año del Pensum</label>
                <select disabled class="form-select form-select-sm" v-model="anio" required aria-label="Default select example">
                  <option value="" selected>Seleccionar</option>
                  <option value="1">1er Año</option>
                  <option value="2">2do Año</option>
                  <option value="3">3er Año</option>
                  <option value="4">4to Año</option>
                  <option value="5">5to Año</option>
                  <option value="6">6to Año</option>
                </select>
              </div>
              <div class="col-6">
                <label class="form-label">Periodo Escolar: </label>
                <input type="text" minlength="1" maxlength="30" v-model="periodo_escolar_consultado" name="periodoescolar" class="form-control form-control-sm" required id="" readonly placeholder="Descripción del periodo">
              </div>

              <div class="col-md-6 py-1" v-for="(i, index) in materias_select">
                <label class="form-label">Materia {{i.num}}<span class="text-danger">*</span></label>
                <select disabled v-model="i.id_materia" class="form-select form-select-sm" aria-label="Default select example">
                  <option value="" selected>Seleccionar</option>
                  <option :value="item.id_materia" v-for="item in lista_materias">{{item.des_materia}}</option>
                </select>
              </div>
            </div>

            <div class="modal-footer mx-auto">
              <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">
                <i class="fa-regular fa-circle-xmark"></i>SALIR
              </button>
            </div>
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
          periodo_escolar_consultado: "",
          estatus: "",
          id_periodo: "",
          materias_select:[
            {num: 1, id_materia: "", name_campo: `id_materia1`}
          ],
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
            this.LimpiarForm();
          }).catch(Error => console.error(Error))
        },
        async GetData(id){
          await fetch(`./Controllers/PensumController.php?ope=ConsultOne&&id=${id}`)
          .then( res => res.json()).then( ({data}) => {

            this.materias_select = [];
            this.anio = data.ano;
            this.periodo_escolar_consultado = data.periodoescolar;
            if(data.id_materia1) this.materias_select.push({num: 1, id_materia: data.id_materia1, name_campo: 'id_materia1'});
            if(data.id_materia2) this.materias_select.push({num: 2, id_materia: data.id_materia2, name_campo: 'id_materia2'});
            if(data.id_materia3) this.materias_select.push({num: 3, id_materia: data.id_materia3, name_campo: 'id_materia3'});
            if(data.id_materia4) this.materias_select.push({num: 4, id_materia: data.id_materia4, name_campo: 'id_materia4'});
            if(data.id_materia5) this.materias_select.push({num: 5, id_materia: data.id_materia5, name_campo: 'id_materia5'});
            if(data.id_materia6) this.materias_select.push({num: 6, id_materia: data.id_materia6, name_campo: 'id_materia6'});
            if(data.id_materia7) this.materias_select.push({num: 7, id_materia: data.id_materia7, name_campo: 'id_materia7'});
            if(data.id_materia8) this.materias_select.push({num: 8, id_materia: data.id_materia8, name_campo: 'id_materia8'});
            if(data.id_materia9) this.materias_select.push({num: 9, id_materia: data.id_materia9, name_campo: 'id_materia9'});
            if(data.id_materia10) this.materias_select.push({num: 10, id_materia: data.id_materia10, name_campo: 'id_materia10'});
            if(data.id_materia11) this.materias_select.push({num: 11, id_materia: data.id_materia11, name_campo: 'id_materia11'});
            if(data.id_materia12) this.materias_select.push({num: 12, id_materia: data.id_materia12, name_campo: 'id_materia12'});
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
        AgregarMaterias(){
          if(this.materias_select.length == 12){
            ViewAlert("Has alcanzado el limite maximo de materias!", "error");
            return false;
          }
          let numero = this.materias_select.length + 1;
          this.materias_select.push({num: numero, id_materia: "", name_campo: `id_materia${numero}`})
          setTimeout( () => { this.ValidaSelect({target:{name: `id_materia${numero}`, value: ''}}) },100)
        },
        QuitarMaterias(){
          if(this.materias_select.length == 1){
            ViewAlert("Has alcanzado el limite minimo de materias!", "error");
            return false;
          }
          let numero = this.materias_select.length - 1;
          this.materias_select.splice(numero)
        },
        ValidaSelect(e){

          if(e == 'false'){
            document.getElementsByName("id_materia1")[0].childNodes.forEach( item => item.disabled = false);
            return false;
          }

          let selects = this.materias_select.map( item => item.name_campo);
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
            let codigos = this.materias_select.map( s =>{ if(s.id_materia != '') return s.id_materia; else return '0';})
            // Recorremos nuestro array de los name's de los selects, a su vez recorremos los options de esos selects en busca de los options desactivados, para luego ver si estos esta incluidos en nuestra lista de comparación ya previamente creada
            selects.forEach( itemy => {
              document.getElementsByName(itemy)[0].childNodes.forEach( itemz => {
                // Si el elemento ya no esta en la lista de codigos y esta inactivo, activalo!
                if(itemz.disabled == true && codigos.includes(itemz.value) == false && itemz.value != '') itemz.disabled = false;
                // Si el elemento si esta en lista de codigos y esta activo, inactivalo (esto para cuando creamos nuevos elementos)
                if(codigos.includes(itemz.value) && itemz.disabled == false && e.target.name == itemy) itemz.disabled = true;
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
          this.anio = "";
          this.ValidaSelect('false');
          this.materias_select = [{num: 1, id_materia: "", name_campo: `id_materia1`}];
          this.estatus = "";
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

    const CambiarEstatus = (e) => app.ChangeState(e.dataset.id)
    const Consult = (e) => app.GetData(e.dataset.id)

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
            let classStatus = row.estatus_pensum == 1 ? 'success' : 'danger';
            let btns = `
              <div class="">
                <button type="button" data-bs-toggle="modal" data-bs-target="#modal_consulta" onClick="Consult(this)" data-id='${row.id}' class="btn btn-sm btn-info">
                  <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                      
                <button type="button" onClick="CambiarEstatus(this)" data-id='${row.id}' class="btn btn-sm btn-${classStatus}">
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

  </script>
</body>
</html>