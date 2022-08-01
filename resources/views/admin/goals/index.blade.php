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
                            <h6 class="m-0 font-weight-bold text-primary">Goals</h6>
                            <a href="{{ route('admin.goals.create')}}"class="btn btn-primary" style="float: right;">Add New Goal</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Unit</th>
                                            <th>Topic</th>
                                            <th>Creator's Name</th>
                                            <th>Instructor's Name</th>
                                            <th>Participants</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Unit</th>
                                            <th>Topic</th>
                                            <th>Creator's Name</th>
                                            <th>Instructor's Name</th>
                                            <th>Participants</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @isset($goals)
                                            @foreach ($goals as $goal)                                            
                                                <tr>
                                                    <td>{{ $goal->subject->title}}</td>
                                                    <td>{{ $goal->unit}}</td>
                                                    <td>{{ $goal->topic}}</td>
                                                    <td>{{ $goal->creator_name}}</td>
                                                    <td>{{ $goal->instructor_name}}</td>
                                                    <td>17</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <!--<button type="button" class="@if($goal->status == '1')btn btn-success @else btn btn-warning @endif dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                @if($goal->status == '1') Active @else Deactivate @endif
                                                            </button>-->
                                                            <div class="dropdown-menu">
                                                            <a id="change_status" class="dropdown-item  @if($goal->status == '1') deactive @else activate @endif">@if($goal->status == '1') Deactive @else Active @endif</a>
                                                        </div>
                                                        <a style="margin-left:10px; border-radius: 0.35rem;" href="{{ route('admin.goals.edit', ['id' => $goal->id])}}" class="btn btn-primary">Edit</a>
                                                        <form action="{{ route('admin.goals.destroy',['id' => $goal->id]) }}" method="POST">
                                                            @csrf
                                                           
                                                            <button style="margin-left:10px; border-radius: 0.35rem;" type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                        </div>
                                                        </td>
                                                </tr>
                                            @endforeach                                           
                                        @endisset
                                    </tbody>
                                </table>
                            </div>
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
        //let change_goal_status = "";
    </script>
    <script src="{{URL::to('/admin/js/all.js')}}"></script>
  
   @endpush