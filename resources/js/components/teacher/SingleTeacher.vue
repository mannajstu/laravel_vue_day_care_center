<template>
    
        

                 <div class="row ">
                    <div col-md-12>
                           
                 
                    
                <div class="col-md-6">
                  <!--   Kitchen Sink -->
                    <div class="panel panel-default">
                        
                        <div class="panel-heading">

                        <router-link to='/Teacher' tag='button' class='btn btn-primary'>Back</router-link>
                    
                           <h3>Teacher Information</h3> 
                            
                        </div>
                    

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    
                                    <tbody>
                                        <tr>
                                            <th>Teacher Name</th>
                                            <td>{{ teacher.user.name }}</td>
                                            
                                        </tr>
                                        
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ teacher.user.email }}</td>
                                        </tr>

                                <tr>
                                      <th>Contact Number</th>
                                      <td>{{ teacher.user.contact_number }}</td>
                                </tr>
                                <tr>
                                      <th>Contact Address</th>
                                      <td>{{ teacher.contact_address }}</td>
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
      
      teacher:{},
      children:{},
     
      
    }
  },
  methods: {
    singleteacher () {
      // Submit the form via a POST request
      let id=this.$route.params.id;
      axios.get('/teacherinfo/'+id)
        .then(({ data }) => 
        { 
           this.teacher=data;
           this.children=data.childinfos;

           console.log(data);
        }
        )
    },
   
  },
  beforeCreate(){
if(!this.$gate.isAdminTeacher()){
    this.$router.push({ name: 'notfound'})
}
},
        created() {
            this.singleteacher()
        },
     

    }
</script>
