<template>
   <div >   
    <div class="row" >
                        <div class="col-md-12">
                           
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    
                                    <router-link :to="{ name: 'addgallery'}" tag='button' class="btn btn-primary">Add Image</router-link>
                                    <h4 class="card-title">Image Information</h4>
                                  <div class="form-group" ><input type="text" class="form-control" placeholder="Search for children..." v-model='search' @keyup='searchit'>

            </div> 
                                </div>

                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                        <tr>
                        <th>ID</th>
                        
                        <th>Title</th>
                        <th>Image</th> 
                        <th>Slider</th>
                        
                        <th>Action</th>
                        </tr>
                        </thead>
                                        <tbody>
                    <tr v-for="gallery in galleries.data">
                        
                    <td>{{ gallery.id }}</td>
                   
                    <td>{{ gallery.title }}</td>
                    <td><img :src="gallery.imagelink" alt="" style="width: 100px;height: 100px"></td>
                    <td v-if="gallery.slider==1">Yes</td>
                    <td v-if="gallery.slider==0">No</td>
                    
 
                   <td>
                    <router-link :to="{ name: 'singlegallery', params: { id: gallery.id }}"tag='button' class="btn btn-primary"><i class="fa fa-eye"></i></router-link>
                  

                    <button type="button" @click="deleteimage(gallery.id)" class="btn btn-danger "><i class="fa fa-trash"></i>
                    </button>
                  </td>


                    </tr> 
                    <pagination :data="galleries" @pagination-change-page="loadgalleries"></pagination> 
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
      galleries:{},
      search:'',
      
    }
  },
  methods: {
          loadgalleries(page = 1){
          axios.get('/galleryinfo?page=' + page)
            .then(({ data }) => 
            { 
               this.galleries=data;
               console.log(data);
            }
            )
          },
           searchit() {
     axios.get('/galleryinfo?q=' + this.search)
            .then(({ data }) => 
            { 
               this.galleries=data;
               console.log(data);
                
            }
            )
   
    },
    deleteimage(id) {
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
          axios.delete("/galleryinfo/" + id).then(({ data }) => {
            this.loadgalleries();
            this.successmsg();
            console.log(data);
          });
        }
      });
    },
  
    
  },
  beforeCreate(){

// if(!this.$gate.isAdmin()){
//     this.$router.push({ name: 'not'})
// }

},
        created() {
            this.loadgalleries();
           
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
