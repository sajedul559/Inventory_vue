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
               <router-link to="/store_supplier" class="btn btn-sm btn-info float-right" id="add_new">Add New Supplier</router-link>
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
                                            <th>Photo</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Shop Name </th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <tr v-for="supplier in filtersearch " :key="supplier.id">

                                            <td>{{ supplier.name}}</td>
                                            <td>
                                                <img :src="supplier.photo" alt="" id="em_photo">
                                            </td>

                                            <td>{{ supplier.phone}}</td>
                                            <td>{{ supplier.address}}</td>
                                            <td>{{ supplier.shopname}}</td>
                                            <td>
                                                <a  @click="deleteSupplier(supplier.id)" class="btn btn-sm btn-danger">Delete</a>
                                                <router-link  :to="{name:'edit_supplier',params:{id:supplier.id}}" class="btn btn-sm btn-info">Edit</router-link>

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
         suppliers:[],
         searchTerm:''
        }
        
    },
    computed:{
      filtersearch(){
        return  this.suppliers.filter(supplier => {
          return    supplier.phone.match(this.searchTerm)
          })
      }
      
    },
    methods:{
        allSupplier(){
            
            axios.get('/api/supplier/')
            .then(({data}) => (this.suppliers = data))
            .catch()
        },
        deleteSupplier(id){
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
                axios.delete('/api/supplier/'+id)
                .then(()=>{
                    this.suppliers  = this.suppliers.filter(supplier =>{
                        return supplier.id != id

                    })
                })
                .catch(() =>{
                    this.$router.push({name:'supplier'})
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
        this.allSupplier();
    }
}
</script>

<style>
#em_photo{
    height:40px;
    width:40px;
}
</style>
