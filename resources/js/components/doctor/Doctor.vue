<template>
   <div >   
    <div class="row" >
                        <div class="col-md-12">
                           
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    
                                    <router-link :to="{ name: 'adddoctor'}" tag='button' class="btn btn-primary">Add Doctor</router-link>
                                    <h4 class="card-title">Doctor Information</h4>
                                    <div class="form-group" ><input type="text" class="form-control" placeholder="Search for children..." v-model='search' @keyup='searchit'>

            </div> 
                                </div>

                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                        <tr>
                                               
                        <th>Doctor ID</th>
                        <th>Doctor Name</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Contact Address</th>
                      
                        
                        <th>Action</th>
                        </tr>
                        </thead>
                                        <tbody>
                    <tr v-for="doctor in doctors.data">
                        
                   
                   
                    <td>{{ doctor.id }}</td>
                    <td>{{ doctor.user.name }}</td>
                    <td>{{ doctor.user.email}}</td>
                    <td>{{ doctor.user.contact_number }}</td>
                    <td>{{ doctor.contact_address }}</td>
                   
 
                   <td>
                    <router-link :to="{ name: 'singledoctor', params: { id: doctor.id }}"tag='button' class="btn btn-primary"><i class="fa fa-eye"></i></router-link>

                    <router-link :to="{ name: 'editdoctor', params: { id: doctor.id }}"tag='button' class="btn btn-info"><i class="fa fa-eye"></i>
                    </router-link>

                    <button type="button" class="btn btn-danger "><i class="fa fa-trash"></i>
                    </button>
                  </td>


                    </tr>  
                    <pagination :data="doctors" @pagination-change-page="loaddoctors"></pagination>
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
      doctors:{},
      search:''
      
    }
  },
  methods: {
          loaddoctors(page = 1){
          axios.get('/doctorinfo?page=' + page)
            .then(({ data }) => 
            { 
               this.doctors=data;
               console.log(data);
                
            }
            )
          },
           searchit() {
     axios.get('/doctorinfo?q=' + this.search)
            .then(({ data }) => 
            { 
               this.doctors=data;
               console.log(data);
                
            }
            )
   
    },
  
    
  },
        created() {
            this.loaddoctors();
           
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
