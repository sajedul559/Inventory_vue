<template>
  <div>
      <ol class="breadcrumb">
          <li class="breadcrumb-item">
              <a> Dashboard</a>
          </li>
          <li class="breadcrumb-item active">
              <a> Add Employee</a>
          </li>
      </ol>
     <div class="card">
            <div class="card-header">
               <i class="fas fa-chart-area"></i>Employee Insert
               <router-link to="/store_employee" class="btn btn-sm btn-info float-right" id="add_new">Add New</router-link>
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
                                            <th>Email</th>
                                            <th>Photo</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <tr v-for="customer in filtersearch " :key="customer.id">

                                            <td>{{ customer.name}}</td>
                                            <td>{{ customer.email}}</td>
                                            <td>
                                                <img :src="customer.photo" alt="" id="em_photo">
                                            </td>

                                            <td>{{ customer.phone}}</td>
                                            <td>{{ customer.address}}</td>
                                            <td>
                                                <a  @click="deleteCustomer(customer.id)" class="btn btn-sm btn-danger">Delete</a>
                                                <router-link  :to="{name:'customer_edit',params:{id:customer.id}}" class="btn btn-sm btn-info">Edit</router-link>

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
         customers:[],
         searchTerm:''
        }
        
    },
    computed:{
      filtersearch(){
        return  this.customers.filter(customer => {
          return    customer.phone.match(this.searchTerm)
          })
      }
      
    },
    methods:{
        allCustomer(){
            
            axios.get('/api/customer/')
            .then(({data}) => (this.customers = data))
            .catch()
        },
        deleteCustomer(id){
        Swal.fire({
            title:'Are you sure?',
            text:"You wan't be able to revert this!",
            type:'warning',
            showCancelButton:true,
            confirmButtonColor:'#3085d6',
            cancelButtonColor:'#d33',
            confirmButtonText:'Yes, delete it!',
           
        }).then((result) => {
            if(result.value){
                axios.delete('/api/customer/'+id)
                .then(()=>{
                    this.customers  = this.customers.filter(customer =>{
                        return customer.id != id

                    })
                })
                .catch(() =>{
                    this.$router.push({name:'customer'})
                })
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })

        }
    },
    created(){
        this.allCustomer();
    }
}
</script>

<style>
#em_photo{
    height:40px;
    width:40px;
}
</style>
