<template>
  <div>
      <ol class="breadcrumb">
          <li class="breadcrumb-item">
              <a> Dashboard</a>
          </li>
          <li class="breadcrumb-item active">
              <a> Pay Salary</a>
          </li>
      </ol>
     <div class="card">
            <div class="card-header">
               <i class="fas fa-chart-area"></i>Pay Salary
               <router-link to="/employee" class="btn btn-sm btn-info" id="add_new">All Employee</router-link>
            </div>


        <div class="card o-hidden border-0 shadow-lg my-5">
            
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Pay Salary</h1>
                            </div>
                            <form @submit.prevent="salaryPaid" class="user">
                                
                                <div class="form-group row">

                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="name"
                                            placeholder="Enter your fullname" v-model="form.name">
                                        <small class="text-danger" v-if="errors.name">{{errors.name[0]}}</small>

                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="email" class="form-control form-control-user" id="email"
                                            placeholder="Enter email Address" v-model="form.email">
                                    <small class="text-danger" v-if="errors.email">{{errors.email[0]}}</small>

                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                      <label for="">Month</label>
                                       <select name="cars form-control orm-control-user" class="form-control" id="cars" v-model="form.salary_month">
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="Merch">Merch</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            <option value="Julay">Julay</option>
                                            <option value="Auguest">Auguest</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="Devember">Devember</option>


                                            
                                       </select>

                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="">salary</label>

                                        <input type="text" class="form-control form-control-user" id="salary"
                                            placeholder="Enter your salary" v-model="form.salary">
                                    <small class="text-danger" v-if="errors.salary">{{errors.salary[0]}}</small>

                                    </div>
                                </div>
                              
                               
                                <button  type="submit" class="btn btn-primary btn-user btn-block">
                                    Pay Salary
                                </button>
                                <hr>
                                <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a>
                            </form>
                            <hr>
                            
                            <div class="text-center">
                               <router-link class="small" to="/">Already have an account? Login!</router-link>

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
            form:{
                name:'',
                email:'',
                salary:'',
                salary_month:'',
               

                
            },
            errors:{

            },
        }
      
    },
    created(){
      let id = this.$route.params.id
      axios.get('/api/employee/'+id)
      .then(({data }) => (this.form = data))
      .catch(console.log('error load edit component'))

    },
    methods:{
       
        salaryPaid(){
          let id = this.$route.params.id
          axios.post('/api/salary/paid/'+id,this.form)
          .then(() => {
            
               this.$router.push({ name:'given_salary'})
               Notification.success();

          })
           //.catch( error => this.errors = error.response.data.errors)
           .catch(() => {
                 Notification.error();

           })
            
        },
    }
   
}

</script>

<style>
</style>