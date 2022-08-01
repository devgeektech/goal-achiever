@extends('admin.layouts.master') @section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
  <!-- Main Content -->
  <div id="content"> @include('admin.layouts.topbar')
    <!-- Begin Page Content -->
    <div class="container-fluid">
      <!-- Page Heading -->
     
      <!-- Content Row -->
      <div class="row">
        <div class="col-md-8">
          <div class="card mb-4"> @if ($message = Session::get('username_success')) <div class="alert alert-success alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>{{ $message }}</strong>
            </div> @endif <div class="card-header">{{ __('Reset Username') }}</div>
            <div class="card-body">
              <form method="POST" action="{{ route('admin.change-username')}}"> @csrf 
              
                <div class="row mb-3">
                    <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>
                    <div class="col-md-6">
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" autocomplete="name"> @error('name') <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span> @enderror
                    </div>
                  </div>
                <div class="row mb-0">
                  <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                      {{ __('Reset Username') }}
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
  
      <div class="col-md-8">
        <div class="card"> @if ($message = Session::get('password_success')) <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
          </div> @endif <div class="card-header">{{ __('Reset Password') }}</div>
          <div class="card-body">
            <form method="POST" action="{{ route('admin.password_reset')}}"> @csrf <div class="row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('New Password') }}</label>
                <div class="col-md-6">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"> @error('password') <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span> @enderror
                </div>
              </div>
              <div class="row mb-3">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                <div class="col-md-6">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
              </div>
              <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('Reset Password') }}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> @endsection