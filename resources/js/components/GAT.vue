  
<template>
    <div class="absolute inset-0 bg-gray-200 flex items-center justify-center">
       <div class="text-3xl text-center text-gray-700">Page Not Found eres: {{this.gat}} <br>404 ERROR!</div>
    </div>
</template>
<script>
import User from '../User';
export default {
   data(){
        return{
            gat: []

        }
    },
    computed:{

    }
    ,
    mounted(){
       this.getNoticias();

    },
    methods:{
        getNoticias (page){
            User.getGat().then((res)=>{
                this.gat=res.data.GAT;
           console.log(res.data.GAT);
        })
        }
     }
}
</script>