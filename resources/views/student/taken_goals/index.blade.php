@extends('student.layouts.master')

@section('content')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

           @include('student.layouts.topbar')
           <div class="card-body p-0">
            @if ($errors->any())
                <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
           </div>

           @if ($message = Session::get('success'))
           <div class="alert alert-success alert-block">
               <button type="button" class="close" data-dismiss="alert">×</button>
               <strong>{{ $message }}</strong>
           </div>
           @endif
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                   <!-- <h1 class="h3 mb-2 text-gray-800">My Goals</h1> -->

                    <!-- DataTales Example -->
                    <div class="card shadow goal-dashboard mb-4">
                        <div class="card-header py-3">
                        <nav aria-label="Breadcrumbs">
                          <ul class="breadcrumbs">
                            <li class="breadcrumbs__item breadcrumbs__item--is-current">
                              <span aria-current="location" class="breadcrumbs-link">My Goals</span>
                            </li>
                          </ul>
                        </nav>
                          
                        </div>
                        <div class="card-body">
                            <div class="container">
                                @isset($goal_detials)
                                @php
                                  $i = 0;
                                @endphp
                                @foreach($goal_detials->chunk(3) as $goal_detial)
                                <div class="row pt-5">
                                 
                                    @foreach($goal_detial as $detial)
                                      <div class="cards col-lg-4 col-md-6">
                                        <div class="card-item">
                                          <div class="card-image taken-goals py-4 px-4">
                                            <img src="@if($detial[0]->goal->image) {{ Storage::url($detial[0]->goal->image) }} @else  {{ URL::to('/images/no-goals-taken.jpg') }} @endif" height="200" width="200"/>

                                            <div class="progress-card">
                                              <svg class="progress-circle" width="200px" height="200px" xmlns="http://www.w3.org/2000/svg">
                                                <circle class="progress-circle-back"
                                                      cx="100" cy="100" r="45"></circle>
                                                  <circle class="progress-circle-prog progress_circle_prog_{{ $i }}"
                                                          cx="100" cy="100" r="45"></circle>
                                              </svg>
                                              <div class="progress-text total_percentage progress_text_{{ $i }}" data-progress="0" data-percentage_id="{{ $i }}">{{ get_percentage($detial[0]->goal->unit_id,$detial[0]->student_id) }}</div>
                                          </div>
                                          </div>
                                          <div class="card-info my-goals-info justify-content-between">
                                            <h3 class="card-title h-100">{{ $detial[0]->goal->unit->name}}</h3>
                                            <h5>Instructor:{{$detial[0]->goal->instructor_name}}</h5>
                                            <p class="card-intro h-100">{{Str::limit($detial[0]->goal->description, 50)}}</p>
                                            <a href="{{ route('student.taken_goals.unit_details',$detial[0]->goal->unit_id) }}" class="btn btn-warning details-btn">Details</a>
                                        </div>
                                      </div>
                                      </div>
                                      @php
                                          $i++;
                                      @endphp

                                      @endforeach
                                </div>
                                @endforeach
                                @else

                                <div class="cards col-lg-6 col-md-6 mx-auto">
                                    <div class="card-item no-goal text-center">
                                      <div class="card-image goal-img pt-4">
                                        <img src="{{ URL::to('/images/no-goals-taken.png') }}" height="100" width="100"/>
                                      </div>
                                      <div class="card-info">
                                        <h3 class="card-title">No goal taken yet!</h3>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                              @endisset
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->


        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
   @endsection
   @push('js')
    <script src="{{URL::to('/admin-panel/js/all.js')}}"></script>
   @endpush

