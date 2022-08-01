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
                                <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                  <div class="form-group">
                                    <strong>Subject:</strong>
                                    <select class="form-select form-control"  name="subject" id="subject">
                                        @foreach($subjects as $subject)
                                            <option {{ $goal->subject_id == $subject->id ? 'selected':''}} value="{{$subject->id}}">{{$subject->title}}</option>
                                        @endforeach   
                                    </select>
                                  </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                      <strong>Unit:</strong>
                                      <input type="text" name="unit" value="{{ $goal->unit ?? "" }}" class="form-control" placeholder="Unit"> @error('unit') <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                      <strong>Topic:</strong>
                                      <input type="text" name="topic" value="{{ $goal->topic ?? ""}}" class="form-control" placeholder="topic"> @error('topic') <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    @foreach($media_document as $media)
                                        <div class="form-group">
                                        <img src="{{Storage::url($media->media) ?? URL::to('/images/dummy.jpg')}}" height="100" widht="100">
                                        </div>
                                    @endforeach
                                        <label class="form-label" for="customFile">Document</label>
                                        <input type="file" class="form-control" id="document" name="document[]" multiple accept="image/png, image/gif, image/jpeg"/>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    @foreach($media_video as $vid_media)
                                        <div class="form-group">
                                            <video width="320" height="240" controls>
                                                <source src="{{Storage::url($vid_media->media) ?? URL::to('/images/dummy.jpg')}}" type="video/mp4">
                                              </video>
                                        </div>
                                    @endforeach
                                        <label class="form-label" for="customFile">Video</label>
                                        <input type="file" class="form-control" id="video" name="video[]" multiple accept="video/mp4,video/x-m4v,video/*"/>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    @foreach($exam_document as $exam_doc)
                                    <div class="form-group">
                                      <img src="{{Storage::url($exam_doc->media) ?? URL::to('/images/dummy.jpg')}}" height="100" widht="100">
                                    </div>
                                    @endforeach
                                        <label class="form-label" for="customFile">Exam Document</label>
                                        <input type="file" class="form-control" id="exam_document" name="exam_document[]" multiple accept="image/png, image/gif, image/jpeg"/>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Creator Name:</strong>
                                        <input type="text" name="creator_name" value="{{ $goal->creator_name ?? "" }}" class="form-control" placeholder="Creator name"> @error('creator_name') <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Instructor Name:</strong>
                                        <input type="text" name="instructor_name" value="{{ $goal->instructor_name ?? ""}}" class="form-control" placeholder="Instructor name"> @error('instructor_name') <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary ml-3">Submit</button>
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