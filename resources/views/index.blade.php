@extends('web.layouts.master')
@section('content')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<section id="banner" class="banner-section pt-5">
  <div class="container">
    <div class="row align-items-center pt-5">
      <div class="@guest col-lg-7 col-md-6 @endguest @auth col-lg-12 col-md-12 @endauth">
        <div class="LeftContent text-white">
          <h6>About The Site</h6>
          <h1>This site is made for students to achieve some educational goals successfully</h1>
          <a href="{{ route('goals')}}">VIEW ALL GOALS<i class="fa-regular fa-arrow-right ml-2"></i>
          </a>
        </div>
      </div>
      @guest
      <div class=" col-lg-5 col-md-6 register-section">
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
              <form action="{{route('register')}}" method="post" id="register_form">
                @csrf
                <div class="form-group">
                  <input type="text" class="form-control px-4 py-4" placeholder="Username" id="name" name="name" autocomplete="off">
                  <span class="username_error error"></span>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control px-4 py-4" placeholder="Email Address" id="email" name="email" autocomplete="off">
                  <span class="email_error error"></span>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control px-4 py-4" placeholder="Password" id="password" name="password" autocomplete="off">
                  <span class="password_error error"></span>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control px-4 py-4" placeholder="Confirm Password" id="confirm-pwd" name="password_confirmation" autocomplete="off">
                  <span class="confirm-pwd_error error"></span>
                </div>
                <div class="form-group">
                  <input type="number" class="form-control px-4 py-4" placeholder="Age" id="age" name="age" autocomplete="off">
                  <span class="age_error error"></span>
                </div>
                <div class="form-group">
                  <select class="form-control" placeholder="Select Country" id="country" required="true" name="country">
                    @foreach($countries as $country)
                    <option value="{{$country->name}}">{{$country->name}}</option>
                    @endforeach
                  </select>
                </div>
                <button type="button" class="btn btn-primary w-100 registerBtn">REGISTER NOW <i class="fa-regular fa-arrow-right"></i>
                </button>
              </form>
              <!-- Form HTML End-->
            </div>
            <div class="tab-pane" id="login" role="tabpanel" aria-labelledby="login-tab">
              <!-- Form HTML Start-->
              <form action="{{route('login')}}" method="post">
                @csrf
                <div class="form-group">
                  <input type="email" class="form-control px-4 py-4" placeholder="Email" id="email" name="email" autocomplete="off">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control px-4 py-4" placeholder="Password" id="pwd" name="password" autocomplete="off">
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
              </form>
              <!-- Form HTML End-->
            </div>
          </div>
        </div>
      </div>
      @endguest
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
          <a href="{{ route('info',$subject->id)}}">
            <div class="box mb-2 text-white">
            <img src="{{Storage::url($subject->image)}}" />
            <h3>{{$subject->title}}</h3>
          </div>
        </a>
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
    <input type="hidden" id="student_list" name="student_list" value="['Aban Fajr', 1000, 700, 300, 300], ['Athar Kairo', 1170, 460, 250, 300], ['Safi Talal', 660, 1120, 300, 300], ['Zayd Omar', 1030, 540, 350, 300],  ['Malik Kairo', 1030, 540, 350, 300]">
    <div class="container">
      <h2>Progress Chart Of The Active Student</h2>
      <div class="graph-chart d-flex">
        <div id="columnchart_material" style="width: 100%; min-width: 25%; height: 500px;"></div>
      </div>
    </div>
    <!--/.Carousel Wrapper-->
  </section>
  <!----------MEMBERSHIP-PLAN-SECTION-START-HERE--------->
  <section  class="membership-plan-section">
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <h2>Membership Plans</h2>
        </div>
      </div>
      <div class="row free-months-row">
        @foreach($plans as $plan)
        <div class="col-12 col-sm-3 col-md-3 col-lg-3 col-xl-3 months-area">
          <div class="free-months-area-inner" @guest data-toggle="modal" data-target="#membershipModal" @endguest  style="cursor: pointer">
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

  @endsection
  @push('js')
  <script>
    let barGraphArr = "{{ route('getBarGraphData') }}";
     // display bar graph 
     function barGraph(barGraphArray){
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);
        var subjects = ['', 'Quran', 'Islam','Computer', 'Math'];
        let dataArr = barGraphArray;

        function drawChart() {  
          if(dataArr.length >= 5){
            var data = google.visualization.arrayToDataTable([
                subjects,
                dataArr[0],
                dataArr[1],
                dataArr[2],
                dataArr[3],
                dataArr[4]
            ]);
          }else{
            var data = google.visualization.arrayToDataTable([
              subjects,
              ['Aban Fajr', 100,30,50,70],
              ['Athar Kairo', 90,70,40,20],
              ['Safi Talal', 20,60,40,30],
              ['Zayd Omar', 85,65,60,80],
              ['Malik Kairo', 10,60,50,70] 
            ]); 
          }
            
            var options = {
                chart: {
                    title: '',
                    subtitle: ''
                }
            };
          var chart = new google.charts.Bar(document.getElementById('columnchart_material'));    
          chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    }
  
    function getBarGraphArr(){
        jQuery.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            type: "post",
            url: barGraphArr,
            success: function (response) {
                if (response.status == 'true') {
                    barGraph(response.data);
                }
            },
            error: function(xhr){
                console.error('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            }
        });
    }
    getBarGraphArr();
  </script>
  @endpush

  

