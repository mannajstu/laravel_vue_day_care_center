<template>
   <div >   
    <div class="row" >
                        <div class="col-md-12">
                           
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    
                                    <router-link :to="{ name: 'adduser'}" tag='button' class="btn btn-primary">Add Admin</router-link>
                                    <h4 class="card-title">All User Information</h4>
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
                    <tr v-for="user in users">
                        
                   
                   
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
      users:{},
      
    }
  },
  methods: {
          loadusers(){
          axios.get('/userinfo')
            .then(({ data }) => 
            { 
               this.users=data;
               console.log(data);
                
            }
            )
          },
  
    
  },
        created() {
            this.loadusers();
           
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
