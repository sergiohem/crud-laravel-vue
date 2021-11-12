import axios from 'axios';
import { base_url } from '@/helpers/config';
import router from '@/router';

export default {

    async initialize() {

        await this.loadInfo();

        this.state.api_crud_token = localStorage.getItem('api_crud_token');
    },

    set(api_crud_token) {
        localStorage.setItem('api_crud_token', api_crud_token);
    },

    remove() {
        localStorage.removeItem('api_crud_token');
    },

    async loadInfo()
    {
        try {
            const response = await axios.get(base_url + 'auth-user');

            if(!response.data.success) {
                this.remove();
                router.replace({name: 'login'});
            } else {
                const api_token = response.data.data.api_token;

                this.set(api_token);
            }

            return localStorage.getItem('api_crud_token');
        } catch (error) {
            this.remove();
            router.replace({name: 'login'});
        }      

    },

    async logout() {
        try {
            const response = await axios.post(base_url + 'logout');
            if(response.data.success){
                this.remove();
                router.replace({name: 'login'})
            } else {
                alert(response.message);
            }
        }catch(error) {
            console.log(error);
            //alert(error.response.data.message)
        }
    },

    verifyApiTokenHeader() {

        const token = localStorage.getItem('api_crud_token');
        if (token !== undefined && token !== null) {
            axios.defaults.headers.common = {'Authorization': `Bearer ${token}`};
            return true;
        }

        return false;
    }
}