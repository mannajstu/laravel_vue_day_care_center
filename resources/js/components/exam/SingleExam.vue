<template>
     <div class="row ">
                    <div col-md-12>
                           
                     
                <div class="col-md-6">
                 
                    <div class="panel panel-default">
                        
                        <div class="panel-heading">

                        <router-link to='/exam' tag='button' class='btn btn-primary'>Back</router-link>
                         <router-link :to="{ name: 'addexamchild'}" tag='button' class="btn btn-danger">Add Child To Exam</router-link>
                    
                           <h3>Exam Information</h3> 
                            
                        </div>
                    

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    
                                    <tbody>
                                        <tr>
                                            <th>Exam ID</th>
                                            <td>{{ exam.id }}</td>
                                            
                                        </tr>
                                        
                                        <tr>
                                            <th>Exam Title</th>
                                            <td>{{ exam.exam_title }}</td>
                                        </tr>

                                <tr>
                                      <th>Exam Description</th>
                                      <td>{{ exam.exam_description }}</td>
                                </tr>

                                <tr>
                                      <th>Exam Date</th>
                                      <td>{{ exam.exam_date }}</td>
                                </tr>
                                <tr>
                                      <th>Exam Time</th>
                                      <td>{{ exam.exam_time }}</td>
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
      
      exam:{},
      children:{},
     
      
    }
  },
  methods: {
    singleexam () {
      // Submit the form via a POST request
      let id=this.$route.params.id;
      axios.get('/examinfo/'+id)
        .then(({ data }) => 
        { 
           this.exam=data;
           this.children=data.childinfos;

           console.log(data);
        }
        )
    },
   
  },
        created() {
            this.singleexam()
        },
     

    }
</script>
