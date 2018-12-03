<template>



<div class="row ">
<div col-md-12>



<div class="col-md-6">

<div class="panel panel-default">

<div class="panel-heading">

<router-link to='/doctor' tag='button' class='btn btn-primary'>Back</router-link>

<h3>Doctor Information</h3> 

</div>


<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">

<tbody>
<tr>
<th>ID</th>
<td>{{ doctor.id }}</td>

</tr>

<tr>
<th>Name</th>
<td>{{ doctor.user.name }}</td>
</tr>


<tr>
<th>Contact Number</th>
<td>{{ doctor.user.contact_number }}</td>
</tr>
<tr>
<th>Contact Email</th>
<td>{{ doctor.user.email }}</td>
</tr>

<tr>
<th>Contact Address</th>
<td>{{ doctor.contact_address }}</td>
</tr>

</tbody>
</table>
</div>
</div>
</div>
</div>
<!-- end col-md-6 -->
<!-- end col-md-6 -->
<div class="col-md-6">
 
                    <form @submit.prevent="doctortoadmin()" @keydown="form.onKeydown($event)" >
<!-- end col-md-12 -->
                    <div class="col-md-12">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                    <h3> Doctor To Admin Message </h3>
                     
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

 <h3>Doctor To Admin Message</h3> 
    
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
<tr v-for="doctortoadminmsg in doctortoadminmsgs">

<td>{{ doctortoadminmsg.id }}</td>
<td>{{ doctortoadminmsg.subject }}</td>
<td>{{ doctortoadminmsg.message.substring(0, 100)+'...' }}</td>

<td>
<router-link :to="{ name: 'singledoctortoparent', params: { id: doctortoadminmsg.id }} "tag='button' class="btn btn-primary"><i class="fa fa-eye"></i></router-link>

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

 <h3>Admin To Doctor Message</h3> 
    
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
<tr v-for="admintodoctormsg in admintodoctormsgs">

<td>{{ admintodoctormsg.id }}</td>
<td>{{ admintodoctormsg.subject }}</td>
<td>{{ admintodoctormsg.message.substring(0, 100)+'...' }}</td>

<td>
<router-link :to="{ name: 'singleadmintodoctor', params: { id: admintodoctormsg.id }}"tag='button' class="btn btn-primary"><i class="fa fa-eye"></i></router-link>

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

doctor:{},
children:{},
doctortoadminmsgs:{},
admintodoctormsgs:{},
      form: new Form({
message: '',
subject: '',
email:'',
doctorid:'',
contact_number:'',

})


}
},
methods: {
singledoctor () {
// Submit the form via a POST request

axios.get('/doctorinfo/')
.then(({ data }) => 
{ 
this.doctor=data;
this.children=data.childinfos;
this.form.doctorid=data.id;
this.form.contact_number=data.user.contact_number;
this.form.email=data.user.email;

}
)
},
 doctortoadmin () {
        // Submit the form via a POST request
        this.form.post('/doctortoadminmsg')
        .then(({ data }) => 
        { 

        this.restform();
        this.successmsg();
        this.singledoctor();
        this.$router.push('/doctor/'+this.doctor.id);
        this.loaddoctortoadminmsg();
        this.loadadmintodoctormsg();
        
}
        )
// alert(this.form)
        },
        loaddoctortoadminmsg () {
// Submit the form via a POST request

axios.get('/doctortoadminmsg/')
.then(({ data }) => 
{ 
this.doctortoadminmsgs=data;

}
)
},
loadadmintodoctormsg () {
// Submit the form via a POST request
 
axios.get('/admintodoctormsg/')
.then(({ data }) => 
{ 
this.admintodoctormsgs=data;

}
)
},

},
beforeCreate(){
if(this.$gate.isAdmin()){
this.$router.push({ name: 'home'})
}
else if(this.$gate.isParent()){
this.$router.push({ name: 'parentdashboard'})
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
	this.singledoctor()
	this.loadadmintodoctormsg()
	this.loaddoctortoadminmsg()
	
	},


}
</script>
