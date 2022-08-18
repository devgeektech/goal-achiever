<header>
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand mr-5" href="{{ route('index')}}">
          <img src="{{URL::to('./images/logo.png')}}">
        </a>
        <h4 class="nav-heading">GOAL ACHIEVER</h4>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end menu-navigation" id="navbarSupportedContent">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link mr-4" href="#">HOME</a>
            </li>
            <li class="nav-item">
              <a class="nav-link goals mr-4" href="{{ route('goals')}}">GOALS <span>|</span>
              </a>
            </li>
            @auth
              <li class="nav-item">
                <a class="nav-link goals mr-4" href="#" data-toggle="modal" data-target="#logoutModal">
                  LOGOUT
              </a>
              </li>
            @endauth
            
            <li class="nav-item">
              <a class="nav-link ph" href="tel:9609822035">
                <img src="{{URL::to('./images/phone.png')}}" class="tel-img mr-2">9609822035 </a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </header>