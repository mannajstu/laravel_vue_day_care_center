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
<notices ></notices>
</div>
<div class="col-md-12">
<childchortinfo :children="children"></childchortinfo>

</div>

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

console.log(data);
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
},


}
</script>
