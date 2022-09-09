@extends('admin.layouts.master')

@section('content')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

           @include('admin.layouts.topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Student Info</h1>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Student Info</h6>
                            <a href="{{ route('admin.students.index')}}"class="btn btn-primary" style="float: right;">Back</a>
                        </div>
                        <div class="card-body">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="forProfileImage">Profile Image</label><br>
                                    <img src="@if($student->profile_image){{ Storage::url($student->profile_image) }} @else {{URL::to('/admin-panel/img/undraw_profile.svg')}} @endif" height="100px" width="100px">
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-6 col-sm-6 col-md-6">
                                        <label for="forName">Name</label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{ $student->name }}" readonly>
                                    </div>
                                    <div class="form-group col-xs-6 col-sm-6 col-md-6">
                                        <label for="forEmail">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" value="{{ $student->email }}" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-6 col-sm-6 col-md-6">
                                        <label for="forAge">Age</label>
                                        <input type="text" class="form-control" name="age" id="age" value="{{ $student->age }}" readonly>
                                    </div>
                                    <div class="form-group col-xs-6 col-sm-6 col-md-6">
                                        <label for="forCountry">Country</label>
                                        <input type="text" class="form-control" name="country" id="country" value="{{ $student->country }}" readonly>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Goals Participated</th>
                                            <th>Goals Achieved</th>
                                            <th>Goals Pending</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>{{getSubjectTakenByStudent($student->id)}}</th>
                                            <th>{{getGoalsCountAchievedByStudent($student->id)}}</th>
                                            <th>{{getSubjectTakenByStudent($student->id) - getGoalsCountAchievedByStudent($student->id) }}</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <td>
                                                @if(getGoalsTakenByStudent($student->id) != "")
                                                    @foreach(getGoalsTakenByStudent($student->id) as $item)
                                                    {{$item}}
                                                    <br>
                                                    @endforeach
                                                @else 
                                                    -
                                                @endif
                                            </td>
                                            <td> 
                                                @if(getGoalsAchievedByStudent($student->id) != "")
                                                    @foreach(getGoalsAchievedByStudent($student->id) as $item)
                                                    {{$item}}
                                                    <br>
                                                    @endforeach
                                                @else 
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if(getGoalsPendingByStudent($student->id) != "")
                                                    @foreach(getGoalsPendingByStudent($student->id) as $item)
                                                    {{$item}}
                                                    <br>
                                                    @endforeach
                                                @else 
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
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