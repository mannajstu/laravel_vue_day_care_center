<template>
   <div >   
    <div class="row" >
                        <div class="col-md-12  " v-if='$gate.isAdmin()'>
                           
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    

<h4 class="card-title">Guest Message</h4>
<div class="form-group" ><input type="text" class="form-control" placeholder="Search for children..." v-model='search' @keyup='searchit'>

            </div> 
                                    </div>

                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                        <tr>
                                               
                        <th>ID</th>
                        <th>Subject</th> 
                        <th>Email</th> 
                        <th>Contact Number</th> 
                                               
                        <th>Action</th>
                        </tr>
                        </thead>
                                        <tbody>
                    <tr v-for="guest in guests.data">
                    <td>{{ guest.id }}</td>
                    <td>{{ guest.subject }}</td>
                    <td>{{ guest.email }}</td>
                    <td>{{ guest.contact_number }}</td>
                                      
 
                   <td>                    

                    <button type="button" class="btn btn-danger "><i class="fa fa-trash"></i>
                    </button>
                  </td>


                    </tr> 
                    <pagination :data="guests" @pagination-change-page="loadguests"></pagination> 
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
      guests:{},
      search:'',
      
    }
  },
  methods: {
          loadguests(page = 1){
          axios.get('/guesttoadminmsg?page=' + page)
            .then(({ data }) => 
            { 
               this.guests=data;
               console.log(data);
                
            }
            )
          },
          searchit() {
     axios.get('/guesttoadminmsg?q=' + this.search)
            .then(({ data }) => 
            { 
               this.guests=data;
               console.log(data);
                
            }
            )
   
    },
  
    
  },
        created() {
            this.loadguests();
            
           
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
