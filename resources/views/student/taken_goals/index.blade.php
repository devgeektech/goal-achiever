@extends('student.layouts.master')

@section('content')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

           @include('student.layouts.topbar')
           <div class="card-body">
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
                    <h1 class="h3 mb-2 text-gray-800">My Goals</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">My Goals</h6>

                        </div>
                        <div class="card-body">
                            <div class="container">
                                @isset($goal_detials)
                                @foreach($goal_detials->chunk(3) as $goal_detial)
                                <div class="row justify-content-center pt-5">
                                    @foreach($goal_detial as $detial)
                                      <div class="cards col-lg-4 col-md-6">
                                        <div class="card-item">
                                          <div class="card-image">
                                            <img src="{{ Storage::url($detial->goal->image) }}" height="200" width="200"/>
                                           <!-- <img src="{{ URL::to('/images/progress.png') }}" height="100" width="100"/> -->
                                            <div class="progress-card">
                                              <svg class="progress-circle" width="200px" height="200px" xmlns="http://www.w3.org/2000/svg">
                                                <circle class="progress-circle-back"
                                                      cx="100" cy="100" r="55"></circle>
                                                  <circle class="progress-circle-prog"
                                                          cx="100" cy="100" r="55"></circle>
                                              </svg>
                                              <div class="progress-text" data-progress="0">45%</div>
                                          </div>
                                          </div>
                                          <div class="card-info">
                                            <h3 class="card-title">{{$detial->goal->unit->name}}</h3>
                                            <h5>Instructor:{{$detial->goal->instructor_name}}</h5>
                                            <p class="card-intro">{{Str::limit($detial->goal->description, 100)}}</p>
                                            <a href="{{ route('student.taken_goals.info',$detial->goal->id) }}" class="btn btn-warning">Details</a>
                                          </div>
                                        </div>
                                      </div>
                                      @endforeach
                                </div>
                                @endforeach
                                @else

                                <div class="cards col-lg-4 col-md-6">
                                    <div class="card-item">
                                      <div class="card-image">
                                        <img src="{{ URL::to('/images/no_goal.png') }}" height="100" width="100"/>
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

