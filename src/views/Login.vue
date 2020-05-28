<template>
    <div class="container">
        <form class="form-horizontal" @submit.prevent="login">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h2>Login</h2>
                <hr>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label for="email">E-Mail Address</label>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-at"></i></div>
                        <input type="text"  class="form-control" 
                               placeholder="you@example.com" v-model="form.email">
                    </div>
                </div>
            </div>
            <div class="col-md-3" v-show="error.email">
                <div class="form-control-feedback">
                        <span class="text-danger align-middle">
                           Valid email required.
                        </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label for="password">Password</label>
            </div>
            <div class="col-md-6">
                <div class="form-group has-danger">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-key"></i></div>
                        <input type="password" class="form-control" 
                               placeholder="Password" v-model="form.password">
                    </div>
                </div>
            </div>
            <div class="col-md-3" v-show="error.password">
                <div class="form-control-feedback">
                        <span class="text-danger align-middle">
                            <i class="fa fa-close"> Password required.</i>
                        </span>
                </div>
            </div>
        </div>
       
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-success float-right"><i class="fa fa-user-plus"></i> Login</button>
            </div>
        </div>
    </form>
    </div>
</template>
<script>
import { API } from '../config';
import jwtToken from "../helpers/jwt-token";
export default {
  name: 'Login',
  data() {
      return {
          form:{
              email:'',
              password:''
          },
        error: {
            email: null,
            password: null
        }
      }
  },
  components: {
   
  },
  methods:{
      async login() {

            try {
            const response = await axios.post(API.login, this.form);
            jwtToken.setToken(response.data.data.token);
            this.$store.dispatch('setAuthUser',response.data.data.auth);
            this.$noty.success("You have logged in successfully.")
            //this.$router.push({name: 'Home'});
            this.$router.go(-1);
            }catch( err ) {
                (err.response.data.error) && this.$noty.error(err.response.data.error);
						(err.response.data.errors)
							? this.setErrors(err.response.data.errors)
							: this.clearErrors();
                
            }

      },
      setErrors(errors) {
				this.error.email = errors.email ? errors.email[0] : null;
				this.error.password = errors.password ? errors.password[0] : null;
	  },
	  clearErrors() {
				this.error.email = null;
				this.error.password = null;
	  }
  }
}
</script>