                    <template>

                    <div >
                    <div class="row">
                    <form @submit.prevent="editmode ? updatechild() : addtemchild()" @keydown="form.onKeydown($event)" >

                <div class="col-md-12">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                    <h3>Child Information</h3>
                    </div> 
                    <div class="panel-body"> 

                    <div class="form-group col-md-3">
                    <label>Child Name</label>
                    <input v-model="form.child_name" type="text" name="child_name"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('child_name') }">
                    <has-error :form="form" field="child_name"></has-error>
                    </div>

                    
                    <div class="form-group col-md-3">
                    <label>Birth Date</label>

                     <date-picker v-model="form.birth_date" :config="options"></date-picker>
                   
                    <has-error :form="form" field="birth_date"></has-error>
                    </div>
                    <div class="form-group col-md-3">
                    <label>Birth Regitation Number</label>
                    <input v-model="form.birth_reg_no" type="number" name="birth_reg_no"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('birth_reg_no') }">
                    <has-error :form="form" field="birth_reg_no"></has-error>
                    </div>

                    <div class="form-group col-md-3">
                    <label>Gender</label>
                    
            <select v-model="form.gender" name="gender" class="form-control" :class="{ 'is-invalid': form.errors.has('gender') }">
            <option>Male</option>
            <option>Female</option>
            <option>Other</option>
            </select>
                    <has-error :form="form" field="gender"></has-error>
                    </div>
                
                    
  
                    </div>
                    </div>
            </div>

                    <!-- end col-md-12 -->
                    <div class="col-md-12">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                    <h3>Parent Information</h3>
                     
                    </div> 
                    <div class="panel-body">  
                    <div class="form-group col-md-4">
                    <label>Contact Number</label>
                        <input v-model="form.contact_number" type="number" name="contact_number"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('contact_number') }">
                        <has-error :form="form" field="contact_number"></has-error>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Email Address</label>
                        <input v-model="form.email" type="email" name="email"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                        <has-error :form="form" field="email"></has-error>
                    </div>
                    <div v-if="!oldparent">
                    <div class="form-group col-md-4">
                    <label>Father Name</label>
                    <input v-model="form.father_name" type="text" name="father_name"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('father_name') }">
                    <has-error :form="form" field="father_name"></has-error>
                    </div>
                    <div class="form-group col-md-4">
                    <label>Mother Name</label>
                    <input v-model="form.mother_name" type="text" name="mother_name"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('mother_name') }">
                    <has-error :form="form" field="mother_name"></has-error>
                    </div>

                    <div class="form-group col-md-4">
                    <label>Contact Address</label>
                    <input v-model="form.contact_address" type="text" name="contact_address"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('contact_address') }">
                    <has-error :form="form" field="contact_address"></has-error>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    
                    <!-- end col-md-12 -->
                    <div class="col-md-12">
<div class="form-group">
                     <button :disabled="form.busy" v-show='!editmode' type="submit" class="btn btn-primary btn-lg btn-block">Add Child</button>
    </div></div>
                    </form>
                    </div> 
                    <!--  end of row -->
                                 
                    </div>

                    </template>

<script>
export default {
    data() {
        return {
            // Create a new form instance

            timeoptions: {
                format: "LT",
                useCurrent: true
            },
            options: {
                format: "DD/MM/YYYY",
                useCurrent: true
            },
            form: new Form({
                id: "",
                child_name: "",
                mother_name: "",
                father_name: "",
                contact_number: "",
                email: "",
                contact_address: "",
                birth_date: "",
                birth_reg_no: "",
                gender: ""
            })
        };
    },
    methods: {
        addtemchild() {
            // Submit the form via a POST request
            this.form.post("/temchild").then(({ data }) => {
                this.restform();
                this.successmsg();
            });
        },
        
        
        

        // method end
    },
    beforeCreate() {
        
    },
    created() {
        
    },
    watch: {
        $route(to, from) {
            //update the variables with new route params
            Object.assign(this.$data, this.$options.data());
        }
    }
    //       computed: {

    //   updateinfo(){
    //     return this.loadchild();
    //   }
    // }
};
</script>
