@extends('admin.layouts.master')

@section('content')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
           @include('admin.layouts.topbar')
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Students</h1>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Students</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Goals Achieved</th>
                                            <th>Goals Taken</th>
                                            <th>Goals Pending</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Goals Achieved</th>
                                            <th>Goals Taken</th>
                                            <th>Goals Pending</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($students as $student)
                                        <tr>
                                            <td>{{ $student->name}}</td>
                                            <td>{{ getTotalGoalsAchieved($student->id)}}</td>
                                            <td>{{ getTotalGoalsTaken($student->id)}}</td>
                                            <td>{{ getPendingGoals($student->id)}}</td>
                                            <td>
                                                <a href="{{ route('admin.students.info',$student->id) }}" class="btn btn-primary">Info</a>
                                                @if($student->status == '2')
                                                <form action="{{ route('admin.students.activate',['id' => $student->id]) }}" method="POST" style="margin-left: 49px;margin-top: -38px">
                                                    @csrf
                                                    <button style="margin-left:10px; border-radius: 0.35rem;" type="submit" class="btn btn-warning">Not Active</button>
                                                </form>
                                                @else
                                                    <a href="#" class="btn btn-success">Activate</a>
                                                @endif
                                                <form action="{{ route('admin.students.destroy',['id' => $student->id]) }}" method="POST" style="margin-left: 120px;margin-top: -38px">
                                                    @csrf
                                                    <button style="margin-left:45px; border-radius: 0.35rem;" type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
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