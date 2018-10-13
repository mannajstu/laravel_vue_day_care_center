                    <template>


                    <div>
                    <div class="row">
 


                    <form @submit.prevent="editmode ? updatechild() : addchild()" @keydown="form.onKeydown($event)" >

                <div class="col-md-12">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                    <h3>Child Information</h3>
                    </div> 
                    <div class="panel-body"> 

                    <div class="form-group col-md-4">
                    <label>Child Name</label>
                    <input v-model="form.child_name" type="text" name="child_name"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('child_name') }">
                    <has-error :form="form" field="child_name"></has-error>
                    </div>

                    
                    <div class="form-group col-md-4">
                    <label>Birth Date</label>
                    <input v-model="form.birth_date" type="text" name="birth_date"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('birth_date') }">
                    <has-error :form="form" field="birth_date"></has-error>
                    </div>
                    <div class="form-group col-md-4">
                    <label>Birth Regitation Number</label>
                    <input v-model="form.birth_reg_no" type="text" name="birth_reg_no"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('birth_reg_no') }">
                    <has-error :form="form" field="birth_reg_no"></has-error>
                    </div>

                    <div class="form-group col-md-4">
                    <label>Gender</label>
                    <input v-model="form.gender" type="text" name="gender"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('gender') }">
                    <has-error :form="form" field="gender"></has-error>
                    </div>

                    <div class="form-group col-md-4">
                    <label>Room Number</label>
                 <v-select v-model="form.room_number" :options="rooms"></v-select>                 
                    <has-error :form="form" field="room_number"></has-error>
                    </div>


                    
                    </div>
                    </div>
            </div>

                    <!-- end col-md-12 -->
                    <div class="col-md-12">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                    <h3>Parent Information</h3>
                     <a class="btn btn-primary" v-if="!editmode" v-show="!oldparent" @click='oldparentshow()'>Old Parent</a>
                      <a class="btn btn-primary " v-if="!editmode" v-show="oldparent" @click='newparentshow()'>New Parent</a>
                    </div> 
                    <div class="panel-body">  
                    <div class="form-group col-md-4">
                    <label>Contact Number</label>
                    <input v-model="form.contact_number" type="text" name="contact_number"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('contact_number') }">
                    <has-error :form="form" field="contact_number"></has-error>
                    </div>
                    <div v-if="!oldparent">
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
                    </div>
                    <!-- end col-md-12 -->
                    <div class="col-md-12">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                    <h3>Other Information</h3>
                    </div> 
                    <div class="panel-body">  

                    <div class="form-group col-md-4">
      <label>Doctor Name</label>
      <input v-model="form.doctor_name" type="text" name="doctor_name"
        class="form-control" :class="{ 'is-invalid': form.errors.has('doctor_name') }">
      <has-error :form="form" field="doctor_name"></has-error>
    </div>
    <div class="form-group col-md-4">
      <label>Teacher Name</label>
      <input v-model="form.teacher_name" type="text" name="teacher_name"
        class="form-control" :class="{ 'is-invalid': form.errors.has('teacher_name') }">
      <has-error :form="form" field="teacher_name"></has-error>
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
oldparent:false,
roominfo:{},
rooms:{},
form: new Form({

id:'',
child_name: '',
mother_name: '',
father_name: '',
contact_number: '',
contact_address:'',
birth_date: '',
birth_reg_no: '',
gender:'',
doctor_name:'',
teacher_name: '',
room_number: '',


})
}
},
methods: {
        addchild () {
        // Submit the form via a POST request
        this.form.post('/childinfo')
        .then(({ data }) => 
        { 

        this.restform();
        this.successmsg();


        }
        )
        },
oldparentshow(){
this.oldparent=true;
},
        newparentshow(){
        this.oldparent=false;
        },
updatechild () {
// Submit the form via a POST request
this.form.put('/childinfo/'+this.form.id)
.then(({ data }) => 
{ 
this.successmsg();
this.$router.push('/child/');

}
)

// console.log("")
},
loadchild(){
let id=this.$route.params.id;
if(id){
this.form.get('/childinfo/'+id)
  .then(({ data }) => 
  { 
    this.editmode=true;
    this.form.id=data.id;
    this.form.child_name=data.child_name;
    
    this.form.birth_date=data.birth_date;
    this.form.birth_reg_no=data.birth_reg_no;
    this.form.gender=data.gender;
    this.form.doctor_name=data.doctor_name;
    this.form.doctor_name=data.doctor_name;
    this.form.teacher_name=data.teacher_name;
    this.form.room_number=data.room_number;

    this.form.mother_name=data.parentinfo.mother_name;
    this.form.father_name=data.parentinfo.father_name;
    this.form.contact_number=data.parentinfo.contact_number;
    this.form.contact_address=data.parentinfo.contact_address;
    
  
  }
  )
}



},
loadrooms(){
    this.form.get('/roomnumber')
        .then(({ data }) => 
        { 
            
this.rooms=data;
console.log(data);


        }
        );
       

        

},

// method end
},
created() {
    
       this.loadchild(); 
       this.loadrooms();

},
watch: {
    '$route' (to, from) {
      //update the variables with new route params
      Object.assign(this.$data, this.$options.data());
    }
  },
//       computed: {
  
//   updateinfo(){
//     return this.loadchild();
//   }
// }


}
</script>
