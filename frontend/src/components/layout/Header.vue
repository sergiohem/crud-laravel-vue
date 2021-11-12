<template>
  <!-- Topbar -->
  <nav
    class="
      navbar navbar-expand navbar-light
      bg-white
      topbar
      mb-4
      static-top
      shadow
    "
  >
    <h4>CRUD - Pessoas</h4>

    <ul class="navbar-nav mr-auto">
      <li class="nav-item ml-3">
        <router-link :to="{ name: 'pessoasLista' }" class="btn btn-primary"
          >Listar pessoas</router-link
        >
      </li>
      <li class="nav-item ml-3">
        <router-link :to="{ name: 'pessoasCadastro' }" class="btn btn-success"
          >Cadastrar pessoa</router-link
        >
      </li>
    </ul>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
      <!-- <div class="topbar-divider d-none d-sm-block"></div> -->

      <li class="nav-item">
        <a class="btn btn-danger" @click.prevent="logout">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
          Sair
        </a>
      </li>
    </ul>
  </nav>
  <!-- End of Topbar -->
</template>
<script>
import Auth from "@/helpers/auth";

export default {
  methods: {
    logout() {
      Auth.logout();
    },
  },
};
</script>
<style lang="">
</style>