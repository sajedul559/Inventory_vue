<template>
  <div>
      <ol class="breadcrumb">
          <li class="breadcrumb-item">
              <a> Dashboard</a>
          </li>
          <li class="breadcrumb-item active">
              <a> Add Supplier</a>
          </li>
      </ol>
     <div class="card">
            <div class="card-header">
               <i class="fas fa-chart-area"></i>Supplier Insert
               <router-link to="/category" class="btn btn-sm btn-info" id="add_new">All Category</router-link>
            </div>


        <div class="card o-hidden border-0 shadow-lg my-5">
            
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Insert New Category</h1>
                            </div>
                            <form @submit.prevent="categoryInsert" class="user">
                                
                                <div class="form-group row">

                                    <div class="col-sm-12 col-md-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="name"
                                            placeholder="Enter your fullname" v-model="form.category_name">
                                        <small class="text-danger" v-if="errors.category_name">{{errors.category_name[0]}}</small>

                                    </div>
                                    
                                </div>
                              
                               
                                <button  type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                                <hr>
                                <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a>
                            </form>
                            <hr>
                            
                            <div class="text-center">
                               <router-link class="small" to="/">Already have an account? Login!</router-link>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default{
   mounted(){
       if(!User.loggedIn()){
           this.$router.push({name:'/'})

       }
   },
    data(){
        return {
            form:{
                category_name:'',
                            
            },
            errors:{

            },
        }
      
    },
    methods:{
        onFileSelected(event){
        let file = event.target.files[0];
        if(file.size > 1048770){
             Notification.image_validation()
        }else{

            let reader = new FileReader();
                reader.onload = event =>{
                    this.form.photo = event.target.result
                    console.log(event.target.result)
                };
                reader.readAsDataURL(file);          
        }
        },
        categoryInsert(){
          axios.post('/api/category/',this.form)
          .then(() => {
               this.$router.push({ name:'category'})
               Notification.success();

          })
          .catch( error => this.errors = error.response.data.errors)
            
        },
    }
   
}

</script>

<style>
</style>