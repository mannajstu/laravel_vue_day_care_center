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
                                </div>

                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                        <th>ID</th>
                        <th>Child Name</th>
                        <th>Father Name</th>
                        <th>Mother Name</th> 
                        <th>Contact Number</th>

                        <th>Birth Reg No</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                                        <tbody>
                    <tr v-for="child in children">
                        
                    <td>{{ child.id }}</td>
                    <td>{{ child.child_name }}</td>
                    <td>{{ child.parentinfo.user.name }}</td>
                    <td>{{ child.parentinfo.mother_name }}</td>
                    <td>{{ child.parentinfo.user.contact_number }}</td>

                    <td>{{ child.birth_reg_no }}</td>


                    <td>
                       <router-link :to="{ name: 'singlechild', params: { id: child.id }}"tag='button' class="btn btn-primary"><i class="fa fa-eye"></i></router-link>
                       <router-link :to="{ name: 'editchild', params: { id: child.id }}"tag='button' class="btn btn-info"><i class="fa fa-eye"></i></router-link>
                    <button type="button" class="btn btn-danger "><i class="fa fa-trash"></i>
                    </button>
                  </td>


                    </tr>

                                           
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
      
    }
  },
  methods: {
    addchild () {
      // Submit the form via a POST request
      
            this.$router.push('/' );
        
    },
    
      
    loadchild(){
axios.get('/childinfo')
        .then(({ data }) => 
        { 
           this.children=data;
           console.log(data);
            
        }
        )
    },
        
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
