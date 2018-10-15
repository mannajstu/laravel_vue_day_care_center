<template>
   <div >   
    <div class="row" >
                        <div class="col-md-12">
                           
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    
                                    <router-link :to="{ name: 'adddoctor'}" tag='button' class="btn btn-primary">Add Doctor</router-link>
                                    <h4 class="card-title">Doctor Information</h4>
                                    </div>

                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                                               
                        <th>Doctor Name</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Contact Address</th>
                      
                        
                        <th>Action</th>
                        </tr>
                        </thead>
                                        <tbody>
                    <tr v-for="doctor in doctors">
                        
                   
                   
                    <td>{{ doctor.doctor_name }}</td>
                    <td>{{ doctor.doctor_email}}</td>
                    <td>{{ doctor.contact_number }}</td>
                    <td>{{ doctor.contact_address }}</td>
                   
 
                   <td>
                    <router-link :to="{ name: 'singledoctor', params: { id: doctor.id }}"tag='button' class="btn btn-primary"><i class="fa fa-eye"></i></router-link>

                    <router-link :to="{ name: 'editdoctor', params: { id: doctor.id }}"tag='button' class="btn btn-info"><i class="fa fa-eye"></i>
                    </router-link>

                    <button type="button" class="btn btn-danger "><i class="fa fa-trash"></i>
                    </button>
                  </td>


                    </tr>  
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
      
    }
  },
  methods: {
          loaddoctors(){
          axios.get('/doctorinfo')
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
