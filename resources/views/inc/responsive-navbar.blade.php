<nav class="navbar navbar-expand-md navbar-dark bg-dark ">
    <a class="navbar-brand" href="#">{{ config('app.name', 'Laravel') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item {{ Request::segment(1) === 'about' ? 'active' : null }}">
                <a class="nav-link" href="{{ route('about') }}">About</a>
            </li>
            <li class="nav-item {{ Request::segment(1) === 'posts' ? 'active' : null }}">
                <a class="nav-link" href="{{ route('posts.index') }}">Blog</a>
            </li>
            <li class="nav-item {{ Request::segment(1) === 'vue-dictionary' ? 'active' : null }}">
                <a class="nav-link" href="{{ route('vue-dictionary') }}">Dictionary</a>
            </li>
            @guest
                @else
                {{--}}todo add checks--}}

                {{--@if(!(Auth::user()->hasRole("Admin")))
                <li class="nav-item {{ Request::segment(1) === 'media' ? 'active' : null }}">
                    <a class="nav-link" href="/media/guest ">Personal Cloud Server</a>
                </li>
                <li class="nav-item {{ Request::segment(1) === 'admin' ? 'active' : null }}">
                    <a class="nav-link" href="/admin/guest">Admin</a>
                </li>
                @else--}}
                    <li class="nav-item {{ Request::segment(1) === 'media' ? 'active' : null }}">
                        <a class="nav-link" href={{route('media.index')}}>Personal Cloud Server</a>
                    </li>
                    <li class="nav-item {{ Request::segment(1) === 'admin' ? 'active' : null }}">
                        <a class="nav-link" href="{{ route('admin') }}">Admin</a>
                    </li>

                {{--@endif--}}
                @endguest

        </ul>



        <!--right hand side-->
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/dashboard">Dashboard</a>
                        {{--@if(!(Auth::user()->hasRole("User")))--}}
                        <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                        <a class="dropdown-item" href='/changepassword'>ChangePassword</a>
                        {{--@endif--}}
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                <ul class="navbar-nav nav navbar-right">
                    <li class="nav-item"><a class="nav-link" href="/posts/create">add post</a></li>
                </ul>
            @endguest
        </ul>



    </div>
</nav>