



<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>



            <!--my links-->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">                        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a></li>
                    <li class="nav-item">                        <a class="nav-link" href="/about">about</a>                    </li>
                    <li class="nav-item"><a class="nav-link" href="/projects">projects</a></li>
                    <li class="nav-item"><a class="nav-link" href="/posts">blog</a></li>
                </ul>


            <!--mylinks end-->


            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    <!--<li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>-->
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="btn btn-default" href="/home"> dashboard</a>
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
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
    </div>
</nav>