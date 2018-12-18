<template>
    
        

                 <div class="row ">
                    <div col-md-12>
                           
                 
                    
                <div class="col-md-6">
                  <!--   Kitchen Sink -->
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
                                            <th>Doctor ID</th>
                                            <td>{{ doctor.id}}</td>
                                            
                                        </tr>
                                        <tr>
                                            <th>Doctor Name</th>
                                            <td>{{ doctor.user.name }}</td>
                                            
                                        </tr>
                                        
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ doctor.user.email }}</td>
                                        </tr>

                                <tr>
                                      <th>Contact Number</th>
                                      <td>{{ doctor.user.contact_number }}</td>
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
<div class="col-md-6">
 
                    <form @submit.prevent="admintodoctor()" @keydown="form.onKeydown($event)" >
<!-- end col-md-12 -->
                    <div class="col-md-12">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                    <h3> Admin To Doctor Message </h3>
                     
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
                    </div>
                    <!-- end col-md-12 -->
                    
                    
                    <div class="col-md-12">
<div class="form-group">
                     <button :disabled="form.busy" type="submit" class="btn btn-primary btn-lg btn-block">Add Message</button>
    </div></div>
                    </form>
                    </div> 
                    <!-- col-md-12 -->
<div class="col-md-12">
                  <childchortinfo :children="children"></childchortinfo>
                        </div>
                       <!--  end col-md- -->
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
<tr v-for="doctortoadminmsg in doctortoadminmsgs.data">

<td>{{ doctortoadminmsg.id }}</td>
<td>{{ doctortoadminmsg.subject }}</td>
<td>{{ doctortoadminmsg.message.substring(0, 100)+'...' }}</td>

<td>
<router-link :to="{ name: 'singledoctortoadmin', params: { id: doctortoadminmsg.id }}"tag='button' class="btn btn-primary"><i class="fa fa-eye"></i></router-link>

<button type="button" class="btn btn-danger "><i class="fa fa-trash"></i>
</button>
</td>


</tr>

  <pagination :data="doctortoadminmsgs" @pagination-change-page="loaddoctortoadminmsg"></pagination>                  
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
<tr v-for="admintodoctormsg in admintodoctormsgs.data">

<td>{{ admintodoctormsg.id }}</td>
<td>{{ admintodoctormsg.subject }}</td>
<td>{{ admintodoctormsg.message.substring(0, 100)+'...' }}</td>

<td>
<router-link :to="{ name: 'singleadmintodoctor', params: { id: admintodoctormsg.id }}"tag='button' class="btn btn-primary"><i class="fa fa-eye"></i></router-link>

<button type="button" class="btn btn-danger "><i class="fa fa-trash"></i>
</button>
</td>


</tr>

        <pagination :data="admintodoctormsgs" @pagination-change-page="loadadmintodoctormsg"></pagination>            
                </tbody>
            </table>
   
</div>
</div>
</div>



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
      
      doctor:{},
      children:{},
      admintodoctormsgs:{},
      doctortoadminmsgs:{},
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
      let id=this.$route.params.id;
      axios.get('/doctorinfo/'+id)
        .then(({ data }) => 
        { 
           this.doctor=data;
           this.children=data.childinfos;
           this.form.doctorid=data.id;
           this.form.contact_number=data.user.contact_number;
           this.form.email=data.user.email;

           console.log(data);
        }
        )
    },
    admintodoctor () {
        // Submit the form via a POST request
        this.form.post('/admintodoctormsg')
        .then(({ data }) => 
        { 

        this.restform();
        this.successmsg();
        this.singledoctor();
        this.$router.push('/doctor/'+this.doctor.id);
        this.loadadmintodoctormsg();
        
}
        )
// alert(this.form)
        },
        loadadmintodoctormsg (page = 1) {
// Submit the form via a POST request
let id=this.$route.params.id;
axios.get('/admintodoctormsg/'+id+'?page=' + page)
.then(({ data }) => 
{ 
this.admintodoctormsgs=data;
console.log(data);
}
)
},
loaddoctortoadminmsg (page = 1) {
// Submit the form via a POST request
let id=this.$route.params.id;
axios.get('/doctortoadminmsg/'+id+'?page=' + page)
.then(({ data }) => 
{ 
this.doctortoadminmsgs=data;
console.log(data);
}
)
},
   
  },
        created() {
            this.singledoctor()
            this.loadadmintodoctormsg()
            this.loaddoctortoadminmsg()
        },
     

    }
</script>
