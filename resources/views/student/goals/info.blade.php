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
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <label class="form-group d-flex" for="forUnit">Documents</label>
                                        @foreach($media_document as $media)
                                            <div class="form-group videoImgBlock" style="display:inline-flex; cursor:pointer;">
                                            <img src="{{Storage::url($media->media) ?? URL::to('/images/dummy.jpg')}}" height="100" widht="100">
                                            <i class="fa fa-download" aria-hidden="true"></i>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <label class="form-group d-flex" for="forUnit">Videos</label>
                                        @foreach($media_video as $vid_media)
                                            <div class="form-group videoImgBlock" style="display:inline-flex;cursor:pointer;">
                                                <video width="320" height="240" controls>
                                                    <source src="{{Storage::url($vid_media->media) ?? URL::to('/images/dummy.jpg')}}" type="video/mp4">
                                                </video>
                                                <i class="fa fa-download" aria-hidden="true"></i>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <label class="form-group d-flex" for="forUnit">Exam Documents</label>
                                        @foreach($exam_document as $exam_doc)
                                            <div class="form-group videoImgBlock" style="display:inline-flex;cursor:pointer;">
                                                <img src="{{Storage::url($exam_doc->media) ?? URL::to('/images/dummy.jpg')}}" height="100" widht="100">
                                                <i class="fa fa-download" aria-hidden="true"></i>
                                            </div>
                                        @endforeach
                                    </div>
                                    <hr>
                                </div>
                                <button type="submit" class="btn btn-primary ml-3">Ready To Achieve</button>
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