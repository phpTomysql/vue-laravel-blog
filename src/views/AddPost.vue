<template>
    <div class="container">
        <form class="form-horizontal" @submit.prevent="addPost">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h2>Add New Post</h2>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label for="name">Title</label>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-user"></i></div>
                        <input type="text"  class="form-control" 
                               placeholder="Post Title" v-model="form.title">
                    </div>
                </div>
            </div>
            <div class="col-md-3" v-show="error.title">
                <div class="form-control-feedback">
                        <span class="text-danger align-middle">
                            {{error.title}}
                        </span>
                </div>
            </div>
        </div>
         <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label for="name">Sub Title</label>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-user"></i></div>
                        <input type="text"  class="form-control" 
                               placeholder="Post Sub Title" v-model="form.subtitle">
                    </div>
                </div>
            </div>
            <div class="col-md-3" v-show="error.subtitle">
                <div class="form-control-feedback">
                        <span class="text-danger align-middle">
                            {{error.subtitle}}
                        </span>
                </div>
            </div>
        </div>
         <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label for="name">Meta Description</label>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-user"></i></div>
                        <input type="text"  class="form-control" 
                               placeholder="Post Meta Description" v-model="form.meta_desc">
                    </div>
                </div>
            </div>
            <div class="col-md-3" v-show="error.meta_desc">
                <div class="form-control-feedback">
                        <span class="text-danger align-middle">
                            {{error.meta_desc}}
                        </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label for="email">Banner Image</label>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-at"></i></div>
                        <button class="btn btn-primary" @click="onPickFile" type="button">Browse</button>
                        <input type="file" v-on:change="onImageChange" class="form-control" ref="fileInput" style="display: none">
                    </div>
                </div>
            </div>
            <div class="col-md-3" v-show="error.image">
                <div class="form-control-feedback">
                        <span class="text-danger align-middle">
                           {{error.image}}
                        </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label for="password">Category</label>
            </div>
            <div class="col-md-6">
                <div class="form-group has-danger">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-key"></i></div>
                        <select  class="form-control" v-model="form.category_id">
                            <option value="">Choose Category</option>
                            <option v-for="category in categories" :value="category.id" :key="category.id">{{category.category_name}}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-3" v-show="error.category_id">
                <div class="form-control-feedback">
                        <span class="text-danger align-middle">
                            {{error.category_id}}
                        </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 field-label-responsive">
                <label for="password">Content</label>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon" style="width: 2.6rem">
                            <i class="fa fa-repeat"></i>
                        </div>
                      <editor
                      v-model="form.post_body"
                      apiKey="75l36thp0b3g6pcy2cw5ckxjnpanuamytju99sz010ow4jkz"
    initialValue="<p>Placeholder content</p>"
    :init="{
      height: 500,
      menubar: false,
      plugins: [
        'advlist autolink lists link image charmap',
        'searchreplace visualblocks code fullscreen',
        'print preview anchor insertdatetime media',
        'paste code help wordcount table'
      ],
      toolbar:
        'undo redo | formatselect | bold italic | \
        alignleft aligncenter alignright | \
        bullist numlist outdent indent | help'
    }"
  >
  </editor>
                    </div>
                </div>
            </div>
             <div class="col-md-3" v-show="error.post_body">
                <div class="form-control-feedback">
                        <span class="text-danger align-middle">
                            {{error.post_body}}
                        </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-success float-right"><i class="fa fa-user-plus"></i>Add Post</button>
            </div>
        </div>
    </form>
    </div>
</template>
<script>
 import Editor from '@tinymce/tinymce-vue'
 import { API } from '../config';
 
export default {
  name: 'AddPost',
  components: {
      editor: Editor
    },
  data() {
    return {
        categories:[],
        form:{
            title:'',
            subtitle:'',
            meta_desc:'',
            image:'',
            category_id:0,
            post_body:''
        },
        error:{
            title:null,
            subtitle:null,
            meta_desc:null,
            image:null,
            category_id:null,
            post_body:null
        }
    }
    },
    methods:{

       async category() {

            try {
                const response = await axios.get(API.category);
                this.categories = response.data;
                
            }catch( err ) {
               
                
            }

      },
      resetForm() {

           this.form = {
            title:'',
            subtitle:'',
            meta_desc:'',
            image:'',
            category_id:0,
            post_body:''
        },
        this.error = {
            title:null,
            subtitle:null,
            meta_desc:null,
            image:null,
            category_id:null,
            post_body:null
        }

      },
      async addPost() {

           try {
                const response = await axios.post(API.addPost,this.form);
              
                this.$noty.success(response.data.message);

                this.resetForm();

            }catch( err ) {
               
                 (err.response.data.error) && this.$noty.error(err.response.data.error);
						(err.response.data.errors)
							? this.setErrors(err.response.data.errors)
							: this.clearErrors();
            }
      },
      onPickFile () {
            this.$refs.fileInput.click()
      },
      onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
        },
        createImage(file) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = (e) => {
                vm.form.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        setErrors(errors) {
            
				this.error.title = errors.title ? errors.title[0] : null;
				this.error.subtitle = errors.subtitle ? errors.subtitle[0] : null;
				this.error.meta_desc = errors.meta_desc ? errors.meta_desc[0] : null;
				this.error.image = errors.image ? errors.image[0] : null;
				this.error.category_id = errors.category_id ? errors.category_id[0] : null;
				this.error.post_body = errors.post_body ? errors.post_body[0] : null;
	  },
	  clearErrors() {
            this.error.title = null
            this.error.subtitle = null
            this.error.meta_desc = null
            this.error.image = null
            this.error.category_id = null
            this.error.post_body = null
	  }
   },
   mounted() {
       this.category();
   }
}
</script>