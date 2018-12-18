<!-- /. NAV TOP  -->
<nav class="navbar-default navbar-side" role="navigation">
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
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">

            <li>
                <router-link to="/">
                    <i class="fa fa-dashboard fa-2x">
                    </i>
                    Home
                </router-link>
            </li>
            @can('isAdmin')
            <li>
                        <a href="#"><i class="fa fa-sitemap fa-2x"></i> Admin<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            
            
            <li>
                <router-link to="/user" >
                    <i class="fa fa-dashboard fa-2x">
                    </i>
                    User
                </router-link>
            </li>
            
            <li>
                <router-link to="/child">
                    <i class="fa fa-dashboard fa-2x">
                    </i>
                    Child
                </router-link>
            </li>
            <li>
                <router-link to="/exam">
                    <i class="fa fa-dashboard fa-2x">
                    </i>
                    Exam
                </router-link>
            </li>
            
            <li>
                <router-link to="/generalnotice">
                    <i class="fa fa-dashboard fa-2x">
                    </i>
                    General Notice
                </router-link>
            </li>
            <li>
                <router-link to="/parent">
                    <i class="fa fa-dashboard fa-2x">
                    </i>
                    Parent
                </router-link>
            </li>
            <li>
                <router-link to="/doctor">
                    <i class="fa fa-dashboard fa-2x">
                    </i>
                    Doctor
                </router-link>
            </li>
            <li>
                <router-link to="/teacher">
                    <i class="fa fa-dashboard fa-2x">
                    </i>
                    Teacher
                </router-link>
            </li>
            <li>
                <router-link to="/room">
                    <i class="fa fa-dashboard fa-2x">
                    </i>
                    Room
                </router-link>
            </li>
            <li>
                <router-link to="/class">
                    <i class="fa fa-dashboard fa-2x">
                    </i>
                    Class
                </router-link>
            </li>
             <li>
                <router-link to="/guestmsg">
                    <i class="fa fa-dashboard fa-2x">
                    </i>
                    Guest Message
                </router-link>
            </li>
            <li>
                <router-link to="/headercontent">
                    <i class="fa fa-dashboard fa-2x">
                    </i>
                   Header Content
                </router-link>
            </li>
            <li>
                <router-link to="/aboutpage">
                    <i class="fa fa-dashboard fa-2x">
                    </i>
                   About Page
                </router-link>
            </li>
            <li>
                <router-link to="/gallerypage">
                    <i class="fa fa-dashboard fa-2x">
                    </i>
                   Gallery Page
                </router-link>
            </li>         
                        </ul>
                      </li>
                       @endcan
                        @auth
              <li>
                <router-link to="/home">
                    <i class="fa fa-dashboard fa-2x">
                    </i>
                    DashBoard
                </router-link>
            </li>
            @endauth
            <li>
                <router-link to="/about">
                    <i class="fa fa-dashboard fa-2x">
                    </i>
                    About
                </router-link>
            </li>
            <li>
                <router-link to="/gallery">
                    <i class="fa fa-dashboard fa-2x">
                    </i>
                    Gallery
                </router-link>
            </li>
            <li>
                <router-link to="/contact">
                    <i class="fa fa-dashboard fa-2x">
                    </i>
                    Contact 
                </router-link>
            </li>

           
                        
            
            

            @auth
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="fa fa-dashboard fa-2x">
                    </i>
                    {{ __('Logout') }}
                </a>
                <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
            @else
            <li>
                <router-link to="/login">
                    <i class="fa fa-dashboard fa-2x">
                    </i>
                    Login
                </router-link>
            </li>
            <li>
                <router-link to="/register">
                    <i class="fa fa-dashboard fa-2x">
                    </i>
                    Register
                </router-link>
            </li>
            @endauth
        </ul>
    </div>
</nav>
<!-- /. NAV SIDE  -->
