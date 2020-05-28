<template>
    <div class="container">
        <form class="form-horizontal" @submit.prevent="register">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h2>Register</h2>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label for="name">User Name</label>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-user"></i></div>
                        <input type="text"  class="form-control" placeholder="John" v-model="form.name">
                    </div>
                </div>
            </div>
            <div class="col-md-3" v-show="error.name">
                <div class="form-control-feedback">
                        <span class="text-danger align-middle">
                            Valid username required
                        </span>
                </div>
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
                            <i class="fa fa-close"> Valid password required.</i>
                        </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label for="password">Confirm Password</label>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem">
                            <i class="fa fa-repeat"></i>
                        </div>
                        <input type="password" class="form-control"
                               placeholder="Password" v-model="form.cpassword">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-success float-right"><i class="fa fa-user-plus"></i> Register</button>
            </div>
        </div>
    </form>
    </div>
</template>
<script>
import { API } from '../config';
export default {
  name: 'Register',
  data() {
      return {
            form:{
                name:'',
                email:'',
                password:'',
                cpassword:''
            },
            error: {
            email: null,
            password: null,
            name:null
            }
      }
  },
  methods:{
      async register() {
            try {
            const response = await axios.post(API.signup, this.form);
            this.$noty.success("You have registered successfully.You can login now.")
            this.$router.push({name: 'Login'});
            
            }catch( err ) {
                
                (err.response.data.error) && this.$noty.error(err.response.data.error);
						(err.response.data.errors)
							? this.setErrors(err.response.data.errors)
							: this.clearErrors();
            }
      },
      setErrors(errors) {
				this.error.email = errors.email ? errors.email[0] : null;
				this.error.name = errors.name ? errors.name[0] : null;
				this.error.password = errors.password ? errors.password[0] : null;
	  },
	  clearErrors() {
                 this.error.name = null;
				this.error.email = null;
				this.error.password = null;
	  }
  }
}
</script>