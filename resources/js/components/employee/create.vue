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
                                <h1 class="h4 text-gray-900 mb-4">Insert New Employee</h1>
                            </div>
                            <form @submit.prevent="employeeInsert" class="user">
                                
                                <div class="form-group row">

                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="fullname"
                                            placeholder="Enter your fullname" v-model="form.name">
                                        <small class="text-danger" v-if="errors.name">{{errors.name[0]}}</small>

                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="email" class="form-control form-control-user" id="email"
                                            placeholder="Email Address" v-model="form.email">
                                    <small class="text-danger" v-if="errors.email">{{errors.email[0]}}</small>

                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="address"
                                            placeholder="Enter your address..." v-model="form.address">
                                        <small class="text-danger" v-if="errors.address">{{errors.address[0]}}</small>

                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="salary"
                                            placeholder="Enter your salary" v-model="form.salary">
                                    <small class="text-danger" v-if="errors.salary">{{errors.salary[0]}}</small>

                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="joining_date"
                                            placeholder="Joining Date..." v-model="form.joining_date">
                                        <small class="text-danger" v-if="errors.joining_date">{{errors.joining_date[0]}}</small>

                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="nid"
                                            placeholder="Enter NID Number" v-model="form.nid">
                                    <small class="text-danger" v-if="errors.nid">{{errors.nid[0]}}</small>

                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="file" class="btn btn-info form-control " @change="onFileSelected">
                                        <small class="text-danger" v-if="errors.photo">{{errors.photo[0]}}</small>

                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <img :src="form.photo" style="height:40px; width:40px;">

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password" v-model="form.password">
                                        <small class="text-danger" v-if="errors.password">{{errors.password[0]}}</small>

                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password" v-model="form.password_confirmation">

                                    </div>
                                </div>
                                <button  type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
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
                address:'',
                photo:'',
                nid:'',
                joining_date:'',

                
            },
            errors:{

            },
        }
      
    },
    methods:{
        onFileSelected(event){
        let file = event.target.files[0];
        if(file.size > 1048770){
             Notification.image_validation()
        }else{

            let reader = new FileReader();
                reader.onload = event =>{
                    this.form.photo = event.target.result
                    console.log(event.target.result)
                };
                reader.readAsDataURL(file);          
        }
        },
        employeeInsert(){
            axios.post('/api/employee/',this.form)
            .then(()=>{
                this.$router.push({name:'employee '})
                Notification.success()
            })
            .catch(error => this.errors = error.response.data.errors)

        },
    }
   
}

</script>

<style>
</style>