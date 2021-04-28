import Home from './components/Home';
import About from './components/About';
import Register from './components/Register';
import Login from './components/Login';
import Dashboard from './components/Dashboard';
import NotFound from './components/NotFound';
import Noticias from './components/Noticias';
import NewNoticias from './components/NewNoticias';
import EditNoticias from './components/EditNoticias';

export default{
    mode: 'history',
    routes: [
        {
            path: '*',
            component: NotFound
        },
        {
            path: '/',
            component: Home,
            name: "Home"
        },
        {
            path: '/about',
            component: About
        },
        {
            path: '/register',
            name: 'Register',
            component: Register,
            beforeEnter: (to, form, next) =>{
                axios.get('/api/athenticated').then(()=>{
                    next()
                }).catch(()=>{
                    return next({ name: 'Login'})
                })
            }
        },
        {
            path: '/login',
            component: Login,
            name: 'Login'
        },
        {
            path: "/dashboard",
            name: "Dashboard",
            component: Dashboard,
           beforeEnter: (to, form, next) =>{
               axios.get('/api/athenticated').then(()=>{
                   next()
               }).catch(()=>{
                   return next({ name: 'Login'})
               })
           }
       
          },
          {
              path: "/noticias",
              name: "Noticias",
              component: Noticias,
             beforeEnter: (to, form, next) =>{
                 axios.get('/api/athenticated').then(()=>{
                     next()
                 }).catch(()=>{
                     return next({ name: 'Login'})
                 })
             }
         
            },
            {
                path: "/newnoticias",
                name: "NewNoticias",
                component: NewNoticias,
               beforeEnter: (to, form, next) =>{
                   axios.get('/api/athenticated').then(()=>{
                       next()
                   }).catch(()=>{
                       return next({ name: 'Login'})
                   })
               }
           
              },
              {
                  path: "/editnoticias",
                  name: "EditNoticias",
                  component: EditNoticias,
                 beforeEnter: (to, form, next) =>{
                     axios.get('/api/athenticated').then(()=>{
                         next()
                     }).catch(()=>{
                         return next({ name: 'Login'})
                     })
                 }
             
                }
          
    ]
}