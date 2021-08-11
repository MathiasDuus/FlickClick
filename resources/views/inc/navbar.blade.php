<header id="header"><!-- top nav bar -->

    <nav class="navbar navbar-expand navbar-dark bg-darkgray">

        <div class="collapse navbar-collapse">
            <a id="flickClickLogo" href="/"><img src="../images/logo.png" alt="Flick Click Logo"/></a>
            <div class="navbar-nav ml-auto">
                <a id="frontpage" class="col-sm nav-item nav-link" href="/">HOME <span class="sr-only">(current)</span></a>
                <a id="news" class="col-sm nav-item nav-link" href="/news">NEWS</a>
                <a id="contact" class="col-sm nav-item nav-link" href="/contact">CONTACT</a>
            </div>
        </div>
    </nav>


    <!-- Nav-bar search -->

    <nav id="nav-middle" class="navbar navbar-expand navbar-dark bg-darkgray nav-height">

        <div class="collapse navbar-collapse">
            <div class="navbar-nav mr-auto">
                <a class="nav-item nav-link" href="/movies">SHOW ALL</a> <!-- filter.php?filter=show_all -->
                <a class="nav-item nav-link" href="/movie/latest">LATEST TRAILERS</a> <!-- filter.php?filter=latest_trailer -->
                <a class="nav-item nav-link" href="/movie/commented">MOST COMMENTED</a> <!-- filter.php?filter=most_commented -->
            </div>

            <form class="form-inline my-2 my-lg-0" method="POST" action="/search">@csrf
                <p id="searchText">SEARCH MOVIE TITLE</p>
                <input class="form-control mr-sm-2 search" type="search" name="search_movie" placeholder="Enter search here" aria-label="Search">
                <button class="btn my-2 my-sm-0 search-btn" name="search" type="submit">GO!</button>
            </form>
        </div>
    </nav>

    <!-- lowest nav bar -->

    @guest
        <nav class="navbar navbar-expand navbar-dark bg-darkgray nav-height">

            <div class="collapse navbar-collapse">
                <div class="navbar-nav ml-auto">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>

                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </div>
            </div>
        </nav>
    @else
        <nav class="navbar navbar-expand navbar-dark bg-darkgray nav-height">

            <div class="collapse navbar-collapse">
                <div class="navbar-nav ml-auto">
                    <form class="form-inline my-2 my-lg-0" method="post" action="/home"> @csrf
                        <button class="btn my-2 my-sm-0 NotAMember-btn" value="{{Auth::user()->user_id}}" name="profile" type="submit">{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</button>
                    </form>

                    <form class="form-inline my-2 my-lg-0" method="POST" action="{{ route('logout') }}"> @csrf
                        <button class="btn my-2 my-sm-0 NotAMember-btn" name="logout" type="submit">Log out</button>
                    </form>
                </div>
            </div>
        </nav>
@endguest

</header>
