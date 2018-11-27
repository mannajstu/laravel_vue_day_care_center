
<template>

                    <div>
                    <div class="row">
 
                    <form @submit.prevent="editmode ? updategallery() : addgallery()" >

                

                    <!-- end col-md-12 -->
                    <div class="col-md-12">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                    <h3>Gallery Image Information</h3>
                     
                    </div> 
                    <div class="panel-body">  
                    <div class="form-group col-md-6">
                    <label>Title</label>
                    <input v-model="title" type="text" name="title"
                    class="form-control" >
                    <form-error v-if="errors.title" :errors="errors">
                       <span class="help-block invalid-feedback" v-for='(item, index) in errors.title'>{{ item }}</span> 
                    </form-error>
                                        </div>
                  
                    <div class="form-group col-md-6">
                    <label>Image</label>
                    
                    <input type="file" class="form-control" v-on:change="onImageChange" >
                    <form-error v-if="errors.image" :errors="errors">
                       <span class="help-block invalid-feedback" v-for='(item, index) in errors.image'>{{ item }}<br></span> 
                    </form-error>
                    </div>
                    <div class="form-group col-md-12">
                    <label>Use As Slider</label>
                    <input type="checkbox" value="1" v-model="slider" >
                   
                    
                    </div>
                    <div v-if='editmode'class="form-group col-md-4">
                    <label>Previous Image</label>
                    <img :src="imagelink"  style="width: 100px;height: 100px">
                   
                    
                    </div>

                    
                   
                    </div>
                    </div>
                    </div>
                    <!-- end col-md-12 -->
                    
                    
                    <div class="col-md-12">
<div class="form-group">
                     <button v-show='!editmode' type="submit" class="btn btn-primary btn-lg btn-block">Add Image</button>
    <button v-show='editmode' type="submit" class="btn btn-primary btn-lg btn-block">Update Image</button></div></div>
                    </form>
                    </div> 
                    <!--  end of row -->
                                 
                    </div>

                    </template>



 

<script>

    export default {        

        data() {
            return {
             editmode:false,
id:'',
title: '',
image: '',
imagelink: '',
slider: [],
errors:{}
   };

        },

        methods: {
            onImageChange(e){

                console.log(e.target.files[0]);

                this.image = e.target.files[0];
            },

            addgallery(e) {
                          let currentObj = this;
  const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
                let formData = new FormData();

                formData.append('image', this.image);
                formData.append('title', this.title);
                formData.append('slider', this.slider); 
console.log(formData)
               axios.post('/galleryinfo', formData, config)
.then(({ data }) => 
{ 
this.successmsg();
this.$router.push('/gallerypage');

}
)
.catch(error => {
    this.errors='';
    this.errors=error.response.data.errors;
})

            },
            updategallery(e) {
                          let currentObj = this;
  const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
                let formData = new FormData();

                formData.append('image', this.image);
                formData.append('title', this.title);
                formData.append('slider', this.slider); 
console.log(formData)
               axios.put('/galleryinfo/'+this.id, {title:this.title}, config)
.then(({ data }) => 
{ 
this.successmsg();
this.$router.push('/gallerypage');

}
)
.catch(error => {
    this.errors='';
    this.errors=error.response.data.errors;
})

            },
            loadgallery(){
let id=this.$route.params.id;
if(id){
axios.get('/galleryinfo/'+id)
  .then(({ data }) => 
  { 
    this.editmode=true;
    this.id=data.id;
    this.imagelink=data.imagelink;

    this.title=data.title;
    this.slider=data.slider;
    console.log(data);
  }
  )
}
},

        },
        created() {
    
       this.loadgallery(); 

},

    }

</script>