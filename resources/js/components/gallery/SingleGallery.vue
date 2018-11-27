<template>
    
        

                 <div class="row ">
                    <div col-md-12>
                           
                 
                    
                <div class="col-md-6">
                  <!--   Kitchen Sink -->
                    <div class="panel panel-default">
                        
                        <div class="panel-heading">

                        <router-link to='/gallerypage' tag='button' class='btn btn-primary'>Back</router-link>
                    
                           <h3>Image Information</h3> 
                            
                        </div>
                    

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    
                                    <tbody>
                                        <tr>
                                            <th>Title</th>
                                            <td>{{ gallery.title }}</td>
                                            
                                        </tr>
                                        
                                        <tr>
                                            <th>Image</th>
                                            <td><img :src="gallery.imagelink" alt="" style="width: 300px;height: 300px"></td>
                                        </tr>

                                <tr>
                                      <th>Slider</th>
                                     <td v-if="gallery.slider==1">Yes</td>
                    <td v-if="gallery.slider==0">No</td>
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
      
      gallery:{},
     
     
      
    }
  },
  methods: {
    singlegallery () {
      // Submit the form via a POST request
      let id=this.$route.params.id;
      axios.get('/galleryinfo/'+id)
        .then(({ data }) => 
        { 
           this.gallery=data;
           

           console.log(data);
        }
        )
    },
   
  },
        created() {
            this.singlegallery()
        },
     

    }
</script>
