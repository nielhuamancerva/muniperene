import Api from "./Api";

export default {

    login(form) {
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
  }
};