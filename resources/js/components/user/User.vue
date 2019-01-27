<template>
   <div >   
    <div class="row" >
                        <div class="col-md-12" v-if='$gate.isAdmin()'>
                           
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                   
               
                                    <router-link :to="{ name: 'adduser'}" tag='button' class="btn btn-primary">Add Admin</router-link>
            
                                    <h4 class="card-title">All User Information</h4>
                <div class="form-group" ><input type="text" class="form-control" placeholder="Search for users..." v-model='search' @keyup='searchit'>
                
                </div> 
              </div>

                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                        <tr>
                                               
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Role</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                                        <tbody>
                    <tr v-for="user in users.data">
                        
                   
                   
                    <td>{{user.id }}</td>
                    <td>{{user.name }}</td>
                    <td>{{ user.email}}</td>
                    <td>{{user.contact_number }}</td>
                    <td>

                        <tr class="alert alert-danger " v-for="role in user.roles">
                        {{ role.name }}
                        </tr>
                  </td>
                    
                   
 
                   <td>
                    <router-link :to="{ name: 'singleuser', params: { id: user.id }}"tag='button' class="btn btn-primary"><i class="fa fa-eye"></i></router-link>

                    <router-link :to="{ name: 'edituser', params: { id: user.id }}"tag='button' class="btn btn-info"><i class="fa fa-eye"></i>
                    </router-link>
                    

                    <button type="button" @click="deleteuser(user.id)" class="btn btn-danger "><i class="fa fa-trash"></i>
                    </button>
                  </td>


                    </tr>  
                    <pagination :data="users" @pagination-change-page="loadusers"></pagination>
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
      users: {},

      search: ""
    };
  },
  methods: {
    loadusers(page = 1) {
      axios.get("/userinfo?page=" + page).then(response => {
        this.users = response.data;
      });
    },

    searchit() {
      axios.get("/userinfo?q=" + this.search).then(({ data }) => {
        this.users = data;
        console.log(data);
      });
    },
    deleteuser(id) {
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
          axios.delete("/userinfo/" + id).then(({ data }) => {
            this.loadusers();
            console.log(data);
          });
        }
      });
    }
  },
  //end method
  beforeCreate() {
    if (!this.$gate.isAdmin()) {
      this.$router.push({ name: "notfound" });
    }
  },

  created() {
    this.loadusers();
  }
};
</script>
