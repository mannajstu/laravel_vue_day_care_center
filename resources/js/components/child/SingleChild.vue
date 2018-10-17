<template>
    
        

                 <div class="row ">
                    <div col-md-12>
                           
                 
                    
                <div class="col-md-6">
                  <!--   Kitchen Sink -->
                    <div class="panel panel-default">
                        
                        <div class="panel-heading">

                        <router-link to='/child' tag='button' class='btn btn-primary'>Back</router-link>
                    
                           <h3>Child Information</h3> 
                            
                        </div>
                    

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    
                                    <tbody>
                                        <tr>
                                            <th>ID</th>
                                            <td>{{ child.id }}</td>
                                            
                                        </tr>
                                        <tr>
                                            <th>Child Name</th>
                                            <td>{{ child.child_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Father Name</th>
                                            <td>{{ child.parentinfo.user.name }}</td>
                                        </tr>

<tr>
                                            <th>Mother Name</th>
                                            <td>{{ child.parentinfo.mother_name }}</td>
                                        </tr>

<tr>
                                            <th>Birth Date</th>
                                            <td>{{ child.birth_date }}</td>
                                        </tr>

<tr>
                                            <th>Birth Reg No</th>
                                            <td>{{ child.birth_reg_no }}</td>
                                        </tr>

<tr>
                                            <th>Contact Number</th>
                                            <td>{{ child.parentinfo.user.contact_number }}</td>
                                        </tr>

<tr>
                                            <th>Contact Address</th>
                                            <td>{{ child.parentinfo.contact_address }}</td>
                                        </tr>

<tr>
                                            <th>Gender</th>
                                            <td>{{ child.gender }}</td>
                                        </tr>
                                        <tr>
                                            <th>Doctor Name</th>
                                            <td>{{ child.doctor.user.name }}</td>
                                        </tr><tr>
                                            <th>Teacher Name</th>
                                            <td>{{ child.teacher.user.name }}</td>
                                        </tr><tr>
                                            <th>Room No</th>
                                            <td>{{ child.room_number }}</td>
                                        </tr>
                                        

                                        
                                    </tbody>
                                </table>
                            </div>
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
      
      child:{},
     
      
    }
  },
  methods: {
    singlechild () {
      // Submit the form via a POST request
      let id=this.$route.params.id;
      axios.get('/childinfo/'+id)
        .then(({ data }) => 
        { 
           this.child=data;
           console.log(data);
        }
        )
    },
   
  },
        created() {
            this.singlechild()
        },
     

    }
</script>
