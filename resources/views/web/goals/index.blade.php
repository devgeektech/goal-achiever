@extends('web.layouts.master')
@section('content')

  <section id="edu-goals" class="education-goals-section mt-5">
    <div class="container container py-5 py-md-1 py-sm-1">
    <h2> Goals To Achieve</h2>
    @php
    $i = 0;
  @endphp
    @foreach($subjects->chunk(3) as $subject)
      <div class="row education-slider-goals-{{$i}} mt-5 pt-4">
        @foreach($subject as $sub)
        <div class="col-lg-4 col-md-4 col-sm-6 d-flex justify-content-center mb-4">
          <a href="{{ route('info',$sub->id)}}" class="goal-box mb-3 text-white">
            <img src="@if($sub->image){{Storage::url($sub->image)}} @else {{ URL::to('/images/no-goals-taken.jpg') }} @endif" />
            <h3>{{$sub->title}}</h3>
          </a>
        </div>
        @endforeach
        @php
            $i++;
        @endphp
      </div>
      @endforeach
    </div>
  </section>
  @endsection
