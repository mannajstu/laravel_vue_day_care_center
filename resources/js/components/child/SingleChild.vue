<template>
    
        

                 <div class="row ">
                    <div col-md-12>
                           
                 
                    
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
                </div>
                
            </div>
             
</template>

<script>
    export default {

        data () {
    return {
      // Create a new form instance
      
      child:{},
     
      
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
   
  },
  beforeCreate(){
    if(!this.$gate.isParent() && !this.$gate.isAdmin() && !this.$gate.isDoctor() && !this.$gate.isTeacher()){
    this.$router.push({ name: 'notfound'})
}

},
  
        created() {
            this.singlechild()
        },
     

    }
</script>
