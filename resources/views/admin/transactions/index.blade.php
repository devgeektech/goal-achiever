@extends('admin.layouts.master')

@section('content')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

           @include('admin.layouts.topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Transactions History</h1>
                    
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
                                            <th>Transaction ID</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Student</th>
                                            <th>Plan Name</th>
                                            <th>Plan Price</th>
                                            <th>Plan Months</th>
                                            <th>Plan Expire Date</th>
                                            <th>Transaction ID</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($transactions as $transaction)
                                        <tr>
                                            <td>{{ $transaction->user->name }}</td>
                                            <td>{{ $transaction->plan->name }}</td>
                                            <td>{{ $transaction->plan->price }}</td>
                                            <td>{{ $transaction->plan->months }}</td>
                                            <td>@if(strtotime(now()) > strtotime($transaction->expiry_date) ) Plan Expired @else {{ \Carbon\Carbon::parse($transaction->expiry_date)->format('j F, Y') }} @endif</td>
                                            <td>{{ $transaction->transaction_id }}</td>
                                            <td>@if(strtotime(now()) > strtotime($transaction->expiry_date) || $transaction->user->status != 1 ) <button class="btn btn-warning">Deactivate</button> @else <button class="btn btn-success">Active</button> @endif</td>
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