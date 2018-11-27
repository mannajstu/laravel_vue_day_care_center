                    <template>

                    <div>
                    <div class="row">
 
                    <form @submit.prevent="editmode ? updateaboutdescription() : addaboutdescription()" @keydown="form.onKeydown($event)" >

                

                    <!-- end col-md-12 -->
                    <div class="col-md-12">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                    <h3>About Page Content</h3>
                     
                    </div> 
                    <div class="panel-body">  
                    
                  
                    
                    <div class="form-group col-md-12">
                                      
                     <textarea v-model="form.description" type="text" name="home_content"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('description') }" style="width: 100%">
                        {{form.description}}
                    </textarea>
                    <has-error :form="form" field="description"></has-error>
                    </div>

                    
                   
                    </div>
                    </div>
                    </div>
                    <!-- end col-md-12 -->
                    
                    
                    <div class="col-md-12">
<div class="form-group">
                     <button :disabled="form.busy" v-show='!editmode' type="submit" class="btn btn-primary btn-lg btn-block">Add Content</button>
    <button :disabled="form.busy" v-show='editmode' type="submit" class="btn btn-primary btn-lg btn-block">Update Content</button></div></div>
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
form: new Form({

id:'',
description: '',

})
}
},
methods: {
        addaboutdescription () {
        // Submit the form via a POST request
        this.form.post('/aboutinfo')
        .then(({ data }) => 
        { 

        this.successmsg();
        this.$router.push('/aboutpage');
        this.oldaboutdescription(); 
        
}
        )
        },
        updateaboutdescription () {
        // Submit the form via a POST request
        
        this.form.put('/aboutinfo/'+this.form.id)
        .then(({ data }) => 
        { 

        this.successmsg();
        this.$router.push('/aboutpage');
        
}
        )
        },
        oldaboutdescription () {
        // Submit the form via a POST request
        this.form.get('/aboutinfo')
        .then(({ data }) => 
        { 
            
                
        this.form.id=data[0].id;
        this.form.description=data[0].description;
        this.editmode=true;
        

  }
        )
        },

// method end
},
created() {
    
       this.oldaboutdescription(); 

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
