<template>
  <div class="row">
      <div class="col-md-6 col-md-offset-3">
          <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <input
                            v-model="email"
                            class="form-control"
                            type="email"
                            placeholder="Email">
                </div>

                <div class="form-group">
                    <input
                            v-model="password"
                            class="form-control"
                            type="password"
                            placeholder="Password">
                </div>
                <button @click="login" class="btn btn-success pull-right">
                    Login
                </button>
            </div>
          </div>
      </div>
  </div>
</template>

<script>
    export default {
        data () {
            return {
                email: '', 
                password: ''
            }
        },

        methods: {
            login () {
                const data = {
                    client_id: 2,
                    client_secret: 'WQyfVhj4SYgarEC2b7jQL0PkBz2Z66ngznpoICwn',
                    grant_type: 'password',
                    username: this.email,
                    password: this.password
                }

                this.$http.post("http://akademiskahus.test/oauth/token", data)
                .then(function (response) {
                    console.log(response)
                })
                // .then(response => {
                //     console.log(response)
                // })
            }
        }
    }
</script>

