<template>
   <div >   
    <div class="row" >
                        <div class="col-md-12  " v-if='$gate.isAdmin()'>
                           
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    
                                    <router-link :to="{ name: 'addclass'}" tag='button' class="btn btn-primary">Add Class</router-link>
                                    <h4 class="card-title">Class Information</h4><input type="text" class="form-control" placeholder="Search for children..." v-model='search' @keyup='searchit'>

            </div> 
                                </div>

                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                        <tr>
                                               
                        <th>Class Number</th>
                        
                        <th>Class Description</th>
                        
                        <th>Action</th>
                        </tr>
                        </thead>
                                        <tbody>
                    <tr v-for="classinfo in classinfos.data">
                        
                   
                   
                    <td>{{ classinfo.class_number }}</td>
                    
                    <td>{{ classinfo.class_description }}</td>
                   
 
                   <td>
                    <router-link :to="{ name: 'singleclass', params: { id: classinfo.class_number }}"tag='button' class="btn btn-primary"><i class="fa fa-eye"></i></router-link>

                    <router-link :to="{ name: 'editclass', params: { id: classinfo.class_number }}"tag='button' class="btn btn-info"><i class="fa fa-eye"></i>
                    </router-link>

                    <button type="button" class="btn btn-danger "><i class="fa fa-trash"></i>
                    </button>
                  </td>


                    </tr> 
                    <pagination :data="classinfos" @pagination-change-page="loadclasss"></pagination> 
                      </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                 

                   </div>

             
</template>

<script>
    export default {

        data () {
    return {
      // Create a new form instance
      classinfos:{},
      
    }
  },
  methods: {
          loadclasss(page = 1){
          axios.get('/classinfo?page=' + page)
            .then(({ data }) => 
            { 
               this.classinfos=data;
               console.log(data);
                
            }
            )
          },
          searchit() {
     axios.get('/classinfo?q=' + this.search)
            .then(({ data }) => 
            { 
               this.classinfos=data;
               console.log(data);
                
            }
            )
   
    },
  
    
  },
        created() {
            this.loadclasss();
            
           
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
