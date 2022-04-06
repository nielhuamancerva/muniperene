<template>
    <div class="page-loader">
        Dashboard <br>
        <div v-if="user">
        Name: {{user.name}} <br>
        Email: {{user.email}}<br><br>
        <button @click.prevent="logout">Logout</button>
        <button v-if="ADMIN || SGTI" @click.prevent="register">User</button>
        <button v-if="SGTI" @click.prevent="cas">CAS</button>
        <button v-if="SGTI" @click.prevent="noticia">Noticias</button>
        <button v-if="SGTI" @click.prevent="normatividad">Normatividad</button>
        <button v-if="GAT || SGTI" @click.prevent="gat">GAT</button>
        <button v-if="GDE || SGTI" @click.prevent="gde">GDE</button>
        <button v-if="GAF || SGTI" @click.prevent="gaf">GAF</button>
        <button v-if="GEPPI || SGTI" @click.prevent="geppi">GEPPI</button>
        <button v-if="GPSDH || SGTI" @click.prevent="gpsdh">GPSDH</button>
        <button v-if="GIDUR || SGTI" @click.prevent="gidur">GIDUR</button>
          <button v-if="TRAMITE || SGTI" @click.prevent="tramitevirtual">TRAMITE</button>
        </div>
 
    </div>
</template>
<script>
import User from "../User";
export default {
    
    data(){
        return{
            user: {id:'',name:'',email: '', role:''},
            habilitar:{name:''},
            GAT:null,
             SGTI:null,
                GDE:null,
               GAF:null,
               GEPPI:null,
               GPSDH:null,
               GIDUR:null,
               ADMIN:null,
                TRAMITE:null
        }
    },
     created(){
    // this.user.id=this.$route.params.id; 
    // this.user.name=this.$route.params.name; 
    // this.user.email=this.$route.params.email; 
    // this.user.role=this.$route.params.role; 
  
    
    //        switch( this.user.role) {
    //             case 'ROLE_SGTI': return this.SGTI = this.user.role;
    //             case 'ROLE_GAT': return  this.GAT = this.user.role;
    //             case 'ROLE_GPSDH': return  this.GPSDH = this.user.role;
    //             case 'ROLE_GIDUR': return  this.GIDUR = this.user.role;
    //             case 'ROLE_GDE': return  this.GDE = this.user.role;
    //             case 'ROLE_GAF': return  this.GAF = this.user.role;
    //             case 'ROLE_GEPPI': return  this.GEPPI = this.user.role;
    //             case 'ROLE_ADMIN': return  this.ADMIN = this.user.role;
    //           }
         },
    methods:{
        dashboard(){
            User.auth().then((res)=>{
        this.user = res.data;
           switch(res.data.role) {
                case 'ROLE_SGTI': return this.SGTI = res.data.role;
                case 'ROLE_GAT': return  this.GAT = res.data.role;
                case 'ROLE_GPSDH': return  this.GPSDH = res.data.role;
                case 'ROLE_GIDUR': return  this.GIDUR = res.data.role;
                case 'ROLE_GDE': return  this.GDE = res.data.role;
                case 'ROLE_GAF': return  this.GAF = res.data.role;
                case 'ROLE_GEPPI': return  this.GEPPI = res.data.role;
                case 'ROLE_ADMIN': return  this.ADMIN = res.data.role;
                case 'ROLE_TRAMITE': return  this.TRAMITE = res.data.role;
              }
           
        })   
        },
    
        logout(){
            User.logout().then(()=>{
             localStorage.removeItem("auth-token");
                this.$router.push({ path: "/login"});
            })
        },
        noticia(){
            this.$router.push({ path: "/gestornoticias" })
        },
        normatividad(){
            this.$router.push({ path: "/gestornormas" })
        },
        cas(){
            this.$router.push({ path: '/gestorcas' })
        },
        register(){
            this.$router.push({ path: '/users' })
        },
        gat(){
            this.$router.push({ path: '/gat' })
        },
        tramitevirtual(){
            this.$router.push({ path: '/gestordemesadepartesvirtual' })
        }
    },
    
    mounted(){
                 this.dashboard();
    }
}
</script>
