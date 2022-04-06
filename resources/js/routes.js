import Home from './components/Home';
import About from './components/About';
import Register from './components/Register';
import Login from './components/Login';
import Users from './components/User';
import Dashboard from './components/Dashboard';
import NotFound from './components/NotFound';
import GestorNoticias from './components/GestorNoticias';
import NewNoticias from './components/NewNoticias';
import EditNoticias from './components/EditNoticias';
import Noticias from './components/Noticias';
import GestorNormas from './components/GestorNormas';
import GestorNormatividad from './components/GestorNormatividad';
import Normas from './components/Normas';
import Cas from './components/Cas';
import Gat from './components/GAT';
import GestoraCas from './components/Gestor_Cas';
import TramiteVirtual from './components/TramiteVirtual';
import GestorTramiteVirtual from './components/GestorTramiteVirtual';
import SeguimientoDocumentoVirtual from './components/BusquedaMesadePartesVirtual';
import HistoriaDistritodePerene from './components/HistoriaDistritodePerene';
import Router from 'vue-router';
import Vue from 'vue'

import User from "./User";
import { validate } from 'webpack/node_modules/schema-utils';

Vue.use(Router);




const router = new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [
  {path: '*', redirect: '/login'},
  {path: '/', component: Home},
  {path: '/about', component: About},
  {path: '/cas', component: Cas},
  {path: '/normas', component: Normas},
  {path: '/login', component: Login},
  {path: "/users",component: Users,name:"Users"},
  {path: '/gestorcas',component: GestoraCas},  
  {path: '/gat', component: Gat},
  {path: '/register',component: Register},
  {path: '/mesadepartesvirtual',component: TramiteVirtual},
  {path: "/gestordemesadepartesvirtual",component: GestorTramiteVirtual},
  {path: '/seguimientodocumento',component: SeguimientoDocumentoVirtual},
  {path: "/dashboard",component: Dashboard,name:"Dashboard"},
  {path: "/gestornoticias",component: GestorNoticias},
  {path: "/newnoticias",component: NewNoticias},
  {path: "/editnoticias",component: EditNoticias,name:"EditNoticias"},
  {path: "/noticias",component: Noticias},
  {path: "/gestornormas",component: GestorNormatividad},
  {path: "/HistoriaDistritodePerene",component: HistoriaDistritodePerene},
    ]
   
});



router.beforeEach((to, from, next) => {
 
  const publicPages = ['/noticias','/login','/cas','/normas','/about','/','/mesadepartesvirtual','/HistoriaDistritodePerene'];
  const authRequired = !publicPages.includes(to.path);
  console.log(authRequired);
  const loggedIn = localStorage.getItem('auth-token');

  if (authRequired && !loggedIn) {
    return next('/login');
  }
  else if(authRequired==true)
  {
    User.auth().then(response => {
    console.log("ready")
    }).catch(err => {
     
      console.log(err);
      localStorage.removeItem("auth-token");
      return next('/login');
    })
  }

  next();

});


export default router;