<!-- Navigation -->
<div class="fixed-top">
    <nav class="navbar navbar-expand-lg navbar-dark mx-background-top-linear">
        <div class="container">
            <a class="navbar-brand" rel="nofollow" target="_blank" href="https://www.gob.pe/iiap"> IIAP </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    @guest
                    @if(Request::url('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="login">{{__('Sign in')}}</a>
                    </li>
                    @endif
                    @if(Request::url('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="register">{{__('Sign up')}}</a>
                    </li>
                    @endif
                    @else
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</div>