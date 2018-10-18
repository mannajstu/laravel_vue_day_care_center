<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li class="text-center">
                <img class="user-image img-responsive" src="/assets/img/find_user.png"/>
            </li>
            @can('isAdmin')
            <li>
                <router-link to="/user">
                    <i class="fa fa-dashboard fa-3x">
                    </i>
                    User
                </router-link>
            </li>
            <li>
                <router-link to="/child">
                    <i class="fa fa-dashboard fa-3x">
                    </i>
                    Child
                </router-link>
            </li>
            @endcan
@can('isAdminParent')
            <li>
                <router-link to="/parent">
                    <i class="fa fa-dashboard fa-3x">
                    </i>
                    Parent
                </router-link>
            </li>
            @endcan
                    @can('isAdminDoctor')
            <li>
                <router-link to="/doctor">
                    <i class="fa fa-dashboard fa-3x">
                    </i>
                    Doctor
                </router-link>
            </li>
            @endcan

                    @can('isAdminTeacher')
            <li>
                <router-link to="/teacher">
                    <i class="fa fa-dashboard fa-3x">
                    </i>
                    Teacher
                </router-link>
            </li>
            @endcan
                    @can('isAdmin')
            <li>
                <router-link to="/room">
                    <i class="fa fa-dashboard fa-3x">
                    </i>
                    Room
                </router-link>
            </li>
            @endcan
        </ul>
    </div>
</nav>
<!-- /. NAV SIDE  -->
