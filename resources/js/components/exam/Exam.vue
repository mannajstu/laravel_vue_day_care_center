<template>
   <div >   
    <div class="row" >
                        <div class="col-md-12  " v-if='$gate.isAdmin()'>
                           
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    
                                    <router-link :to="{ name: 'addexam'}" tag='button' class="btn btn-primary">Add Exam</router-link>
                                    <h4 class="card-title">Exam Information</h4>
                                    </div>

                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                                               
                        <th>Exam ID</th>
                        <th>Exam Title</th> 
                        <th>Exam Date</th> 
                        <th>Exam Time</th> 
                        
                        
                        <th>Action</th>
                        </tr>
                        </thead>
                                        <tbody>
                    <tr v-for="exam in exams">
                        
                   
                   
                    <td>{{ exam.id }}</td>
                    <td>{{ exam.exam_title }}</td>
                    <td>{{ exam.exam_date }}</td>
                    <td>{{ exam.exam_time }}</td>
                   
 
                   <td>
                    <router-link :to="{ name: 'singleexam', params: { id: exam.id }}"tag='button' class="btn btn-primary"><i class="fa fa-eye"></i></router-link>

                    <router-link :to="{ name: 'editexam', params: { id: exam.id }}" tag='button' class="btn btn-info"><i class="fa fa-eye"></i>
                    </router-link>

                    <button type="button" class="btn btn-danger "><i class="fa fa-trash"></i>
                    </button>
                  </td>


                    </tr>  
                      </tbody>
                                    </table>
                                </div>
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
      exams:{},
      
    }
  },
  methods: {
          loadexams(){
          axios.get('/examinfo')
            .then(({ data }) => 
            { 
               this.exams=data;
               console.log(data);
                
            }
            )
          },
  
    
  },
        created() {
            this.loadexams();
            
           
        },
  //       computed: {
  //   filteredList() {
  //     return this.children.filter(childrens => {
  //       return childrens.child_name.toLowerCase().includes(this.search.toLowerCase())
  //     })
  //   }
  // }
     

    }
</script>
