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
                    <h1 class="h3 mb-2 text-gray-800">Goals</h1>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add Goal</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('goals.store') }}" method="post" enctype="multipart/form-data"> 
                                @csrf
                                <div class="form-group">
                                  <label for="goalSubject">Subject</label>
                                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Enter Subject">
                                </div>
                                <div class="form-group">
                                  <label for="goalUnit">Unit</label>
                                  <input type="text" class="form-control" name="unit" id="unit" placeholder="Unit">
                                </div>
                                <div class="form-group">
                                    <label for="goalTopic">Topic</label>
                                    <input type="text" class="form-control" name="topic" id="topic" placeholder="Topic">
                                </div>

                                <div class="form-group">
                                    <label for="goalDocuments">Documents</label>
                                    <input type="file" class="form-control-file" name="document" id="documents">
                                </div>
                                <div class="form-group">
                                    <label for="goalVideo">Video</label>
                                    <input type="file" class="form-control-file" name="video" id="video">
                                </div>
                                <div class="form-group">
                                    <label for="exampleExamDocument">Exam Document</label>
                                    <input type="file" class="form-control-file" name="exam_document" id="Exam Documents">
                                </div>
                                <div class="form-group">
                                    <label for="goalCreatorName">Creator's Name</label>
                                    <input type="text" class="form-control" name="creator_name" id="creator_name" placeholder="Creator's Name">
                                </div>
                                <div class="form-group">
                                    <label for="goalInstructorName">Instructor's Name</label>
                                    <input type="text" class="form-control" name="instructor_name" id="instructor_name" placeholder="Instructor's Name">
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