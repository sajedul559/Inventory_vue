<template>
  <div>
      <ol class="breadcrumb">
          <li class="breadcrumb-item">
              <a> Dashboard</a>
          </li>
          <li class="breadcrumb-item active">
              <a> All Salary</a>
          </li>
      </ol>
     <div class="card">
            <div class="card-header">
               <i class="fas fa-chart-area"></i>All Salary  Details
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
                                            <th>Month Name</th>
                                            <th>Details</th>
                                            
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <tr v-for="salary in salaries " :key="salary.salary_month">

                                            <td>{{ salary.salary_month}}</td>
                                           
                                            <td>
                                                <router-link  :to="{name:'view_salary',params:{id:salary.salary_month}}" class="btn btn-sm btn-info">View Salary</router-link>

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
    // computed:{
    //   filtersearch(){
    //     return  this.salaries.filter(salary => {
    //       return    salary.amount.match(this.searchTerm)
    //       })
    //   }
      
    // },
    methods:{
        allSalary(){
            
            axios.get('/api/salary/')
            .then(({data}) => (this.salaries = data))
            .catch()
        },
       
    },
    created(){
        this.allSalary();
    }
}
</script>

<style>
#em_photo{
    height:40px;
    width:40px;
}
</style>
