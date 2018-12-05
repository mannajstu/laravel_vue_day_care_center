<template>
    
        

                 <div class="row ">
                    <div col-md-12>
                           
                 
                    
                <div class="col-md-6">
                  <!--   Kitchen Sink -->
                    <div class="panel panel-default">
                        
                        <div class="panel-heading">

                        <router-link to='/parent' tag='button' class='btn btn-primary'>Back</router-link>
                    
                           <h3>Parent Information</h3> 
                            
                        </div>
                    

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    
                                    <tbody>
                                      <!--   <tr>
                                            <th>ID</th>
                                            <td>{{ parent.id }}</td>
                                            
                                        </tr>
                                        
                                        <tr>
                                            <th>Father Name</th>
                                            <td>{{ parent.user.name }}</td>
                                        </tr>

<tr>
                                            <th>Mother Name</th>
                                            <td>{{ parent.mother_name }}</td>
                                        </tr>


<tr>
                                            <th>Contact Number</th>
                                            <td>{{ parent.user.contact_number }}</td>
                                        </tr>
                                        <tr>
                                            <th>Contact Email</th>
                                            <td>{{ parent.user.email }}</td>
                                        </tr>

<tr>
                                            <th>Contact Address</th>
                                            <td>{{ parent.contact_address }}</td>
                                        </tr> -->
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                        </div>
<!-- end col-md-6 -->
<div class="col-md-12">
                 
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
      
      parent:{},
      children:{},
     
      
    }
  },
  methods: {
    singleparent () {
      // Submit the form via a POST request
      let id=this.$route.params.id;
      axios.get('/parentinfo/'+id)
        .then(({ data }) => 
        { 
           this.parent=data;
           this.children=data.childinfos;

           console.log(data);
        }
        )
    },
   
  },
  beforeCreate(){
if(!this.$gate.isParent()){
    this.$router.push({ name: 'notfound'})
}
},
        created() {
            this.singleparent()
        },
     

    }
</script>
