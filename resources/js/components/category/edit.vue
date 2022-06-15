<template>
  <div>
      <ol class="breadcrumb">
          <li class="breadcrumb-item">
              <a> Dashboard</a>
          </li>
          <li class="breadcrumb-item active">
              <a> Update Category</a>
          </li>
      </ol>
     <div class="card">
            <div class="card-header">
               <i class="fas fa-chart-area"></i>Category Update
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
                                <h1 class="h4 text-gray-900 mb-4">Update Employee</h1>
                            </div>
                            <form @submit.prevent="categoryUpdate" class="user">
                                
                                <div class="form-group row">

                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="name"
                                        v-model="form.category_name">
                                        <small class="text-danger" v-if="errors.category_name">{{errors.category_name[0]}}</small>

                                    </div>
                                    
                                </div>
                               
                               
                                <button  type="submit" class="btn btn-primary btn-user btn-block">
                                    Update Account
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
     created(){
      let id = this.$route.params.id
    let test =  axios.get('/api/category/'+id)
      .then(({data }) => (this.form = data))
      .catch(console.log('error load edit component'))

    },
    methods:{
       
        categoryUpdate(){
          let id = this.$route.params.id
          axios.patch('/api/category/'+id,this.form)
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