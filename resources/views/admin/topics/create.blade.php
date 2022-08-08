@extends('admin.layouts.master')

@section('content')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

           @include('admin.layouts.topbar')
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
                    <h1 class="h3 mb-2 text-gray-800">Unit</h1>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Unit</h6>
                            <a href="{{ route('admin.topics.index')}}"class="btn btn-primary" style="float: right;">Back</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.topics.store') }}" method="post" enctype="multipart/form-data"> 
                                @csrf
                                <div class="form-group">
                                    <label for="goalSubject">Subject</label>
                                      <select class="form-select form-control"  name="subject" id="subject">
                                        <option value="">Select Subject</option>
                                          @foreach($subjects as $subject)
                                              <option value="{{$subject->id}}">{{$subject->title}}</option>
                                          @endforeach   
                                      </select>
                                  </div>
                                <div class="form-group">
                                <label for="forUnit">Unit</label>
                                    <select class="form-select form-control"  name="unit" id="unit">
                                        <option value="">Select Unit</option>
                                        @foreach($units as $units)
                                            <option value="{{$units->id}}">{{$units->name}}</option>
                                        @endforeach   
                                    </select>
                                </div>
                                <div class="form-group">
                                  <label for="planName">Topic</label>
                                  <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                                </div>
                                <button type="submit" class="btn btn-primary">Add</button>
                              </form>
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
    <script>
        let get_units = "{{route('admin.goals.get_units')}}";
        let get_topics = "{{route('admin.goals.get_topics')}}";
    </script>
    <script src="{{URL::to('/admin-panel/js/all.js')}}"></script>
   @endpush