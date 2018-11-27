<template>
   <div >   
    <div class="row" >
                        <div class="col-md-12">
                           
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    
                                    <router-link :to="{ name: 'addgallery'}" tag='button' class="btn btn-primary">Add Image</router-link>
                                    <h4 class="card-title">Image Information</h4>
                                    </div>

                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
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
                    <tr v-for="gallery in galleries">
                        
                    <td>{{ gallery.id }}</td>
                   
                    <td>{{ gallery.title }}</td>
                    <td><img :src="gallery.imagelink" alt="" style="width: 100px;height: 100px"></td>
                    <td v-if="gallery.slider==1">Yes</td>
                    <td v-if="gallery.slider==0">No</td>
                    
 
                   <td>
                    <router-link :to="{ name: 'singlegallery', params: { id: gallery.id }}"tag='button' class="btn btn-primary"><i class="fa fa-eye"></i></router-link>

                    <router-link :to="{ name: 'editgallery', params: { id: gallery.id }}"tag='button' class="btn btn-info"><i class="fa fa-eye"></i>
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
      galleries:{},
      
    }
  },
  methods: {
          loadgalleries(){
          axios.get('/galleryinfo')
            .then(({ data }) => 
            { 
               this.galleries=data;
               console.log(data);
            }
            )
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
