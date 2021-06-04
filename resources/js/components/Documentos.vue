<template>
    <div>
        <div class="row">
        <div class="col-md-8 mx-auto">
            <h3 class="text-center"> LISTA DE NORMATIVIDAD </h3>  
            <form class="form-inline" autocomplete="off">
                        <div class="form-group">
                                        <select class="form-control" id="exampleFormControlSelect1" placeholder="Buscar el N° Expediente" v-model="ano" @change="select_año" >
                                           <option disabled value="">Seleccione Año</option>
                                        <option v-for="year in years" :key="year.value">{{year.value}}</option>
                                        </select>
                        </div>
                        <div class="form-group">
                                        <select class="form-control" id="exampleFormControlSelect1" v-model="tipo_documento"  @change="select_documento">
                                        <option disabled value="">Seleccione Tipo de Documento</option>
                                        <option v-for="documento in cargar_select_documento" :key="documento.id">{{documento.documento}}</option>
                                        </select>
                        </div>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#CrearPersonas" @click.prevent="getNoticias">Buscar</button>  
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
            cargar_select_documento: [],   
            ano:'',
            tipo_documento:'',
            years: [{ value: '2021', text: '2021' },{value: '2020',text: '2020'},{value: '2019',text: '2019'},{value: '2018',text: '2018'}
            ,{value: '2017',text: '2017'},{value: '2016',text: '2016'},{value: '2015',text: '2015'},{value: '2014',text: '2014'},{value: '2013',text: '2013'}
            ,{value: '2012',text: '2012'},{value: '2011',text: '2011'}],
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

            axios.get('/api/normas?page='+page+'&ano='+this.ano+'&tipo_documento='+this.tipo_documento).then((res)=>{
                console.log(this.ano);
                 console.log(this.tipo_documento);
            this.documentos= res.data.documentos.data,
            this.paginate = res.data.paginate
        }).catch(function (error) {
                     alert('No se Realizo esta accion '+error);
        });
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
            window.open(`/api/download/${item.id}`);
        },

        buscarnormas(){
   
        }
     }
}
</script>