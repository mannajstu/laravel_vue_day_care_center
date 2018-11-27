<template>
   <div >   
    <div class="row">
  <div class="col-xs-6 col-md-3" v-for="gallery in galleries">
    <button data-toggle="modal"  class="thumbnail">
      <img :src="gallery.imagelink" alt="..." style="height: 20em;width: 100%">
    </button>
  </div>
  
</div>
<!-- <div v-for="gallery in galleries" :class="modal fade bd-example-modal-lg +  'gallery.title'"  tabindex="-1" role="dialog" :aria-labelledby="'exmal'+gallery.id" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img :src="gallery.imagelink" alt="..." style="width: 100%">
      </div>
      
    </div>
  </div>
</div>
        -->          

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
