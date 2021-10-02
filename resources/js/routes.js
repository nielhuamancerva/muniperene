import Home from './components/Home';
import About from './components/About';
import Register from './components/Register';
import Login from './components/Login';
import Dashboard from './components/Dashboard';
import NotFound from './components/NotFound';
import Noticias from './components/Noticias';
import NewNoticias from './components/NewNoticias';
import EditNoticias from './components/EditNoticias';
import Normatividad from './components/Normatividad';
import Documentos from './components/Documentos';
import Cas from './components/Cas';
import Gat from './components/GAT';
import GestoraCas from './components/Gestor_Cas';
import Router from 'vue-router';
import Vue from 'vue'


Vue.use(Router);

const router = new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [
  {path: '*', redirect: '/login'},
  {path: '/', component: Home},
  {path: '/about', component: About},
  {path: '/cas', component: Cas},
  {path: '/normas', component: Documentos},
  {path: '/login', component: Login},
  {path: '/gestorcas',component: GestoraCas},  
  {path: '/gat', component: Gat},
  {path: '/register',component: Register},
  {path: "/dashboard",component: Dashboard},
  {path: "/noticias",component: Noticias},
  {path: "/newnoticias",component: NewNoticias},
  {path: "/editnoticias",component: EditNoticias},
  {path: "/normatividad",component: Normatividad}
    ]
   
});

router.beforeEach((to, from, next) => {
  const publicPages = ['/login','/cas','/normas','/about','/'];
  const authRequired = !publicPages.includes(to.path);
  const loggedIn = localStorage.getItem('token');

  if (authRequired && !loggedIn) {
    return next('/login');
  }

  next();

});

export default router;