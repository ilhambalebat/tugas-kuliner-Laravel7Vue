<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Kuliner</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <router-link exact :to="{name : 'home'}" class="nav-link">Home <span class="sr-only">(current)</span></router-link>
      </li>
      <template v-if="authCheck">
      <li class="nav-item">
        <router-link :to="{name : 'posts.index'}" class="nav-link">Menu 
          </router-link>
      </li>
        
      </template>
    </ul>
    <ul class="navbar-nav">

      <template v-if="!authCheck">
        <li class="nav-item">
          <router-link :to="{name: 'auth.login'}" class="nav-link">Login</router-link>
        </li>
      </template>
      <template v-else>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ user.name }}
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <router-link class="dropdown-item" to="/posts/new">New Menu</router-link>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" @click.prevent="logout">Logout</a>
          </div>
        </li>
      </template>

    </ul>
    
  </div>
</nav>
</template>

<script>
import {mapGetters, mapActions} from 'vuex'
export default {
    computed: {
      ...mapGetters({
        authCheck: 'auth/check',
        user: 'auth/user'
      })
    },
    methods: {
      ...mapActions({
        signoutAction: 'auth/signout'
      }),
      async logout()
      {
         await this.signoutAction();
         this.$router.replace({name: 'auth.login'})
      } 
    }
}
</script>