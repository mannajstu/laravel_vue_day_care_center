<template>
   <div >   
    <div class="row">
  <div class="col-xs-6 col-md-3" v-for="gallery in galleries.data">
    <button class="btn btn-primary btn-lg thumbnail" data-toggle="modal" :data-target="'#'+gallery.id"  >
      <img :src="gallery.imagelink" alt="..." style="height: 20em;width: 100%">
    </button>
  </div>
  
</div>
<!-- Modal -->
<div v-for="gallery in galleries.data" class="modal fade" :id=" gallery.id" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">{{ gallery.title }}</h4>
      </div>
      <div class="modal-body">
        
       <img :src="gallery.imagelink" alt="..." style="height: 20em;width: 100%">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>       
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

                 

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
