<template>
 <div>
 <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0; min-height: 0">
    <div class="navbar-header">
        <button class="navbar-toggle" data-target=".sidebar-collapse" data-toggle="collapse" type="button">
            <span class="sr-only">
                Toggle navigation
            </span>
            <span class="icon-bar">
            </span>
            <span class="icon-bar">
            </span>
            <span class="icon-bar">
            </span>
        </button>
        
        
    </div>
    
</nav>
<!-- /. NAV TOP  -->
<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            
            <li>
                <router-link to="/user">
                    <i class="fa fa-dashboard fa-3x">
                    </i>
                   Home
                </router-link>
            </li>
            <li>
                <router-link to="/child">
                    <i class="fa fa-dashboard fa-3x">
                    </i>
                 Gallery
                </router-link>
            </li>
            <li>
                <router-link to="/exam">
                    <i class="fa fa-dashboard fa-3x">
                    </i>
                  Exam
                </router-link>
            </li>
            <li>
                <router-link to="/user">
                    <i class="fa fa-dashboard fa-3x">
                    </i>
                   Home
                </router-link>
            </li>
            <li>
                <router-link to="/child">
                    <i class="fa fa-dashboard fa-3x">
                    </i>
                  Child
                </router-link>
            </li>
            <li>
                <router-link to="/exam">
                    <i class="fa fa-dashboard fa-3x">
                    </i>
                  Exam
                </router-link>
            </li>
            
             
        </ul>
    </div>
</nav>

               
             </div>            
</template>

<script>
    export default {

        data () {
    return {
      
     
      
    }
  },
  methods: {
    
   
  },
 
    
     

    }
</script>
