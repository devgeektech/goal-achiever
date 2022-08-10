<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Student Dashboard</title>
	<!-- Custom fonts for this template-->
	<link href="{{URL::to('/admin-panel/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<!-- Custom styles for this template-->
	<link href="{{URL::to('/admin-panel/css/sb-admin-2.min.css')}}" rel="stylesheet"> </head>
	<link href="{{URL::to('/admin-panel/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::to('/admin-panel/css/style.css')}}">
<body id="page-top">
	<!-- Page Wrapper -->
	<div id="wrapper">
		@include('student.layouts.sidebar')
		@yield('content')
	</div>
	<!-- End of Page Wrapper -->
	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top"> <i class="fas fa-angle-up"></i> </a>



	<input type="hidden" name="is_plan" id="is_plan" value="{{ Session::get('set_plan') }}">
	<input type="hidden" name="plan_expire" id="plan_expire" value="{{ Session::get('plan_expire') }}">

	<!-- Modal -->
	<div id="myModal" class="modal" data-backdrop="static" data-keyboard="false">


	<!-- Modal content -->
	<div class="modal-content">
	 
	  <section>

		<section class="signup-step-container">
			<h3 class="popup-heading text-center">Membership</h3>
			<div class="container mt-5">
				<div class="row d-flex justify-content-center">
					<div class="col-md-12 col-lg-12">
						<div class="wizard">
							<div class="wizard-inner">
								<div class="connecting-line"></div>
								<ul class="nav nav-tabs" role="tablist">
									<li role="presentation" class="active">
										<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab"
											aria-expanded="true"><span class="round-tab">1 </span> <i>Select
												Plan</i></a>
									</li>
									<li role="presentation" class="disabled">
										<a href="#step2" data-toggle="tab" aria-controls="step2" role="tab"
											aria-expanded="false"><span class="round-tab">2</span> <i>Select
												Subject</i></a>
									</li>
									<li role="presentation" class="disabled">
										<a href="#step3" data-toggle="tab" aria-controls="step3" role="tab"><span
												class="round-tab">3</span> <i>Payment</i></a>
									</li>
								</ul>
							</div>
							
							<form action="{{ route('student.plans.store') }}" method="post" enctype="multipart/form-data"> 
								@csrf
								<div class="tab-content" id="main_form">
									<div class="tab-pane active" role="tabpanel" id="step1">
										<h4 class="text-center">Select Plan</h4>
										<div class="plan row free-months-row">
												<div class="container">
													<div class="row mt-4">
														<input type="hidden" name="plan_months" id="plan_months" value="">
														@foreach ($plans as $plan)
															<div class="col-12 col-sm-3 col-md-6 col-lg-3 col-xl-3 months-area selct-plan">
																<label>
																	<input type="radio" data-months="{{$plan->months}}" name="plan" class="card-input-element d-none plan-input" id="plan" value="{{$plan->id}}">
																	
																	<div class="card card-body bg-light">
																		<div class="box mb-2">
																			<h6>{{$plan->name}} <br>@if($plan->name == 'FREE') <span>${{ $plan->price}}</span> @else ${{ $plan->price}}@endif</h6>
																		</div>
																	</div>
																</label>
															</div>
														@endforeach
													</div>
													@error('plan') <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> @enderror
												</div>
										</div>
										<ul class="list-inline pull-right">
											<li><button type="button" class="default-btn next-step">Continue</button></li>
										</ul>
									</div>

									<div class="tab-pane" role="tabpanel" id="step2">
										<h4 class="text-center">Select Subject</h4>
										<div class="container">
											<div class="row mt-4">
												@foreach ($subjects as $subject)
												<div class="col-lg-3 col-md-4 edu-popup">
													<label>
														<input type="radio" name="plan_subject" class="card-input-element d-none" id="demo1" value="{{$subject->id}}">
														<div class="card card-body bg-light d-flex justify-content-center  align-items-center">
															<div class="box mb-2 d-flex flex-column align-items-center text-white">
																<img src="{{Storage::url($subject->image)}}" />
																<h6>{{$subject->title}}</h6>
															</div>
														</div>
													</label>
												</div>
												@endforeach
											</div>
											@error('plan_subject') <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div> @enderror
										</div>
										<ul class="list-inline pull-right">
											<li><button type="button" class="default-btn prev-step">Back</button></li>
											<li><button type="button" class="default-btn next-step">Continue</button>
											</li>
										</ul>
									</div>
									<div class="tab-pane" role="tabpanel" id="step3">
										<h4 class="text-center">Payment</h4>
										<div class="container">
											<label class="payment-label pl-3">What type of subscription you want to select?</label>
											<div class='row my-4'>
												<div class="btn-wrapper">
													<input type="radio" name="subscription_type" id="option-1" value="manual" checked>
													<input type="radio" name="subscription_type" id="option-2" value="auto">
													  <label for="option-1" class="option option-1">

														 <span>Manual</span>
														 </label>
													  <label for="option-2" class="option option-2">
														 <span>Auto</span>
													  </label>
												   </div>
												</div>

												<div class='col-md-12'>
													<div class='form-row'>
													  <div class=' col-md-12 col-xs-12 form-group required'>
														<label class='control-label'>Name on Card</label>
														<input class='form-control' size='4' type='text'>
													  </div>
													</div>
													<div class='form-row'>
													  <div class=' col-md-12 col-xs-12 form-group required'>
														<label class='control-label'>Card Number</label>
														<input autocomplete='off' class='form-control card-number' size='20' type='text'>
													  </div>
													</div>
													<div class='form-row'>
													  <div class='col-xs-4 col-md-4 form-group cvc required'>
														<label class='control-label'>CVC</label>
														<input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
													  </div>
													  <div class='col-xs-4 col-md-4 form-group expiration required'>
														<label class='control-label'>Expiration</label>
														<input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
													  </div>
													  <div class='col-xs-4 col-md-4 form-group expiration required'>
														<label class='control-label'> </label>
														<input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
													  </div>
													</div>
													<div class='form-row'>
													  <div class='col-md-12'>
														<div class='form-control total btn btn-info'>
														  Total:
														  <span class='amount'></span>
														</div>
													  </div>
													</div>
													<div class='form-row'>
													  <div class='col-md-12 form-group mt-2'>
														<button class='form-control btn btn-primary submit-button' type='button'>Pay »</button>
													  </div>
													</div>
												</div>
										</div>
										<ul class="list-inline pull-right">
											<li><button type="button" class="default-btn prev-step">Back</button></li>
											<li><button type="submit" class="default-btn next-step">Continue</button>
											</li>
										</ul>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
	</section>
	</div>

  </div>
	<!-- Logout Modal-->
	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
				</div>
				<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button> 
					<form method="POST" action="{{ route('logout') }}">
						@csrf
						<a  class="btn btn-primary" href="{{ route('logout') }}"
										onclick="event.preventDefault();
												 this.closest('form').submit();">
							{{ __('Logout') }}
						</a>
					</form>
			</div>
		</div>
	</div>
	@include('student.layouts.scripts')
</body>
 <script>
        // ------------step-wizard-------------
        $(document).ready(function () {
            $('.nav-tabs > li a[title]').tooltip();

            //Wizard
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

                var target = $(e.target);

                if (target.parent().hasClass('disabled')) {
                    return false;
                }
            });

            $(".next-step").click(function (e) {

                var active = $('.wizard .nav-tabs li.active');
                active.next().removeClass('disabled');
                nextTab(active);

            });
            $(".prev-step").click(function (e) {

                var active = $('.wizard .nav-tabs li.active');
                prevTab(active);

            });
        });

        function nextTab(elem) {
            $(elem).next().find('a[data-toggle="tab"]').click();
        }
        function prevTab(elem) {
            $(elem).prev().find('a[data-toggle="tab"]').click();
        }


        $('.nav-tabs').on('click', 'li', function () {
            $('.nav-tabs li.active').removeClass('active');
            $(this).addClass('active');
        });
    </script>
</html>