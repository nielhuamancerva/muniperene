<template>
    <div>
        <div class="row">
        <div class="col-md-8 mx-auto">
            <h3 class="text-center"> LISTA DE NORMATIVIDAD </h3>   
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" >Nuevo Normatividad</button>  
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
                                        <label for="exampleFormControlSelect1">Tipo de Documento</label>
                                        <select class="form-control" id="exampleFormControlSelect1" v-model="newnormativad.tipo_documento"  @change="select_documento">
                                        <option v-for="documento in documentos" :key="documento.id">{{documento.documento}}</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Numero de Documento:</label>
                                        <input type="text" class="form-control" id="recipient-name" v-model="newnormativad.numero_documento">
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Año del Documento:</label>
                                        <select class="form-control" id="exampleFormControlSelect1" v-model="newnormativad.año_documento"  @change="select_año">
                                        <option v-for="year in years" :key="year.value">{{year.value}}</option>
                                        </select>
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
                                            <input v-show="false" id="boton-descarga" type="file" @change="select_file" >
                                            <input type="button" @click.prevent="clickbutton" value="Upload File">
                                            <span id="glosaArchivos">{{nombre}}</span>
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
            selected:{},
            years: [{ value: '2021', text: '2021' },{value: '2020',text: '2020'},{value: '2019',text: '2019'},{value: '2018',text: '2018'}
            ,{value: '2017',text: '2017'},{value: '2016',text: '2016'},{value: '2015',text: '2015'},{value: '2014',text: '2014'},{value: '2013',text: '2013'}
            ,{value: '2012',text: '2012'},{value: '2011',text: '2011'}],
            normatividad: [],
            documentos: [],
            nombre:null,
            newnormativad: {id:'',tipo_documento:'',numero_documento:'',año_documento:'',siglas_documento:'',resumen_documento:'',archivo:null},
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
            var urlNoticias = '/api/normatividad?page='+page;
            axios.get(urlNoticias).then((res)=>{
            this.normatividad= res.data.normatividad.data,
            this.paginate = res.data.paginate
        })
        },

        getDocumentos(){
            axios.get('/api/tipodocumentos').then(res=>{
            this.documentos = res.data
        })
        },

        select_documento(event){
        this.newnormativad.tipo_documento=event.target.value;
        },

        clickbutton(){
        $('#boton-descarga').click()
        },
        select_file(event){
          this.newnormativad.archivo=event.target.files[0];
           this.nombre=this.newnormativad.archivo.name;
        }, 

        select_año(event){
          this.newnormativad.año_documento=event.target.value;
        }, 

        closemodal(){
             this.newnormativad={id:'',tipo_documento:'',numero_documento:'',año_documento:'',siglas_documento:'',resumen_documento:'',archivo:null},
               this.selected='',
              $('#exampleModal').modal('hide');
        },

        editar(item){
            this.newnormativad.id=item.id;
            this.newnormativad.tipo_documento=item.tipo_documento;
            this.newnormativad.numero_documento=item.numero_documento; 
            this.newnormativad.año_documento=item.año_documento; 
            this.newnormativad.siglas_documento=item.siglas_documento; 
            this.newnormativad.resumen_documento=item.resumen_documento; 
        },

        changePage: function(page){
            this.paginate.current_page = page;
            this.getNoticias(page);
        },

        crearnormatividad(){
                let newnormativad = new FormData();
                    for(let key in this.newnormativad){ 
                        newnormativad.append(key, this.newnormativad[key]);
                    }
                axios.post('/api/normatividad',newnormativad)
                .then((res) =>{
                $('#exampleModal').modal('hide');

            if(this.newnormativad.id===''){
                const normatividad1= res.data;
                this.normatividad.push(normatividad1);
                alert('Se Registro una nueva normatividad');
            }
            else{
                const index = this.normatividad.findIndex(item => item.id === this.newnormativad.id);
                this.normatividad[index] = res.data;
                alert('Se Actualizo una nueva normatividad');
            }
                this.selected='';
                this.newnormativad={id:'',tipo_documento:'',numero_documento:'',año_documento:'',siglas_documento:'',resumen_documento:'',archivo:null};
                this.nombre='';
                }).catch(function (error) {
                     alert('El Archivo ya esta Registro; Cambialo');
        });  
        },
    }
}
</script>