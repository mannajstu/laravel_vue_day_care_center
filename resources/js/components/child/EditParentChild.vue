                    <template>

                    <div>
                    <div class="row">
                    <form @submit.prevent="updatechild()" @keydown="form.onKeydown($event)" >

                <div class="col-md-12">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                    <h3>
                        <router-link :to="{ name: 'parentdashboard'}" tag='button' class="btn btn-primary" v-show="this.$gate.isParent()">Back</router-link>
                    Child Information
                </h3>
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

                    </div>
                    </div>
            </div>

            
    <!-- //col-md-4 end -->
                   
                   
                    
                    <!-- end col-md-12 -->
                    <div class="col-md-12">
<div class="form-group">
                     
    <button :disabled="form.busy" type="submit" class="btn btn-primary btn-lg btn-block">Update Child</button></div></div>
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


children:{},

form: new Form({

id:'',
child_name: '',

birth_date: '',
birth_reg_no: '',
gender:'',



})
}
},
methods: {
       

updatechild () {
// Submit the form via a POST request
this.form.put('/childinfo/'+this.form.id)
.then(({ data }) => 
{ 
this.successmsg();
this.$router.push('/');

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
    
     console.log(data);

    }
  )
}



},


// method end
},
beforeCreate(){
    if(!this.$gate.isParent()){
    this.$router.push({ name: 'notfound'})
}

},
created() {
    
       this.loadchild(); 
       

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
