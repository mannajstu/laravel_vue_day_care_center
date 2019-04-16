<template>
<div class="row ">
<div class="col-md-12">
   


<div class="col-md-6">
<!--   Kitchen Sink -->
<div class="panel panel-default">

<div class="panel-heading">

<router-link v-if="this.$gate.isAdmin()" to='/show_tem_child' tag='button' class='btn btn-primary'>Back</router-link>
<h3>Temporary Child Information</h3> 
    
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
                    <td>{{ child.father_name }}</td>
                </tr>

<tr>
                    <th>Mother Name</th>
                    <td>{{ child.mother_name }}</td>
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
                    <td>{{ child.contact_number }}</td>
                </tr>

<tr v-if='child.parentinfo!==null'>
                    <th>Contact Address</th>
                    <td>{{ child.contact_address }}</td>
                </tr>
                

<tr>
                    <th>Gender</th>
                    <td>{{ child.gender }}</td>
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

</template>

<script>
export default {

data () {
return {
// Create a new form instance

child:{},

form: new Form({


})


}
},
methods: {
singlechild () {
// Submit the form via a POST request
let id=this.$route.params.id;
axios.get('/temchild/' +id)
.then(({ data }) => 
{ 
this.child=data;
console.log(data);
}
)
},
        

},
beforeCreate(){


},

created() {
this.singlechild()



},


}
</script>
