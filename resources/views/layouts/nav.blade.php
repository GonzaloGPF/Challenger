<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <!-- Branding Image -->
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <!-- Collapsed Hamburger -->
        <button type="button" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <div class="navbar-collapse collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a href="#" id="dropDownBrowse" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Browse <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropDownBrowse">
                        <li class="dropdown-item"><a href="{{ url('challenges') }}">All Challenges</a></li>
                        @if(\Auth::check())
                            <li class="dropdown-item"><a href="{{ url('challenges', ['name' => \Auth::user()] ) }}">My Challenges</a></li>
                        @endif
{{--                        <li class="dropdown-item"><a href="{{ route('challenges', ['popular' => 1] )}}">Popular Challenges</a></li>--}}
                    </ul>
                </li>
                <li class="nav-item"><a href="{{ route('challenges.create') }}" class="nav-link">New Challenge</a></li>

                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories <span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--@foreach($challengeCategory as $category)--}}
                            {{--<li><a href="{{url('challenges', ['type' => $category->id] ) }}">{{ $category->name }}</a></li>--}}
                        {{--@endforeach--}}
                    {{--</ul>--}}
                {{--</li>--}}
            </ul>


            <!-- Authentication Links -->
            @if (Auth::guest())
                <a href="{{ route('login') }}" class="nav-link">Login</a>
                <a href="{{ route('register') }}" class="nav-link">Register</a>
            @else
                {{--<user-notifications></user-notifications>--}}
                <div class="nav-item dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li class="nav-item">
                            <a href="{{ route('profiles', Auth::user()) }}" class="nav-link">My profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
</nav>