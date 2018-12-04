<template>



<div class="row ">
<div col-md-12>



<div class="col-md-6">
<!--   Kitchen Sink -->
<div class="panel panel-default">

<div class="panel-heading">

<router-link to='/teacher' tag='button' class='btn btn-primary'>Back</router-link>

<h3>Teacher Information</h3> 

</div>


<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">

<tbody>
<tr>
<th>ID</th>
<td>{{ teacher.id }}</td>

</tr>

<tr>
<th>Name</th>
<td>{{ teacher.user.name }}</td>
</tr>




<tr>
<th>Contact Number</th>
<td>{{ teacher.user.contact_number }}</td>
</tr>
<tr>
<th>Contact Email</th>
<td>{{ teacher.user.email }}</td>
</tr>

<tr>
<th>Contact Address</th>
<td>{{ teacher.contact_address }}</td>
</tr>

</tbody>
</table>
</div>
</div>
</div>
</div>
<!-- end col-md-6 -->
<div class="col-md-6">
 
                    <form @submit.prevent="teachertoadmin()" @keydown="form.onKeydown($event)" >
<!-- end col-md-12 -->
                    <div class="col-md-12">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                    <h3> Teacher To Admin Message </h3>
                     
                    </div> 
                    <div class="panel-body">  
                    <div class="form-group col-md-12">
                    <label>Subject</label>
                    <input v-model="form.subject" type="text" name="subject"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('subject') }">
                    <has-error :form="form" field="subject"></has-error>
                    </div>
                  
                    <div class="form-group col-md-12">
                    <label>Message</label>
                    <textarea v-model="form.message" type="text" name="message"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('message') }" style="width: 100%">
                        {{form.message}}
                    </textarea>
                    <has-error :form="form" field="message"></has-error>
                    </div>
                                       
                   
                    </div>
                    </div>
                           <div class="form-group">
                     <button :disabled="form.busy" type="submit" class="btn btn-primary btn-lg btn-block">Add Message</button>
    </div>

                    </div>
                    <!-- end col-md-12 -->
                                 
             
                    </form>
                    </div> 
                    <!-- col-md-12 -->
<div class="col-md-12">
<childchortinfo :children="children"></childchortinfo>

</div>
<div class="col-md-12">
                          <!-- col-md-6 -->
 <div class="col-md-6">
<!--   Kitchen Sink -->
<div class="panel panel-default">

<div class="panel-heading">

 <h3>Teacher To Admin Message</h3> 
    
</div>


<div class="panel-body">
  
  <table class="table table-hover table-striped">
<thead>
<tr>
<th>ID</th>
<th>Subject</th>
<th>Message</th>

<th>Action</th>
</tr>
</thead>
                <tbody>
<tr v-for="teachertoadminmsg in teachertoadminmsgs">

<td>{{ teachertoadminmsg.id }}</td>
<td>{{ teachertoadminmsg.subject }}</td>
<td>{{ teachertoadminmsg.message.substring(0, 100)+'...' }}</td>

<td>
<router-link :to="{ name: 'singleteachertoadmin', params: { id: teachertoadminmsg.id }} "tag='button' class="btn btn-primary"><i class="fa fa-eye"></i></router-link>

<button type="button" class="btn btn-danger "><i class="fa fa-trash"></i>
</button>
</td>


</tr>

                   
                </tbody>
            </table>
   
</div>
</div>
</div>
<!-- col-md-6 -->
 <div class="col-md-6">
<!--   Kitchen Sink -->
<div class="panel panel-default">

<div class="panel-heading">

 <h3>Admin To Teacher Message</h3> 
    
</div>


<div class="panel-body">
  
  <table class="table table-hover table-striped">
<thead>
<tr>
<th>ID</th>
<th>Subject</th>
<th>Message</th>

<th>Action</th>
</tr>
</thead>
                <tbody>
<tr v-for="admintoteachermsg in admintoteachermsgs">

<td>{{ admintoteachermsg.id }}</td>
<td>{{ admintoteachermsg.subject }}</td>
<td>{{ admintoteachermsg.message.substring(0, 100)+'...' }}</td>

<td>
<router-link :to="{ name: 'singleadmintoteacher', params: { id: admintoteachermsg.id }}"tag='button' class="btn btn-primary"><i class="fa fa-eye"></i></router-link>

<button type="button" class="btn btn-danger "><i class="fa fa-trash"></i>
</button>
</td>


</tr>
   </tbody>
            </table>
   
</div>
</div>
</div>



                        </div>

                       <!--  end -col -->

<!--  end -col -->

</div>

</div>

</template>

<script>
export default {

data () {
return {
// Create a new form instance

teacher:{},
children:{},
teachertoadminmsgs:{},
admintoteachermsgs:{},
      form: new Form({
message: '',
subject: '',
email:'',
teacherid:'',
contact_number:'',

})


}
},
methods: {
singleteacher () {
// Submit the form via a POST request

axios.get('/teacherinfo/')
.then(({ data }) => 
{ 
this.teacher=data;
this.children=data.childinfos;
this.form.teacherid=data.id;
this.form.contact_number=data.user.contact_number;
this.form.email=data.user.email;


console.log(data);
}
)
},

teachertoadmin () {
        // Submit the form via a POST request
        this.form.post('/teachertoadminmsg')
        .then(({ data }) => 
        { 

        this.restform();
        this.successmsg();
        this.singleteacher();
        this.$router.push('/teacher/dashboard');
        this.loadteachertoadminmsg();
        this.loadadmintoteachermsg();
        
}
        )
// alert(this.form)
        },
          loadteachertoadminmsg () {
// Submit the form via a POST request

axios.get('/teachertoadminmsg/')
.then(({ data }) => 
{ 
this.teachertoadminmsgs=data;

}
)
},
loadadmintoteachermsg () {
// Submit the form via a POST request
 
axios.get('/admintoteachermsg/')
.then(({ data }) => 
{ 
this.admintoteachermsgs=data;

}
)
},


},
beforeCreate(){
if(this.$gate.isAdmin()){
this.$router.push({ name: 'home'})
}
else if(this.$gate.isDoctor()){
this.$router.push({ name: 'teacherdashboard'})
}
else if(this.$gate.isDoctor()){
this.$router.push({ name: 'doctordashboard'})
}
else if(this.$gate.isTeacher()){
this.$router.push({ name: 'teacherdashboard'})
}
else{
this.$router.push({ name: 'notfound'})
}
},
created() {
this.singleteacher()
 this.loadteachertoadminmsg();
        this.loadadmintoteachermsg();
},


}
</script>
