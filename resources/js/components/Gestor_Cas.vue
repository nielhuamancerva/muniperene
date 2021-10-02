<template>
    <div>
        <div class="row">
        <div class="col-md-6 mx-auto">
            <h3 class="text-center"> CONVOCATORIA CAS-2021 </h3>  
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" >Nuevo Publicacion CAS</button>  
            <button type="button" class="btn btn-danger" @click.prevent="dashboard">Atras</button>   
            <form class="form-inline" autocomplete="off">
                
              </form> 
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Descargas</th>
                         <th scope="col">Accion</th>
                        </tr>
                    </thead>
                  
                    <tbody v-for="(item, index) in cas" :key="item.id">
                   
                        <tr>
                        <th scope="row">{{index+paginate.current_page*paginate.per_page-(paginate.per_page-1)}}</th>
                        <td>{{item.descripcion}} </td>
                        <td>{{item.archivo}}</td>               
                        <td>
                             <button class="btn btn-danger" @click="editar(item)"><i class="fas fa-check" ></i>download</button>
                            
                        </td>
                        </tr>
           
                    </tbody>
                </table>

                <nav>
                        <ul class="pagination" aria-label="Page navigation example">
                            <li class="page-item" v-if="paginate.current_page > 1">
                                <a href="#" class="page-link" @click.prevent="changePage(paginate.current_page - 1)">
                                    <span>Atras</span>
                                </a>
                            </li>

                            <li class="page-item" v-for="page in pagesNumber" :key="page.id" v-bind:class="[ page == isActived ? 'active' : '']">
                                <a href="#" class="page-link" @click.prevent="changePage(page)">
                                    {{ page }}
                                </a>
                            </li>

                            <li class="page-item" v-if="paginate.current_page < paginate.last_page">
                                <a href="#" class="page-link" @click.prevent="changePage(paginate.current_page + 1)">
                                    <span>Siguiente</span>
                                </a>
                            </li>
                        </ul>
                    </nav>

            </div>
        </div>

              
    </div>
</template>
<script>
export default {
   data(){
        return{
            cas: [],
            cargar_select_documento: [],   
            ano:'',
            tipo_documento:'',
            year: [],
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
        this.getDocumentos();
    },
    methods:{
        getNoticias: function(page){
            axios.get('/api/cas?page='+page).then((res)=>{
                console.log(res);
                 console.log(this.tipo_documento);
            this.cas= res.data.cas,
            this.year= res.data.year,
            this.paginate = res.data.paginate
        }).catch(function (error) {
                     alert('No se Realizo esta accion '+error);
        });
        },
        dashboard(){
            this.$router.push({path: '/dashboard'})

        },
        getDocumentos(){
            axios.get('/api/tipodocumentos').then(res=>{
            this.cargar_select_documento = res.data
        })
        },

        changePage: function(page){
            this.paginate.current_page = page;
            this.getNoticias(page);
        },

        select_año(event){
        this.ano=event.target.value;
        }, 

        select_documento(event){
        this.tipo_documento=event.target.value;
        },

        editar(item){
            window.open(`/api/downloads/${item.id}`);
        },

        buscarnormas(){
   
        }
     }
}
</script>