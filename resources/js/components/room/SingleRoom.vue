<template>
    
        

                 <div class="row ">
                    <div col-md-12>
                           
                 
                    
                <div class="col-md-6">
                  <!--   Kitchen Sink -->
                    <div class="panel panel-default">
                        
                        <div class="panel-heading">

                        <router-link to='/room' tag='button' class='btn btn-primary'>Back</router-link>
                    
                           <h3>Room Information</h3> 
                            
                        </div>
                    

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    
                                    <tbody>
                                        <tr>
                                            <th>Room Number</th>
                                            <td>{{ room.room_number }}</td>
                                            
                                        </tr>
                                        
                                        <tr>
                                            <th>Room Capacity</th>
                                            <td>{{ room.room_capacity }}</td>
                                        </tr>

                                <tr>
                                      <th>Room Description</th>
                                      <td>{{ room.room_description }}</td>
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
      
      room:{},
      children:{},
     
      
    }
  },
  methods: {
    singleroom () {
      // Submit the form via a POST request
      let id=this.$route.params.id;
      axios.get('/roominfo/'+id)
        .then(({ data }) => 
        { 
           this.room=data;
           this.children=data.childinfos;

           console.log(data);
        }
        )
    },
   
  },
        created() {
            this.singleroom()
        },
     

    }
</script>
