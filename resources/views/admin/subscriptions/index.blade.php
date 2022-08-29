@extends('admin.layouts.master')

@section('content')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

           @include('admin.layouts.topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Subscriptions</h1>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Student</th>
                                            <th>Plan Name</th>
                                            <th>Plan Price</th>
                                            <th>Plan Months</th>
                                            <th>Plan Expire Date</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Student</th>
                                            <th>Plan Name</th>
                                            <th>Plan Price</th>
                                            <th>Plan Months</th>
                                            <th>Plan Expire Date</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($subscriptions as $subscription)
                                        <tr>
                                            <td>{{ $subscription->user->name }}</td>
                                            <td>{{ $subscription->plan->name }}</td>
                                            <td>{{ $subscription->plan->price }}</td>
                                            <td>{{ $subscription->plan->months }}</td>
                                            <td>@if(strtotime(now()) > strtotime($subscription->expiry_date) ) Plan Expired @else {{ \Carbon\Carbon::parse($subscription->expiry_date)->format('j F, Y') }} @endif</td>
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