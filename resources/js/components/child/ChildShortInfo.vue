<template>
	
	<div class="panel panel-default">
                        
                        <div class="panel-heading">

                        <router-link to='/child' v-if="this.$gate.isAdmin()" tag='button' class='btn btn-primary'>All Child</router-link>
                    
                           <h3>Child Information</h3> 
                            
                        </div>
                    

                         <div class="card-body table-full-width table-responsive">
                                     <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                        <th>ID</th>
                        <th>Child Name</th>
                        

                        <th>Birth Reg No</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                                        <tbody>
                    <tr v-for="child in children">
                        
                    <td>{{ child.id }}</td>
                    <td>{{ child.child_name }}</td>
                     <td>{{ child.birth_reg_no }}</td>


                    <td>
                      <router-link :to="{ name: 'singlechild', params: { id: child.id }}"tag='button' class="btn btn-primary"><i class="fa fa-eye"></i></router-link>
                       <router-link :to="{ name: 'editchild', params: { id: child.id }}"tag='button' class="btn btn-info"><i class="fa fa-eye"></i></router-link>

                    
                    <button type="button" class="btn btn-danger "><i class="fa fa-trash"></i>
                    </button>
                  </td>


                    </tr>             
                             
           </tbody>
                </table>
                 </div>
                    </div>
</template>

<script>
    export default {
    	props: ['children'],

       
     
beforeCreate(){
if(!this.$gate.isParent() && !this.$gate.isAdmin() && !this.$gate.isDoctor() && !this.$gate.isTeacher()){
this.$router.push({ name: 'notfound'})
}

},
    }
</script>