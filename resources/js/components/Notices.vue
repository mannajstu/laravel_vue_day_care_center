<template>
	<div class="panel panel-default">
                        
                        <div class="panel-heading">

                    <h3>Notices</h3> 
                            
                        </div>
 <ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#general">General</a></li>
  <li><a data-toggle="tab"  v-if="this.$gate.isParent()" href="#doctor">Doctor</a></li>
  <li><a data-toggle="tab" v-if="this.$gate.isParent()" href="#teacher">Teacher</a></li>
</ul>

<div class="tab-content">
  <div id="general" class="tab-pane fade in active">
     <ul >
            <li v-for="generalnotice in generalnotices"><router-link :to="{ name: 'singlegeneralnotice', params: { id: generalnotice.id }}" >{{ generalnotice.title }}</router-link></li>
            
            
            
          </ul>
  </div>
  <div v-if="this.$gate.isParent()" id="doctor" class="tab-pane fade">
  <ul v-for="generalnotice in generalnotices">
           <!--  <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li><a href="#">Separated link</a></li>
            <li><a href="#">One more separated link</a></li>
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li><a href="#">Separated link</a></li>
            <li><a href="#">One more separated link</a></li>
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li> -->
            
            
          </ul>
  </div>
  <div v-if="this.$gate.isParent()" id="teacher" class="tab-pane fade">
    <ul >
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li><a href="#">Separated link</a></li>
            <li><a href="#">One more separated link</a></li>
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li><a href="#">Separated link</a></li>
            <li><a href="#">One more separated link</a></li>
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            
            
          </ul>
  </div>
</div>
</div>
</template>

<script>
    export default {

        data () {
    return {
      // Create a new form instance
      
      parent:{},
      children:{},
       generalnotices:{},
     
      
    }
  },
  methods: {
    singleparent () {
      // Submit the form via a POST request
      let id=this.$route.params.id;
      axios.get('/parentinfo/'+id)
        .then(({ data }) => 
        { 
           this.parent=data;
           this.children=data.childinfos;

           console.log(data);
        }
        )
    },
     loadgeneralnotices(){
          axios.get('/generalnoticeinfo')
            .then(({ data }) => 
            { 
               this.generalnotices=data;
               console.log(data);
                
            }
            )
          },
   
  },
  beforeCreate(){

},
        created() {
            this.singleparent();
            this.loadgeneralnotices();
        },
     

    }
</script>
