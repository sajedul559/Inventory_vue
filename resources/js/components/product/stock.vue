<template>
  <div>
      <ol class="breadcrumb">
          <li class="breadcrumb-item">
              <a> Dashboard</a>
          </li>
          <li class="breadcrumb-item active">
              <a> All Product</a>
          </li>
      </ol>
     <div class="card">
            <div class="card-header">
               <i class="fas fa-chart-area"></i>Product Insert
            </div>


            <div class="card o-hidden border-0 shadow-lg my-5">
                
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="">
                         <div class="card shadow mb-4">
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <label>Search</label>
                                 <input type="text"  v-model="searchTerm" class="form-control " style="width:200px;">
                                <table class="table table-bordered mt-2" width="100%" cellspacing="0" >
                                    <thead class="" >
                                        <tr>
                                            <th>Name</th>
                                            <th>Code</th>
                                            <th>Photo</th>
                                            <th>Category </th>
                                            <th>Buying Data</th>

                                            <th>Status</th>
                                            <th>Quantity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <tr v-for="product in filtersearch " :key="product.id">

                                            <td>{{ product.product_name}}</td>
                                            <td>{{ product.product_code}}</td>

                                            <td>
                                                <img :src="product.image" alt="" id="em_photo">
                                            </td>
                                            <td>{{ product.category_name}}</td>
                                            <td>{{ product.buying_date}}</td>

                                            <td v-if="product.product_quantity >= 1"><span class="badge badge-success">Available</span></td>
                                             <td v-else=""><span class="badge badge-danger">Stock Out</span></td>

                                            <td>{{ product.product_quantity}}</td>
                                            <td>
                                                <router-link  :to="{name:'edit_stock',params:{id:product.id}}" class="btn btn-sm btn-info">Edit</router-link>

                                            </td>

                                        </tr>
                                        
                                    </tbody>
                                </table>
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
         products:[],
         searchTerm:''
        }
        
    },
    computed:{
      filtersearch(){
        return  this.products.filter(product => {
          return    product.product_name.match(this.searchTerm)
          })
      }
      
    },
    methods:{
        allProduct(){
            
            axios.get('/api/product/')
            .then(({data}) => (this.products = data))
            .catch()
        },
      
    },
    created(){
        this.allProduct();
    }
}
</script>

<style>
#em_photo{
    height:40px;
    width:40px;
}
</style>
