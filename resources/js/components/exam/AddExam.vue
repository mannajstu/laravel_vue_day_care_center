                    <template>

                    <div>
                    <div class="row">
 
                    <form @submit.prevent="editmode ? updateexam() : addexam()" @keydown="form.onKeydown($event)" >

                

                    <!-- end col-md-12 -->
                    <div class="col-md-12">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                    <h3>exam Information</h3>
                     
                    </div> 

                    <div class="panel-body">  
                         <div class="form-group col-md-4">
                    <label>Exam Title</label>
                    <input v-model="form.exam_title" type="text" name="exam_title"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('exam_capacity') }">
                    <has-error :form="form" field="exam_title"></has-error>
                    </div>
                    <div class="form-group col-md-4">
                    <label>Exam Description</label>
                    <input v-model="form.exam_description" type="text" name="exam_description"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('exam_description') }">
                    <has-error :form="form" field="exam_description"></has-error>
                    </div>


                    <div class="form-group col-md-4">
                    <label>Exam Mark</label>
                    <input v-model="form.exam_mark" type="text" name="exam_mark"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('exam_mark') }">
                    <has-error :form="form" field="exam_mark"></has-error>
                    </div>

                    <div class="form-group col-md-4">
                    <label>Exam Date</label>

                    <date-picker v-model="form.exam_date" :config="options"></date-picker>
                    
                    <has-error :form="form" field="exam_date"></has-error>
                    </div>

                    <div class="form-group col-md-4">
                    <label>Exam Time</label>

                    <date-picker  v-model="form.exam_time" :config="timeoptions"></date-picker>
                    <has-error :form="form" field="exam_time"></has-error>
                    </div>

                    <div class="form-group col-md-4">
                    <label>Class</label>
                 <select class="form-control" v-model='form.class_number'>
                        <option v-for='classinfo in classinfos' :value="classinfo.class_number">{{ classinfo.class_number }}</option>
                        
                    </select>                   
                    <has-error :form="form" field="class_number"></has-error>
                    </div>
                  
                   

                    
                   
                    </div>
                    </div>
                    </div>
                    <!-- end col-md-12 -->
                    
                    
                    <div class="col-md-12">
<div class="form-group">
                     <button :disabled="form.busy" v-show='!editmode' type="submit" class="btn btn-primary btn-lg btn-block">Add Exam</button>
    <button :disabled="form.busy" v-show='editmode' type="submit" class="btn btn-primary btn-lg btn-block">Update Exam</button></div></div>
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


    timeoptions: {
        format: 'LT',
        useCurrent: true,           
    },  
    options: {
        format: 'DD/MM/YYYY',
        useCurrent: true, 

    },  
editmode:false,
exams:{},
classinfos:{},

form: new Form({

id:'',
exam_title: '',
exam_description: '',
exam_date: '',
exam_time: '',
exam_mark: '',
class_number:''

})
}
},
methods: {
        addexam () {
        // Submit the form via a POST request
        this.form.post('/examinfo')
        .then(({ data }) => 
        { 

        this.restform();
        this.successmsg();
        // this.$router.push('/exam');
        
}
        )
        },

        
updateexam () {
// Submit the form via a POST request
this.form.put('/examinfo/'+this.form.id)
.then(({ data }) => 
{ 
this.successmsg();
this.$router.push('/exam');

}
)

// console.log("")
},
loadexam(){
let id=this.$route.params.id;
if(id){
this.form.get('/examinfo/'+id)
  .then(({ data }) => 
  { 
    this.editmode=true;
    this.form.fill(data);
    console.log(data);
  }
  )
}
},
loadclasss(){
    this.form.get('/classnumber')
        .then(({ data }) => 
        { 
            
this.classinfos=data;
console.log(data);


        }
        );
},



// method end
},
created() {
    
       this.loadexam(); 
       this.loadclasss(); 

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
