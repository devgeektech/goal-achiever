@extends('admin.layouts.master')

@section('content')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

           @include('admin.layouts.topbar')
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>    
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Edit Topic</h1>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Topic</h6>
                            <a href="{{ route('admin.topics.index')}}"class="btn btn-primary" style="float: right;">Back</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.topics.update',$topic->id) }}" method="POST" enctype="multipart/form-data"> 
                                @csrf 
                                <input type="hidden" name="subject_id" id="subject_id" value="">
                                <input type="hidden" name="unit_id" id="unit_id" value="">
                                <div class="row">
                               
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Subject:</strong>
                                        <select class="form-select form-control"  name="subject" id="subject">
                                            @foreach($subjects as $subject)
                                                <option {{ $topic->subject_id == $subject->id ? 'selected':''}} value="{{$subject->id}}">{{$subject->title}}</option>
                                            @endforeach   
                                        </select>
                                      </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Unit:</strong>
                                        <select class="form-select form-control"  name="unit" id="unit">
                                            @foreach($units as $unit)
                                                <option {{ $topic->unit_id == $unit->id ? 'selected':''}} value="{{$unit->id}}">{{$unit->name}}</option>
                                            @endforeach   
                                        </select>
                                      </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                      <strong>Topic:</strong>
                                      <input type="text" name="name" value="{{ $topic->name ?? "" }}" class="form-control" placeholder="Topic"> 
                                     @error('name') <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary ml-3">Update</button>
                              </div>
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