@extends('web.layouts.master')
@section('content')

  <div class="container">
    <div class="row align-items-center pt-5">
    
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
 
  @endsection
