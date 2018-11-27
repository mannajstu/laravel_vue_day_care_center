<template>
    
        

                 <div class="row ">
                    <div col-md-12>
                           
                 
                    
                <div class="col-md-6">
                  <!--   Kitchen Sink -->
                    <div class="panel panel-default">
                        
                        <div class="panel-heading">

                        <router-link to='/' tag='button' v-if='!this.$gate.isAdmin()'class='btn btn-primary'>Back</router-link>
                        <router-link to='/generalnotice' v-if='this.$gate.isAdmin()' tag='button' class='btn btn-primary'>Back</router-link>
                    
                           <h3>General Notice </h3> 
                            
                        </div>
                    

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    
                                    <tbody>
                                        <tr>
                                            <th>General Notice Title</th>
                                            <td>{{ generalnotice.title }}</td>
                                            
                                        </tr>
                                        
                                        <tr>
                                            <th> General Notice Description</th>
                                            <td>{{ generalnotice.description }}</td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                        </div>
<!-- end col-md-6 -->


                       <!--  end -col -->

                </div>
                
            </div>
             
</template>

<script>
    export default {

        data () {
    return {
      // Create a new form instance
      
      generalnotice:{},
      
   }
  },
  methods: {
    singlegeneralnotice () {
      // Submit the form via a POST request
      let id=this.$route.params.id;
      axios.get('/generalnoticeinfo/'+id)
        .then(({ data }) => 
        { 
           this.generalnotice=data;
          console.log(data);
        }
        )
    },
   
  },
        created() {
            this.singlegeneralnotice()
        },
     

    }
</script>
