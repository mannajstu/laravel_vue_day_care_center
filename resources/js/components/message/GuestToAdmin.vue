                    <template>

                    <div>
                    <div class="row">
 
                    <form @submit.prevent="guesttoadmin()" @keydown="form.onKeydown($event)" >
<!-- end col-md-12 -->
                    <div class="col-md-12">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                    <h3>Contact With Admin </h3>
                     
                    </div> 
                    <div class="panel-body">  
                    <div class="form-group col-md-12">
                    <label>Subject</label>
                    <input v-model="form.subject" type="text" name="subject"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('subject') }">
                    <has-error :form="form" field="subject"></has-error>
                    </div>
                    <div class="form-group col-md-12">
                    <label>Email</label>
                    <input v-model="form.email" type="email" name="subject"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                    <has-error :form="form" field="email"></has-error>
                    </div>

                    <div class="form-group col-md-12">
                    <label>Contact Number</label>
                    <input v-model="form.contact_number" type="number" name="subject"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('contact_number') }">
                    <has-error :form="form" field="contact_number"></has-error>
                    </div>
                  
                    <div class="form-group col-md-12">
                    <label>Message</label>
                    <textarea v-model="form.message" type="text" name="message"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('message') }" style="width: 100%">
                        
                    </textarea>
                    <has-error :form="form" field="message"></has-error>
                    </div>
                                       
                   
                    </div>
                    </div>
                    </div>
                    <!-- end col-md-12 -->
                    
                    
                    <div class="col-md-12">
<div class="form-group">
                     <button :disabled="form.busy" type="submit" class="btn btn-primary btn-lg btn-block">Add Message</button>
    </div></div>
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
message: '',
subject: '',
email:'',

contact_number:'',

})
}
},
methods: {
        guesttoadmin () {
        // Submit the form via a POST request
        this.form.post('/guesttoadminmsg')
        .then(({ data }) => 
        { 

        this.restform();
        this.successmsg();
        console.log(data);
        
        
}
        )
// alert(this.form)
        },

// method end
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
