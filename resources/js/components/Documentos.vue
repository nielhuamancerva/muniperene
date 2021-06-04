<template>
    <div>
        <div class="row">
        <div class="col-md-8 mx-auto">
            <h3 class="text-center"> LISTA DE NORMATIVIDAD </h3>  
            <form class="form-inline" autocomplete="off" @click.prevent="getNoticias">
          
             <div class="form-group row">
                    <div class="col-md-6">
                        <input class="form-control border-dark" type="search" placeholder="Buscar el N° Expediente" aria-label="Search" v-model="pages.buscador">
                    </div>
            </div>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#CrearPersonas" >Nuevo Persona</button>  
              </form> 
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Documento</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Archivo</th>
                        </tr>
                    </thead>
                  
                    <tbody v-for="item in documentos" :key="item.id">
                   
                        <tr>
                        <th scope="row">{{item.id}}</th>
                        <td>{{item.tipo_documento}} N°{{item.numero_documento}}-{{item.año_documento}}-{{item.siglas_documento}}</td>
                        <td>{{item.resumen_documento}}</td>               
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
            documentos: [],   
            pages:{page:'',buscador:''},
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
        getNoticias: function(){
              
            axios.post('/api/normas',this.pages).then((res)=>{
            this.documentos= res.data.documentos.data,
            this.paginate = res.data.paginate
        })
        },

           changePage: function(page){
            this.paginate.current_page = page;
             this.pages={page:page,buscador:this.pages.buscador}
            this.getNoticias(this.pages);
        },


        editar(item){
            window.open(`/api/download/${item.id}`);
        },

        buscarnormas(){

            console.log('niel');
          this.getNoticias();
        }
     }
}
</script>