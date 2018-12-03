                    <template>

                    <div>
                    <div class="row">
 
                    <form @submit.prevent="editmode ? updateroom() : addroom()" @keydown="form.onKeydown($event)" >

                

                    <!-- end col-md-12 -->
                    <div class="col-md-12">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                    <h3>Room Information</h3>
                     
                    </div> 
                    <div class="panel-body">  
                    <div class="form-group col-md-4">
                    <label>Room Number</label>
                    <input v-model="form.room_number" type="number" name="room_number"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('room_number') }">
                    <has-error :form="form" field="room_number"></has-error>
                    </div>
                  
                    <div class="form-group col-md-4">
                    <label>Room Capacity</label>
                    <input v-model="form.room_capacity" type="text" name="room_capacity"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('room_capacity') }">
                    <has-error :form="form" field="room_capacity"></has-error>
                    </div>
                    <div class="form-group col-md-4">
                    <label>Room Description</label>
                    <input v-model="form.room_description" type="text" name="room_description"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('room_description') }">
                    <has-error :form="form" field="room_description"></has-error>
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
room_number: '',
room_capacity: '',
room_description: '',




})
}
},
methods: {
        addroom () {
        // Submit the form via a POST request
        this.form.post('/roominfo')
        .then(({ data }) => 
        { 

        this.restform();
        this.successmsg();
        this.$router.push('/room');
        
}
        )
        },

        
updateroom () {
// Submit the form via a POST request
this.form.put('/roominfo/'+this.form.id)
.then(({ data }) => 
{ 
this.successmsg();
this.$router.push('/room');

}
)

// console.log("")
},
loadroom(){
let id=this.$route.params.id;
if(id){
this.form.get('/roominfo/'+id)
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
    
       this.loadroom(); 

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
