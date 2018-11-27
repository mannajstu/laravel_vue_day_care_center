<template>
   <div >   
    <div class="row" >
                        <div class="col-md-12  " v-if='$gate.isAdmin()'>
                           
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    
                                    <router-link :to="{ name: 'addgeneralnotice'}" tag='button' class="btn btn-primary">Add General Notice</router-link>
                                    <h4 class="card-title">General Notice</h4>
                                    </div>

                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                                               
                        <th>ID</th>
                        <th>Title</th> 
                        <th>Description</th>
                        
                        <th>Action</th>
                        </tr>
                        </thead>
                                        <tbody>
                    <tr v-for="generalnotice in generalnotices">
                        
                   
                   
                    <td>{{ generalnotice.id }}</td>
                    <td>{{ generalnotice.title }}</td>
                    <td>{{ generalnotice.description.substring(0, 100)+'...' }}</td>
                   
 
                   <td>
                    <router-link :to="{ name: 'singlegeneralnotice', params: { id: generalnotice.id }}"tag='button' class="btn btn-primary"><i class="fa fa-eye"></i></router-link>

                    <router-link :to="{ name: 'editgeneralnotice', params: { id: generalnotice.id }}"tag='button' class="btn btn-info"><i class="fa fa-eye"></i>
                    </router-link>

                    <button type="button" class="btn btn-danger "><i class="fa fa-trash"></i>
                    </button>
                  </td>


                    </tr>  
                      </tbody>
                                    </table>
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
      generalnotices:{},
      
    }
  },
  methods: {
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
        created() {
            this.loadgeneralnotices();
            
           
        },
  //       computed: {
  //   filteredList() {
  //     return this.children.filter(childrens => {
  //       return childrens.child_name.toLowerCase().includes(this.search.toLowerCase())
  //     })
  //   }
  // }
     

    }
</script>
