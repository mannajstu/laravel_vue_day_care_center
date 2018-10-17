                    <template>

                    <div>
                    <div class="row">
 
                    <form @submit.prevent="editmode ? updateuser() : adduser()" @keydown="form.onKeydown($event)" >

                

                    <!-- end col-md-12 -->
                    <div class="col-md-12">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                    <h3> User Information</h3>
                     
                    </div> 
                    <div class="panel-body">  
                    <div class="form-group col-md-4">
                    <label>User Name</label>
                    <input v-model="form.name" type="text" name="name"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                    <has-error :form="form" field="name"></has-error>
                    </div>
                  
                    <div class="form-group col-md-4">
                    <label>User Email</label>
                    <input v-model="form.email" type="email" name="email"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                    <has-error :form="form" field="email"></has-error>
                    </div>
                    <div class="form-group col-md-4">
                    <label>Contact Number</label>
                    <input v-model="form.contact_number" type="number" name="contact_number"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('contact_number') }">
                    <has-error :form="form" field="contact_number"></has-error>
                    </div>

                    <div v-if="editmode" class="form-group col-md-4">
                    <label>User Roles</label>
                        <div class="form-check">
                        

                        <input type="checkbox"   value="admin" v-model="form.role">
  <label >Admin</label>
  <input type="checkbox"   value="parent" v-model="form.role">
  <label >Parent</label>
  <input type="checkbox"  value="teacher" v-model="form.role">
  <label >Teacher</label>
  <input type="checkbox"  value="doctor" v-model="form.role">
  <label >Doctor</label>
  
                        </div>
                    <has-error :form="form" field="contact_number"></has-error>
                    </div>

                     </div>
                    </div>
                    </div>
                    <!-- end col-md-12 -->
                    
                    
                    <div class="col-md-12">
<div class="form-group">
                     <button :disabled="form.busy" v-show='!editmode' type="submit" class="btn btn-primary btn-lg btn-block">Add User</button>
    <button :disabled="form.busy" v-show='editmode' type="submit" class="btn btn-primary btn-lg btn-block">Update User</button></div></div>
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
users:{},



form: new Form({

id:'',
name: '',
email: '',
contact_number: '',

role:[],
})
}
},
methods: {
        adduser () {
        // Submit the form via a POST request
        this.form.post('/userinfo')
        .then(({ data }) => 
        { 

        this.restform();
        this.successmsg();
        this.$router.push('/user');
        
}
        )
        },

        
updateuser () {
// Submit the form via a POST request
this.form.put('/userinfo/'+this.form.id)
.then(({ data }) => 
{ 
this.successmsg();
this.$router.push('/user');

}
)

// console.log("")
},
loaduser(){
let id=this.$route.params.id;
if(id){
this.form.get('/userinfo/'+id)
  .then(({ data }) => 
  { 
    this.editmode=true;


    this.form.id=data.id;
    this.form.name=data.name;
    this.form.email=data.email;
    this.form.contact_number=data.contact_number;
   for (var i = 0; i <  data.roles.length; i++) {
        this.form.role.push( data.roles[i].name);
    };
    
    console.log(data);
  }
  )
}
},




// method end
},
created() {
    
       this.loaduser(); 
     

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
