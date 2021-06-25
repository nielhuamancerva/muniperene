<template>
    <div>
        Dashboard <br>
        <div v-if="user">
        Name: {{user.name}} <br>
        Email: {{user.email}}<br><br>
       <button @click.prevent="logout">Logout</button>
        <button @click.prevent="noticia">Noticias</button>
        <button @click.prevent="normatividad">Normatividad</button>
        </div>
 
    </div>
</template>
<script>
import User from "../User";
export default {
    
    data(){
        return{
            user: null,
        }
    },
    methods:{
        logout(){
            User.logout().then(()=>{
             localStorage.removeItem("token");
                this.$router.push({ name: "Home"});
            })
        },
        noticia(){
            this.$router.push({ name: 'Noticias' })
        },
        normatividad(){
            this.$router.push({ name: 'Normatividad' })
        }
    },
    mounted(){

       User.auth().then((res)=>{
            this.user = res.data
        })
    }
}
</script>