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
                            <li class="list-group-item btn-info text-white">Customer Details</li>
                             <li class="list-group-item">{{orders.name}}</li>
                            <li class="list-group-item">just tesignkfls</li>
                            <li class="list-group-item">just tesignkfls</li>
                            <li class="list-group-item">just tesignkfls</li>

                        </ul>

                    </div>
                     <div class="col-lg-6 col-md-6 col-6">
                        <ul class="list-group">
                             <li class="list-group-item">just tesignkfls</li>
                            <li class="list-group-item">just tesignkfls</li>
                            <li class="list-group-item">just tesignkfls</li>
                            <li class="list-group-item">just tesignkfls</li>
                            <li class="list-group-item">just tesignkfls</li>

                        </ul>

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
</style>