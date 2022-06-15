<template>
  <div>
      <ol class="breadcrumb">
          <li class="breadcrumb-item">
              <a> Dashboard</a>
          </li>
          <li class="breadcrumb-item active">
              <a> All Category</a>
          </li>
      </ol>
     <div class="card">
            <div class="card-header">
               <i class="fas fa-chart-area"></i>Category Insert
               <router-link to="/store_category" class="btn btn-sm btn-info float-right" id="add_new">Add New Category</router-link>
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
                                            <th> Categorn Name</th>
                                           
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <tr v-for="category in categories " :key="category.id">

                                            <td>{{ category.category_name}}</td>
                                           
                                            <td>
                                                <a  @click="deletecategory(category.id)" class="btn btn-sm btn-danger">Delete</a>
                                                <router-link  :to="{name:'edit_category',params:{id:category.id}}" class="btn btn-sm btn-info">Edit</router-link>

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
         categories:[],
         searchTerm:''
        }
        
    },
    computed:{
      filtersearch(){
        return  this.categories.filter(category => {
          return    category.category_name.match(this.searchTerm)
          })
      }
      
    },
    methods:{
        allCategory(){
            
            axios.get('/api/category/')
            .then(({data}) => (this.categories = data))
            .catch()
        },
        deletecategory(id){
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
                axios.delete('/api/category/'+id)
                .then(()=>{
                    this.categories  = this.categories.filter(category =>{
                        return category.id != id

                    })
                })
                .catch(() =>{
                    this.$router.push({name:'category'})
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
        this.allCategory();
    }
}
</script>

<style>
#em_photo{
    height:40px;
    width:40px;
}
</style>
