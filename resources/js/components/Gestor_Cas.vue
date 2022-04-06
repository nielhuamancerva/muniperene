<template>
    <div>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h3 class="text-center">GESTOR CONVOCATORIA CAS-2021 </h3>  
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" >Nuevo Publicacion CAS</button>  
                <button type="button" class="btn btn-danger" @click.prevent="dashboard">Atras</button>   
                    <form class="form-inline" autocomplete="off"></form> 
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
                        <td style="white-space:nowrap;">
                            <button class="btn btn-danger btn-xs" @click="descargar(item)"><i class="fas fa-file-download"></i></button>
                            <button class="btn btn-warning btn-xs" @click="editar(item)" data-toggle="modal" data-target="#exampleModal"><i class="far fa-edit"></i></button>
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
                                        <label for="recipient-name" class="col-form-label">Descripcion:</label>
                                        <input type="text" class="form-control" id="recipient-name" v-model="newcas.descripcion">
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Archivo:</label>
                                            <input v-show="false" id="boton-descarga" type="file" @change="select_file" >
                                            <input type="button" @click.prevent="clickbutton" value="Upload File">
                                            <span id="glosaArchivos">{{nombrefile}}</span>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" @click.prevent="crearcas">Guardar</button>
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
            cas: [],
            nombrefile:null,
            newcas: {id:'',descripcion:'',archivo:null},
            cargar_select_documento: [],   
            ano:'',
            tipo_documento:'',
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
        clickbutton(){
            $('#boton-descarga').click()
        },
        select_file(event){
          this.newcas.archivo=event.target.files[0];
           this.nombrefile=this.newcas.archivo.name;
        }, 
        getNoticias: function(page){
            axios.get('/api/cas?page='+page).then((res)=>{
                console.log(res);
            this.cas= res.data.cas.data,
            console.log(this.cas);
            this.paginate = res.data.paginate
        }).catch(function (error) {
                     alert('No hay ninguno registro '+error);
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
            this.page=page;
        },

        select_año(event){
        this.ano=event.target.value;
        }, 

        select_documento(event){
        this.tipo_documento=event.target.value;
        },

        editar(item){
            this.newcas.id=item.id;
            this.newcas.descripcion=item.descripcion;
            this.nombrefile=item.archivo;
        },
        
        closemodal(){
            this.newnormativad={id:'',descripcion:'',archivo:null},
            this.nombrefile='',
            this.selected='',
              $('#exampleModal').modal('hide');
        },

        descargar(item){
            window.open(`/api/downloads/${item.id}`);
        },

        buscarnormas(){
   
        },
        crearcas(){
            let newcas = new FormData();
                for(let key in this.newcas){ 
                    newcas.append(key, this.newcas[key]);
                }

            User.PostCas(newcas).then((res) =>{
                $('#exampleModal').modal('hide');

                if(this.newcas.id===''){
                    swal("Registro Exitoso!", this.newcas.descripcion, "success");
                    this.changePage(this.page);
                }
                else{
                    const index = this.cas.findIndex(item => item.id === this.newcas.id);
                    this.cas[index] = res.data;
                    swal("Se Actualizo el Registro!", this.newcas.descripcion, "success");
                }
                    this.selected='';
                    this.newcas= {id:'',descripcion:'',archivo:null};
                    this.nombrefile='';
                }).catch(function (error) {
                    swal("Registro no Se Completo!",error.response.data.message, "error");
             
                });  
        }
     }
}
</script>