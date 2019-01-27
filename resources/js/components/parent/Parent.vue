<template>
   <div >   
    <div class="row" >
                        <div class="col-md-12">
                           
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    
<router-link :to="{ name: 'addparent'}" tag='button' class="btn btn-primary">Add Parent</router-link>
<h4 class="card-title">Parent Information</h4>
<div class="form-group" ><input type="text" class="form-control" placeholder="Search for children..." v-model='search' @keyup='searchit'>

            </div> 
                                    </div>

                               <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                        <tr>
                        <th>ID</th>
                        
                        <th>Father Name</th>
                        <th>Mother Name</th> 
                        <th>Contact Number</th>
                        <th>Contact Address</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                                        <tbody>
                    <tr v-for="parent in parents.data">
                        
                    <td>{{ parent.id }}</td>
                   
                    <td>{{ parent.user.name }}</td>
                    <td>{{ parent.mother_name }}</td>
                    <td>{{ parent.user.contact_number }}</td>
                    <td>{{ parent.contact_address }}</td>
 
                   <td>
                    <router-link :to="{ name: 'singleparent', params: { id: parent.id }}"tag='button' class="btn btn-primary"><i class="fa fa-eye"></i></router-link>

                    <router-link :to="{ name: 'editparent', params: { id: parent.id }}"tag='button' class="btn btn-info"><i class="fa fa-eye"></i>
                    </router-link>

                    <button type="button" @click="deleteparent(parent.id)" class="btn btn-danger "><i class="fa fa-trash"></i>
                    </button>
                  </td>


                    </tr>  
                    <pagination :data="parents" @pagination-change-page="loadparents"></pagination>
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
      parents: {}
    };
  },
  methods: {
    loadparents(page = 1) {
      axios.get("/parentinfo?page=" + page).then(({ data }) => {
        this.parents = data;
        console.log(data);
      });
    },
    searchit() {
      axios.get("/parentinfo?q=" + this.search).then(({ data }) => {
        this.parents = data;
        console.log(data);
      });
    },
    deleteparent(id) {
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
          axios.delete("/parentinfo/" + id).then(({ data }) => {
            this.loadparents();
            this.successmsg();
            console.log(data);
          });
        }
      });
    }
  },
  beforeCreate() {
    if (this.$gate.isParent()) {
      this.$router.push({ name: "parentdashboard" });
    }
  },
  created() {
    this.loadparents();
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
