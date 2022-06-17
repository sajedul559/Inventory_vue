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
               <i class="fas fa-chart-area"></i>Employee Salary Pay
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
                                            <th>Month</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <tr v-for="salary in filtersearch " :key="salary.id">

                                            <td>{{ salary.name}}</td>
                            

                                            <td>{{ salary.salary_month}}</td>
                                            <td>{{ salary.amount}}</td>              
                                            <td>{{ salary.salary_date}}</td>


                                            <td>
                                                <router-link  :to="{name:'edit_salary',params:{id:salary.id}}" class="btn btn-sm btn-info">Edit Salary</router-link>

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
         salaries:[],
         searchTerm:''
        }
        
    },
    computed:{
      filtersearch(){
        return  this.salaries.filter(salary => {
          return    salary.name.match(this.searchTerm)
          })
      }
      
    },
    methods:{
        viewSalary(){
            let id = this.$route.params.id
            axios.get('/api/salary/view/'+id)
         .then(({data}) => (this.salaries = data))
         .catch( error => this.errors = error.response.data.errors)

        },
       
    },
    created(){
        this.viewSalary();
    }
}
</script>

<style>
#em_photo{
    height:40px;
    width:40px;
}
</style>
