/*
|-------------------------------------------------------------------------------
| routes.js
|-------------------------------------------------------------------------------
| Contains all of the routes for the application
*/

/*
    Imports Vue and VueRouter to extend with the routes.
*/
import Vue from 'vue'
import VueRouter from 'vue-router'

/*
    Extends Vue to use Vue Router
*/
Vue.use( VueRouter )

/*
    Makes a new VueRouter that we will use to run all of the routes
    for the app.
*/
export default new VueRouter({
    routes: [
                {        
                            path: '/passport-clients',
                            name: 'passport-clients',
                            component: Vue.component(
                                'passport-clients',
                                require('./components/passport/Clients.vue')
                            )
                },
                {
                            
                
                            path: '/passport-authorized-clients',
                            name: 'passport-authorized-clients',
                            component: Vue.component(
                                'passport-authorized-clients',
                                require('./components/passport/AuthorizedClients.vue')
                            )
                            
                },
                {           
                            path: '/passport-personal-access-tokens',
                            name: 'passport-personal-access-tokens',
                            component: Vue.component(
                                'passport-personal-access-tokens',
                                require('./components/passport/PersonalAccessTokens.vue')
                            )
                },
        ]

      
}); 

