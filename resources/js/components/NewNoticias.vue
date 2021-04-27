<template>
  <div>
    <form @submit.prevent="agregar">
   <h3 class="text-center"> NUEVAS NOTICIAS </h3>  
    <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right" >Nombre Noticia </label>
            <div class="col-md-6">
                <input id="name" type="text" class="form-control" required placeholder="Nombre de la noticia" v-model="noticia.nombre_noticia">
            </div>
    </div>

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Descripcion</label>
            <div class="col-md-6">
                <input id="username" type="text" class="form-control" required placeholder="Descripción de la noticia" v-model="noticia.descripcion">
            </div>
        </div>

         <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Imagen</label>
            <div class="col-md-6">
                <input v-show="false" id="boton-descarga" type="file" @change="select_file" required>
                <input type="button" @click.prevent="clickbutton" value="Upload File">
                 <span id="glosaArchivos">{{}}</span>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      noticias: [],
      name:null,
      noticia: {id:'',nombre_noticia:'',descripcion: '', thumbnail:null},
    }
  },
  created(){
      
  },
  methods:{
clickbutton()
    {
      $('#boton-descarga').click()
    }
    ,
      select_file(event){
          this.noticia.thumbnail=event.target.files[0];
         
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
  
      axios.post('/api/noticias', noticia)
        .then((res) =>{
    
            this.$router.push({ path: '/noticias' })
        })
    }
  
  }
}
</script>