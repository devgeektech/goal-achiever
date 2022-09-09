@extends('student.layouts.master') @section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
  <!-- Main Content -->
  <div id="content"> @include('student.layouts.topbar')
    <!-- Begin Page Content -->
    <div class="container-fluid">
      <!-- Page Heading -->
      <!-- Content Row -->
      <div class="row">
        <div class="col-md-8">
          <div class="card mb-4"> @if ($message = Session::get('username_success')) <div class="alert alert-success alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>{{ $message }}</strong>
            </div> @endif <div class="card-header">{{ __('Update Profile') }}</div>
            <div class="card-body">
              <form method="POST" action="{{ route('student.change-username')}}" enctype="multipart/form-data"> @csrf <div class="row mb-3">
                  <label for="image" class="col-md-4 col-form-label text-md-end"></label>
                  <div class="col-md-6">
                    <img class="img-profile rounded-circle" src="{{ (Auth::user()->profile_image) ? Storage::url(Auth::user()->profile_image) : URL::to('/admin-panel/img/undraw_profile.svg')}}" height="100px" width="100px">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Profile Image') }}</label>
                  <div class="col-md-6">
                    <input id="profile_image" type="file" class="form-control @error('profile_image') is-invalid @enderror" name="profile_image" autocomplete="profile_image" accept="image/png, image/gif, image/jpeg"> @error('profile_image') <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span> @enderror
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>
                  <div class="col-md-6">
                    <input id="name" type="text" value="{{ Auth::user()->name }}" class="form-control @error('name') is-invalid @enderror" name="name"> @error('name') <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span> @enderror
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
                  <div class="col-md-6">
                    <input id="email" type="email" value="{{ Auth::user()->email }}" class="form-control @error('email') is-invalid @enderror" name="email"> @error('email') <span class="invalid-feedback" role="alert">
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
          <div class="card "> @if ($message = Session::get('password_success')) <div class="alert alert-success alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>{{ $message }}</strong>
            </div> @endif <div class="card-header">{{ __('Reset Password') }}</div>
            <div class="card-body">
              <form method="POST" action="{{ route('student.password_reset')}}"> @csrf <div class="row mb-3">
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
  </div>
</div> @endsection