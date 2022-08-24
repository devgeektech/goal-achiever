@extends('student.layouts.master')
@section('content')
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
           @include('student.layouts.topbar')
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Goal Info</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Goal Info</h6>
                            <a href="{{ route('student.goals.index')}}"class="btn btn-primary" style="float: right;">Back</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('student.goals.take_goal')}}" method="post">
                                @csrf
                                <div class="row goalWrap">
                                    <input type="hidden" name="goal_id" id="goal_id" value="{{$goal->id}}">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group" >
                                        <label for="forSubject">Subject</label>
                                        <input type="text" class="form-control" value="{{ $goal->subject->title }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="forUnit">Unit</label>
                                        <input type="text" class="form-control" value="{{ getUnitName($goal->unit_id) }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="forTopic">Topic</label>
                                        <input type="text" class="form-control" value="{{ getTopicName($goal->topic_id) }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="forGoalEndDate">Goal End Date</label>
                                        <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($goal->end_date)->format('j F, Y') }}" readonly>
                                    </div>
                                    @isset($media_document)
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <label class="form-group d-flex" for="forUnit">Documents</label>
                                        @foreach($media_document as $media)
                                            <div class="form-group videoImgBlock" style="display:inline-flex; cursor:pointer;">
                                            <img src="{{Storage::url($media->media) ?? URL::to('/images/dummy.jpg')}}" height="100" widht="100">
                                            {{-- <a download="Goal_Document" id="goal_document" href="{{Storage::url($media->media) }}" title="Goal_Document"> --}}<i class="fa fa-download" data-doc="{{Storage::url($media->media) }}" aria-hidden="true" id="goal_document" title="Download"></i>{{-- </a> --}}
                                            </div>
                                        @endforeach
                                    </div>
                                    @endisset
                                    @isset($media_video)
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <label class="form-group d-flex" for="forUnit">Videos</label>
                                        @foreach($media_video as $vid_media)
                                            <div class="form-group videoImgBlock" style="display:inline-flex;cursor:pointer;">
                                                <video width="320" height="240" controls>
                                                    <source src="{{Storage::url($vid_media->media) ?? URL::to('/images/dummy.jpg')}}" type="video/mp4">
                                                </video>
                                                <a download="Goal_Videos" href="{{Storage::url($vid_media->media) }}" title="Goal_Videos"><i class="fa fa-download" aria-hidden="true" title="Download"></i></a>
                                            </div>
                                        @endforeach
                                    </div>
                                    @endisset
                                    @isset($exam_document)
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <label class="form-group d-flex" for="forUnit">Exam Documents</label>
                                            @foreach($exam_document as $exam_doc)
                                                <div class="form-group videoImgBlock" style="display:inline-flex;cursor:pointer;">
                                                    <img src="{{Storage::url($exam_doc->media) ?? URL::to('/images/dummy.jpg')}}" height="100" widht="100">
                                                    <a download="Goal_Exam_Document" href="{{Storage::url($exam_doc->media) }}" title="Goal_Exam_Document"><i class="fa fa-download" aria-hidden="true" title="Download"></i></a>
                                                </div>
                                            @endforeach
                                    </div>
                                    @endisset
                                    <hr>
                                </div>
                                <button type="button" class="btn btn-primary ml-3" id="submit_papers">Submit Papers</button>
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

<!-- Modal -->
<div class="modal fade" id="uploadAssignmentsModal" tabindex="-1" role="dialog" aria-labelledby="uploadAssignmentsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <form method="post" action="{{ route('student.taken_goals.upload_assignments') }}" enctype="multipart/form-data">
     @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Upload Asignments</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="assign_goal_id" id="assign_goal_id">
            <input type="file"  name="goal_assignment[]" multiple accept="image/png, image/gif, image/jpeg">
            @error('goal_assignment') <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> @enderror      
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Upload</button>
        </div>
      </div>
    </form>
    </div>
  </div>
   @endsection

   @push('js')
    <script src="{{URL::to('/admin-panel/js/all.js')}}"></script>
   @endpush