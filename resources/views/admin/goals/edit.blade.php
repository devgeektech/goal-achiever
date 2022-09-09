@extends('admin.layouts.master')

@section('content')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

           @include('admin.layouts.topbar')
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Edit Goal</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Goal</h6>
                            <a href="{{ route('admin.goals.index')}}"class="btn btn-primary" style="float: right;">Back</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.goals.update',$goal->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="subject_id" id="subject_id" value="">
                                <input type="hidden" name="unit_id" id="unit_id" value="">
                                <div class="row goalWrap">
                                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                  <div class="form-group">
                                    <strong>Category:</strong>
                                    <select class="form-select form-control"  name="subject" id="subject">
                                        @foreach($subjects as $subject)
                                            <option {{ $goal->subject_id == $subject->id ? 'selected':''}} value="{{$subject->id}}">{{$subject->title}}</option>
                                        @endforeach
                                    </select>
                                    @error('subject') <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> @enderror
                                  </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                    <div class="form-group">
                                      <strong>Unit:</strong>
                                      <select class="form-select form-control"  name="unit" id="unit">
                                        @foreach($units as $unit)
                                            <option {{ $goal->unit_id == $unit->id ? 'selected':''}} value="{{$unit->id}}">{{$unit->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('unit') <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                    <div class="form-group">
                                      <strong>Topic:</strong>
                                      <select class="form-select form-control"  name="topic" id="topic">
                                        @foreach($topics as $topic)
                                            <option {{ $goal->topic_id == $topic->id ? 'selected':''}} value="{{$topic->id}}">{{$topic->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('topic') <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                    <label class="form-label d-flex" for="goalImage">Goal Image</label>
                                    <div class="form-group videoImgBlock" style="display:inline-flex;">
                                        <i class="fas fa-edit goal_image_edit" data-id="{{$goal->id}}" style="cursor:pointer"></i>
                                        <img src="@if($goal->image) {{Storage::url($goal->image)}} @else {{URL::to('/images/no_goal.png')}}@endif" height="100" widht="100">
                                    </div>
                                    @error('goal_image') <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                    <label class="form-label d-flex" for="customFile">Document</label>
                                    @foreach($media_document as $media)
                                        <div class="form-group videoImgBlock" style="display:inline-flex;">
                                            <i class="fas fa-edit document_edit"  data-type="{{$media->type}}" data-id="{{$media->id}}" style="cursor:pointer"></i>
                                                <img src="{{Storage::url($media->media) ?? URL::to('/images/dummy.jpg')}}" height="100" widht="100">

                                        </div>
                                    @endforeach
                                        <input type="file" class="form-control" id="document" name="document[]" multiple accept="image/png, image/gif, image/jpeg"/>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                    <label class="form-label d-flex" for="customFile">Video</label>
                                    @foreach($media_video as $vid_media)
                                        <div class="form-group videoImgBlock" style="display:inline-flex;">
                                            <i class="fas fa-edit document_edit" data-type="{{$vid_media->type}}" data-id="{{$vid_media->id}}" style="cursor:pointer"></i>
                                            <video width="320" height="240" controls>
                                                <source src="{{Storage::url($vid_media->media) ?? URL::to('/images/dummy.jpg')}}" type="video/mp4">
                                              </video>

                                        </div>
                                    @endforeach

                                        <input type="file" class="form-control" id="video" name="video[]" multiple accept="video/mp4,video/x-m4v,video/*"/>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                    <label class="form-label d-flex" for="customFile">Exam Document</label>
                                    @foreach($exam_document as $exam_doc)
                                    <div class="form-group videoImgBlock" style="display:inline-flex;">
                                        <i class="fas fa-edit document_edit" data-type="{{$exam_doc->type}}" data-id="{{$exam_doc->id}}" style="cursor:pointer"></i>
                                        <img src="{{Storage::url($exam_doc->media) ?? URL::to('/images/dummy.jpg')}}" height="100" widht="100">

                                    </div>
                                    @endforeach

                                        <input type="file" class="form-control" id="exam_document" name="exam_document[]" multiple accept="image/png, image/gif, image/jpeg"/>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                    <label class="form-label d-flex" for="goalImage">Give Sadhaqah</label>
                                    <div class="form-group sadhaqahBlock" style="display:inline-flex;">
                                        <i class="fas fa-edit sadhaqah_edit" data-id="{{$goal->id}}" style="cursor:pointer"></i>
                                        <img src="@if($goal->sadhaqah) {{Storage::url($goal->sadhaqah)}} @else {{URL::to('/images/no_goal.png')}}@endif" height="100" widht="100">
                                    </div>
                                    @error('sadhaqah') <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                    <div class="form-group">
                                        <strong>Goal End Date:</strong>
                                        <input type="date" name="end_date" value="{{ $goal->end_date ?? "" }}" class="form-control" placeholder="Goal End Date"> @error('end_date') <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                    <div class="form-group">
                                        <strong>Creator Name:</strong>
                                        <input type="text" name="creator_name" value="{{ $goal->creator_name ?? "" }}" class="form-control" placeholder="Creator name"> @error('creator_name') <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                    <div class="form-group">
                                        <strong>Instructor Name:</strong>
                                        <input type="text" name="instructor_name" value="{{ $goal->instructor_name ?? ""}}" class="form-control" placeholder="Instructor name"> @error('instructor_name') <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                    <label for="goalDescription">Description</label>
                                    <textarea class="form-control" name="description" id="exampleDescription" rows="3">{{ $goal->description}}</textarea>
                                    @error('description') <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> @enderror
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
    <!-- Modal
    <div class="modal fade" id="add_doc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Document</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.goals.update-doc') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="doc_id" id="doc_id" value="">
                        <input type="hidden" name="doc_type" id="doc_type" value="">
                        <label class="form-label"  for="goalDocuments">Documents</label>
                        <input type="file" class="form-control"  name="document" accept="image/png, image/gif, image/jpeg,video/mp4,video/x-m4v,video/* "/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>

        </div>
        </div>
    </div> -->
       <!-- Modal -->
<div class="modal fade" id="add_doc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <form method="post" action="{{ route('student.taken_goals.upload_assignments') }}" enctype="multipart/form-data">
     @csrf
      <div class="modal-content submit-paper goal-edit">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel" class="upload-assignmnt">Update Documents</h4>
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
            <form action="{{ route('admin.goals.update-doc') }}" method="post" enctype="multipart/form-data">
            <div class="zone">

            <div id="dropZ">
            <img src="{{ URL::to('./images/cloud-arrow-up-solid.png') }}" height="50" width="80" class="uplaod-img mb-3"/>
                <div>Drag and drop your Image here</div>
                <span>OR</span>
                <div class="selectFile">
                <label for="file">Select file</label>
                <input type="file" class="form-control"  name="document" accept="image/png, image/gif, image/jpeg,video/mp4,video/x-m4v,video/* "/>
                </div>
                </div>

            </div>
            </form>

         <!--   <form action="{{ route('admin.goals.update_image') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="goal_id" id="goal_id" value="">
                        <label class="form-label"  for="goalImage">Image</label>
                        <input type="file" class="form-control"  name="goal_image" accept="image/png, image/gif, image/jpeg,video/mp4,video/x-m4v,video/* "/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form> -->

            </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary upload-btn">Upload</button>
        </div>
      </div>
    </form>
    </div>
  </div>
    <!-- Goal Image Edit Modal-->

    <!-- Modal -->
<div class="modal fade" id="edit_goal_image" tabindex="-1" role="dialog" aria-labelledby="uploadAssignmentsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <form method="post" action="{{ route('student.taken_goals.upload_assignments') }}" enctype="multipart/form-data">
     @csrf
      <div class="modal-content submit-paper goal-edit">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel" class="upload-assignmnt">Update Documents</h4>
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
            <form action="{{ route('admin.goals.update_image') }}" method="post" enctype="multipart/form-data">
            <div class="zone">

            <div id="dropZ">
            <img src="{{ URL::to('./images/cloud-arrow-up-solid.png') }}" height="50" width="80" class="uplaod-img mb-3"/>
                <div>Drag and drop your Image here</div>
                <span>OR</span>
                <div class="selectFile">
                <label for="file">Select file</label>
                <input type="file" class="form-control"  name="goal_image" accept="image/png, image/gif, image/jpeg,video/mp4,video/x-m4v,video/* "/>
                </div>
                </div>

            </div>
            </form>
            </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary upload-btn">Upload</button>
        </div>
      </div>
    </form>
    </div>
  </div>


      <!-- Give Sadhaqah Modal -->
<div class="modal fade" id="edit_sadhaqah" tabindex="-1" role="dialog" aria-labelledby="uploadAssignmentsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <form method="post" action="{{ route('admin.goals.update_sadhaqah') }}" enctype="multipart/form-data">
     @csrf
      <div class="modal-content submit-paper goal-edit">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel" class="upload-assignmnt">Update Sadhqah</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="sadhaqah_goal_id" id="sadhaqah_goal_id">
            <div class="zone">
            <div id="dropZ">
            <img src="{{ URL::to('./images/cloud-arrow-up-solid.png') }}" height="50" width="80" class="uplaod-img mb-3"/>
                <div>Drag and drop your Image here</div>
                <span>OR</span>
                <div class="selectFile">
                <label for="file">Select file</label>
                <input type="file" class="form-control"  name="edit_sadhaqah" accept="image/png, image/gif, image/jpeg,video/mp4,video/x-m4v,video/* "/>
                </div>
                </div>
            </div>
            </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary upload-btn">Update</button>
        </div>
      </div>
    </form>
    </div>
  </div>
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