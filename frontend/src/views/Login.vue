<template>
    <!-- <load-page :load='loading' /> -->
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                    </div>
                                    <strong v-if="errors" class="text-danger">
                                        <br>
                                        <ul>
                                            <li v-for="(item, index) in errors" :key="index">
                                                {{ (errors[index].length > 1) ? errors[index] : errors[index][0] }}
                                            </li>
                                        </ul>
                                    </strong>
                                    <form @submit.prevent="submit" class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="E-mail de acesso" v-model="email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Senha" v-model="password">
                                        </div>
                                        <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div> -->
                                        <button class="btn btn-primary btn-user btn-block" :disabled="loading">
                                            Entrar
                                        </button>
                                        <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a> -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</template>
<script>
    import { base_url } from '@/helpers/config'
    //import LoadPage from '@/components/others/Loading'
    import Auth from '@/helpers/auth'
    import axios from 'axios'

    export default {

        name: 'Login',
        components: {
            //LoadPage
        },
        data() {
            return {
                email : null,
                password: null,
                loading: false,
                errors: []
            }
        },

        // mounted () {
        //     document.body.classList.add('bg-gradient-primary')
        // },

        methods: {
            async submit() {
                this.loading = true
                const data = { email: this.email, password: this.password}
                try {
                    const response = await axios.post(base_url + 'login', data)
                    Auth.set(response.data.data)
                    this.$router.replace({name: 'pessoasLista'})
                }catch(error) {
                   this.errors = error.response.data.message
                }

                this.loading = false
            }
        }
    }
</script>