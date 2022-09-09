<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Islamic</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{URL::to('images/favicon.svg')}}">
    <link rel="stylesheet" href="{{URL::to('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::to('css/style.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  </head>
  <body> @include('web.layouts.topbar') @yield('content') <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content logout">
          <div class="modal-header">
            <h5 class="modal-title text-white" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body text-white">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary logout-cancel" type="button" data-dismiss="modal">Cancel</button>
            <form method="POST" action="{{ route('logout') }}"> @csrf <a class="btn btn-primary logout-btn" href="{{ route('logout') }}" onclick="event.preventDefault();
                             this.closest('form').submit();">
                {{ __('Logout') }}
              </a>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Membership Modal -->
    <div class="modal fade" id="membershipModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <!-- Modal content -->
      <div class="modal-content">

        <section>
          <section class="signup-step-container">
            <h3 class="popup-heading text-center text-white">Membership</h3>
            <hr>
            <div class="container mt-5">
              <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-12">
                  <div class="wizard">
                    <div class="wizard-inner">
                      <div class="connecting-line"></div>
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                          <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" aria-expanded="true">
                            <span class="round-tab">1 </span>
                            <i>Register</i>
                          </a>
                        </li>
                        <li role="presentation" class="disabled">
                          <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" aria-expanded="false">
                            <span class="round-tab">2</span>
                            <i>Select Plan</i>
                          </a>
                        </li>
                        <li role="presentation" class="disabled">
                          <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab">
                            <span class="round-tab">3</span>
                            <i>Payment</i>
                          </a>
                        </li>
                      </ul>
                    </div>

                      <div class="tab-content" id="main_form">
                        <div class="tab-pane active" role="tabpanel" id="step1">
                          <h4 class="text-center mb-4 text-white">Register</h4>
                          <!-- Form HTML Start-->
                          <form action="#" method="post" id="membership_form">
                            <div class="row">
                            <div class="form-group col-lg-6 col-md-6 col-12">
                              <input type="text" class="form-control px-3 py-3" placeholder="Username" id="m_name" name="name" autocomplete="off">
                              <span class="username_error error"></span>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-12">
                              <input type="email" class="form-control px-3 py-3" placeholder="Email Address" id="m_email" name="email" autocomplete="off">
                              <span class="email_error error"></span>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-12">
                              <input type="password" class="form-control px-3 py-3" placeholder="Password" id="m_pwd" name="password" autocomplete="off">
                              <span class="password_error error"></span>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-12">
                              <input type="password" class="form-control px-3 py-3" placeholder="Confirm Password" id="m_confirm-pwd" name="password_confirmation" autocomplete="off">
                              <span class="confirm-pwd_error error"></span>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-12">
                              <input type="number" class="form-control px-3 py-3" placeholder="Age" id="m_age" name="age" autocomplete="off">
                              <span class="age_error error"></span>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-12">
                              <select class="form-control" placeholder="Select Counrty" id="m_country" required="true" name="country"> @foreach($countries as $country) <option value="{{$country->name}}">{{$country->name}}</option> @endforeach </select>
                            </div>
                            <button type="button" id="registerBtn" class="btn btn-primary register d-block mx-auto mt-3 registerBtn">Register Now <i class="fa-solid fa-arrow-right ml-2"></i>
                            </button>
                            </div>
                          </form>
                          <!-- Form HTML End-->
                        </div>

                        <div class="tab-pane" role="tabpanel" id="step2">
                          <h4 class="text-center text-white">Select Plan</h4>
                          <div class="plan row free-months-row pt-2">
                            <div class="container">
                              <div class="row mt-4">
                                <input type="hidden" name="plan_months" id="plan_months" value="">
                                <input type="hidden" name="plan_name" id="plan_name" value="">
                                <input type="hidden" name="plan_price" id="plan_price" value=""> 
                                <input type="hidden" name="plan_id" id="plan_id" value=""> 
                                <input type="hidden" name="get_user_id" id="get_user_id" value="">
                                <input type="hidden" name="goal_id" id="goal_id" value="">
                                <input type="hidden" name="subject_id" id="subject_id" value="">
                                <input type="hidden" name="unit_id" id="unit_id" value="">
                                <input type="hidden" name="topic_id" id="topic_id" value="">
                                <input type="hidden" name="end_date" id="end_date" value="">
                                  @foreach ($plans as $plan) 
                                  <div class="col-12 col-sm-3 col-md-6 col-lg-3 col-xl-3 months-area selct-plan">
                                    <label>
                                      <input type="radio" data-price="{{$plan->price}}" data-name="{{$plan->name}}" data-months="{{$plan->months}}" name="plan" class="card-input-element d-none plan-input" id="plan" value="{{$plan->id}}">
                                      <div class="card card-body bg-light">
                                        <div class="box mb-2">
                                          <h6>{{$plan->name}}
                                            <br>@if($plan->name == 'FREE') <span>${{ $plan->price}}</span> @else ${{ $plan->price}}@endif
                                          </h6>
                                        </div>
                                      </div>
                                    </label>
                                  </div>
                                  @endforeach
                                  <span class="plan_error"></span> 
                              </div>
                             
                            </div>
                          </div>
                          <ul class="list-inline pull-right">
                            <li>
                              <button type="button" class="default-btn prev-step">Back</button>
                            </li>
                            <li>
                              <button type="button" class="default-btn next-step">Continue</button>
                            </li>
                          </ul>
                        </div>
                        <div class="tab-pane" role="tabpanel" id="step3">
                          <h4 class="text-center text-white">Payment</h4>
                          <div class="container">

                            
                            <div class='row my-4 justify-content-center subscription-type'>

                            </div>
                          
                          
                            <div class='col-md-12'>
                              
                              <div class='form-row'>
                                <div class=' col-md-12 col-xs-12 form-group required'>
                                  <label class='control-label text-white'>PLEASE  PAY VIA BANK TRANSFER</label>
                                  <label class='control-label text-white'>Account name : Aishath Nahula</label>
                                  <label class='control-label text-white'>MRF Account number: 7770000008259</label>
                                  <label class='control-label text-white'>US$ Account number: 7770000080879</label>
                                  <label class='control-label text-white'>Viber no: 9822035</label>
                                  <label class='control-label text-white'>When you transfer the payment, please add your full name in the remarks column of the slip and share the slip in the above Viber number.</label>
                                </div>
                              
                                <div class=' col-md-12 col-xs-12 form-group required'>
                                  <label class='control-label text-white'>Reference Number</label>
                                  <input class='form-control' type='text' id="reference_no" name="reference_no" required>
                                  <span class="reference_no_error error"></span>
                                </div>
                              </div>
                            <!--  
                              <div class='form-row'>
                                <div class=' col-md-12 col-xs-12 form-group required'>
                                  <label class='control-label text-white'>Name on Card</label>
                                  <input class='form-control' size='4' type='text' id="name_on_card" name="name_on_card" required>
                                  <span class="card_name_error error"></span>
                                </div>
                              </div>
                            
                              <div class='form-row'>
                                <div class=' col-md-12 col-xs-12 form-group required'>
                                  <label class='control-label text-white'>Card Number</label>
                                  <input id="cr_no" type="text" maxlength="16" name="card_number" class='form-control card-number' placeholder="xxxx xxxx xxxx xxxx" required>
                                  <span class="card_number_error error"></span>
                                </div>
                              </div>
                             
                              <div class='form-row'>
                                <div class='col-xs-4 col-md-4 form-group cvc required'>
                                  <label class='control-label text-white'>CVC</label>
                                  <input autocomplete='off' name="cvc_number" id="cvc_number" class='form-control card-cvc' placeholder='ex. 311' size='4' type='text' required>
                                  <span class="cvc_error error"></span>
                                </div>
                                <div class='col-xs-4 col-md-4 form-group expiration required'>
                                  <label class='control-label text-white'>Expiration</label>
                                  <input class='form-control card-expiry-month' id="expiration_month" name="expiration_month" placeholder='MM' size='2' type='text' required>
                                  <span class="exp_month_error error"></span>
                                </div>
                                <div class='col-xs-4 col-md-4 form-group expiration required'>
                                  <label class='control-label'></label>
                                  <input class='form-control card-expiry-year mt-2' id="expiration_year" name="expiration_year" placeholder='YYYY' size='4' type='text' required>
                                  <span class="exp_year_error error"></span>
                                </div>
                              </div>
                              
                              <div class='form-row'>
                                <div class='col-md-12'>
                                  <div class='form-control total btn btn-info'> Total: <span class='amount' id="total_amount"></span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                        -->

                          <ul class="list-inline pull-right">
                            <li>
                              <button type="button" class="default-btn prev-step">Back</button>
                            </li>
                            <li>
                              <button type="submit" id="purchase_plan" class="default-btn next-step">Pay</button>
                            </li>
                          </ul>
                        </div>

                  </div>

                </div>
              </div>
            </div>
          </section>
        </section>
      </div>
    </div>
    <!----------FOOTER-SECTION-END-HERE--------->
    @extends('web.layouts.scripts')
    @extends('web.layouts.footer')
    @push('js')
    <script>
      let register_route = "{{route('register')}}";
      let purchase_plan_route = "{{route('payment_store')}}";
    </script>
    @endpush