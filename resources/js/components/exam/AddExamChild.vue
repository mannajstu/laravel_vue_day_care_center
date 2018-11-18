<template>
    
        

                  <div >
                    
                        
                    
                  <div class="row" >
                        <div class="col-md-12">
                           
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    <button type="button" class="btn btn-danger" data-toggle="modal" @click="addchildexam()">
                                    Add Child To Exam
                                    </button>
                                    <h4 class="card-title">Children Information</h4>
                                </div>

                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                        <th>Add To Exam</th>
                        <th>ID</th>
                        <th>Child Name</th>
                        
                        <th>Contact Number</th>
                        
                        </tr>
                        </thead>
                                        <tbody>
                    <tr v-for="child in children">
                        
                    <td><input type="checkbox" v-model="form.childid" class="form-check-input" v-bind:value="child.id"></td>
                    <td>{{ child.id }}</td>
                    <td>{{ child.child_name }}</td>
                    <td>{{ child.parentinfo.user.contact_number }}</td>
                  

                    </tr>

                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- col-md-12 end -->
                        
                    </div>
                    <!-- end row -->
                 <!--  modal start  -->

                


                        
                            </div>

             
</template>

<script>
    export default {

        data () {
    return {
      // Create a new form instance
      
     children:{},
     
     form: new Form({
childid:[],
})
      
    }
  },
  methods: {
    addchild () {
      // Submit the form via a POST request
      
            this.$router.push('/' );
        
    },
    
      
    loadchild(){
axios.get('/childinfo')
        .then(({ data }) => 
        { 
           this.children=data;
           console.log(data);
            
        }
        )
    },
    addchildexam(){
// axios.get('/childinfo')
//         .then(({ data }) => 
//         { 
//            this.children=data;
//            console.log(data);
            
//         }
//         )
if(this.form.childid.length > 0){
  alert('Allah')
}
else{
  alert('Check Any Checkbox')
}

    },
        
  },
   beforeCreate(){
if(!this.$gate.isAdmin()){
    this.$router.push({ name: 'notfound'})
}
},
        created() {
            this.loadchild();
            // this.$on('updatechild',()=>{
            //     this.loadchild();
            // });
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
