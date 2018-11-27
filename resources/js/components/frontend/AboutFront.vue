<template>
 
                 <div class="row ">
                 
                    <div col-md-12>
                      <div class="col-md-12 " >     
                 <div class="well">{{ description }}</div>
 </div>
                 
                    
                           
                        </div>    
                        </div>    

</template>

<script>
    export default {

        data () {
    return {
      description:'',
      

      
    }
  },
  methods: {
     aboutcontent () {
        // Submit the form via a POST request
        axios.get('/aboutinfo')
        .then(({ data }) => 
        {    
        
        this.description=data[0].description;
        console.log(data);
   }
        )
        },
        
   
  },
 
    created() {
    
       this.aboutcontent(); 
       

},
     

    }
</script>
