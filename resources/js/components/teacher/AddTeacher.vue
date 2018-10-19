                    <template>

                    <div>
                    <div class="row">
 
                    <form @submit.prevent="editmode ? updateteacher() : addteacher()" @keydown="form.onKeydown($event)" >

                

                    <!-- end col-md-12 -->
                    <div class="col-md-12">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                    <h3>Teacher Information</h3>
                     
                    </div> 
                    <div class="panel-body">  
                    <div class="form-group col-md-4">
                    <label>Teacher Name</label>
                    <input v-model="form.teacher_name" type="text" name="teacher_name"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('teacher_number') }">
                    <has-error :form="form" field="teacher_name"></has-error>
                    </div>
                  
                    <div class="form-group col-md-4">
                    <label>Teacher Email</label>
                    <input v-model="form.teacher_email" type="email" name="teacher_email"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('teacher_email') }">
                    <has-error :form="form" field="teacher_email"></has-error>
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
                     <button :disabled="form.busy" v-show='!editmode' type="submit" class="btn btn-primary btn-lg btn-block">Add Teacher</button>
    <button :disabled="form.busy" v-show='editmode' type="submit" class="btn btn-primary btn-lg btn-block">Update Teacher</button></div></div>
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
teachers:{},

form: new Form({

id:'',
teacher_name: '',
teacher_email: '',
contact_number: '',
contact_address: '',
})
}
},
methods: {
        addteacher () {
        // Submit the form via a POST request
        this.form.post('/teacherinfo')
        .then(({ data }) => 
        { 

        this.restform();
        this.successmsg();
        this.$router.push('/teacher');
        console.log(data);
         }
        )
        },

        
updateteacher () {
// Submit the form via a POST request
this.form.put('/teacherinfo/'+this.form.id)
.then(({ data }) => 
{ 
this.successmsg();
this.$router.push('/teacher');

}
)

// console.log("")
},
loadteacher(){
let id=this.$route.params.id;
if(id){
this.form.get('/teacherinfo/'+id)
  .then(({ data }) => 
  { 
    this.editmode=true;
    this.form.id=data.id;
  

    this.form.teacher_name=data.user.name;
    this.form.teacher_email=data.user.email;
    this.form.contact_number=data.user.contact_number;
    this.form.contact_address=data.contact_address;
    console.log(data);
  }
  )
}
},




// method end
},
beforeCreate(){
if(!this.$gate.isAdminTeacher()){
    this.$router.push({ name: 'notfound'})
}
},
created() {
    
       this.loadteacher(); 

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
