<template>
  <div>
      <ol class="breadcrumb">
          <li class="breadcrumb-item">
              <a> Dashboard</a>
          </li>
          <li class="breadcrumb-item active">
              <a> Today Order</a>
          </li>
      </ol>
     <div class="card">
            <div class="card-header">
               <i class="fas fa-chart-area"></i> Today Orders Table
               <router-link to="/store_expense" class="btn btn-sm btn-info float-right" id="add_new">Add New Expense</router-link>
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
                                            <th>Total Amount</th>
                                            <th> Pay</th>
                                            <th> Due</th>
                                            <th> PayBy</th>                                          
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <tr v-for="order in orders " :key="order.id">

                                            <td>{{ order.name}}</td>
                                            <td>{{ order.total}}</td>
                                            <td>{{ order.pay}}</td>
                                            <td>{{ order.due}}</td>
                                            <td>{{ order.payby}}</td>                                         
                                            <td>
                                                <router-link  :to="{name:'view_order',params:{id:order.id}}" class="btn btn-sm btn-info">view</router-link>

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
            expenses:[],
            searchTerm:'',
            orders:''
        }

    },
    computed:{
      filtersearch(){
        return  this.orders.filter(order => {
          return    order.name.match(this.searchTerm)
          })
      }
      
    },
    methods:{
       allOrder(){
        axios.get('/api/orders')
        .then(({data})  => (this.orders = data))
        .catch(console.log('error'))
       },
        deleteexpense(id){
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
                axios.delete('/api/expense/'+id)
                .then(()=>{
                    this.expenses  = this.expenses.filter(expense =>{
                        return expense.id != id

                    })
                })
                .catch(() =>{
                    this.$router.push({name:'expense'})
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
        this.allOrder();
        
    }
}
</script>

<style>
#em_photo{
    height:40px;
    width:40px;
}
</style>
