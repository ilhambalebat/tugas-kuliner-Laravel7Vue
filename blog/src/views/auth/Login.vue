<template>
  <div class="container p-5">
      <div class="row">
          <div class="col-md-6">
              <div class="card">
                  <div class="card-header">
                    Login
                  </div>
                  <div class="card-body">
                    <form action="" method="post" @submit.prevent="store">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" type="email" v-model="form.email" id="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input class="form-control" type="password" v-model="form.password" id="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                  </div>
              </div>
          </div>
          <div class="col-md-6">
              <div class="card">
                   <img :src="background" alt="" height="350px">
              </div>
          </div>
      </div>
  </div>
</template>

<script>
import {mapActions} from 'vuex'
import background from '../../assets/img/background.jpg'
export default {
    data() {
        return {
            form: {
                email: "",
                password: ""
            },
            background: background
        }
    },
    mounted() {
        document.title = "Login"
    },
    methods:
    {
        ...mapActions({
            login: 'auth/login'
        }),
        async store()
        {           
            await this.login(this.form)
            this.$router.replace({name: 'home'})
        }
    }
}
</script>

<style>

</style>