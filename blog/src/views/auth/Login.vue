<template>
  <div class="container">
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
      </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            form: {
                email: "ilhambalebat@gmail.com",
                password: "password"
            }
        }
    },
    methods:
    {
        async store()
        {
            await axios.get('sanctum/csrf-cookie')
            await axios.post('login', this.form)
            let user = await axios.get("api/user")
            console.log(user.data)
        }
    }
}
</script>

<style>

</style>