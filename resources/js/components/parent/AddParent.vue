                    <template>


                    <div>
                    <div class="row">
 


                    <form @submit.prevent="editmode ? updateparent() : addparent()" @keydown="form.onKeydown($event)" >

                

                    <!-- end col-md-12 -->
                    <div class="col-md-12">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                    <h3>Parent Information</h3>
                     
                    </div> 
                    <div class="panel-body">  
                    <div class="form-group col-md-4">
                    <label>Contact Number</label>
                    <input v-model="form.contact_number" type="text" name="contact_number"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('contact_number') }">
                    <has-error :form="form" field="contact_number"></has-error>
                    </div>

                    <div class="form-group col-md-4">
                    <label>Contact Email</label>
                    <input v-model="form.email" type="email" name="email"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                    <has-error :form="form" field="email"></has-error>
                    </div>
                  
                    <div class="form-group col-md-4">
                    <label>Father Name</label>
                    <input v-model="form.father_name" type="text" name="father_name"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('father_name') }">
                    <has-error :form="form" field="father_name"></has-error>
                    </div>
                    <div class="form-group col-md-4">
                    <label>Mother Name</label>
                    <input v-model="form.mother_name" type="text" name="mother_name"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('mother_name') }">
                    <has-error :form="form" field="mother_name"></has-error>
                    </div>

                    <div class="form-group col-md-4">
                    <label>Contact Address</label>
                    <input v-model="form.contact_address" type="text" name="contact_address"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('contact_address') }">
                    <has-error :form="form" field="contact_address"></has-error>
                    </div>
                   
                    </div>
                    </div>
                    </div>
                    <!-- end col-md-12 -->
                    
                    
                    <div class="col-md-12">
<div class="form-group">
                     <button :disabled="form.busy" v-show='!editmode' type="submit" class="btn btn-primary btn-lg btn-block">Add Child</button>
    <button :disabled="form.busy" v-show='editmode' type="submit" class="btn btn-primary btn-lg btn-block">Update Child</button></div></div>
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
children:{},

form: new Form({

id:'',

mother_name: '',
father_name: '',
contact_number: '',
email: '',
contact_address:'',


})
}
},
methods: {
        addparent () {
        // Submit the form via a POST request
        this.form.post('/parentinfo')
        .then(({ data }) => 
        { 

        this.restform();
        this.successmsg();
        this.$router.push('/parent');
        



        }
        )
        },

        
updateparent () {
// Submit the form via a POST request
this.form.put('/parentinfo/'+this.form.id)
.then(({ data }) => 
{ 
this.successmsg();
this.$router.push('/parent');

}
)

// console.log("")
},
loadparent(){
let id=this.$route.params.id;
if(id){
this.form.get('/parentinfo/'+id)
  .then(({ data }) => 
  { 
    this.editmode=true;
    this.form.id=data.id;
    this.form.mother_name=data.mother_name;

    this.form.father_name=data.user.name;
    this.form.email=data.user.email;
    this.form.contact_number=data.user.contact_number;
    this.form.contact_address=data.contact_address;
    
    
    
    console.log(data);
  }
  )
}
},




// method end
},
created() {
    
       this.loadparent(); 

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
