<template>
  <div>
    <form @submit.prevent="editar">
   <h3 class="text-center"> Editar NOTICIAS </h3>  
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
                <input v-show="false" id="boton-descarga" type="file" @change="select_file" novalidate>
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
    this.noticia.id=this.$route.params.id; 
     this.noticia.nombre_noticia=this.$route.params.nombre_noticia; 
    this.noticia.descripcion=this.$route.params.descripcion; 
    this.nombre=this.$route.params.imagen;
  },
  methods:{
clickbutton()
    {
      $('#boton-descarga').click()
    }
    ,
    select_file(event){
      this.noticia.thumbnail=event.target.files[0];
      this.nombre=this.noticia.thumbnail.name;
    }, 
    atras(){
      this.$router.push({path: '/gestornoticias'})
    },
    editar(){
      if(this.noticia.nombre_noticia.trim() === '' || this.noticia.descripcion.trim() === ''){
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