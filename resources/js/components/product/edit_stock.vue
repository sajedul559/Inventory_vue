<template>
  <div>
      <ol class="breadcrumb">
          <li class="breadcrumb-item">
              <a> Dashboard</a>
          </li>
          <li class="breadcrumb-item active">
              <a> Update Stock</a>
          </li>
      </ol>
     <div class="card">
            <div class="card-header">
               <i class="fas fa-chart-area"></i>Stock Update
            </div>


        <div class="card o-hidden border-0 shadow-lg my-5">
            
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Update Stock</h1>
                            </div>
                              <form @submit.prevent="stockUpdate" class="user">
                                
                              
                                 <div class="form-group row">

                                    
                                    <div class="col-sm-12 mb-3 mb-sm-0 " style="margin-top:30px;">
                                        <input type="text" class="form-control form-control-user" id="nid"
                                            placeholder="Enter product quantity" v-model="form.product_quantity">
                                    <small class="text-danger" v-if="errors.product_quantity">{{errors.product_quantity[0]}}</small>

                                    </div>
                                </div>
                                
                               
                               
                                <button  type="submit" class="btn btn-primary btn-user btn-block">
                                   Stock Update
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
            
                product_quantity:'',                
          },
           errors:{},
           
        }
      
    },
    created(){
      let id = this.$route.params.id
      axios.get('/api/product/'+id)
      .then(({data }) => (this.form = data))
      .catch(console.log('error load edit component'))
       
    },
    methods:{
       
        stockUpdate(){
          let id = this.$route.params.id
          axios.post('/api/stock/update/'+id,this.form)
          .then(() => {
            
               this.$router.push({ name:'stock'})
               Notification.success();

          })
           .catch( error => this.errors = error.response.data.errors)
            
        },
    }
   
}

</script>

<style>
</style>