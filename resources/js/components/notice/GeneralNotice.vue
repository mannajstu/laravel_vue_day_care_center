<template>
   <div >   
    <div class="row" >
                        <div class="col-md-12  " v-if='$gate.isAdmin()'>
                           
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    
<router-link :to="{ name: 'addgeneralnotice'}" tag='button' class="btn btn-primary">Add General Notice</router-link>
<h4 class="card-title">General Notice</h4>
<div class="form-group" ><input type="text" class="form-control" placeholder="Search for children..." v-model='search' @keyup='searchit'>

</div> 
                                    </div>

                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                        <tr>
                                               
                        <th>ID</th>
                        <th>Title</th> 
                        <th>Description</th>
                        
                        <th>Action</th>
                        </tr>
                        </thead>
                                        <tbody>
                    <tr v-for="generalnotice in generalnotices.data">
                        
                   
                   
                    <td>{{ generalnotice.id }}</td>
                    <td>{{ generalnotice.title }}</td>
                    <td>{{ generalnotice.description.substring(0, 100)+'...' }}</td>
                   
 
                   <td>
                    <router-link :to="{ name: 'singlegeneralnotice', params: { id: generalnotice.id }}"tag='button' class="btn btn-primary"><i class="fa fa-eye"></i></router-link>

                    <router-link :to="{ name: 'editgeneralnotice', params: { id: generalnotice.id }}"tag='button' class="btn btn-info"><i class="fa fa-eye"></i>
                    </router-link>

                    <button type="button" @click="deletegeneralnotice(generalnotice.id)" class="btn btn-danger "><i class="fa fa-trash"></i>
                    </button>
                  </td>


                    </tr> 
                    <pagination :data="generalnotices" @pagination-change-page="loadgeneralnotices"></pagination>  
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
      generalnotices:{},
      
    }
  },
  methods: {
          loadgeneralnotices(page = 1){
          axios.get('/generalnoticeinfo?page=' + page)
            .then(({ data }) => 
            { 
               this.generalnotices=data;
               console.log(data);
                
            }
            )
          },
          searchit() {
     axios.get('/generalnoticeinfo?q=' + this.search)
            .then(({ data }) => 
            { 
               this.generalnotices=data;
               console.log(data);
                
            }
            )
   
    },
    deletegeneralnotice(id) {
      swal({
        title: "Are you sure?",
        // text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        if (result.value) {
          axios.delete("/generalnoticeinfo/" + id).then(({ data }) => {
            this.loadgeneralnotices();
            this.successmsg();
            console.log(data);
          });
        }
      });
    }
  
    
  },
        created() {
            this.loadgeneralnotices();
            
           
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
