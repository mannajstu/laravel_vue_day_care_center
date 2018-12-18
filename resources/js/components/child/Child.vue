<template>
  <div >  
   <div class="row" >
                        <div class="col-md-12">
                           
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    <button type="button" class="btn btn-danger" data-toggle="modal" @click="addchild()">
                                    Add Child
                                    </button>
                                    <h4 class="card-title">Children Information</h4>
            <div class="form-group" ><input type="text" class="form-control" placeholder="Search for children..." v-model='search' @keyup='searchchild'>

            </div> 
                                </div>

                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                        <tr>
                        <th>ID</th>
                        <th>Child Name</th>
                        <th>Father Name</th>
                        <th>Mother Name</th>
                        <th>Contact Number</th>
                                               

                        <th>Birth Reg No</th>
                        <th>Birth Day</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                                        <tbody>
                    <tr v-for="child in children.data">
                        
                    <td>{{ child.id }}</td>
                    <td>{{ child.child_name }}</td>
                    <td>{{ child.parentinfo.user.name }}</td>
                    <td>{{ child.parentinfo.mother_name }}</td>
                    <td>{{ child.parentinfo.user.contact_number }}</td>
                    
                    <td>{{ child.birth_reg_no }}</td>
                    <td>{{ child.birth_date }}</td>


                    <td>
                       <router-link :to="{ name: 'singlechild', params: { id: child.id }}"tag='button' class="btn btn-primary"><i class="fa fa-eye"></i></router-link>
                       <router-link :to="{ name: 'editchild', params: { id: child.id }}"tag='button' class="btn btn-info"><i class="fa fa-eye"></i></router-link>
                    <button type="button" class="btn btn-danger "><i class="fa fa-trash"></i>
                    </button>
                  </td>


                    </tr>
                    <pagination :data="children" @pagination-change-page="loadchild"></pagination>

                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- col-md-12 end -->
                        
                    </div>
                    <!-- end row -->
                 <!--  modal start  -->

                


                        
                            </div>

             
</template>

<script>
    export default {

        data () {
    return {
      // Create a new form instance
      
     children:{},
     search:'',
      
    }
  },
  methods: {
    addchild () {
      // Submit the form via a POST request
      
            this.$router.push('/home' );
        
    },
    
      
    loadchild(page = 1){
axios.get('/childinfo?page=' + page)
        .then(({ data }) => 
        { 
           this.children=data;
           console.log(data);
            
        }
        )
    },
     searchchild() {
     axios.get('/childinfo?q=' + this.search)
            .then(({ data }) => 
            { 
               this.children=data;
               console.log(data);
                
            }
            )
   
    },
        
  },
   beforeCreate(){
if(!this.$gate.isAdmin()){
    this.$router.push({ name: 'notfound'})
}
},
        created() {
            this.loadchild();
            // this.$on('updatechild',()=>{
            //     this.loadchild();
            // });
        },

  //       computed: {
  //   filteredList() {
  //     return this.children.filter(childrens => {
  //       return childrens.child_name.toLowerCase().includes(this.search.toLowerCase())
  //     })
  //   }
  // }
     

    }
</script>
