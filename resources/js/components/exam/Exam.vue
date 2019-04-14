<template>
   <div >   
    <div class="row" >
                        <div class="col-md-12  " v-if='$gate.isAdmin()'>
                           
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    
<router-link :to="{ name: 'addexam'}" tag='button' class="btn btn-primary">Add Exam</router-link>
<h4 class="card-title">Exam Information</h4>
<div class="form-group" ><input type="text" class="form-control" placeholder="Search for children..." v-model='search' @keyup='searchit'>

            </div> 
                                    </div>

                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                        <tr>
                                               
                        <th>Exam ID</th>
                        <th>Exam Title</th> 
                        <th>Exam Date</th> 
                        <th>Exam Start Time</th> 
                        <th>Exam Class</th> 
                        
                        
                        <th>Action</th>
                        </tr>
                        </thead>
                                        <tbody>
                    <tr v-for="exam in exams.data">
                    <td>{{ exam.id }}</td>
                    <td>{{ exam.exam_title }}</td>
                    <td>{{ exam.exam_date }}</td>
                    <td>{{ exam.exam_time }}</td>
                    <td>{{ exam.class_number }}</td>
                   
 
                   <td>
                    <router-link :to="{ name: 'singleexam', params: { id: exam.id }}"tag='button' class="btn btn-primary"><i class="fa fa-eye"></i></router-link>

                    <router-link :to="{ name: 'editexam', params: { id: exam.id }}" tag='button' class="btn btn-info"><i class="fa fa-eye"></i>
                    </router-link>

                    <button type="button" @click="deleteexam(exam.id)" class="btn btn-danger "><i class="fa fa-trash"></i>
                    </button>
                  </td>


                    </tr> 
                    <pagination :data="exams" @pagination-change-page="loadexams"></pagination> 
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
      search:'',
      
    }
  },
  methods: {
          loadexams(page = 1){
          axios.get('/examinfo?page=' + page)
            .then(({ data }) => 
            { 
               this.exams=data;
               console.log(data);
                
            }
            )
          },
          searchit() {
     axios.get('/examinfo?q=' + this.search)
            .then(({ data }) => 
            { 
               this.exams=data;
               console.log(data);
                
            }
            )
   
    }
    ,
    deleteexam(id) {
      swal({
        title: "Are you sure?",
        // text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        if (result.value) {
          axios.delete("/examinfo/" + id).then(({ data }) => {
            this.loadexams();
            this.successmsg();
            console.log(data);
          });
        }
      });
    }
  
    
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
