<template>
   <div >   
    <div class="row" >
                        <div class="col-md-12">
                           
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    
                                    <router-link :to="{ name: 'addparent'}" tag='button' class="btn btn-primary">Add Parent</router-link>
                                    <h4 class="card-title">Parent Information</h4>
                                    </div>

                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
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
                    <tr v-for="parent in parents">
                        
                    <td>{{ parent.id }}</td>
                   
                    <td>{{ parent.user.name }}</td>
                    <td>{{ parent.mother_name }}</td>
                    <td>{{ parent.user.contact_number }}</td>
                    <td>{{ parent.contact_address }}</td>
 
                   <td>
                    <router-link :to="{ name: 'singleparent', params: { id: parent.id }}"tag='button' class="btn btn-primary"><i class="fa fa-eye"></i></router-link>

                    <router-link :to="{ name: 'editparent', params: { id: parent.id }}"tag='button' class="btn btn-info"><i class="fa fa-eye"></i>
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
      parents:{},
      
    }
  },
  methods: {
          loadparents(){
          axios.get('/parentinfo')
            .then(({ data }) => 
            { 
               this.parents=data;
               console.log(data);
            }
            )
          },
  
    
  },
  beforeCreate(){
if(!this.$gate.isAdminParent()){
    this.$router.push({ name: 'notfound'})
}
},
        created() {
            this.loadparents();
           
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
