<template>
    <div>
        <div class="container">
            <div class="col-md-12">
                <h2 class="text-center bg-dark text-white">Noticias del Distrito de Perené</h2>
            </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-warning ">
                    <div class="panel-body">
                        <div class="row">
                                <div class="row bg-white col-sm-12 p-3 border p-0 m-0" v-for="(item,index) in noticias" :key="index"> 
                                    <div class="col-sm-2 p-0"> 
                                        <img v-bind:src="'/imagenes/' + item.imagen" class="img-thumbnail" alt="Cinque Terre">
                                    </div>
                                    <div class="col-sm-10 p-0"> 
                                        <h5 class="text-uppercase text-primary">{{item.nombre_noticia}}</h5>
                                        <p class="p-0 m-0">{{item.descripcion}}</p>
                                        <button type="button" class="btn btn-primary btn-sm ">VER MAS</button>
                                    </div>
                                </div>
                        </div>
                    </div>
            </div>
            </div>
        </div>
    </div>
    </div>
</template>
<script>
import User from '../User';
export default {
    data(){
        return{
            noticias: [],
            offset:3,
            paginate:{
            'total':0,
            'current_page':0,
            'per_page':0,
            'last_page':0,
            'from':0,
            'to':0}
        }
      
    },
    computed:{
        isActived:function(){
            return this.paginate.current_page;
        },
        pagesNumber:function(){
            if(!this.paginate.to){
                return [];
            }
            var from= this.paginate.current_page - this.offset;
            if(from < 1){
                from = 1;
            }

            var to = from + (this.offset*2);
            if (to >= this.paginate.last_page)
            {
                to = this.paginate.last_page;
            }

            var pagesArray = [];
            while(from <= to){
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    }
    ,
    mounted(){
       this.getNoticias();
        

    },
    methods:{
         getNoticias (page){
            axios.get('/api/backindex').then((res)=>{
                console.log(res);
            this.noticias= res.data,
            this.paginate = res.data.paginate
        })
        },
        newnoticia(){
            this.$router.push({ path: '/newnoticias' })
        },
        dashboard(){
               this.$router.push({path: '/dashboard'})

        },
        editar(item){
            const params = {id: item.id, nombre_noticia: item.nombre_noticia,descripcion: item.descripcion, imagen:item.imagen};
            this.$router.push({ name: 'EditNoticias',params})
        },

        changePage: function(page){
            this.paginate.current_page = page;
            this.getNoticias(page);
        }
    }
}
</script>