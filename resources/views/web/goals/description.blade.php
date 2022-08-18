@extends('web.layouts.master')
@section('content')

  <div class="container">
    <div class="row align-items-center pt-5">
    
<section id="edu-goals" class="education-goals">
  <div class="container">
    <h2>Our Educational Goals To Achieve</h2>
    <div class="container">
      <div class="">
        @if(isset($goal_detials))
            @foreach($goal_detials as $goal_detial)
              <span>{{ $goal_detial->subject->title}}</span>
              <span>{{ $goal_detial->unit->name}}</span>
              <span>{{ $goal_detial->topic->name}}</span>
              <span>{{ \Carbon\Carbon::parse($goal_detial->end_date)->format('j F, Y') }}</span>
              <span>{{ $goal_detial->creator_name}}</span>
              <span>{{ $goal_detial->instructor_name}}</span>
              <button class="btn btn-primary" @guest data-toggle="modal" data-target="#membershipModal" style="cursor: pointer" @endguest >Achieve this Goal</button>     
            @endforeach
        @else
        <div class="box mb-2 text-white">
            <h3>No Goal Found</h3>
        </div>
        @endif
        
      </div>
    </div>
  </div>
</section>
  @endsection
