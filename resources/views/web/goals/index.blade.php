@extends('web.layouts.master')
@section('content')

  <section id="edu-goals" class="education-goals-section mt-5">
    <div class="container container py-5 py-md-1 py-sm-1">
    <h2> Goals To Achieve</h2>
      <div class="row education-slider-goals mt-5 pt-4">
        @foreach($subjects as $subject)
        <div class="col-lg-4 col-md-4 col-sm-6 d-flex justify-content-center mb-4">
          <a href="{{ route('info',$subject->id)}}" class="goal-box mb-3 text-white">
            <img src="{{Storage::url($subject->image)}}" />
            <h3>{{$subject->title}}</h3>
          </a>
        </div>
        @endforeach
      </div>
    </div>
  </section>
  @endsection
