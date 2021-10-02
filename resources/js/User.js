import Api from "./Api";

export default {

    login(form) {
      console.log(form);
        return Api().post("/login", form);
      },

  logout() {
    return Api().post("/logout");
  },

  auth() {
    return Api().get("/user");
  },

  getNoticias(page){
    return Api().get('/normatividad?page='+page);
  },
  getGat(){
    return Api().get('/gat');
  },
  Normatividad(){
    return Api().get('/normatividad?page=');
  },

  botones(id){

    return Api().post("/botones", id);
  }





};