<template>
   <div >   
    <div class="row" >
                        <div class="col-md-12">
                           
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    
                                    <router-link :to="{ name: 'addroom'}" tag='button' class="btn btn-primary">Add Room</router-link>
                                    <h4 class="card-title">Room Information</h4>
                                    </div>

                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                                               
                        <th>Room Number</th>
                        <th>Room Capacity</th> 
                        <th>Room Description</th>
                        
                        <th>Action</th>
                        </tr>
                        </thead>
                                        <tbody>
                    <tr v-for="room in rooms">
                        
                   
                   
                    <td>{{ room.room_number }}</td>
                    <td>{{ room.room_capacity }}</td>
                    <td>{{ room.room_description }}</td>
                   
 
                   <td>
                    <router-link :to="{ name: 'singleroom', params: { id: room.room_number }}"tag='button' class="btn btn-primary"><i class="fa fa-eye"></i></router-link>

                    <router-link :to="{ name: 'editroom', params: { id: room.id }}"tag='button' class="btn btn-info"><i class="fa fa-eye"></i>
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
      rooms:{},
      
    }
  },
  methods: {
          loadrooms(){
          axios.get('/roominfo')
            .then(({ data }) => 
            { 
               this.rooms=data;
               console.log(data);
                
            }
            )
          },
  
    
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
