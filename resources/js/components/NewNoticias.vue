<template>
   <div class="row justify-content-center">
<div class="col-md-8">
<div class="card">
  
  <div class="card-header text-center bg-dark text-white">NUEVAS NOTICIAS</div>
     <div class="card-body">
      <form @submit.prevent="agregar">
       
       
          <div class="form-group row">
                  <label for="name" class="col-md-4 col-form-label text-md-right" >Nombre Noticia </label>
                  <div class="col-md-6">
                      <input id="name" type="text" class="form-control" required placeholder="Nombre de la noticia" v-model="noticia.nombre_noticia" maxlength="254">
                  </div>
          </div>

          <div class="form-group row">
              <label for="name" class="col-md-4 col-form-label text-md-right">Descripcion</label>
              <div class="col-md-6">
                  <input id="username" type="text" class="form-control" required placeholder="Descripción de la noticia" v-model="noticia.descripcion" maxlength="254">
              </div>
          </div>

          <div class="form-group row">
              <label class="col-md-4 col-form-label text-md-right">Imagen</label>
              <div class="col-md-6 md-4">
                  <input v-show="false" id="boton-descarga" type="file" @change="select_file" >
                  <input type="button" @click.prevent="clickbutton" value="Upload File">
                  <span id="glosaArchivos">{{nombre}}</span>
              </div>
            </div>

          <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-danger" @click.prevent="atras">Atras</button>  
              </div>
             
          </div>
      </form>
    </div>
  </div>
 </div>
 </div>
</template>

<script>
import User from '../User';
export default {
  data() {
    return {
      noticias: [],
      name:null,
      noticia: {id:'',nombre_noticia:'',descripcion: '', thumbnail:null},
      nombre:null
    }
  },
  created(){
      
  },
  methods:{
clickbutton(){
      $('#boton-descarga').click()
    },
      select_file(event){
          this.noticia.thumbnail=event.target.files[0];
          this.nombre=this.noticia.thumbnail.name;
      },
    atras(){
               this.$router.push({path: '/gestornoticias'})
        },
    agregar(){
      if(this.noticia.nombre_noticia.trim() === '' || this.noticia.descripcion.trim() === '' || this.noticia.thumbnail === null){
        alert('Debes completar todos los campos antes de guardar');
        return;
      }
      let noticia = new FormData();
      for(let key in this.noticia){ 
          noticia.append(key, this.noticia[key]);
      }
  
      User.PostNoticias(noticia).then((res) =>{
            this.$router.push({ path: '/gestornoticias' });
            console.log(res);
              swal("Registro Exitoso de la Noticia!",res.data.descripcion+'con imagen : '+res.data.imagen, "success");
        }).catch(function (error) {
            swal("Registro no Se Completo!", error.response.data.message, "error");
             
             
        });
    }
  
  }
}
</script>