<template>
 
                 <div class="row ">
                 
                    <div col-md-12>
                      <div class="col-md-12 " >     
                 <div class="well">{{ header_content }}</div>
 </div>
                 
                    
                <div class="col-md-6" >
                 
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li v-for='(slider,index) in frontslider' data-target="#myCarousel" :data-slide-to="index" class="active"></li>
      
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" >

      <div v-for='(slider,index) in frontslider' :class="[index==0 ? 'item active' : 'item']">
        <img :src="slider.imagelink" alt="Los Angeles" style="width:100%; height: 22em">
        <div class="carousel-caption">
          <h3>{{ slider.title }}</h3>
          
        </div>
      </div>

      
  
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
                        </div>   


               <div class="col-md-6 col-sm-12 col-xs-12" >
                   
                    <div class="chat-panel panel panel-default chat-boder chat-panel-head">
                        <div class="panel-heading">
                            <i class="fa fa-comments fa-fw"></i>
                            Notice
                            </div>

                        <div class="panel-body" style="height: 20em" >
                            <div id="general" class="tab-pane fade in active">
    <ul >
            <li v-for="generalnotice in generalnotices"><router-link :to="{ name: 'singlegeneralnotice', params: { id: generalnotice.id }}" :style="{ color: 'black'}">{{ generalnotice.title }}</router-link></li>
            

            
            
          </ul>
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
      header_content:'',
      generalnotices:{},
      frontslider:{},

      
    }
  },
  methods: {
     headercontent () {
        // Submit the form via a POST request
        axios.get('/homecontent')
        .then(({ data }) => 
        {    
        
        this.header_content=data[0].header_content;
        console.log(data);
   }
        )
        },
        fgeneralnotice () {
        // Submit the form via a POST request
       axios.get('/generalnoticeinfo')
        .then(({ data }) => 
        {    
        
        this.generalnotices=data;
        console.log(data);
   }
        )
        },
         fslider () {
        // Submit the form via a POST request
       axios.get('/sliderinfo')
        .then(({ data }) => 
        {    
        
        this.frontslider=data;
        console.log(data);
   }
        )
        },
   
  },
 
    created() {
    
       this.headercontent(); 
       this.fgeneralnotice(); 
       this.fslider(); 

},
     

    }
</script>
