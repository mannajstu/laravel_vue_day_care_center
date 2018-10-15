<template>
    
        

                 <div class="row ">
                    <div col-md-12>
                           
                 
                    
                <div class="col-md-6">
                  <!--   Kitchen Sink -->
                    <div class="panel panel-default">
                        
                        <div class="panel-heading">

                        <router-link to='/doctor' tag='button' class='btn btn-primary'>Back</router-link>
                    
                           <h3>Doctor Information</h3> 
                            
                        </div>
                    

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    
                                    <tbody>
                                        <tr>
                                            <th>Doctor Name</th>
                                            <td>{{ doctor.doctor_name }}</td>
                                            
                                        </tr>
                                        
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ doctor.doctor_email }}</td>
                                        </tr>

                                <tr>
                                      <th>Contact Number</th>
                                      <td>{{ doctor.contact_number }}</td>
                                </tr>
                                <tr>
                                      <th>Contact Address</th>
                                      <td>{{ doctor.contact_address }}</td>
                                </tr>



                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                        </div>
<!-- end col-md-6 -->
<div class="col-md-12">
                  <!--   Kitchen Sink -->
                    <div class="panel panel-default">
                        
                        <div class="panel-heading">

                        <router-link to='/child' tag='button' class='btn btn-primary'>All Child</router-link>
                    
                           <h3>Child Information</h3> 
                            
                        </div>
                    

                         <div class="card-body table-full-width table-responsive">
                                     <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                        <th>ID</th>
                        <th>Child Name</th>
                        

                        <th>Birth Reg No</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                                        <tbody>
                    <tr v-for="child in children">
                        
                    <td>{{ child.id }}</td>
                    <td>{{ child.child_name }}</td>
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

                       <!--  end -col -->

                </div>
                
            </div>
             
</template>

<script>
    export default {

        data () {
    return {
      // Create a new form instance
      
      doctor:{},
      children:{},
     
      
    }
  },
  methods: {
    singledoctor () {
      // Submit the form via a POST request
      let id=this.$route.params.id;
      axios.get('/doctorinfo/'+id)
        .then(({ data }) => 
        { 
           this.doctor=data;
           this.children=data.childinfos;

           console.log(data);
        }
        )
    },
   
  },
        created() {
            this.singledoctor()
        },
     

    }
</script>
