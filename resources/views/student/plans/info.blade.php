@extends('student.layouts.master')

@section('content')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

           @include('student.layouts.topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Plan Info</h1>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Plan Info</h6>
                            <a href="{{ route('student.plans.index')}}"class="btn btn-primary" style="float: right;">Back</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('student.plans.store') }}" method="post" enctype="multipart/form-data"> 
                                @csrf
                                <div class="row goalWrap">
                                    <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group" >
                                            <label for="forSubject">Name</label>
                                            <input type="text" class="form-control" value="{{ $plan->name }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group" >
                                            <label for="forSubject">Price</label>
                                            <input type="text" class="form-control" value="{{ $plan->price }}" readonly>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary ml-3">Buy</button>
                                </div>
                            </form>
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