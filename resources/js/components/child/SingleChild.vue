<template>
<div class="row ">
<div class="col-md-12">
   


<div class="col-md-6">
<!--   Kitchen Sink -->
<div class="panel panel-default">

<div class="panel-heading">

<router-link v-if="this.$gate.isAdmin()" to='/child' tag='button' class='btn btn-primary'>Back</router-link>
<router-link :to="{ name: 'parentdashboard'}" tag='button' class="btn btn-primary" v-if="this.$gate.isParent()">Back</router-link>
<router-link :to="{ name: 'doctordashboard'}" tag='button' class="btn btn-primary" v-if="this.$gate.isDoctor()">Back</router-link>
<router-link :to="{ name: 'teacherdashboard'}" tag='button' class="btn btn-primary" v-if="this.$gate.isTeacher()">Back</router-link>

   <h3>Child Information</h3> 
    
</div>


<div class="panel-body">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            
            <tbody>
                <tr>
                    <th>ID</th>
                    <td>{{ child.id }}</td>
                    
                </tr>
                <tr>
                    <th>Child Name</th>
                    <td>{{ child.child_name }}</td>
                </tr>
                <tr>
                    <th>Father Name</th>
                    <td>{{ child.parentinfo.user.name }}</td>
                </tr>

<tr>
                    <th>Mother Name</th>
                    <td>{{ child.parentinfo.mother_name }}</td>
                </tr>

<tr>
                    <th>Birth Date</th>
                    <td>{{ child.birth_date }}</td>
                </tr>

<tr>
                    <th>Birth Reg No</th>
                    <td>{{ child.birth_reg_no }}</td>
                </tr>



<tr v-if='child.parentinfo!==null'>
                    <th>Contact Number</th>
                    <td>{{ child.parentinfo.user.contact_number }}</td>
                </tr>

<tr v-if='child.parentinfo!==null'>
                    <th>Contact Address</th>
                    <td>{{ child.parentinfo.contact_address }}</td>
                </tr>
                

<tr>
                    <th>Gender</th>
                    <td>{{ child.gender }}</td>
                </tr>
                <tr>
                    <th>Doctor Name</th>
                    <td v-if='child.doctor!==null'>{{ child.doctor.user.name }}</td>
                </tr><tr>
                    <th>Teacher Name</th>
                    <td v-if='child.teacher!==null'>{{ child.teacher.user.name }}</td>
                </tr><tr>
                    <th>Room No</th>
                    <td >{{ child.room_number }}</td>
                </tr>
                <tr>
                    <th>Class</th>
                    <td >{{ child.class_number }}</td>
                </tr>
                

                
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
<!-- col-md-6 -->

 <div class="col-md-6">
<!--   Kitchen Sink -->
<div class="panel panel-default">

<div class="panel-heading">

 <h3>Message</h3> 
    
</div>


<div class="panel-body">
  
<router-link v-if="this.$gate.isAdmin()" :to="{ name: 'admintoparent', params: { child: child }}" tag='button' class="btn btn-primary btn-lg btn-block">Admin To Parent</router-link>


<router-link v-if="this.$gate.isDoctor()" :to="{ name: 'doctortoparent', params: { child: child }}" tag='button' class="btn btn-primary btn-lg btn-block">Doctor To Parent</router-link>
<router-link v-if="this.$gate.isTeacher()" :to="{ name: 'teachertoparent', params: { child: child }}" tag='button' class="btn btn-primary btn-lg btn-block">Teacher To Parent</router-link>

<router-link  v-if="this.$gate.isParent()" :to="{ name: 'parenttoadmin', params: { child: child }}" tag='button' class="btn btn-primary btn-lg btn-block"> Parent To Admin </router-link>
<router-link v-if="this.$gate.isParent()" :to="{ name: 'parenttodoctor', params: { child: child }}" tag='button' class="btn btn-primary btn-lg btn-block"> Parent To Doctor </router-link>
<router-link v-if="this.$gate.isParent()" :to="{ name: 'parenttoteacher', params: { child: child }}" tag='button' class="btn btn-primary btn-lg btn-block"> Parent To Teacher </router-link>
   
</div>
</div>
</div>
<!-- col-md-6 -->
<div class="col-md-12" >
  <!--   tab link -->
<ul class="nav nav-tabs nav-justified panel panel-default">
  <li class="active "><a data-toggle="tab" href="#admintoparentmsg">Admin To Parent Message</a></li>
  <li><a data-toggle="tab"   href="#doctortoparentmsg">Doctor To Parent Message</a></li>
   <li><a data-toggle="tab"   href="#teachertoparentmsg">Teacher To Parent Message</a></li>
   <li><a data-toggle="tab"   href="#parenttoadminmsg">Parent To Admin Message</a></li>
   <li><a data-toggle="tab"   href="#parenttodoctormsg">Parent To Doctor Message</a></li>
    <li><a data-toggle="tab"   href="#parenttoteachermsg">Parent To Teacher Message</a></li>

   
</ul>
 <!--   tab link -->
<div class="tab-content">
  <div id="admintoparentmsg" class="tab-pane fade in active">
     <div class="row">
         
     <div class="col-md-12">
<!--   Kitchen Sink -->
<div class="panel panel-default">

<div class="panel-heading">

 <h3>Admin To Parent Message</h3> 
    
</div>


<div class="panel-bodytable-full-width table-responsive">
<table class="table table-hover table-striped table-bordered">
<thead>
<tr>
<th>ID</th>
<th>Subject</th>
<th>Message</th>

<th>Action</th>
</tr>
</thead>
                <tbody>
<tr v-for="adminmsg in adminmsgs">

<td>{{ adminmsg.id }}</td>
<td>{{ adminmsg.subject }}</td>
<td>{{ adminmsg.message.substring(0, 50)+'...' }}</td>

<td>
<router-link :to="{ name: 'singleadmintoparent', params: { id: adminmsg.id }}"tag='button' class="btn btn-primary"><i class="fa fa-eye"></i></router-link>

<button type="button" class="btn btn-danger "><i class="fa fa-trash"></i>
</button>
</td>


</tr>

                   
                </tbody>
            </table>
   
</div>
</div>
</div>
<!-- end col 12 -->
  </div>
  
</div> 
<!-- tab end inter-->

<div id="doctortoparentmsg" class="tab-pane fade ">
     <div class="row">
         
   <!-- col-md-6 -->
 <div class="col-md-12">
<!--   Kitchen Sink -->
<div class="panel panel-default">

<div class="panel-heading">

 <h3>Doctor To Parent Message</h3> 
    
</div>


<div class="panel-bodytable-full-width table-responsive">
<table class="table table-hover table-striped table-bordered">
<thead>
<tr>
<th>ID</th>
<th>Subject</th>
<th>Message</th>

<th>Action</th>
</tr>
</thead>
                <tbody>
<tr v-for="doctormsg in doctormsgs">

<td>{{ doctormsg.id }}</td>
<td>{{ doctormsg.subject }}</td>
<td>{{ doctormsg.message.substring(0, 50)+'...' }}</td>

<td>
<router-link :to="{ name: 'singledoctortoparent', params: { id: doctormsg.id }}"tag='button' class="btn btn-primary"><i class="fa fa-eye"></i></router-link>

<button type="button" class="btn btn-danger "><i class="fa fa-trash"></i>
</button>
</td>


</tr>

                   
                </tbody>
            </table>
   
</div>
</div>
</div>
<!-- end col 12 -->
  </div>
  
</div> 
<!-- tab end inter-->

<div id="teachertoparentmsg" class="tab-pane fade ">
     <div class="row">
         
   <!-- col-md-6 -->
 <div class="col-md-12">
<!--   Kitchen Sink -->
<div class="panel panel-default">

<div class="panel-heading">

 <h3>Teacher To Parent Message</h3> 
    
</div>


<div class="panel-bodytable-full-width table-responsive">
<table class="table table-hover table-striped table-bordered">
<thead>
<tr>
<th>ID</th>
<th>Subject</th>
<th>Message</th>

<th>Action</th>
</tr>
</thead>
                <tbody>
<tr v-for="teachermsg in teachermsgs">

<td>{{ teachermsg.id }}</td>
<td>{{ teachermsg.subject }}</td>
<td>{{ teachermsg.message.substring(0, 50)+'...' }}</td>

<td>
<router-link :to="{ name: 'singleteachertoparent', params: { id: teachermsg.id }}"tag='button' class="btn btn-primary"><i class="fa fa-eye"></i></router-link>

<button type="button" class="btn btn-danger "><i class="fa fa-trash"></i>
</button>
</td>


</tr>

                   
                </tbody>
            </table>
   
</div>
</div>
</div>
<!-- end col-md-6 -->
<!-- end col 12 -->
  </div>
  
</div> 
<!-- tab end inter-->
<div id="parenttoadminmsg" class="tab-pane fade ">
     <div class="row">
         
   <div class="col-md-12">
<!--   Kitchen Sink -->
<div class="panel panel-default">

<div class="panel-heading">

 <h3>Parent To Admin Message</h3> 
    
</div>
<div class="panel-bodytable-full-width table-responsive">
<table class="table table-hover table-striped table-bordered">
<thead>
<tr>
<th>ID</th>
<th>Subject</th>
<th>Message</th>

<th>Action</th>
</tr>
</thead>
                <tbody>
<tr v-for="parentmsg in parentmsgs">

<td>{{ parentmsg.id }}</td>
<td>{{ parentmsg.subject }}</td>
<td>{{ parentmsg.message.substring(0, 50)+'...' }}</td>

<td>
<router-link :to="{ name: 'singleparenttoadmin', params: { id: parentmsg.id }}"tag='button' class="btn btn-primary"><i class="fa fa-eye"></i></router-link>

<button type="button" class="btn btn-danger "><i class="fa fa-trash"></i>
</button>
</td>
</tr>
</tbody>
            </table>
   
</div>
</div>
</div>
<!-- end col-md-6 -->
  </div>
  
</div> 
<!-- tab end inter-->
<div id="parenttodoctormsg" class="tab-pane fade ">
     <div class="row">

<div class="col-md-12">
<!--   Kitchen Sink -->
<div class="panel panel-default">

<div class="panel-heading">

 <h3>Parent To Doctor Message</h3> 
    
</div>


<div class="panel-bodytable-full-width table-responsive">
<table class="table table-hover table-striped table-bordered">
<thead>
<tr>
<th>ID</th>
<th>Subject</th>
<th>Message</th>

<th>Action</th>
</tr>
</thead>
                <tbody>
<tr v-for="parenttodoctormsg in parenttodoctormsgs">

<td>{{ parenttodoctormsg.id }}</td>
<td>{{ parenttodoctormsg.subject }}</td>
<td>{{ parenttodoctormsg.message.substring(0, 50)+'...' }}</td>

<td>
<router-link :to="{ name: 'singleparenttodoctor', params: { id: parenttodoctormsg.id }}"tag='button' class="btn btn-primary"><i class="fa fa-eye"></i></router-link>

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
  </div>
  
</div> 
<!-- tab end inter-->
<div id="parenttoteachermsg" class="tab-pane fade ">
     <div class="row">
   <div class="col-md-12">
<!--   Kitchen Sink -->
<div class="panel panel-default">

<div class="panel-heading">

 <h3>Parent To Teacher Message</h3> 
    
</div>
<div class="panel-bodytable-full-width table-responsive">
<table class="table table-hover table-striped table-bordered">
<thead>
<tr>
<th>ID</th>
<th>Subject</th>
<th>Message</th>

<th>Action</th>
</tr>
</thead>
                <tbody>
<tr v-for="parenttoteachermsg in parenttoteachermsgs">

<td>{{ parenttoteachermsg.id }}</td>
<td>{{ parenttoteachermsg.subject }}</td>
<td>{{ parenttoteachermsg.message.substring(0, 50)+'...' }}</td>

<td>
<router-link :to="{ name: 'singleparenttoteacher', params: { id: parenttoteachermsg.id }}"tag='button' class="btn btn-primary"><i class="fa fa-eye"></i></router-link>

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

<!-- col-md-6 -->
  </div>
  
</div> 
<!-- tab end inter-->
</div>
<!-- tab end -->






</div>

</div>

</template>

<script>
export default {

data () {
return {
// Create a new form instance

child:{},
adminmsgs:{},
doctormsgs:{},
teachermsgs:{},
parentmsgs:{},
parenttodoctormsgs:{},
parenttoteachermsgs:{},
form: new Form({


})


}
},
methods: {
singlechild () {
// Submit the form via a POST request
let id=this.$route.params.id;
axios.get('/childinfo/'+id)
.then(({ data }) => 
{ 
this.child=data;
console.log(data);
}
)
},
loadadminmsg () {
// Submit the form via a POST request
let id=this.$route.params.id;
axios.get('/admintoparentmsg/'+id)
.then(({ data }) => 
{ 
this.adminmsgs=data;
console.log(data);
}
)
},
loaddoctormsg () {
// Submit the form via a POST request
let id=this.$route.params.id;
axios.get('/doctortoparentmsg/'+id)
.then(({ data }) => 
{ 
this.doctormsgs=data;
console.log(data);
}
)
},
loadteachermsg () {
// Submit the form via a POST request
let id=this.$route.params.id;
axios.get('/teachertoparentmsg/'+id)
.then(({ data }) => 
{ 
this.teachermsgs=data;
console.log(data);
}
)
},
loadparenttoadminmsg () {
// Submit the form via a POST request
let id=this.$route.params.id;
axios.get('/parenttoadminmsg/'+id)
.then(({ data }) => 
{ 
this.parentmsgs=data;
console.log(data);
}
)
},
loadparenttodoctormsg () {
// Submit the form via a POST request
let id=this.$route.params.id;
axios.get('/parenttodoctormsg/'+id)
.then(({ data }) => 
{ 
this.parenttodoctormsgs=data;
console.log(data);
}
)
},
loadparenttoteachermsg () {
// Submit the form via a POST request
let id=this.$route.params.id;
axios.get('/parenttoteachermsg/'+id)
.then(({ data }) => 
{ 
this.parenttoteachermsgs=data;
console.log(data);
}
)
},

},
beforeCreate(){
if(!this.$gate.isParent() && !this.$gate.isAdmin() && !this.$gate.isDoctor() && !this.$gate.isTeacher()){
this.$router.push({ name: 'notfound'})
}

},

created() {
this.singlechild()
this.loadadminmsg()
this.loaddoctormsg()
this.loadteachermsg()
this.loadparenttoadminmsg()
this.loadparenttodoctormsg()
this.loadparenttoteachermsg()
},


}
</script>
