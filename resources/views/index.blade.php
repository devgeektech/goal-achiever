<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Islamic</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{URL::to('images/favicon.svg')}}">
    <link rel="stylesheet" href="{{URL::to('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::to('css/style.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
  </head>
  <body>
    <header>
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
          <a class="navbar-brand mr-5" href="#">
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
                <a class="nav-link goals mr-4" href="#">GOALS <span>|</span>
                </a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link ph" href="tel:9609822035">
                  <img src="{{URL::to('./images/phone.png')}}" class="tel-img mr-2">9609822035 </a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </header>
    <section id="banner" class="banner-section pt-5">
      <div class="container">
        <div class="row align-items-center pt-5">
          <div class="col-lg-7 col-md-6">
            <div class="LeftContent text-white">
              <h6>About The Site</h6>
              <h1>This Site is Made for students to achieve some educational goal successfully</h1>
              <a href="#">VIEW ALL GOALS <i class="fa-regular fa-arrow-right ml-2"></i>
              </a>
            </div>
          </div>
          <div class=" col-lg-5 col-md-6">
            <div class="registerblock px-5 py-5 bg-white rounded">
              <!-- Nav tabs -->
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="home" aria-selected="true">Register</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="profile" aria-selected="false">Login</a>
                </li>
              </ul>
              @if ($message = Session::get('errors'))
              <div class="alert alert-danger alert-block">
                  <strong>{{ $message }}</strong>
              </div>
              @endif
              <!-- Tab panes -->
              <div class="tab-content mt-5">
                <div class="tab-pane active" id="register" role="tabpanel" aria-labelledby="register-tab">
                  <!-- Form HTML Start-->
                  <form action="{{route('register')}}" method="post">
                    @csrf
                    <div class="form-group">
                      <input type="text" class="form-control px-4 py-4" placeholder="Username" id="name" name="name">
                    </div>
                    <div class="form-group">
                      <input type="email" class="form-control px-4 py-4" placeholder="Email Address" id="email" name="email">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control px-4 py-4" placeholder="Password" id="pwd" name="password">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control px-4 py-4" placeholder="Confirm Password" id="confirm-pwd" name="password_confirmation">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">REGISTER NOW <i class="fa-regular fa-arrow-right"></i>
                    </button>
                  </form>
                  <!-- Form HTML End-->
                </div>
                <div class="tab-pane" id="login" role="tabpanel" aria-labelledby="login-tab">
                  <!-- Form HTML Start-->
                  <form action="{{route('login')}}" method="post">
                    @csrf
                    <div class="form-group">
                      <input type="email" class="form-control px-4 py-4" placeholder="Email" id="email" name="email">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control px-4 py-4" placeholder="Password" id="pwd" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                  </form>
                  <!-- Form HTML End-->
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Sign in page HTML End-->
      </div>
    </section>
    <section id="edu-goals" class="education-goals">
      <div class="container">
        <h2>Our Educational Goals To Achieve</h2>
        <div class="container">
          <div class="education-slider mt-5">
            @foreach($subjects as $subject)
              <div class="box mb-2 text-white">
                <img src="{{Storage::url($subject->image)}}" />
                <h3>{{$subject->title}}</h3>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>
      <section id="tips" class="goal-tips mt-5 pt-5">
        <div class="container pt-5">
          <div class="row">
            <div class="col-lg-6 col-md-6">
              <h2>7 Tips To Achieve Your Goals</h2>
              <ul class="tips-list">
                <li>
                  <a href="#">
                    <img src="{{URL::to('./images/tick.png')}}">Make dhua for guidance and ask for help. </a>
                </li>
                <li>
                  <a href="#">
                    <img src="{{URL::to('./images/tick.png')}}">Learn from experts. </a>
                </li>
                <li>
                  <a href="#">
                    <img src="{{URL::to('./images/tick.png')}}">Make a plan and focus on that and work hard. </a>
                </li>
                <li>
                  <a href="#">
                    <img src="{{URL::to('./images/tick.png')}}">Give sadaqah. </a>
                </li>
                <li>
                  <a href="#">
                    <img src="{{URL::to('./images/tick.png')}}">Do lots of isthiufar. </a>
                </li>
                <li>
                  <a href="#">
                    <img src="{{URL::to('./images/tick.png')}}">Always remember Allah. </a>
                </li>
                <li>
                  <a href="#">
                    <img src="{{URL::to('./images/tick.png')}}">Be grateful to Allah and everyone. </a>
                </li>
              </ul>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="tips-img"></div>
            </div>
          </div>
        </div>
      </section>
      <section id="progress-chart" class="progress-chart-section py-5">
        <div class="container">
          <h2>Progress Chart Of The Active Student</h2>
          <div class="graph-chart d-flex">
            <canvas id="myChart" style="width:100%; max-width: 100%;"></canvas>
            <ul>
              <li>Quran</li>
              <li>Islam</li>
              <li>Arabic</li>
              <li>English</li>
            </ul>
          </div>
        </div>
        <!--/.Carousel Wrapper-->
      </section>
      <!----------MEMBERSHIP-PLAN-SECTION-START-HERE--------->
      <section id="membership-plan" class="membership-plan-section">
        <div class="container">
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
              <h2>Membership Plans</h2>
            </div>
          </div>
          <div class="row free-months-row">
            @foreach($plans as $plan)
            <div class="col-12 col-sm-3 col-md-3 col-lg-3 col-xl-3 months-area">
              <div class="free-months-area-inner">
                <p>{{ $plan->name}} <br>
                  @if($plan->name != 'FREE') ${{ $plan->price}}@else<span>{{ $plan->price}}</span>@endif
                </p>
              </div>
            </div>
            @endforeach
            <div class="col-12 col-sm-3 col-md-3 col-lg-3 col-xl-3 months-area"></div>
          </div>
      </section>
      <!----------MEMBERSHIP-PLAN-SECTION-END-HERE--------->
      <!----------CONTACT-US-SECTION-START-HERE--------->
      <section id="contact-us" class="contact-us-section">
        <div class="container">
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
              <h2>Contact Us</h2>
            </div>
          </div>
          <div class="row contact-row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
              <form action="{{route('contact')}}" method="post" accept-charset="utf-8">
                @csrf
                <div class="row " style="padding-bottom: 20px;">
                  <div class="col-lg-4 col-md-4 col-sm-4">
                    <input class="form-control" name="firstname" placeholder="Name" type="text" name="firstname" required="" autofocus="">
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4">
                    <input class="form-control" name="email" placeholder="E-mail" name="email" type="email" required="">
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4">
                    <select class="form-control" placeholder="Select Counrty" id="country" required="true" name="country">
                      @foreach($countries as $country)
                      <option value="{{$country->name}}">{{$country->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <textarea style="resize:vertical;" class="form-control-text" placeholder="Message..." rows="10" name="comment" required=""></textarea>
                  </div>
                </div>
                <div class="panel-footer" style="margin-bottom:-14px;">
                  <button style="float: right;" type="submit" class="btn btn-default btn-close" data-dismiss="modal">Submit <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
        @if ($message = Session::get('errors'))
        <div class="alert alert-danger alert-block">
            <strong>{{ $message }}</strong>
        </div>
        @endif
        @if ($message = Session::get('success'))
           <div class="alert alert-success alert-block">
               <button type="button" class="close" data-dismiss="alert">×</button>    
               <strong>{{ $message }}</strong>
           </div>
           @endif
      </section>
      <!----------CONTACT-US-SECTION-END-HERE--------->
      <!----------FOOTER-SECTION-START-HERE--------->
      <section id="footer" class="footer-section">
        <div class="container">
          <div class="row">
            <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
              <div class="footer-logo-area">
                <a href="#">
                  <img class="img-fluid" src="{{URL::to('images/footer-logo.png')}}">
                </a>
                <p>Connect With Us</p>
                <ul>
                  <li>
                    <a href="#">
                      <img src="{{URL::to('images/facebook.png')}}">
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <img src="{{URL::to('images/witter.png')}}">
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <img src="{{URL::to('images/youtube.png')}}">
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
              <div class="links-area">
                <h5>Links</h5>
                <ul>
                  <li>
                    <a href="#">Quran Videos</a>
                  </li>
                  <li>
                    <a href="#">Hadith Videos</a>
                  </li>
                  <li>
                    <a href="#">Dhuas</a>
                  </li>
                  <li>
                    <a href="#">Quotes</a>
                  </li>
                  <li>
                    <a href="#">Articles</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
              <div class="google-add-image">
                <img class="img-fluid" src="{{URL::to('images/google-add.png')}}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
              <div class="copy-right-area">
                <div class="border-line"></div>
                <p>Copyright © 2022 islamicolc. All Rights Reserved</p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!----------FOOTER-SECTION-END-HERE--------->
      <!-- JS Links Start -->
      <script src="{{URL::to('js/jquery.slim.min.js')}}"></script>
      <script src="{{URL::to('js/popper.min.js')}}"></script>
      <script src="{{URL::to('js/bootstrap.bundle.min.js')}}"></script>
      <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js"></script>
      <script>
        $('.education-slider').slick({
          dots: true,
          infinite: false,
          speed: 300,
          slidesToShow: 4,
          slidesToScroll: 1,
          responsive: [{
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: false,
                dots: true
              }
            }, {
              breakpoint: 600,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2
              }
            }, {
              breakpoint: 480,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1
              }
            }, {
              breakpoint: 374,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
          ]
        });
      </script>
      <script>
        var xValues = ["Aban Fajr", "Athar Kairo", "Safi Talal", "Zayd Omar", "Malik Kairo"];
        var yValues = [55, 49, 44, 24, 30];
        var barColors = ["red", "green", "blue", "orange", "brown"];
        new Chart("myChart", {
          type: "bar",
          data: {
            labels: xValues,
            datasets: [{
              backgroundColor: barColors,
              data: yValues
            }]
          },
          options: {
            legend: {
              display: false
            },
            title: {
              display: true,
              text: ""
            }
          }
        });
      </script>
      <!-- JS Links End -->
  </body>
</html>