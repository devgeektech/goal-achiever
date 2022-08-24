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
                    <h1 class="h3 mb-2 text-gray-800">Unit Topics</h1>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Unit Topics</h6>
                           
                        </div>
                        <div class="card-body">
                            <div class="container">
                                @isset($goal_detials)
                                @foreach($goal_detials->chunk(3) as $goal_detial)
                                <div class="row justify-content-center pt-5">
                                    @foreach($goal_detial as $detail)
                                      <div class="cards col-lg-4 col-md-6">
                                        <div class="card-item">
                                          <div class="card-image">
                                            <img src="{{ Storage::url($detail->image) }}" height="200" width="200"/>
                                          </div>
                                          <div class="card-info">
                                            <h3 class="card-title">{{$detail->topic->name}}</h3>
                                            <h5>Instructor:{{$detail->instructor_name}}</h5>
                                            <p class="card-intro">{{Str::limit($detail->description, 100)}}</p>
                                            <a href="{{ route('student.taken_goals.info',$detail->id) }}" class="btn btn-warning">Details</a>
                                            @if($detail->status == '2')
                                            <button class="btn btn-success">Completed</button>
                                            @endif
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