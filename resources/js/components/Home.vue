<template>
      <div class="container">
     <div class="row">
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8 py-2">
                  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="box-shadow:3px 3px 30px black, 5px 5px 8px black">
                    <ol class="carousel-indicators">
                      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                      <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                      <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                      <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                      <li data-target="#carousel-example-generic" data-slide-to="4"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox" >
                        <div class="carousel-item" v-for="(item,index) in noticias" :key="index" :class="{ 'active': index === 0 }">
                            <img v-bind:src="'/imagenes/' + item.imagen"  alt="Fourth Slide" class="img-fluid"/>
                            <div class="carousel-caption" style="background:rgba(0,0,0,0.4)">
                            <h2 style="font-size:1.3vw;">{{item.nombre_noticia}}</h2>
                            <p class="text-warning font-weight-bold" >{{item.descripcion}}</p>
                            <button type="button" class="btn btn-primary btn-sm ">VER MAS</button>
                        </div>
                    </div>
                      
                  </div>

                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                      <span class="icon-prev" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>

                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                      <span class="icon-next" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>
                </div>
                  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 ml-md-auto py-2" style="text-align:center;">
                   <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FMunicipalidad-Distrital-de-Peren%25C3%25A9-2019-2022-1474164819303304&tabs=timeline&width=340&height=545&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=2134772420083393" width="340" height="545" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
              </div>
      </div>
    </div> 
</template>
  <script>
    export default {
      data(){
        return{
          noticias:[],
        }
      },
      created(){
        axios.get('/api/backindex').then(res=>{ this.noticias=res.data;
        })
      }
    }
</script>