                    <template>

                    <div>
                    <div class="row">
 
                    <form @submit.prevent="editmode ? updateheadercontent() : addheadercontent()" @keydown="form.onKeydown($event)" >

                

                    <!-- end col-md-12 -->
                    <div class="col-md-12">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                    <h3>Header Content</h3>
                     
                    </div> 
                    <div class="panel-body">  
                    
                  
                    
                    <div class="form-group col-md-12">
                                      
                     <textarea v-model="form.header_content" type="text" name="home_content"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('header_content') }" style="width: 100%">
                        {{form.header_content}}
                    </textarea>
                    <has-error :form="form" field="header_content"></has-error>
                    </div>

                    
                   
                    </div>
                    </div>
                    </div>
                    <!-- end col-md-12 -->
                    
                    
                    <div class="col-md-12">
<div class="form-group">
                     <button :disabled="form.busy" v-show='!editmode' type="submit" class="btn btn-primary btn-lg btn-block">Add Header Content</button>
    <button :disabled="form.busy" v-show='editmode' type="submit" class="btn btn-primary btn-lg btn-block">Update Header Content</button></div></div>
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

            editmode: false,
            old_content: "",

            form: new Form({
                id: "",
                header_content: ""
            })
        };
    },
    methods: {
        addheadercontent() {
            // Submit the form via a POST request
            this.form.post("/homecontent").then(({ data }) => {
                this.successmsg();
                this.$router.push("/headercontent");
                this.oldheadercontent();
            });
        },
        updateheadercontent() {
            // Submit the form via a POST request

            this.form.put("/homecontent/" + this.form.id).then(({ data }) => {
                this.successmsg();
                this.$router.push("/headercontent");
            });
        },
        oldheadercontent() {
            // Submit the form via a POST request
            this.form.get("/homecontent").then(({ data }) => {
                this.form.id = data[0].id;
                this.form.header_content = data[0].header_content;
                this.editmode = true;
            });
        }

        // method end
    },
    created() {
        this.oldheadercontent();
    }
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
};
</script>
