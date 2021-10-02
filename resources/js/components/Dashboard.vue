<template>
    <div>
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
        </div>
 
    </div>
</template>
<script>
import User from "../User";
export default {
    
    data(){
        return{
            user: {id:''},
            habilitar:{name:''},
            GAT:null,
             SGTI:null
        }
    },
    methods:{
    
        logout(){
            User.logout().then(()=>{
             localStorage.removeItem("token");
                this.$router.push({ path: "/login"});
            })
        },
        noticia(){
            this.$router.push({ path: "/noticias" })
        },
        normatividad(){
            this.$router.push({ path: "/normatividad" })
        },
        cas(){
            this.$router.push({ path: '/gestorcas' })
        },
        register(){
            this.$router.push({ path: '/register' })
        },
        gat(){
            this.$router.push({ path: '/gat' })
        }
    },
    
    mounted(){

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
              }
           
        })


    
      
    }
}
</script>