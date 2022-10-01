<!DOCTYPE html>
<html lang="en">
<?php $this->Head(); ?>
<body>
  <div class="col-md-12" >
    <div class="row" id="App_vue">
      <!-- CONTENEDOR DE NAVBAR -->
      <?php $this->Navbar(); ?>
      <!-- CONTENEDOR DE TABLA Y BUSCADOR -->
      <div class="col-md-12">

        <div class="col-md-9 mx-auto " style="margin-top:5%;">

          <!-- input de busqueda -->
          <div class="col-md-12 row " style="margin: 0; padding: 0;">
            <div class="col-md-3" style="margin: 0; padding: 0;">
              <h6 class="fw-bold text-danger">Periodo: {{des_periodo}}</h6>
            </div>

            <div class="col-md-7">
              <h3 class="fw-bold text-success">Gestión de Profesores</h3>
            </div>
            <div class="col-md-2 justify-content-end" style="margin: 0; padding: 0;">
              <button type="button" class="btn btn-sm btn-primary" @click="LimpiarForm" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="margin-bottom: 10px;">
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
      <div class="modal modal-xl fade" id="staticBackdrop" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
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
                  <input type="text" v-bind:disabled="nacionalidad == '' " name="cedula" v-model="cedula" v-bind:maxlength="[ nacionalidad == 'V' ? 8: 6 ]" class="form-control form-control-sm" id="" required placeholder="Ingrese la cédula del profesor" :readonly="action == 'Asignar' " style="width:70%;">
                  <span class="error-text">Cedula incorrecta</span>
                </div> 

    
              </div>

              <div class="col-md-6 " style="margin:0; padding:5px;">

                <div class="input-group input-group-sm form-box" style="display:flex; flex-wrap: wrap;">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Nombres:</span>
                  <input type="text" name="nombre" v-model="nombre" maxlength="20" class="form-control form-control-sm" id="" required placeholder="Ingrese el nombre del profesor" :disabled="action == 'Asignar' " style="width:70%;">
                  <span class="error-text">Nombre no valido</span>
                </div> 

    
              </div>

              <div class="col-md-6 " style="margin:0; padding:5px;">

                <div class="input-group input-group-sm form-box" style="display:flex; flex-wrap: wrap;">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Apellidos:</span>
                  <input type="text" name="apellido" v-model="apellido" maxlength="20" class="form-control form-control-sm" id="" required placeholder="Ingrese el apellido del profesor" :disabled="action == 'Asignar' " style="width:70%;">
                  <span class="error-text">Apellido no valido</span>
                </div> 

              </div>

              <div class="col-md-6 " style="margin:0; padding:5px;" v-if="action != 'Asignar' ">

                <div class="input-group input-group-sm form-box" style="display:flex; flex-wrap: wrap;">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Fecha de Nacimiento:</span>
                  <input type="text" name="fecha_n_persona" v-model="fecha_n" class="form-control form-control-sm" id="" placeholder="dd/mm/aaaa" required style="width:50%;">
                  <span class="error-text">Formato o fecha inválida</span>
                </div> 

              </div>

              <div class="col-md-6 " style="margin:0; padding:5px;" v-if="action != 'Asignar' ">
                <div class="input-group input-group-sm form-box" style="display:flex; flex-wrap: wrap;">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Correo electronico:</span>
                  <input type="email" name="correo_persona" v-model="correo_persona" class="form-control form-control-sm" id="" required placeholder="Ingrese el correo electronico" style="width: 50%;">
                  <span class="error-text">Correo inválido</span>
                </div> 
              </div>
              <!-- <div class="col-md-2"></div> -->

              <div class="col-md-6" style="margin:0; padding:5px;" v-if="action != 'Asignar' ">
                <div class="input-group input-group-sm form-box" style="display:flex; flex-wrap: wrap;">
                  <span class="input-group-text" id="inputGroup-sizing-sm">Dirección:</span>
                  <input type="text" name="direccion" v-model="direccion" class="form-control form-control-sm" id="" placeholder="Ingrese la dirección" required style="width:70%;">
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

              <div v-if="action == 'Asignar' " class="row d-flex align-items-center" v-for="(item,index) in id_materia">
                <div class="col-md-6" style="margin:0; padding:5px;">
                  <div class="input-group input-group-sm form-box form-box-select" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Asignación: {{(index+1)}}</span>
                    <input type="text" min="1" v-model="seguimiento[index]" max="6" maxlength="1" minlength="1" name="seguimiento_profesor[]" class="form-control form-control-sm" id="" @keypress="consultarSecciones" :data-index="index" placeholder="Año" style="width: 10%">
                    <select name="id_seccion[]" @change="MateriaRepetida(index)" v-model="secciones[index]" id="" class="form-select" aria-label="Default select example" style="width: 10%">
                      <option value="" selected>Seleccione una opción</option>
                      <option :value="item.id_seccion" v-for="item in id_seccion[index]">{{item.id_seccion}}</option>
                    </select>
                    <span class="error-text">Selecciona año y sección</span>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="input-group input-group-sm form-box-select" style="display:flex; flex-wrap: wrap;">
                    <span class="input-group-text">Materia</span>
                    <select name="id_materia[]" @change="MateriaRepetida(index)" v-model="materias[index]" id="" class="form-select" aria-label="Default select example" style="width: 50%;">
                      <option value="" selected>Seleccione una opción</option>
                      <option :value="item.id_materia" v-for="item in id_materia[index]">{{item.des_materia}}</option>
                    </select>
                    <span class="error-text">Seleccione una materia</span>
                  </div>
                </div>
              </div>


              <div class="modal-footer mx-auto">
                <div class="btn-group" v-if="action == 'Asignar' ">
                  <button class="btn btn-sm btn-success" @click="MasAsignacion">
                    <i class="fas fa-plus"></i>
                  </button>
                  <button class="btn btn-sm btn-danger" @click="MenosAsignacion" v-if="id_materia.length > 1">
                    -
                  </button>
                </div>
                <input type="hidden" name="ope" v-model="action">
                <button type="submit" class="btn btn-sm btn-primary" id="btn-g">
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
      data(){
        return{
          des_periodo:"actual",
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
          id_seccion: [[{id_seccion: ''}]],
          id_materia: [{id_materia:""}],
          // Arrays para el formulario
          secciones: [],
          materias: [],
          // Filtros
          id_periodoFiltro: "",
          periodosFiltro:[],
          formulario_valido: false,
          bucle: 1,
          action: "Save",
        }
      },
      methods:{
        MasAsignacion(e){
          this.id_materia.push({id_materia:''})
          this.id_seccion.push([{id_seccion:''}])
          this.seguimiento.push('');
        },
        MenosAsignacion(){
          this.id_materia.pop()
          this.id_seccion.pop()
          this.seguimiento.pop()
          this.secciones.pop();
          this.materias.pop();
        },
        SendData(e){

          e.preventDefault();
          // if(!$("#Formulario").valid()) return false;
          let form = new FormData(e.target);
          if(!this.formulario_valido) return false;
                    
          fetch("./Controllers/ProfesorController.php",{
            method: "POST",
            body: form
          }).then( res => res.json()).then( result => {
            $("#datatable").DataTable().ajax.reload(null,false);
            this.ToggleModal();
            this.LimpiarForm();
            ViewAlert(result.mensaje, result.estado);
            this.periodo_activo();
          }).catch(Error =>{
            console.error(Error)
          })
        },
        async GetData(id){
          await fetch(`./Controllers/ProfesorController.php?ope=ConsultOne&&id=${id}`)
          .then( res => res.json()).then( ({data}) => {
            let profesor = data.profesor;
            this.nacionalidad = profesor.nacionalidad_persona;
            this.cedula = profesor.cedula_persona;
            this.nombre = profesor.nombre_persona;
            this.apellido = profesor.apellido_persona;
            this.fecha_n = moment(profesor.fecha_n_persona).format("D/MM/YYYY");
            this.correo_persona = profesor.correo_persona;
            this.direccion = profesor.direccion_persona;
            this.sexo = profesor.sexo_persona;
            
            if(data.Asignaciones[0] != undefined){
              
              data.Asignaciones.forEach( (item, index) =>{
                this.materias.push(item.id_materia);
                this.secciones.push(item.id_seccion);
                this.seguimiento.push(item.ano_seguimiento);

                let obj = {
                  key: item.ano_seguimiento,
                  target: { dataset:{ index: index } }
                }

                this.consultarSecciones(obj)
              })
            }
            this.action = "Update";
          }).catch( error => console.error(error))
        },
        async ChangeState(id){
          this.cedula = id;
          this.action = "ChangeStatus";
          this.nacionalidad = "V";
          
          setTimeout( async () => {
            let form = new FormData(document.getElementById("Formulario"));
            await fetch(`./Controllers/ProfesorController.php`,{
              method: "POST",
              body: form
            }).then( res => res.json()).then( result => {
              ViewAlert(result.mensaje, result.estado);
              $("#datatable").DataTable().ajax.url(`./Controllers/ProfesorController.php?ope=ConsulAll&&id_periodo=${this.id_periodo}`).load();
            }).catch( error => console.error(error))  
          }, 100);
        },
        async periodo_activo(){
          await fetch(`./Controllers/PeriodoController.php?ope=ConsulAll`)
          .then( res => res.json()).then( ({data}) => {
            if(data[0] != undefined) this.periodosFiltro = data; else this.periodosFiltro = [];
          }).catch( Error => console.error(Error))

          await fetch(`./Controllers/PeriodoController.php?ope=ConsultPeriodoActivo`)
          .then( res => res.json()).then( ({data}) => {
            if(data[0] != undefined){
              this.id_periodo = data.id_periodo_escolar;
              this.des_periodo = data.periodoescolar; 
            }else this.des_periodo = "No hay Periodo Escolar Activo";
          }).catch( Error => console.error(Error))
        },
        async Asignar(id){
          await this.GetData(id);
          setTimeout( () => this.action = "Asignar",100)
        },
        ToggleModal(){
          $("#staticBackdrop").modal("hide");
          $("body").removeClass("modal-open");
          $(".modal-backdrop").remove();
        },
        LimpiarForm(){
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
          this.id_seccion = [[{id_seccion: ''}]]
          this.id_materia = [{id_materia:""}]
          this.secciones = []
          this.materias = []
        },
        async consultarSecciones(e){
          let anio = e.key, index = e.target.dataset.index;          
          const res = await fetch(`./Controllers/SeccionController.php?ope=ConsultPorAnio&&anio=${anio}`)
          .then( res => res.json()).then( ({data}) =>{
            return data;
          }).catch(error => console.error(error));
          
          this.consultarMaterias(e)
          if(res[0] != undefined){
            this.id_seccion[index] = res;
          }else ViewAlert("No hay suficientes secciones registradas","error");

        },
        async consultarMaterias(e){
          let anio = e.key, index = e.target.dataset.index;
          
          const res = await fetch(`./Controllers/PensumController.php?ope=ConsultPorAnio&&anio=${anio}`)
          .then( res => res.json()).then( ({data}) =>{
            return data;
          }).catch(error => console.error(error));
          
          if(res[0] != undefined){
            let lista = res.filter( i =>{ if(i) return i; })
            this.id_materia[index] = lista; 
          }else ViewAlert("No existe pensum para el año solicitado","error");
        },
        async MateriaRepetida(index){
          
          if(!this.secciones[index] && !this.materias[index]) return false;
          const res = await fetch(`./Controllers/ProfesorController.php?ope=MateriasRepetidas&&cedula=${this.cedula}&&materia=${this.materias[index]}&&seccion=${this.secciones[index]}`)
          .then( res => res.json()).then( ({data}) => data)
          .catch( error => console.error(error));
          if(res[0]){
            this.MenosAsignacion();
            ViewAlert("La materia seleccionada ya esta asginada", "error");
          }
        },
        async GetPeriodoEscolar(){
          const res = await fetch(`./Controllers/PeriodoController.php?ope=ConsultPeriodoActivo`)
          .then( res => res.json()).then( ({data}) =>{
            return data;
          }).catch(error => console.error(error));
          this.id_periodo = res.id_periodo_escolar;
        }
      },
      computed:{
        ifPeriodo(){
          if(this.id_periodo == "") return true; return false;
        }
      },
      watch: {
        id_periodoFiltro(periodo){ 
          if(periodo != ''){
            $("#datatable").DataTable().ajax.url(`./Controllers/ProfesorController.php?ope=ConsulAll&&id_periodo=${periodo}`).load();
          }
        }
      },
      async mounted(){
        await this.periodo_activo();
        await this.GetPeriodoEscolar();
      }
    }).mount("#App_vue");

    const CambiarEstatus = (e) => app.ChangeState(e.dataset.id)
    const Asignar = (e) => app.Asignar(e.dataset.id)

    const Consult = (e) => {
      app.GetData(e.dataset.id)
    }
  
    $("#datatable").DataTable({
      ajax:{
        url: "./Controllers/ProfesorController.php?ope=ConsulAll",
        dataSrc: "data"
      },
      columns:[
        { data: "cedula_profesor",
          render: function(data,type, row){
            return `${row.nacionalidad_persona}-${data}`
          }
        },
        { data: "nombre_persona", 
          render: function(data, type, row){
            let nombres = `${row.nombre_persona} ${row.apellido_persona}`;
            return nombres;
          }
        },
        { data: "estatus_profesor", 
          render: function(data){
            return data == 1 ? "Activo" : "Inactivo";
          }
        },
        { defaultContent: '',
          render: function(data, type, row){
            
            let classStatus = row.estatus_profesor == 1 ? 'success' : 'danger';
            let btns = '';    
            if(row.estatus_asignacion == '1' && row.estatus_asignacion != undefined){
              btns = `
                <div class="">
                  <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onClick="Consult(this)" data-id='${row.cedula_profesor}' class="btn btn-sm btn-info">
                    <i class="fa-solid fa-magnifying-glass"></i>
                  </button>

                  <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onClick="Asignar(this)" data-id='${row.cedula_profesor}' class="btn btn-sm btn-info">
                    <i class="fa-regular fa-user"></i>
                  </button>
                  
                  <button type="button" onClick="CambiarEstatus(this)" data-id='${row.cedula_profesor}' class="btn btn-sm btn-${classStatus}">
                    <i class="fas fa-power-off"></i>
                  </button>
                </div>`;  
            }else{
              btns = `
              <div class="">
                <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onClick="Asignar(this)" data-id='${row.cedula_profesor}' class="btn btn-sm btn-info">
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
      language:{
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
    let fechaValida = false;
    let correoValida = false;
    let direccionValida = false;
    let seguimientoValida = false;
    let materiaValida = false;
    let seccionValida = false;
    let radioValida = false;

    document.querySelectorAll('.form-box').forEach((box) => {
      const boxInput = box.querySelector('input');
                      
      boxInput.addEventListener("keypress", (event) => {
        clearTimeout(tiempoFuera);
        tiempoFuera = setTimeout(() => {
          console.log(`input ${boxInput.name} value: `, boxInput.value)
          validacion(box, boxInput,null)
        });
      })
      radio.addEventListener('click', () => {
        validacion(box, 'sexo');
      })
      radio1.addEventListener('click', () => {
        validacion(box, 'sexo');
      })
      let button = document.querySelector('#btn-g');
      button.addEventListener('click', e =>{
        validacion(box, boxInput);
        let cedulaValida = false;
        let nombreValida = false;
        let apellidoValida = false;
        let fechaValida = false;
        let correoValida = false;
        let direccionValida = false;
        let seguimientoValida = false;
        let radioValida = false;
      });
      
      document.querySelectorAll('.form-box-select').forEach((box) => {
        const boxSelect = box.querySelector('select');
        boxSelect.addEventListener("click", (event) => {
          clearTimeout(tiempoFuera);
          tiempoFuera = setTimeout(() => {
            console.log(`select ${boxSelect.name} value: `, boxSelect.value)
              validarSelect(box, boxSelect, null)
            });
          })
          let button = document.querySelector('#btn-g');
          button.addEventListener('click', e =>{
            validarSelect(box, boxSelect)
            let materiaValida = false;
            let seccionValida = false;
          })
        });
      });

      function validarSelect(box, boxSelect){
        if (boxSelect.name == 'nacionalidad') {                        
            if(boxSelect.value == ""){
                mostrarError(true, box);
                nacionalidadValida = false;
            }
            else{
                console.log(box);
                mostrarError(false, box);
                nacionalidadValida = true;
            }
        }
        if (boxSelect.name == 'id_seccion') {                        
            if(boxSelect.value == ""){
                mostrarError(true, box);
                seccionValida = false;
            }
            else{
                console.log(box);
                mostrarError(false, box);
                seccionValida = true;
            }
        }
        if (boxSelect.name == 'id_materia') {                        
            if(boxSelect.value == ""){
                mostrarError(true, box);
                materiaValida = false;
            }
            else{
                console.log(box);
                mostrarError(false, box);
                materiaValida = true;
            }
        }
      }


      function validacion(box, boxInput){
        if(boxInput!= null && boxInput.name == "cedula"){
          if (boxInput.value.length < 7 || boxInput.value.length > 8) {
              console.error('Campo vacío o cédula inválida')
              mostrarError(true, box);
              cedulaValida = false;
          }
          else if (isNaN(boxInput.value)) {
              console.error(`${boxInput.value} no es un numero`);
              mostrarError(true, box);
              cedulaValida = false
          }
          else {
                mostrarError(false, box);
                cedulaValida = true;
          }
        }

        if(boxInput!= null && boxInput.name == "nombre"){
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
          console.log("validacion nombre")
          if (boxInput.value == '' || boxInput.value == ' ' || boxInput.value.length < 3 || contieneNumeros > 0 || contieneLetraEspecial > 0){
            mostrarError(true, box);
            nombreValida = false;
          }
          else{
            mostrarError(false, box);
            nombreValida = true;
          }
        }
        if(boxInput!= null && boxInput.name == "apellido"){
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
          console.log("validacion apellido")
          if (boxInput.value == '' || boxInput.value == ' ' || boxInput.value.length < 3 || contieneNumeros > 0 || contieneLetraEspecial > 0){
              mostrarError(true, box);
              apellidoValida = false;
          }
          else{
              mostrarError(false, box);
              apellidoValida = true;
          }
        }
        
        if(boxInput!= null & boxInput.name == "fecha_n_persona"){
          const DATE_REGEX = /^(0[1-9]|[1-2]\d|3[01])(\/)(0[1-9]|1[012])\2(\d{4})$/
          const CURRENT_YEAR = new Date().getFullYear();
            console.log('Validacion fecha de nacimiento')
            if(boxInput.value.length == 2) boxInput.value = boxInput.value+'/';
            if(boxInput.value.length == 5) boxInput.value = boxInput.value+'/';

            if (!boxInput.value.match(DATE_REGEX)) {
              mostrarError(true, box);
              fechaValida = false;
              return false
            }
            /* Comprobar los días del mes */
            const day = parseInt(boxInput.value.split('/')[0])
            const month = parseInt(boxInput.value.split('/')[1])
            const year = parseInt(boxInput.value.split('/')[2])
            const monthDays = new Date(year, month, 0).getDate()
            if (day > monthDays) {
              mostrarError(true, box);
              fechaValida = false;
              return false
            }
            
            /* Comprobar que el año no sea superior al actual*/
            if (year > CURRENT_YEAR) {
              mostrarError(true, box);
              fechaValida = false;
              return false
            }
            else{
              mostrarError(false, box);
              fechaValida = true;
              return true
            }
        }

        if(boxInput!= null && boxInput.name == "correo_persona"){
            console.log("validacion correo")
            if (emailRegex.test(boxInput.value)){
                console.log("validacion lugar nacimiento");
                mostrarError(false, box);
                correoValida = true;
            }
            else{
                mostrarError(true, box);
                correoValida = false;
            }
        }
        if(boxInput!= null && boxInput.name == "direccion"){
            console.log("validacion direccion")
            if (boxInput.value.length < 3 || boxInput.value == "" || boxInput.value == null){
                mostrarError(true, box);
                direccionValida = false;
            }
            else{
                mostrarError(false, box);
                direccionValida = true;
            }
          }

        if(boxInput!= null && boxInput.name == "seguimiento_profesor"){
            console.log("validacion seguimiento")
            if (boxInput.value > 6 || boxInput.value < 1){
                mostrarError(true, box);
                seguimientoValida = false;
            }
            else{
                mostrarError(false, box);
                seguimientoValida = true;
            }
          }
        let button = document.querySelector('#btn-g');

        if(radio.checked || radio1.checked){
            radioValida = true;
        }
      // seguimientoValida && && seccionValida

        if(app.action == "Asignar"){
          let materias = true, secciones = true;
          app.id_materia.forEach( item => { if(item.id == '') materias = false; })
          app.id_seccion.forEach( item => { if(item == '') secciones = false; })

          if(app.seguimiento != '' && materias && secciones) app.formulario_valido = true; else{
            app.formulario_valido = false;
            alert("Debes de llenar todos los datos faltantes (secciones y materias)");
          }
          return false;
        }

        if(cedulaValida && nombreValida && apellidoValida && correoValida && fechaValida && direccionValida && nacionalidadValida && radioValida){
          app.formulario_valido = true;
        }else app.formulario_valido = false;
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

  <!-- <script src="./views/js/Seccion/index.js"></script> -->
</body>
</html>