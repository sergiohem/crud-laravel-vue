import Vue from 'vue'
import VueRouter from 'vue-router'
import PeopleList from "@/views/PeopleList";
import PeopleCreate from "@/views/PeopleCreate";
import PeopleEdit from "@/views/PeopleEdit";
import Login from "@/views/Login";
import Auth from "@/helpers/auth";
import axios from 'axios';

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'login',
            component: Login,
            meta: {
                guest: true
            }
        },
        {
            path: '/pessoas',
            name: 'pessoasLista',
            component: PeopleList,
        },
        {
            path: '/pessoas/cadastro',
            name: 'pessoasCadastro',
            component: PeopleCreate,
        },
        {
            path: '/pessoas/:id/editar',
            name: 'pessoasEdicao',
            component: PeopleEdit,
        },
    ]
})


let last_modify = null;

router.beforeEach((to, from, next) => {

    if (to.meta && to.meta.guest) {
        if (Auth.verifyApiTokenHeader() && last_modify === null || last_modify !== null && (last_modify.getTime() + 60 * 1000) < new Date().getTime()) {
            last_modify = new Date;
            const token = Auth.loadInfo();
            if (token) {
                next({
                    name: 'pessoasLista'
                });
            }
        }
        return next();
    }

    try {

        if (Auth.verifyApiTokenHeader() && last_modify === null || (last_modify !== null && (last_modify.getTime() + 60 * 1000) < new Date().getTime())) {
            last_modify = new Date;
            Auth.loadInfo();
        }

        next();


    } catch (e) {

        localStorage.removeItem('api_crud_token');

        let query;

        if (e.status == 401) {
            query = {
                error: 'revoked_token'
            }
        } else if (e.response.status == 404) {
            throw e;
        }

        next({
            name: 'login',
            query
        })
    } finally {
        //
    }
})

axios.interceptors.response.use(
    response => {
      return response;
    },
    function(error) {
      if (error.response?.status === 401) {
        router.replace({name: 'login'});
      }
      return Promise.reject(error);
    }
  )

export default router;