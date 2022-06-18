<template>
  <div>
      <ol class="breadcrumb">
          <li class="breadcrumb-item">
              <a> Dashboard</a>
          </li>
          <li class="breadcrumb-item active">
              <a> Point Of Sale</a>
          </li>
      </ol>
      <div class="row">
         <div class=" card col-lg-5 col-md-5">
            <div class="card-header">
               <i class="fas fa-chart-area"></i>Products
                 <a class="btn btn-sm btn-info float-right" data-toggle="modal" data-target="#exampleModal" id="add_new">Add Customer</a>

            </div>              
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="">
                         <div class="card shadow mb-4">
                        
                       <form action="">
                            <div class="card-body">
                                <table class="table table-sm table-striped">
                                    <thead>
                                        <th scope="col">Name</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Unit</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Action</th>

                                    </thead>
                                    <tbody>
                                        <tr v-for="card in cards" :key="card.id">
                                            <td>{{card.pro_name}}</td>
                                        
                                            <td> <input type="text" readonly=" " style="width:20px;" :value="card.pro_quantity">
                                               <button class="btn btn-sm btn-success">+</button>
                                               <button class="btn btn-sm btn-danger">-</button>
                                            </td>
                                            <td>{{card.sub_total}}</td>
                                            <td><a @click="removeitem(card.id)" class="btn btn-sm btn-danger">x</a></td>

                                        </tr>
                                        
                                    </tbody>

                                </table>
                                <hr>
                                <div class="card-footer">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Total Quantity :
                                            <strong>2</strong>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                             Sub Total : 
                                            <strong>2000</strong>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Vat :
                                            <strong>5%</strong>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Total  : 
                                            <strong>120000</strong>
                                        </li>
                                    </ul> 
                                        <br>
                                        <label>Customer Name</label>
                                        <select class="form-control">
                                            <option v-for="customer in customers" :key="customer.name">{{customer.name}}</option>
                                            

                                        </select>
                                        <label for="">Due</label>
                                        <input type="text" class="form-control">

                                        <label for="">Pay By</label>
                                         <select class="form-control">
                                            <option>Hand Cash</option>
                                            <option>Bkash</option>
                                            <option>Gift Card</option>
                                        </select>
                                        <br>
                                        <button type="submit" class="btn btn-success">Submit</button>


                                </div>
                               
                        </div>
                       </form>
                    </div>
                    <!-- Modal for add Customer -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add New Customer</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                         <form @submit.prevent="customerInsert" class="user">
                                            
                                            <div class="form-group row">

                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control form-control-user" id="name"
                                                        placeholder="Enter your fullname" v-model="form.name">
                                                    <small class="text-danger" v-if="errors.name">{{errors.name[0]}}</small>

                                                </div>
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control form-control-user" id="email"
                                                        placeholder="Enter email Address" v-model="form.email">
                                                <small class="text-danger" v-if="errors.email">{{errors.email[0]}}</small>

                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label for="address">Address</label>

                                                    <input type="text" class="form-control form-control-user" id="address"
                                                        placeholder="Enter your address..." v-model="form.address">
                                                    <small class="text-danger" v-if="errors.address">{{errors.address[0]}}</small>

                                                </div>
                                                <div class="col-sm-4 mb-3 mb-sm-0">
                                                    <label for="phone">Phone</label>
                                                    <input type="text" class="form-control form-control-user"
                                                        id="phone" placeholder="Phone Number" v-model="form.phone">

                                                </div>
                                            </div>
                                
                                            <div class="form-group row">
                                                

                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <input type="file" class="btn btn-info form-control " @change="onFileSelected">
                                                    <small class="text-danger" v-if="errors.photo">{{errors.photo[0]}}</small>

                                                </div>
                                                <div class="col-sm-3 mb-3 mb-sm-0">
                                                    <img :src="form.photo" style="height:40px; width:40px;">

                                                </div>
                                            </div>
                               
                                            <button  type="submit" class="btn btn-primary btn-user btn-block">
                                                Add Customer
                                            </button>
                                            <hr>
                                            <a href="index.html" class="btn btn-google btn-user btn-block">
                                                <i class="fab fa-google fa-fw"></i> Register with Google
                                            </a>
                                            <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                                <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                            </a>
                                         </form>
                                    </div>
                                    
                                    </div>
                                </div>
                            </div>
                     <!-- End Modal for add Customer -->

                    </div>
                </div>

         </div>

          <div class=" card col-lg-7 col-md-7">
            <div class="card-header">
               <i class="fas fa-chart-area"></i>Products
            </div>
                <input type="text" v-model="searchTerm" class="form-control mb-2" placeholder="search">

                <!----categorie wise product show-->
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">All</a>
                        </li>
                        <li class="nav-item" v-for="category in categories" :key="category.id">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false" @click="subproduct(category.id)">{{category.category_name}}</a>
                        </li>
                       
                </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="card-body p-0">

                        <!-- Nested Row within Card Body -->
                                <div class="">
                                    <div class="card shadow mb-4">                                  
                                        <div class="card-body">
                                            <div class="row" style="margin-right:10px;">

                                                <div class="col-lg-3 col-md-8 col-sm-6 col-6" v-for="product in filtersearch " :key="product.id">
                                                    <div class="card" style="width: 10rem;">
                                                    <button  class="btn btn-sm" @click.prevent="addToCart(product.id)">
                                                        <img :src="product.image" alt="" id="em_photo">
                                                        <div class="card-body">
                                                            <small  class="card-link">{{product.product_name}}</small> <br>
                                                            <span v-if="product.product_quantity >= 1" class="badge badge-success">Available({{product.product_quantity}})</span>
                                                            <span v-else="" class="badge badge-danger">Stock Out</span>
                                                        </div>
                                                    </button>
                                                        
                                                    </div>
                                                </div>
                                            
                                            
                                            </div>
                                        </div>
                                   </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <input type="text" v-model="getsearchTerm" class="form-control mb-2" placeholder="search">

                            <div class="card-body p-0">

                        <!-- Nested Row within Card Body -->
                                <div class="">
                                    <div class="card shadow mb-4">                                  
                                        <div class="card-body">
                                            <div class="row" style="margin-right:10px;">

                                                <div class="col-lg-3 col-md-8 col-sm-6 col-6" v-for="getproduct in getproducts " :key="getproduct.id">
                                                <h1>{{getproduct.product_name}}</h1>
                                                    <div class="card" style="width: 10rem;">
                                                    <a href="">
                                                        <img :src="getproduct.image" alt="" id="em_photo">
                                                        <div class="card-body">
                                                            <small  class="card-link">{{getproduct.product_name}}</small> <br>
                                                            <span v-if="getproduct.product_quantity >= 1" class="badge badge-success">Available({{product.product_quantity}})</span>
                                                            <span v-else="" class="badge badge-danger">Stock Out</span>
                                                        </div>
                                                    </a>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                   </div>
                                </div>
                            </div>


                        </div>
                    </div>
               

         </div>
      </div>
     <div class="card">
            
    </div>
  </div>
</template>

<script>
export default {
    mounted() {
        if (!User.loggedIn()) {
            this.$router.push({ 
                name: '/'
            })
        }
    },
    data(){
        return{
            form:{
                details:'',
                amount:'',
                name:'',
                email:'',
                address:'',
                photo:'',
                phone:'',               
            },
            
         products:[],
         searchTerm:'',
         categories:'',
         getproducts:'',
         getsearchTerm:'',
         customers:'',
         errors:'',
         cards:''
        }
        
    },
    computed:{
      filtersearch(){
        return  this.products.filter(product => {
          return    product.product_name.match(this.searchTerm)
          })
      },
      getfiltersearch(){
        return this.getproducts.filter(getproduct =>{
            return getproduct.product_name.match(this.getsearchTerm)
        })
      }
      
    },
    methods:{
        //cart methods
        addToCart(id){
        axios.get('/api/addToCart/'+id)
        .then(() => {
            Reload.$emit('AfterAdd');
            Notification.cart_success()
        })

        },
        cartProduct(){
            axios.get('/api/cart/product/')
            .then(({data}) => (this.cards = data))
            .catch()
        },
        removeitem(id){
         axios.get('/api/cart/remove/'+id)
          .then(() => {
           Reload.$emit('AfterAdd');

            Notification.cart_success()
        })
            .catch()
        },
        //End Card methods
        allProduct(){
            
            axios.get('/api/product/')
            .then(({data}) => (this.products = data))
            .catch()
        },
        allCategory(){
            
            axios.get('/api/category/')
            .then(({data}) => (this.categories = data))
            .catch()
        },
         allCustomer(){          
            axios.get('/api/customer/')
            .then(({data}) => (this.customers = data))
            .catch(console.log('error'))
        },
        subproduct(id){
            axios.get('api/getting/product/'+id)
            .then(({data}) => (this.getproducts = data))
            .catch(error => this.errors = error.response.data.errors)
        },
        //Image validation
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
         customerInsert(){
          axios.post('/api/customer/',this.form)
          .then(() => {
            $('#closeModal').click();
               Notification.success();
               this.customers = this.customers.filter(customer =>{
                return customer.id !=id
               })

          })
          .catch( error => this.errors = error.response.data.errors)
            
        },
      
    },
    created(){
        this.allProduct();
        this.allCategory();
        this.allCustomer();
        this.cartProduct();
        Reload.$on('AfterAdd', () => {
            this.cartProduct();
        })
    }
}
</script>

<style scoped>
#em_photo{
    height:100px;
    width:90px;
}
</style>
