<template>
  <layout-base>
    <h3>Cadastrar Pessoa</h3>
    <form @submit.prevent="submit">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control" v-model="pessoa.nome" />
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="form-group">
                <label>E-mail</label>
                <input
                  type="email"
                  class="form-control"
                  v-model="pessoa.email"
                />
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="form-group">
                <label>Categoria</label>
                <select class="form-control" v-model="pessoa.categoria_id">
                  <option
                    :value="categoria.id"
                    v-for="(categoria, index) in categorias"
                    :key="index"
                  >
                    {{ categoria.nome }}
                  </option>
                </select>
              </div>
            </div>
          </div>

          <div class="row justify-content-center">
            <button type="submit" class="btn btn-success">Salvar</button>
          </div>
        </div>
      </div>
    </form>
  </layout-base>
</template>
 
<script>
import LayoutBase from "@/components/layout/Layout.vue";
import { base_url } from "@/helpers/config";
import axios from "axios";

export default {
  components: { LayoutBase },
  data() {
    return {
      pessoa: {},
      categorias: [],
      carregando: true,
    };
  },

  async mounted() {
    this.carregando = true;
    try {
      await axios.get(base_url + "categorias").then((response) => {
        this.categorias = response.data.data;
      });
    } finally {
      this.carregando = false;
    }
  },

  methods: {
    submit() {
      this.carregando = true;
      axios
        .post(base_url + "pessoas", this.pessoa, {
          headers: { Accept: 'application/json' }
        })
        .then(() => this.$router.push({ name: "pessoasLista" }))
        .catch((err) => {
          
          alert(Object.values(err.response.data.errors)[0])
        })
        .finally(() => (this.carregando = false));
    },
  },
};
</script>