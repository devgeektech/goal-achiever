@extends('web.layouts.master')
@section('content')

<section id="islam" class="islam my-5 py-4">

  <div class="container">
    <h2>{{ $get_subject_title }}</h2>
    @if(isset($goal_detials))
    <input type="hidden" name="user_id" id="user_id">
    @foreach($goal_detials->chunk(3) as $goal_detial)
    <div class="row justify-content-center pt-5">
        @foreach($goal_detial as $detial)
          <div class="cards col-lg-4 col-md-6">
            <div class="card-item">
              <div class="card-image">
                <img src="{{ Storage::url($detial->image) }}" class="img-fluid" />
              </div>
              <div class="card-info">
                <h3 class="card-title">{{$detial->topic->name}}</h3>
                <h5>Instructor:{{$detial->instructor_name}}</h5>
                <p class="card-intro">{{Str::limit($detial->description, 100)}}</p>
              </div>
            </div>
          </div>
          @endforeach
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
  </div>
  </section>
  
  @endsection
  @push('js')
    <script>
      let check_auth = "{{route('check_auth')}}";
      let achieve_goal = "{{route('student.goals.take_goal')}}";
      
    </script>
  @endpush