//import Auth from "@/helpers/auth";

export default {
    auth(to, from, next) {
        if (to.meta && to.meta.guest) {
            return next();
        }

        const token = localStorage.getItem('api_crud_token');

        if (!token) {
            next({
                name: 'login'
            })
        }

        next();
    }
}