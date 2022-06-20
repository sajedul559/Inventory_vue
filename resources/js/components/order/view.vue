<template>
  <div>
      <ol class="breadcrumb">
          <li class="breadcrumb-item">
              <a> Dashboard</a>
          </li>
          <li class="breadcrumb-item active">
              <a>Order Details</a>
          </li>
      </ol>
     <div class="card">
            <div class="card-header">
               <i class="fas fa-chart-area"></i>Order Details
            </div>
        <div class="card o-hidden border-0 shadow-lg my-5">           
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-6">
                        <ul class="list-group">
                            <li class="list-group-item btn btn-success" style="background-color: green;">Customer Details</li>
                             <li class="list-group-item">Name: {{orders.name}}</li>
                            <li class="list-group-item">Phone: {{orders.phone}}</li>
                            <li class="list-group-item">Address: {{orders.address}}</li>
                            <li class="list-group-item">Date: {{orders.order_date}}</li>
                           <li class="list-group-item">Quantity: {{orders.qty}}</li>
                        </ul>
                    </div>
                     <div class="col-lg-6 col-md-6 col-6">
                        <ul class="list-group">
                             <li class="list-group-item">Sub Total: {{orders.sub_total}}</li>
                            <li class="list-group-item">Vat:  {{orders.vat}} %</li>
                            <li class="list-group-item">Total: {{orders.total}}</li>
                            <li class="list-group-item">Pay: {{orders.pay}}</li>
                            <li class="list-group-item">Due: {{orders.due}}</li>
                            <li class="list-group-item">Through: {{orders.payby}}</li>


                        </ul>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
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
                                            <th>Product Name</th>
                                            <th>Code</th>
                                            <th> Image</th>
                                            <th> Qty</th>
                                            <th> Unit Price</th>                                          
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <tr v-for="detail in details " :key="detail.id">

                                            <td>{{ detail.product_name}}</td>
                                            <td>{{ detail.product_code}}</td>
                                            <td> 
                                              <img :src="detail.image" alt="" id="em_photo">

                                            </td> 
                                            <td>{{ detail.pro_quantity}}</td>
                                            <td>{{ detail.product_price}}</td> 
                                            <td>{{ detail.sub_total}}</td>                                         
                                        
                                            

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
import axios from 'axios'

export default{
   mounted(){
       if(!User.loggedIn()){
           this.$router.push({name:'/'})

       }
   },
    data(){
        return {
           
           errors:{},
            orders:{},
            details:{},
        }
      
    },
    created(){

        let id = this.$route.params.id
        axios.get('/api/order/details/'+id)
        .then(({data}) => (this.orders = data))
        .catch()

        axios.get('/api/order/order_details/'+id)
        .then(({data}) => (this.details = data))
        .catch()


   
    },
    
   
}

</script>

<style>
#em_photo{
    height: 40px;
    width: 40px;
}
</style>