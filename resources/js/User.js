import Api from "./Api";

export default {

login(form) {
        return Api().post("/login", form);
  },

register(form) {
        //return Api().post("/register", form);
        return Api().post("/users", form); 
  },

logout() {
    localStorage.removeItem("auth-token");
    return Api().post("/logout");
  },

auth() {
    return Api().get("/user");
  },

GetUserAll(page){
    return Api().get('/users?page='+page);
  },
GetByIdUser(iduser){
  return Api().get('/users/'+iduser);
},
UpdateUser(iduser){
  return Api().patch('/users/'+iduser.id,iduser);
},

GetNoticias(page){
    return Api().get('/noticias?page='+page);
  },

PostNoticias(noticia){
    return Api().post('/noticias', noticia);
  },

getGat(){
    return Api().get('/gat');
  },

Normatividad(){
    return Api().get('/normatividad?page=');
  },

getNormatividad(page){
    return Api().get('/normatividad?page='+page);
  },

PostNormatividad(normatividad){
    return Api().post('/normatividad',normatividad);
  },

PostCas(datacas){
    return Api().post('/gestorcas',datacas);
  },

botones(id){
    return Api().post("/botones", id);
  }





};