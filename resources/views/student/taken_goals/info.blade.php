@extends('student.layouts.master')
@section('content')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
           @include('student.layouts.topbar')
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading
                    <h1 class="h3 mb-2 text-gray-800">Goal Info</h1> -->
                    <!-- DataTales Example -->
                    <nav aria-label="Breadcrumbs">
                          <ul class="breadcrumbs pl-4">
                            <li class="breadcrumbs__item">
                              <a href="{{ route('student.taken_goals.index') }}" class="breadcrumbs-link">My Goals</a>
                            </li>
                            <li class="breadcrumbs__item">
                              <a href="{{ route('student.taken_goals.unit_details',$goal_unit_id)  }}" class="breadcrumbs-link">{{ $unit_name}}</a>
                            </li>
                            <li class="breadcrumbs__item breadcrumbs__item--is-current">
                              <span aria-current="location" class="breadcrumbs-link">{{ $topic_name }}</span>
                            </li>
                          </ul>
                        </nav>
                    <div class="card shadow mb-4">
                        <!-- <div class="card-header student-dashboard py-3">
                            <h3 class="m-0 font-weight-bold">Goal Info</h3>
                            <a href="{{ route('student.goals.index')}}"class="btn btn-primary" style="float: right;">Back</a>
                        </div> -->
                        <div class="card-body goal-info-section">
                            <div class="row">
                            <div class="col-lg-5 col-md-5 unit-btns d-flex flex-column p-0">
                            <a href="#" class="unit-btn mb-3">Unit 1- <span>Calculus</span></a>
                            <a href="#" class="topic-btn mb-3">Topic A-<span> Continuity and Differentiability</span></a>
                            <a href="#" class="lesson-btn mb-3">Lesson-<span> 1</span></a>
                            </div>
                            </div>
                            <form action="{{ route('student.goals.take_goal')}}" method="post">
                                @csrf
                                <div class="row goalWrap flex-column">
                                    <input type="hidden" name="goal_id" id="goal_id" value="{{$goal->id}}">
                                <div class="row">
                                    <!-- <div class="form-group goal-info col-lg-3 col-6">
                                        <div class="goals-info-box">
                                        <img src="{{ URL::to('/images/book.png')}}">
                                        <label for="forSubject">Subject</label>
                                        <input type="text" class="form-control border-0" value="{{ $goal->subject->title }}" readonly>
                                    </div>
                                    </div>
                                    <div class="form-group goal-info col-lg-3 col-6">
                                    <div class="goals-info-box">
                                    <img src="{{ URL::to('/images/unit.png')}}">
                                        <label for="forUnit">Unit</label>
                                        <input type="text" class="form-control border-0" value="{{ getUnitName($goal->unit_id) }}" readonly>
                                    </div>
                                    </div>
                                    <div class="form-group goal-info col-lg-3 col-6">
                                    <div class="goals-info-box">
                                    <img src="{{ URL::to('/images/trending-topic.png')}}">
                                        <label for="forTopic">Topic</label>
                                        <input type="text" class="form-control border-0" value="{{ getTopicName($goal->topic_id) }}" readonly>
                                    </div>
                                    </div>
                                    <div class="form-group goal-info col-lg-3 col-6">
                                    <div class="goals-info-box">
                                    <img src="{{ URL::to('/images/time-left.png')}}">
                                        <label for="forGoalEndDate">Goal End Date</label>
                                        <input type="text" class="form-control border-0" value="{{ \Carbon\Carbon::parse($goal->end_date)->format('j F, Y') }}" readonly>
                                    </div>
                                    </div> -->
                                    <div class="col-xs-12 col-sm-12 col-md-12 mt-4">
                                        <label class="form-group d-flex mb-2 font-weight-bold text-primary text-center mb-3" for="forDocuments">Documents</label>
                                        @foreach($media_document as $media)
                                            <div class="form-group videoImgBlock doc" style="display:inline-flex; cursor:pointer;">
                                            <img src="{{Storage::url($media->media) ?? URL::to('/images/dummy.jpg')}}" class="goal-info-img">
                                            <h5>Documents</h5>
                                            <div class="download d-flex justify-content-between align-items-center ">
                                                <span>Download</span>
                                                <a download="Document" href="{{ Storage::url($media->media) }}" title="{{ Storage::url($media->media) }}"><i class="fa fa-download mr-0" aria-hidden="true" title="Download"></i></a>

                                            </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 mt-4">
                                        <label class="form-group d-flex mb-2 font-weight-bold text-primary text-center mb-3" for="forVideos">Videos</label>
                                        @foreach($media_video as $vid_media)
                                            <div class="form-group videoImgBlock" style="display:inline-flex;cursor:pointer;">
                                                <video controls>
                                                    <source src="{{Storage::url($vid_media->media) ?? URL::to('/images/dummy.jpg')}}" type="video/mp4">
                                                </video>
                                                <h5>Videos</h5>
                                                <div class="download d-flex justify-content-between align-items-center">
                                                <span>Download</span>
                                                <a download="Document" href="{{ Storage::url($vid_media->media) }}" title="{{ Storage::url($vid_media->media) }}"><i class="fa fa-download mr-0" aria-hidden="true" title="Download"></i></a>
                                            </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @isset($exam_document)
                                    <div class="col-xs-12 col-sm-12 col-md-12 my-4">
                                        <label class="form-group d-flex mb-2 font-weight-bold text-primary mb-3" for="forExam">Exam Documents</label>
                                        @foreach($exam_document as $exam_doc)
                                            <div class="form-group videoImgBlock" style="display:inline-flex;cursor:pointer;">
                                                <img src="{{Storage::url($exam_doc->media) ?? URL::to('/images/no-goals-taken.jpg') }}" class="goal-info-img">
                                                <h5>Documents</h5>
                                                <div class="download d-flex justify-content-between align-items-center">
                                                <span>Download</span>
                                                <a download="Document" href="{{ Storage::url($exam_doc->media) }}" title="{{ Storage::url($exam_doc->media) }}"><i class="fa fa-download mr-0" aria-hidden="true" title="Download"></i></a>
                                            </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @endisset
                                    <hr>
                                </div>
                                <div class="submit-paper mx-auto mt-5">
                                <button type="button" class="btn btn-primary ml-3 mt-5" id="submit_papers">Submit Papers</button>
                                </div>
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
      <div class="modal-content submit-paper">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel" class="upload-assignmnt">Upload Assignments</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="assign_goal_id" id="assign_goal_id">
           <!-- <input type="file"  name="goal_assignment[]" multiple accept="image/png, image/gif, image/jpeg">
            @error('goal_assignment') <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> @enderror
            <label for="markCompleted">Mark Completed</label>

            <input type="checkbox" name="mark_goal_completed" id="mark_completed">Completed
            -->
            <div class="zone">

            <div id="dropZ">
            <img src="{{ URL::to('./images/cloud-arrow-up-solid.png') }}" height="50" width="80" class="uplaod-img mb-3"/>
                <div>Drag and drop your file here</div>
                <span>OR</span>
                <div class="selectFile">
                <label for="file">Select file</label>
                <input type="file"  name="goal_assignment[]" multiple accept="image/png, image/gif, image/jpeg">
                </div>

                <form>
                    <input type="checkbox" id="mark_completed" name="mark_goal_completed">
                    <label for="mark_completed">Please Check this Box To Complete The Goal</label>

                </form>
                </div>

            </div>

            </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary upload-btn">Upload</button>
        </div>
      </div>
    </form>
    </div>
  </div>
   @endsection

   @push('js')
    <script src="{{URL::to('/admin-panel/js/all.js')}}"></script>
   @endpush