<template>
  <layout-base>
    <h3>Lista de Pessoas</h3>
    <div class="row">
      <div class="col-12">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Nome</th>
              <th>E-mail</th>
              <th>Categoria</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <template v-if="!carregando && pessoas.data.length">
              <tr v-for="item in pessoas.data" :key="item.id">
                <td>{{ item.nome }}</td>
                <td>{{ item.email }}</td>
                <td>{{ item.categoria.nome }}</td>
                <td>
                  <router-link
                    :to="{ name: 'pessoasEdicao', params: { id: item.id } }"
                    class="btn btn-warning mr-2"
                    >Editar</router-link
                  >
                  <button
                    class="btn btn-danger"
                    @click="excluirPessoa(item.id)"
                  >
                    Excluir
                  </button>
                </td>
              </tr>
            </template>
            <template v-else>
              <tr>
                <td colspan="4">Nenhum registro encontrado</td>
              </tr>
            </template>
          </tbody>
        </table>
        <div class="row justify-content-center">
          <pagination :value.sync="pessoas" @change="paginate" />
        </div>
      </div>
    </div>
  </layout-base>
</template>
<script>
import LayoutBase from "@/components/layout/Layout.vue";
import { base_url } from "@/helpers/config";
import axios from "axios";
import Pagination from "@/components/Pagination.vue";

export default {
  components: { LayoutBase, Pagination },

  data() {
    return {
      pessoas: {},
      carregando: true,
    };
  },
  async created() {
    await this.paginate();
  },

  methods: {
    async paginate(page = 1) {
      this.carregando = true;

      try {
        const response = await axios.get(base_url + "pessoas", {
          params: { page },
        });

        this.pessoas = response.data.data;
      } finally {
        this.carregando = false;
      }
    },
    excluirPessoa(id) {
      axios.delete(base_url + `pessoas/${id}`).then(() => {
        let i = this.pessoas.data.map((data) => data.id).indexOf(id);
        this.pessoas.data.splice(i, 1);

        if (this.pessoas.data.length < 15) this.paginate(1);
      });
    },
  },
};
</script>