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
                    <h1 class="h3 mb-2 text-gray-800">Units</h1>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Units</h6>
                            <a href="{{ route('admin.units.create')}}"class="btn btn-primary" style="float: right;">Add New Unit</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Title</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @isset($units)
                                        @foreach ($units as $unit)                                            
                                            <tr>
                                                <td>{{ $unit->subject->title}}</td>
                                                <td>{{ $unit->name}}</td>
                                                <td>
                                                    <div class="btn-group">
                                                    <a style="margin-left:10px; border-radius: 0.35rem;" href="{{ route('admin.units.edit', ['id' => $unit->id])}}" class="btn btn-primary">Edit</a>
                                                    <form action="{{ route('admin.units.destroy',['id' => $unit->id]) }}" method="POST">
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