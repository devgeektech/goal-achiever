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
                    <h1 class="h3 mb-2 text-gray-800">Goals</h1>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add Goal</h6>
                            <a href="{{ route('admin.goals.index')}}"class="btn btn-primary" style="float: right;">Back</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.goals.store') }}" method="post" enctype="multipart/form-data"> 
                                @csrf
                                <input type="hidden" name="subject_id" id="subject_id" value="">
                                <input type="hidden" name="unit_id" id="unit_id" value="">
                                <div class="form-group">
                                  <label for="goalSubject">Subject</label>
                                    <select class="form-select form-control"  name="subject" id="subject">
                                        <option value="">Select Subject</option>
                                        @foreach($subjects as $subject)
                                            <option value="{{$subject->id}}">{{$subject->title}}</option>
                                        @endforeach   
                                    </select>
                                    @error('subject') <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                  <label for="goalUnit">Unit</label>
                                  <select class="form-select form-control"  name="unit" id="unit">
                                    <option value="">Select Unit</option>
                                    @foreach($units as $unit)
                                        <option value="{{$unit->id}}">{{$unit->name}}</option>
                                    @endforeach   
                                </select>
                                @error('unit') <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="goalTopic">Topic</label>
                                    <select class="form-select form-control"  name="topic" id="topic">
                                        <option value="">Select Topic</option>
                                        @foreach($topics as $topic)
                                            <option value="{{$topic->id}}">{{$topic->name}}</option>
                                        @endforeach   
                                    </select>
                                    @error('topic') <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label"  for="goalDocuments">Documents</label>
                                    <input type="file" class="form-control"  name="document[]" multiple accept="image/png, image/gif, image/jpeg"/>
                                    @error('document') <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="goalVideo">Video</label>
                                    <input type="file" class="form-control"  name="video[]" multiple accept="video/mp4,video/x-m4v,video/*"/>
                                    @error('video') <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="examDocument">Exam Document</label>
                                    <input type="file" class="form-control"  name="exam_document[]" multiple accept="image/png, image/gif, image/jpeg"/>
                                    @error('exam_document') <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="goalEndDate">Goal End Name</label>
                                    <input type="date" class="form-control" name="end_date" id="datepicker" placeholder="Goal End Date">
                                    @error('end_date') <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="goalCreatorName">Creator's Name</label>
                                    <input type="text" class="form-control" name="creator_name" id="creator_name" placeholder="Creator's Name" value="{{ Auth::user()->name }}">
                                    @error('creator_name') <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="goalInstructorName">Instructor's Name</label>
                                    <input type="text" class="form-control" name="instructor_name" id="instructor_name" placeholder="Instructor's Name" value="{{ Auth::user()->name }}">
                                    @error('instructor_name') <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> @enderror
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