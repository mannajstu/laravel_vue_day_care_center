<template>
   <div >   
    <div class="row" >
                        <div class="col-md-12  " v-if='$gate.isAdmin()'>
                           
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    
                                    <router-link :to="{ name: 'addroom'}" tag='button' class="btn btn-primary">Add Room</router-link>
                                    <h4 class="card-title">Room Information</h4>
                                    <div class="form-group" ><input type="text" class="form-control" placeholder="Search for children..." v-model='search' @keyup='searchit'>

            </div> 
                                </div>

                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                        <tr>
                                               
                        <th>Room Number</th>
                        <th>Room Capacity</th> 
                        <th>Room Description</th>
                        
                        <th>Action</th>
                        </tr>
                        </thead>
                                        <tbody>
                    <tr v-for="room in rooms.data">
                        
                   
                   
                    <td>{{ room.room_number }}</td>
                    <td>{{ room.room_capacity }}</td>
                    <td>{{ room.room_description }}</td>
                   
 
                   <td>
                    <router-link :to="{ name: 'singleroom', params: { id: room.room_number }}"tag='button' class="btn btn-primary"><i class="fa fa-eye"></i></router-link>

                    <router-link :to="{ name: 'editroom', params: { id: room.room_number }}"tag='button' class="btn btn-info"><i class="fa fa-eye"></i>
                    </router-link>

                    <button type="button" @click="deleteroom(room.id)" class="btn btn-danger "><i class="fa fa-trash"></i>
                    </button>
                  </td>


                    </tr>  
                    <pagination :data="rooms" @pagination-change-page="loadrooms"></pagination>
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
      rooms:{},
      search:'',

      
    }
  },
  methods: {
          loadrooms(page = 1){
          axios.get('/roominfo?page=' + page)
            .then(({ data }) => 
            { 
               this.rooms=data;
               console.log(data);
                
            }
            )
          },
           searchit() {
     axios.get('/roominfo?q=' + this.search)
            .then(({ data }) => 
            { 
               this.rooms=data;
               console.log(data);
                
            }
            )
   
    },
    deleteroom(id) {
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
          axios.delete("/roominfo/" + id).then(({ data }) => {
            this.loadrooms();
            this.successmsg();
            console.log(data);
          });
        }
      });
    }
  
    
  },
        created() {
            this.loadrooms();
            
           
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
