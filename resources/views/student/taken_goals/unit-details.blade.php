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
                                            <img src="{{ Storage::url($detail->goal->image) }}" height="200" width="200"/>
                                          </div>
                                          <div class="card-info">
                                            <h3 class="card-title">{{$detail->goal->topic->name}}</h3>
                                            <h5>Instructor:{{$detail->goal->instructor_name}}</h5>
                                            <p class="card-intro h-100">{{Str::limit($detail->goal->description, 100)}}</p>
                                            <div class="complete-butn d-flex">
                                            @if($detail->status == 2)
                                              <a href="{{ route('student.taken_goals.info',$detail->goal->id) }}" class="btn btn-warning">Details</a>
                                            @endif
                                            @php
                                                $end_date = $detail->end_date;
                                                $current_date = Date('Y-m-d');
                                                $datetime1 = new DateTime($end_date);
                                                $datetime2 = new DateTime($current_date);
                                                $interval = $datetime2->diff($datetime1);
                                                $days = $interval->format('%R%a');
                                            @endphp  
                                            @if($days < 0) Expired @else {{ str_replace('+', ' ', $days) }} Days Left @endif   
                                            @if( checkGoalStatus($detail->unit_id,$detail->topic_id) == 1)
                                            <button class="btn btn-success">Completed</button>
                                            @endif
                                            </div>
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