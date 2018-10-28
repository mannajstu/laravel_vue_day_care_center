<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
            <meta content="width=device-width, initial-scale=1" name="viewport">
                <!-- CSRF Token -->
                <meta content="{{ csrf_token() }}" name="csrf-token">
                    <title>
                        {{ config('app.name', 'Laravel') }}
                    </title>
                    <!-- Fonts -->
                    <link href="https://fonts.gstatic.com" rel="dns-prefetch">
                        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
                            <!-- Styles -->
                            <link href="{{ asset('css/app.css') }}" rel="stylesheet">
                                <!-- BOOTSTRAP STYLES-->
                                <!-- GOOGLE FONTS-->
                                <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css"/>
                            </link>
                        </link>
                    </link>
                </meta>
            </meta>
        </meta>
    </head>
    <body>
        <div id="app">
            @if(Auth::check())
            <div id="wrapper">
                @include('inc.topmenu') 
@include('inc.sidemenu')
                <div id="page-wrapper">
                    <div id="page-inner">
                        <router-view>
                        </router-view>
                    </div>
                    <!-- /. PAGE INNER  -->
                </div>
                <!-- /. PAGE WRAPPER  -->
            </div>
            @else
        
            @yield('content')
        
    
        @endif
        </div>
        <!-- /. WRAPPER /app finished  -->
        <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
        <!-- JQUERY SCRIPTS -->
        <script src="{{ asset('assets/js/jquery-1.10.2.js') }}">
        </script>
        <!-- BOOTSTRAP SCRIPTS -->
        <script src="{{ asset('assets/js/bootstrap.min.js') }}">
        </script>
        <!-- METISMENU SCRIPTS -->
        <script src="{{ asset('assets/js/jquery.metisMenu.js') }}">
        </script>
        <!-- MORRIS CHART SCRIPTS -->
        <script src="{{ asset('assets/js/morris/raphael-2.1.0.min.js') }}">
        </script>
        <script src="{{ asset('assets/js/morris/morris.js') }}">
        </script>
        <!-- CUSTOM SCRIPTS -->
        <script src="{{ asset('assets/js/custom.js') }}">
        </script>
        <!-- Scripts -->
        <script defer="" src="{{ asset('js/app.js') }}">
        </script>
        @auth
        @php
            
            $roles= auth()->user()->roles()->get();
            $role= false;
        foreach ($roles as $urole) {
           if($urole->name===Session::get('role')){
            $role= true;
           }

        }

        @endphp
        @if($role)
        <script>
            window.user=@json(Session::get('role'));
        </script>
        @endif
           @endauth
    </body>
</html>
