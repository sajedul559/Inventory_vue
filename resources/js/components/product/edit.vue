<template>
  <div>
      <ol class="breadcrumb">
          <li class="breadcrumb-item">
              <a> Dashboard</a>
          </li>
          <li class="breadcrumb-item active">
              <a> Update Employee</a>
          </li>
      </ol>
     <div class="card">
            <div class="card-header">
               <i class="fas fa-chart-area"></i>Employee Update
               <router-link to="/employee" class="btn btn-sm btn-info" id="add_new">All Employee</router-link>
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
                              <form @submit.prevent="productUpdate" class="user">
                                
                                <div class="form-group row">

                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="name"
                                            placeholder="Enter your product_name" v-model="form.product_name">
                                        <small class="text-danger" v-if="errors.product_name">{{errors.product_name[0]}}</small>

                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="name"
                                            placeholder="Enter your product code" v-model="form.product_code">
                                        <small class="text-danger" v-if="errors.product_code">{{errors.product_code[0]}}</small>

                                    </div>
                                    
                                </div>
                                <div class="form-group row">

                                   <div class="col-sm-6 mb-3 mb-sm-0">
                                      <label for="">Category</label>
                                       <select name="cars form-control orm-control-user" class="form-control" id="cars" v-model="form.category_id">
                                            <option :value="category.id" v-for="(category, index) in categories" :key="index">{{ category.category_name}}</option>
                                            
                                       </select>

                                    </div>
                                     <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="">Supplier</label>
                                       <select name="cars form-control orm-control-user" class="form-control" id="cars" v-model="form.supplier_id">
                                    <option :value="supplier.id" v-for="(supplier, index) in suppliers" :key="index">{{ supplier.name}}</option>

                                       </select>

                                    </div>
                                </div>
                               
                                <div class="form-group row">

                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="root"
                                            placeholder="Joining Date..." v-model="form.root">
                                        <small class="text-danger" v-if="errors.root">{{errors.root[0]}}</small>

                                    </div>
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="nid"
                                            placeholder="Enter buying price" v-model="form.buying_price">
                                        <small class="text-danger" v-if="errors.buying_price">{{errors.buying_price[0]}}</small>

                                    </div>
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="nid"
                                            placeholder="Enter NID Number" v-model="form.selling_price">
                                    <small class="text-danger" v-if="errors.selling_price">{{errors.selling_price[0]}}</small>

                                    </div>
                                    
                                </div>
                                 <div class="form-group row">

                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="buying_date">Buying Date</label>
                                        <input type="date" class="form-control form-control-user" id="joining_date"
                                            placeholder="Buying Date..." v-model="form.buying_date">
                                        <small class="text-danger" v-if="errors.buying_date">{{errors.buying_date[0]}}</small>

                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0 " style="margin-top:30px;">
                                        <input type="text" class="form-control form-control-user" id="nid"
                                            placeholder="Enter product quantity" v-model="form.product_quantity">
                                    <small class="text-danger" v-if="errors.product_quantity">{{errors.product_quantity[0]}}</small>

                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                   

                                    <div class="col-sm-5 mb-3 mb-sm-0">
                                        <input type="file" class="btn btn-info form-control " @change="onFileSelected">
                                        <small class="text-danger" v-if="errors.newimage">{{errors.newimage[0]}}</small>

                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <img :src="form.newimage" style="height:40px; width:40px;">

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
                product_name:'',
                product_code:'',
                category_id:'',
                supplier_id:'',
                root:'',
                buying_price:'',
                selling_price:'',
                buying_date:'',
                image:'',
                newphoto:'',

                product_quantity:'',

               

                
            },
           errors:{},
            suppliers:{},
            categories:{},
        }
      
    },
    created(){
      let id = this.$route.params.id
      axios.get('/api/product/'+id)
      .then(({data }) => (this.form = data))
      .catch(console.log('error load edit component'))
       axios.get('/api/category')
        .then(({data}) =>(this.categories = data))
        axios.get('/api/supplier')
        .then(({data}) =>(this.suppliers = data))

    },
    methods:{
        onFileSelected(event){
        let file = event.target.files[0];
        if(file.size > 1048770){
             Notification.image_validation()
        }else{

            let reader = new FileReader();
                reader.onload = event =>{
                    this.form.newphoto = event.target.result
                    console.log(event.target.result)
                };
                reader.readAsDataURL(file);          
        }
        },
        productUpdate(){
          let id = this.$route.params.id
          axios.patch('/api/product/'+id,this.form)
          .then(() => {
            
               this.$router.push({ name:'product'})
               Notification.success();

          })
           .catch( error => this.errors = error.response.data.errors)
            
        },
    }
   
}

</script>

<style>
</style>