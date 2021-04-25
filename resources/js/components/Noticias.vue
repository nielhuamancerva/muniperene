<template>
    <div>
        <div class="row">
        <div class="col-md-5 mx-auto">
            <h3 class="text-center"> LISTA DE NOTICIAS </h3>   
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#CrearPersonas" @click.prevent="newnoticia">Nuevo Persona</button>  
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descipcion</th>
                          <th scope="col">Imagen</th>
                        <th scope="col">operaciones</th>
                        </tr>
                    </thead>
                  
                    <tbody v-for="(item,index) in noticias" :key="index">
                        <tr>
                        <th scope="row">{{item.id}}</th>
                        <td>{{item.nombre_noticia}}</td>
                        <td>{{item.descripcion}}</td>
                         <td>{{item.imagen}}</td>                              
                        <td>
                             <button class="btn btn-warning btn-sm" @click="editar(item)">Editar</button>
                        </td>
                        </tr>
           
                    </tbody>
                </table>
        </div>
    </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            noticias: null

        }
    },
    methods:{
            newnoticia(){
            this.$router.push({ path: '/newnoticias' })
        },
        editar(item){
            const params = {id: item.id, nombre_noticia: item.nombre_noticia,descripcion: item.descripcion, imagen:item.imagen};
            this.$router.push({ name: 'EditNoticias',params})
        }
    },
    mounted(){
        axios.get('/api/noticias').then((res)=>{
            this.noticias= res.data
        })
    }
}
</script>