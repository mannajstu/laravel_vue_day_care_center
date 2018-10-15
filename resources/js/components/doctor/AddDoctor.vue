                    <template>

                    <div>
                    <div class="row">
 
                    <form @submit.prevent="editmode ? updatedoctor() : adddoctor()" @keydown="form.onKeydown($event)" >

                

                    <!-- end col-md-12 -->
                    <div class="col-md-12">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                    <h3>Doctor Information</h3>
                     
                    </div> 
                    <div class="panel-body">  
                    <div class="form-group col-md-4">
                    <label>Doctor Name</label>
                    <input v-model="form.doctor_name" type="text" name="doctor_name"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('room_number') }">
                    <has-error :form="form" field="doctor_name"></has-error>
                    </div>
                  
                    <div class="form-group col-md-4">
                    <label>Doctor Email</label>
                    <input v-model="form.doctor_email" type="email" name="doctor_email"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('doctor_email') }">
                    <has-error :form="form" field="doctor_email"></has-error>
                    </div>
                    <div class="form-group col-md-4">
                    <label>Contact Number</label>
                    <input v-model="form.contact_number" type="number" name="contact_number"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('contact_number') }">
                    <has-error :form="form" field="contact_number"></has-error>
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
                     <button :disabled="form.busy" v-show='!editmode' type="submit" class="btn btn-primary btn-lg btn-block">Add Room</button>
    <button :disabled="form.busy" v-show='editmode' type="submit" class="btn btn-primary btn-lg btn-block">Update Room</button></div></div>
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
rooms:{},

form: new Form({

id:'',
doctor_name: '',
doctor_email: '',
contact_number: '',
contact_address: '',
})
}
},
methods: {
        adddoctor () {
        // Submit the form via a POST request
        this.form.post('/doctorinfo')
        .then(({ data }) => 
        { 

        this.restform();
        this.successmsg();
        this.$router.push('/doctor');
        
}
        )
        },

        
updatedoctor () {
// Submit the form via a POST request
this.form.put('/doctorinfo/'+this.form.id)
.then(({ data }) => 
{ 
this.successmsg();
this.$router.push('/doctor');

}
)

// console.log("")
},
loaddoctor(){
let id=this.$route.params.id;
if(id){
this.form.get('/doctorinfo/'+id)
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
    
       this.loaddoctor(); 

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
