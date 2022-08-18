@extends('web.layouts.master')
@section('content')

<section id="islam" class="islam my-5 py-4">

  <div class="container">
    <h2>{{ $get_subject_title }}</h2>
    <div class="row justify-content-center pt-5">

      @if(isset($goal_detials))
        @foreach($goal_detials as $goal_detial)
          <div class="cards col-lg-4 col-md-6">
            <div class="card-item">
              <div class="card-image">
                <img src="{{ Storage::url($goal_detial->image) }}" height="200" width="200"/>
              </div>
              <div class="card-info">
                <h3 class="card-title">{{$goal_detial->unit->name}}</h3>
                <h5>Instructor:{{$goal_detial->instructor_name}}</h5>
                <p class="card-intro">{{Str::limit($goal_detial->description, 100)}}</p>
                <a data-id="{{ $goal_detial->id}}" @guest data-toggle="modal" data-target="#membershipModal" style="cursor: pointer" @endguest  class="achieve-btn @if(checkGoalAval($goal_detial->id) != 'yes')  achieve_goal @endif " >@if(checkGoalAval($goal_detial->id) == 'yes') Already Taken  @else Achieve This Goal @endif</a>
              </div>
            </div>
          </div>
          @endforeach
          @else
          <div class="cards col-lg-4 col-md-6">
            <div class="card-item">
              <div class="card-info">
                <h3 class="card-title">No Goal Created Yet For This Subject</h3>
                <p class="card-intro">Coming soon....</p>
              </div>
            </div>
          </div>
        @endif
  </section>
  
  @endsection
  @push('js')
    <script>
      let achieve_goal = "{{route('student.goals.take_goal')}}";
    </script>
  @endpush