<template>
    
        

                 <div class="row ">
                    <div col-md-12>
                           
                 
                    
                <div class="col-md-6">
                  <!--   Kitchen Sink -->
                    <div class="panel panel-default">
                        
                        <div class="panel-heading">

                        <router-link to='/class' tag='button' class='btn btn-primary'>Back</router-link>
                    
                           <h3>Class Information</h3> 
                            
                        </div>
                    

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    
                                    <tbody>
                                        <tr>
                                            <th>Class Number</th>
                                            <td>{{ classinfo.class_number }}</td>
                                            
                                        </tr>
                                        
                                        

                                <tr>
                                      <th>Class Description</th>
                                      <td>{{ classinfo.class_description }}</td>
                                </tr>


                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                        </div>
<!-- end col-md-6 -->
<div class="col-md-12">
                 <childchortinfo :children="children"></childchortinfo>
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
      
      classinfo:{},
      children:{},
     
      
    }
  },
  methods: {
    singleclass () {
      // Submit the form via a POST request
      let id=this.$route.params.id;
      axios.get('/classinfo/'+id)
        .then(({ data }) => 
        { 
           this.classinfo=data;
           this.children=data.childinfos;

           console.log(data);
        }
        )
    },
   
  },
        created() {
            this.singleclass()
        },
     

    }
</script>
