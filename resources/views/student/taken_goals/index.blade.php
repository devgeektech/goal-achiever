@extends('student.layouts.master')

@section('content')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

           @include('student.layouts.topbar')
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
                    <h1 class="h3 mb-2 text-gray-800">Taken Goals</h1>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Taken Goals</h6>
                           
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Unit</th>
                                            <th>Topic</th>
                                            <th>Goal Start Date</th>
                                            <th>Goal End Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Unit</th>
                                            <th>Topic</th>
                                            <th>Goal Start Date</th>
                                            <th>Goal End Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @isset($taken_goals)
                                            @foreach ($taken_goals as $taken_goal)                                            
                                                <tr>
                                                    <td>{{ $taken_goal->goal->subject->title}}</td>
                                                    <td>{{ $taken_goal->goal->unit->name}}</td>
                                                    <td>{{ $taken_goal->goal->topic->name}}</td>
                                                    <td>{{ \Carbon\Carbon::parse($taken_goal->created_at)->format('j F, Y') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($taken_goal->goal->end_date)->format('j F, Y') }}</td>
                                                    <td>
                                                       <a href="{{ route('student.taken_goals.submit_papers',$taken_goal->id) }}" class="btn btn-warning">Submit Papers</a>
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
    <script src="{{URL::to('/admin-panel/js/all.js')}}"></script>
   @endpush