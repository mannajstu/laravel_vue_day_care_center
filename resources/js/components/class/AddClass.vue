                    <template>

                    <div>
                    <div class="row">
 
                    <form @submit.prevent="editmode ? updateclass() : addclass()" @keydown="form.onKeydown($event)" >

                

                    <!-- end col-md-12 -->
                    <div class="col-md-12">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                    <h3>Class Information</h3>
                     
                    </div> 
                    <div class="panel-body">  
                    <div class="form-group col-md-4">
                    <label>Class Number</label>
                    <input v-model="form.class_number" type="number" name="class_number"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('class_number') }">
                    <has-error :form="form" field="class_number"></has-error>
                    </div>
                                      
                    <div class="form-group col-md-4">
                    <label>Class Description</label>
                    <input v-model="form.class_description" type="text" name="class_description"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('class_description') }">
                    <has-error :form="form" field="class_description"></has-error>
                    </div>

                    
                   
                    </div>
                    </div>
                    </div>
                    <!-- end col-md-12 -->
                    
                    
                    <div class="col-md-12">
<div class="form-group">
                     <button :disabled="form.busy" v-show='!editmode' type="submit" class="btn btn-primary btn-lg btn-block">Add Class</button>
    <button :disabled="form.busy" v-show='editmode' type="submit" class="btn btn-primary btn-lg btn-block">Update Class</button></div></div>
                    </form>
                    </div> 
                    <!--  end of row -->
                                 
                    </div>

                    </template>

<script>

export default {

data () {
return {
// Create a new form instance

editmode:false,
classs:{},

form: new Form({

id:'',
class_number: '',
class_description: '',

})
}
},
methods: {
        addclass () {
        // Submit the form via a POST request
        this.form.post('/classinfo')
        .then(({ data }) => 
        { 

        this.restform();
        this.successmsg();
        this.$router.push('/class');
        
}
        )
        },

        
updateclass () {
// Submit the form via a POST request
this.form.put('/classinfo/'+this.form.id)
.then(({ data }) => 
{ 
this.successmsg();
this.$router.push('/class');

}
)

// console.log("")
},
loadclass(){
let id=this.$route.params.id;
if(id){
this.form.get('/classinfo/'+id)
  .then(({ data }) => 
  { 
    this.editmode=true;
    this.form.fill(data);
    console.log(data);
  }
  )
}
},




// method end
},
created() {
    
       this.loadclass(); 

},
// watch: {
//     '$route' (to, from) {
//       //update the variables with new route params
//       Object.assign(this.$data, this.$options.data());
//     }
//   },
//       computed: {
  
//   updateinfo(){
//     return this.loadchild();
//   }
// }


}
</script>
