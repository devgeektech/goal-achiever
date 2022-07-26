@extends('student.layouts.master')

@section('content')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

           @include('student.layouts.topbar')
           <div class="card-body p-0">
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

                    <!-- Page Heading -
                    <h1 class="h3 mb-2 text-gray-800">Goals</h1> -->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h3 class="m-0 font-weight-bold goals-heading">Goals</h3>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Unit</th>
                                            <th>Goal End Date</th>
                                            <th>Creator's Name</th>
                                            <th>Instructor's Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Unit</th>
                                            <th>Goal End Date</th>
                                            <th>Creator's Name</th>
                                            <th>Instructor's Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @isset($goals)
                                            @foreach ($goals as $goal)
                                                <tr>
                                                    <td>{{ getSubjectName($goal[0]->subject_id) }}</td>
                                                    <td>{{ getUnitName($goal[0]->unit_id) }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($goal[0]->end_date)->format('j F, Y') }}</td>
                                                    <td>{{ $goal[0]->creator_name}}</td>
                                                    <td>{{ $goal[0]->instructor_name}}</td>
                                                    <td>
                                                       <a href="{{ route('student.goals.details',$goal[0]->unit_id) }}" class="btn btn-warning">Info</a>
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