                    <template>


                    <div>
                    <div class="row">
 


                    <form @submit.prevent="login()" @keydown="form.onKeydown($event)" >

                

                    <!-- end col-md-12 -->
                    <div class="col-md-12">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                    <h3>Reset Password</h3>
                     
                    </div> 
                    <div class="panel-body">  
                    <div class="form-group col-md-4">
                    <label>Email</label>
                    <input v-model="form.email" type="text" name="email"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                    <has-error :form="form" field="email"></has-error>
                    </div>
                    <div class="form-group col-md-4">
                    <label>Password</label>
                    <input v-model="form.password" type="password" name="password"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                    <has-error :form="form" field="password"></has-error>
                    </div>
                    <div class="form-group col-md-4">
                    <label>Confirm Password</label>
                    <input v-model="form.password_confirmation" type="password" name="password_confirmation"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('password_confirmation') }">
                    <has-error :form="form" field="password_confirmation"></has-error>
                    </div>
                    

                    </div>
                    </div>
                    </div>
                    <!-- end col-md-12 -->
                    
                    
                    <div class="col-md-12">
<div class="form-group">
                     <button :disabled="form.busy" type="submit" class="btn btn-primary btn-lg btn-block">Reset Password</button>
    </div>
</div>


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


form: new Form({
email: '',
password: '',
password_confirmation:'',


})
}
},
methods: {
        
login(){
// Submit the form via a POST request
this.form.post('/password/reset')
.then(({ data }) => 
{ 
this.$router.go('/home')
}

)
// console.log("")
},
// method end
},
beforeCreate(){
// if(!this.$gate.isAdmin() && !this.$gate.isParent()){
//     this.$router.push({ name: 'notfound'})
// }
},
created() {
    
       // this.loadparent(); 

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
