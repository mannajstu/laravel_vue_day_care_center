<template>
     <div class="row ">
                    <div col-md-12>
                           
                     
                <div class="col-md-6">
                 
                    <div class="panel panel-default">
                        
                        <div class="panel-heading">

                        <router-link to='/' tag='button' class='btn btn-primary'>Back</router-link>
                       
                        
                    
                           <h3>Exam Information</h3> 
                            
                        </div>
                    

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    
                                    <tbody>
                                        <tr>
                                            <th>Exam ID</th>
                                            <td>{{ childexam.id }}</td>
                                            
                                        </tr>
                                        
                                        <tr>
                                            <th>Exam Title</th>
                                            <td>{{ childexam.exam_title }}</td>
                                        </tr>

                                <tr>
                                      <th>Exam Description</th>
                                      <td>{{ childexam.exam_description }}</td>
                                </tr>

                                <tr>
                                      <th>Exam Date</th>
                                      <td>{{ childexam.exam_date }}</td>
                                </tr>
                                <tr>
                                      <th>Exam Time</th>
                                      <td>{{ childexam.exam_time }}</td>
                                </tr>
                                



                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                        </div>

                       <!--  end -col -->

                </div>
                
            </div>
             
</template>

<script>
    export default {
        
props: ['childexam'],   
     

    }
</script>
