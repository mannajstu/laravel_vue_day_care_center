{{-- <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0;">
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
    <div style="color: white;padding: 15px 50px 5px 50px;float: right;
font-size: 16px;">
<p class="btn btn-info square-btn-adjust">You Are Login As {{ Session::get('role') }}</p>
        <a class="btn btn-danger square-btn-adjust" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
        <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</nav>
<!-- /. NAV TOP  -->
 --}}