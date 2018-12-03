<template>
     <div class="row ">
                    <div col-md-12>
                           
                 
                    
                <div class="col-md-6">
                  <!--   Kitchen Sink -->
                    <div class="panel panel-default">
                        
                        <div class="panel-heading">

                        <router-link v-if="this.$gate.isAdmin()" to='/child' tag='button' class='btn btn-primary'>Back</router-link>
                        <router-link :to="{ name: 'parentdashboard'}" tag='button' class="btn btn-primary" v-if="this.$gate.isParent()">Back</router-link>
                        <router-link :to="{ name: 'doctordashboard'}" tag='button' class="btn btn-primary" v-if="this.$gate.isDoctor()">Back</router-link>
                        <router-link :to="{ name: 'teacherdashboard'}" tag='button' class="btn btn-primary" v-if="this.$gate.isTeacher()">Back</router-link>
                   
                           <h3>Parent To Teacher Message</h3> 
                            
                        </div>
                    

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    
                                    <tbody>
                                        <tr>
                                            <th>ID</th>
                                            <td>{{ parenttoteachermsg.id }}</td>
                                            
                                        </tr>
                                        <tr>
                                            <th>Subject</th>
                                            <td>{{ parenttoteachermsg.subject }}</td>
                                        </tr>
                                        <tr>
                                            <th>Message</th>
                                            <td>{{ parenttoteachermsg.message }}</td>
                                        </tr>


                           </tbody>
                         </table>
                       
                    </div>
                        </div>
                        <!-- col-md-6 -->
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
      
      parenttoteachermsg:{},
       
      }
  },
  methods: {
    singleparenttoteachermsg () {
      // Submit the form via a POST request
      let id=this.$route.params.id;
      axios.get('/singleparenttoteachermsg/'+id)
        .then(({ data }) => 
        { 
           this.parenttoteachermsg=data;
           console.log(data);
        }
        )
    },
     
   
  },
  beforeCreate(){
    if(!this.$gate.isParent() && !this.$gate.isAdmin() && !this.$gate.isDoctor() && !this.$gate.isTeacher()){
    this.$router.push({ name: 'notfound'})
}

},
  
        created() {
            this.singleparenttoteachermsg ()
            
        },
     

    }
</script>
