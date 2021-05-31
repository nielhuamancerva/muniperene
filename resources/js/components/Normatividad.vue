<template>
    <div>
        <div class="row">
        <div class="col-md-8 mx-auto">
            <h3 class="text-center"> LISTA DE NORMATIVIDAD </h3>   
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" >Nuevo Persona</button>  
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Documento</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Archivo</th>
                        <th scope="col">operaciones</th>
                        </tr>
                    </thead>
                  
                    <tbody v-for="item in normatividad" :key="item.id">
                   
                        <tr>
                        <th scope="row">{{item.id}}</th>
                        <td>{{item.tipo_documento}} N°{{item.numero_documento}}-{{item.año_documento}}-{{item.siglas_documento}}</td>
                        <td>{{item.resumen_documento}}</td>
                        <td>{{item.archivo}}</td>                              
                        <td>
                             <button class="btn btn-warning btn-sm" @click="editar(item)" data-toggle="modal" data-target="#exampleModal">Editar</button>
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

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static" 
                data-keyboard="false">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Crear Normatividad</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click.prevent="closemodal">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form  @submit.prevent="editar">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Documento:</label>
                                        <input type="text" class="form-control" id="recipient-name" v-model="newnormativad.tipo_documento">
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Numero de Documento:</label>
                                        <input type="text" class="form-control" id="recipient-name" v-model="newnormativad.numero_documento">
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Año del Documento:</label>
                                        <input type="text" class="form-control" id="recipient-name" v-model="newnormativad.año_documento">
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Siglas del Documento:</label>
                                        <input type="text" class="form-control" id="recipient-name" v-model="newnormativad.siglas_documento">
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Resumen:</label>
                                        <input type="text" class="form-control" id="recipient-name" v-model="newnormativad.resumen_documento">
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Archivo:</label>
                                        <input type="text" class="form-control" id="recipient-name" v-model="newnormativad.archivo">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" @click.prevent="crearnormatividad">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            normatividad: [],
            newnormativad: {tipo_documento:'',numero_documento:'',año_documento:'',siglas_documento:'',resumen_documento:'',archivo:''},
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
        getNoticias: function(page){
            var urlNoticias = '/api/normatividad?page='+page;
            axios.get(urlNoticias).then((res)=>{
            this.normatividad= res.data.normatividad.data,
            this.paginate = res.data.paginate
        })
        },

        closemodal(){
             this.newnormativad={tipo_documento:'',numero_documento:'',año_documento:'',siglas_documento:'',resumen_documento:'',archivo:''},
              $('#exampleModal').modal('hide');
        },

        editar(item){
            this.newnormativad.tipo_documento=item.tipo_documento; 
            this.newnormativad.numero_documento=item.numero_documento; 
            this.newnormativad.año_documento=item.año_documento; 
            this.newnormativad.siglas_documento=item.siglas_documento; 
            this.newnormativad.resumen_documento=item.resumen_documento; 
            this.newnormativad.archivo=item.archivo; 
        },

        changePage: function(page){
            this.paginate.current_page = page;
            this.getNoticias(page);
        },

        crearnormatividad(){
                axios.post('/api/normatividad',this.newnormativad)
                .then((res) =>{
                $('#exampleModal').modal('hide');
                const normatividad1= res.data;
                this.normatividad.push(normatividad1);
                alert('Se Registro una nueva normatividad');
                this.newnormativad={tipo_documento:'',numero_documento:'',año_documento:'',siglas_documento:'',resumen_documento:'',archivo:''};
        })
        },
    }
}
</script>