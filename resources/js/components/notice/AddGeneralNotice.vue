                    <template>

                    <div>
                    <div class="row">
 
                    <form @submit.prevent="editmode ? updategeneralnotice() : addgeneralnotice()" @keydown="form.onKeydown($event)" >

                

                    <!-- end col-md-12 -->
                    <div class="col-md-12">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                    <h3>General Notice </h3>
                     
                    </div> 
                    <div class="panel-body"> 
                    <div class="form-group col-md-4">
                    <label>Notice Title</label>
                    <input v-model="form.title" type="text" name="title"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
                    <has-error :form="form" field="title"></has-error>
                    </div>
                    <div class="form-group col-md-12">
                       <label>Notice Description</label>               
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
                     <button :disabled="form.busy" v-show='!editmode' type="submit" class="btn btn-primary btn-lg btn-block">Add Notice</button>
    <button :disabled="form.busy" v-show='editmode' type="submit" class="btn btn-primary btn-lg btn-block">Update Notice</button></div></div>
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
title: '',
description: '',

})
}
},
methods: {
        addgeneralnotice () {
        // Submit the form via a POST request
        this.form.post('/generalnoticeinfo')
        .then(({ data }) => 
        { 

        this.restform();
        this.successmsg();
        this.$router.push('/generalnotice');
        
}
        )
        },

        
updategeneralnotice () {
// Submit the form via a POST request
this.form.put('/generalnoticeinfo/'+this.form.id)
.then(({ data }) => 
{ 
this.successmsg();
this.$router.push('/generalnotice');

}
)

// console.log("")
},
loadgeneralnotice(){
let id=this.$route.params.id;
if(id){
this.form.get('/generalnoticeinfo/'+id)
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
    
       this.loadgeneralnotice(); 

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
