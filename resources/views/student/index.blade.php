@extends('student.layouts.master')

@section('content')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
           @include('student.layouts.topbar')



            <!-- Begin Page Content -->
            <div class="container-fluid">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                 @endif
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800 font-weight-bold  dashboard-heading">Dashboard</h1>  </div>
                <!-- Content Row -->
                <div class="row">
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> My Goals </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"> @isset($all_goals) {{ $all_goals }}  @endisset </div>
                                    </div>
                                    <div class="col-auto"> <i class="fas fa-calendar fa-2x text-gray-300"></i> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1"> Goals Pending</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">@if($comp_goals){{ $all_goals - $comp_goals }} @else 0 @endif </div>
                                    </div>
                                    <div class="col-auto"> <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Goals Completed</div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $comp_goals }}</div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-auto"> <i class="fas fa-clipboard-list fa-2x text-gray-300"></i> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"> Goal Inprogress</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $all_goals - $comp_goals }}</div>
                                    </div>
                                    <div class="col-auto"> <i class="fas fa-comments fa-2x text-gray-300"></i> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Content Row -->
                <div class="row d-block">
                    <div class="col-lg-8 col-md-8 col-12 card shadow mb-4 p-0 ml-3">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">My Goals Achieving Progress Chart</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-bar">
                               <input type="hidden" name="goals" id="my_goals" value="@isset($get_units) {{json_encode($get_units,true)}} @endisset">
                               <input type="hidden" name="goals_percentage" id="goals_percentage" value="@isset($get_percentage) {{json_encode($get_percentage,true)}} @endisset">
                                <canvas id="myBarChart"></canvas>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
                <!-- Content Row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto"> <span>Copyright &copy; Your Website 2021</span> </div>
            </div>
        </footer>
        <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->

@endsection
@push('js')
<script>
    var students = "{{ json_encode($get_units,true) }}";
    students = JSON.parse(students.replace(/&quot;/g,'"'));
</script>
<script src="{{URL::to('/admin-panel/js/all.js')}}"></script>
@endpush