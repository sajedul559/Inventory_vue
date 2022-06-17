<template>
  <div>
      <ol class="breadcrumb">
          <li class="breadcrumb-item">
              <a> Dashboard</a>
          </li>
          <li class="breadcrumb-item active">
              <a> Add Expense</a>
          </li>
      </ol>
     <div class="card">
            <div class="card-header">
               <i class="fas fa-chart-area"></i>Expense Update
               <router-link to="/category" class="btn btn-sm btn-info" id="add_new">All Expense</router-link>
            </div>


        <div class="card o-hidden border-0 shadow-lg my-5">
            
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Insert New Expense</h1>
                            </div>
                            <form @submit.prevent="expenseUpdate" class="user">
                                
                                <div class="form-group row">

                                    <div class="col-sm-12 col-md-12 mb-3 mb-sm-0">
                                       <textarea class="form-control" rows="4" v-model="form.details"></textarea>

                                    </div>
                                    
                                </div>
                                <div class="form-group row">

                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="expense_amount">Expense Amount</label>

                                        <input type="text" class="form-control form-control-user" id="amount"
                                            placeholder="Enter your amount" v-model="form.amount">
                                        <small class="text-danger" v-if="errors.amount">{{errors.amount[0]}}</small>

                                    </div>
                                    <!-- <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="expense_date">Expense Date</label>
                                        <input type="date" class="form-control form-control-user" id="name"
                                            placeholder="Enter your product code" v-model="form.expense_date">
                                        <small class="text-danger" v-if="errors.expense_date">{{errors.expense_date[0]}}</small>

                                    </div> -->
                                    
                                </div>
                              
                               
                                <button  type="submit" class="btn btn-primary btn-user btn-block">
                                    Add Expense
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
                details:'',
                amount:'',
                expense_date:'',

                            
            },
            errors:{

            },
            expenses:''
        }
      
    },
  
    methods:{
      
        expenseUpdate(){
         let id = this.$route.params.id
          axios.patch('/api/expense/'+id,this.form)
          .then(() => {
               this.$router.push({ name:'expense'})
               Notification.success();

          })
          .catch( error => this.errors = error.response.data.errors)
            
        },
    },
    created(){
      let id = this.$route.params.id
      axios.get('/api/expense/'+id)
      .then(({data }) => (this.form = data))
      .catch(console.log('error load edit component'))

    },
   
}

</script>

<style>
</style>