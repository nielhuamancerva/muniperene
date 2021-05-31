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
                  
                    <tbody v-for="item in noticias" :key="item.id">
                   
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
        getNoticias: function(page){
            var urlNoticias = '/api/noticias?page='+page;
            axios.get(urlNoticias).then((res)=>{
            this.noticias= res.data.noticias.data,
            this.paginate = res.data.paginate
        })
        },
        newnoticia(){
            this.$router.push({ path: '/newnoticias' })
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