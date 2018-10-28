                    <template>

                    <div>
                    <div class="row">
 
                    <form @submit.prevent="adminactivation()" @keydown="form.onKeydown($event)" >

                

                    <!-- end col-md-12 -->
                    <div class="col-md-12">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                    <h3>Admin Activation</h3>
                     
                    </div> 
                    <div class="panel-body">  
                    <div class="form-group col-md-6">
                    <label>Activation Code</label>
                    <input v-model="form.admin_activation" type="text" name="admin_activation"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('admin_activation') }">
                    <has-error :form="form" field="admin_activation"></has-error>
                    </div>
                  
                    

                    
                   
                    </div>
                    </div>
                    </div>
                    <!-- end col-md-12 -->
                    
                    
                    <div class="col-md-12">
<div class="form-group">
                     
    <button :disabled="form.busy" type="submit" class="btn btn-primary btn-lg btn-block">Activated</button></div></div>
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

admin_activation: '',

})
}
},
methods: {
        adminactivation () {
        // Submit the form via a POST request
        this.form.post('/adminActivation')
        .then(({ data }) => 
        { 

        
        this.successmsg();
        this.$router.go(0);
        
        
}
        )
        },

 

// method end
},
created() {
    
       // this.loaddoctor(); 

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
