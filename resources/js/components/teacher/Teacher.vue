<template>
   <div >   
    <div class="row" >
                        <div class="col-md-12">
                           
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    
                                    <router-link :to="{ name: 'addteacher'}" tag='button' class="btn btn-primary">Add Teacher</router-link>
                                    <h4 class="card-title">Teacher Information</h4>
                                               <div class="form-group" ><input type="text" class="form-control" placeholder="Search for children..." v-model='search' @keyup='searchit'>

            </div> 
                                    </div>

                                 <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                        <tr>
                                               
                        <th>Teacher Name</th>
                        <th>Teacher ID</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Contact Address</th>
                      
                        
                        <th>Action</th>
                        </tr>
                        </thead>
                                        <tbody>
                    <tr v-for="teacher in teachers.data">
                        
                   
                   
                    <td>{{ teacher.id }}</td>
                    <td>{{ teacher.user.name }}</td>
                    <td>{{ teacher.user.email}}</td>
                    <td>{{ teacher.user.contact_number }}</td>
                    <td>{{ teacher.contact_address }}</td>
                   
 
                   <td>
                    <router-link :to="{ name: 'singleteacher', params: { id: teacher.id }}"tag='button' class="btn btn-primary"><i class="fa fa-eye"></i></router-link>

                    <router-link :to="{ name: 'editteacher', params: { id: teacher.id }}"tag='button' class="btn btn-info"><i class="fa fa-eye"></i>
                    </router-link>

                    <button type="button" @click="deleteteacher(teacher.id)" class="btn btn-danger "><i class="fa fa-trash"></i>
                    </button>
                  </td>


                    </tr>  
                    <pagination :data="teachers" @pagination-change-page="loadteachers"></pagination>
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
  data() {
    return {
      // Create a new form instance
      teachers: {},
      search: ""
    };
  },
  methods: {
    loadteachers(page = 1) {
      axios.get("/teacherinfo?page=" + page).then(({ data }) => {
        this.teachers = data;
        console.log(data);
      });
    },
    searchit() {
      axios.get("/teacherinfo?q=" + this.search).then(({ data }) => {
        this.teachers = data;
        console.log(data);
      });
    },
    deleteteacher(id) {
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
          axios.delete("/teacherinfo/" + id).then(({ data }) => {
            this.loadteachers();
            this.successmsg();
            console.log(data);
          });
        }
      });
    }
  },
  //method end

  beforeCreate() {
    if (!this.$gate.isAdmin()) {
      this.$router.push({ name: "notfound" });
    }
  },
  created() {
    this.loadteachers();
  }
  //       computed: {
  //   filteredList() {
  //     return this.children.filter(childrens => {
  //       return childrens.child_name.toLowerCase().includes(this.search.toLowerCase())
  //     })
  //   }
  // }
};
</script>
