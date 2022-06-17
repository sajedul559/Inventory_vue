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
                                            <th>Photo</th>
                                            <th>Phone</th>
                                            <th>Salary</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <tr v-for="employee in filtersearch " :key="employee.id">

                                            <td>{{ employee.name}}</td>
                                            <td>
                                                <img :src="employee.photo" alt="" id="em_photo">
                                            </td>

                                            <td>{{ employee.phone}}</td>
                                            <td>{{ employee.salary}}</td>
                                            <td>
                                                <router-link  :to="{name:'pay_salary',params:{id:employee.id}}" class="btn btn-sm btn-info">Pay Salary</router-link>

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
         employees:[],
         searchTerm:''
        }
        
    },
    computed:{
      filtersearch(){
        return  this.employees.filter(employee => {
          return    employee.phone.match(this.searchTerm)
          })
      }
      
    },
    methods:{
        allEmployee(){
            
            axios.get('/api/employee/')
            .then(({data}) => (this.employees = data))
            .catch()
        },
       
    },
    created(){
        this.allEmployee();
    }
}
</script>

<style>
#em_photo{
    height:40px;
    width:40px;
}
</style>
