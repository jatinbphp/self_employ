@extends('frontend.layouts.app')
@section('content')
    <div class="main-content-bx01 login-page">
        <div class="container">
            <div class="d-flex align-items-start profile-tabssetting">
                <div class="nav profile-tb-btn1 flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="bankAccount nav-link active " id="bankAccountTab" data-bs-toggle="pill" data-bs-target="#v-pills-bank-account" type="button" role="tab" aria-controls="v-pills-bank-account" aria-selected="true">Connect Bank Account</button>
                    <button class="bankAccount nav-link " id="depositTab" data-bs-toggle="pill" data-bs-target="#v-pills-deposit" type="button" role="tab" aria-controls="v-pills-bank-account" aria-selected="true">Deposit</button>
                    <button class="bankAccount nav-link " id="withdrawTab" data-bs-toggle="pill" data-bs-target="#v-pills-withdraw" type="button" role="tab" aria-controls="v-pills-withdraw" aria-selected="true">Withdraw</button>
                </div>
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-bank-account" role="tabpanel" aria-labelledby="bankAccountTab" tabindex="0">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="post-taskbx01">
                                    <div class="profile-viewbx1">
                                        @if($isAccount == 1)
                                            @if($bankStatus == 0)
                                                <div class="card-body border p-0 mb-2">
                                                    <p>
                                                        <a class="btn btn-primary w-100 h-100 d-flex align-items-center justify-content-between">
                                                            <span class="fw-bold">Stripe Payout Account Status</span>
                                                        </a>
                                                    </p>
                                                    <div class="p-3 pt-0">
                                                        <label class="bg-warning p-2 mt-2">Verification Pending</label>
                                                        <p class="my-2">
                                                            This status is shown to your Connect Stripe account for payout. if this status
                                                            is still pending verification, you can find the Stripe verification button below.
                                                        </p>
                                                        <button type="button" class="btn btn-primary" id="verifyAccount">Verify You Account with Stripe</button>
                                                        <p class="mt-2">
                                                            To confirm your account details with Stripe, simply click on the button
                                                            provided. This process is a user-friendly verification process facilitated by
                                                            Stripe Connect. Be assured that all your data will be secured by Stripe and
                                                            we will not store any real data such as identification numbers or documents.
                                                            Instead, all data will be directly uploaded to Stripe and verified by them.
                                                        </p>
                                                    </div>
                                                </div>
                                            @else
                                                <label class="bg-info p-2 mb-2">Bank Account Verified</label>
                                            @endif
                                        @endif

                                        <form id="connectBankForm" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-spacebx1">
                                                <p>Select Business Type</p>
                                                <div class="form-group">
                                                    @foreach(\App\Models\User::$businessType as $key => $btype)
                                                        @php
                                                                $checked = isset($bankAccount) && $bankAccount['business_type'] == $key ? 'checked' : '';
                                                        @endphp
                                                        <input type="radio" name="business_type" {{$checked}} value="{{$key}}" style="height: unset!important; min-height: unset!important;">
                                                        <span style="@if($key == "individual") margin-right:10px; @endif">{{ $btype }}</span>
                                                    @endforeach
                                                     <br><span class="text-danger" id="error-business_type"></span>
                                                </div>

                                                <div class="form-inputrow">
                                                    <div class="form-group formspace02">
                                                        <p>First Name</p>
                                                        <input type="text" name="first_name" value="{{auth()->user()->first_name}}" class="form-control form-control-lg" placeholder="First Name">
                                                        <span class="text-danger" id="error-first_name"></span>
                                                    </div>
                                                    <div class="form-group formspace02">
                                                        <p>Last Name</p>
                                                        <input type="text" name="last_name" value="{{auth()->user()->last_name}}" class="form-control form-control-lg" placeholder="Last Name">
                                                        <span class="text-danger" id="error-last_name"></span>
                                                    </div>
                                                </div>

                                                <p>Bank Country</p>
                                                <div class="form-group">
                                                    <select name="bank_country" id="bankCountry" class="form-select select2">
                                                        <option value="">Select Country</option>
                                                        @if(count($bankCountry) > 0)
                                                            @foreach($bankCountry as $list)
                                                                @php
                                                                        $selected =  isset($bankAccount) &&  $bankAccount['country'] == $list['id'] ? 'selected' : '';
                                                                @endphp
                                                                <option value="{{$list['id']}}" {{$selected}}>{{$list['country_name']}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <span class="text-danger" id="error-bank_country"></span>
                                                </div>

                                                <p>Address</p>
                                                <div class="form-group">
                                                    <input type="text" name="address" value="{{isset($bankAccount) ? $bankAccount['address'] : '' }}" class="form-control form-control-lg" placeholder="Address">
                                                    <span class="text-danger" id="error-address"></span>
                                                </div>
                                                <p>City/Town</p>
                                                <div class="form-group">
                                                    <input type="text" name="city" value="{{isset($bankAccount) ? $bankAccount['city'] : '' }}" class="form-control form-control-lg" placeholder="City">
                                                    <span class="text-danger" id="error-city"></span>
                                                </div>
                                                <div class="form-inputrow">
                                                    <div class="form-group formspace02">
                                                        <p>ZIP/Postal Code</p>
                                                        <input type="text" name="zip_code" value="{{isset($bankAccount) ? $bankAccount['zip_code'] : '' }}" class="form-control form-control-lg" placeholder="Zip/Postal Code">
                                                        <span class="text-danger" id="error-zip_code"></span>
                                                    </div>
                                                    <div class="form-group formspace02">
                                                        <p>State/Region</p>
                                                        <input type="text" name="state" value="{{isset($bankAccount) ? $bankAccount['state'] : '' }}" class="form-control form-control-lg" placeholder="State">
                                                        <span class="text-danger" id="error-state"></span>
                                                    </div>
                                                </div>

                                                <p>Bank Account Holder Name</p>
                                                <div class="form-group">
                                                    <input type="text" name="bank_holder_name" value="{{isset($bankAccount) ? $bankAccount['bank_holder_name'] : '' }}" class="form-control form-control-lg" placeholder="Bank Account Holder Name">
                                                    <span class="text-danger" id="error-bank_holder_name"></span>
                                                </div>
                                                <input type="hidden" name="min" id="min">
                                                <input type="hidden" name="max" id="max">
                                                <div class="form-inputrow" id="dynamicFields">
                                                    <div class="form-group formspace02">
                                                        <p>Bank Account Number</p>
                                                        <input type="text" name="bank_account_number" data-name="Bank Account Number" id="bankDetail_0" value="{{isset($bankAccount) ? $bankAccount['bank_account_number'] : '' }}" class="form-control form-control-lg" placeholder="Bank Account Number">
                                                        <span class="text-danger" id="error-bank_account_number"></span>
                                                    </div>
                                                    <div class="form-group formspace02" id="specialNumber">
                                                        <p>Bank Routing Number</p>
                                                        <input type="text" name="routing_number" data-name="Bank Routing Number" id="bankDetail_1" value="{{isset($bankAccount) ? $bankAccount['bank_routing_number'] : '' }}" class="form-control form-control-lg" placeholder="Bank Routing Number">
                                                        <span class="text-danger" id="error-routing_number"></span>
                                                    </div>
                                                </div>
                                                <div class="submit-btnbx0">
                                                    <button type="submit" class="btn btn-primary" name="update" value="update">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-deposit" role="tabpanel" aria-labelledby="depositTab" tabindex="0">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="post-taskbx01">
                                    <div class="profile-viewbx1">
                                        <form id="depositForm" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-spacebx1">
                                                <h3>Payment Method</h3>
                                                <div class="card-body border p-0">
                                                    <p>
                                                        <a class="btn btn-primary w-100 h-100 d-flex align-items-center justify-content-between"
                                                           data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true"
                                                           aria-controls="collapseExample">
                                                            <span class="fw-bold">Swish Payment</span>
                                                            <!-- <span class="fa fa-paypal">
                                                            </span> -->
                                                        </a>
                                                    </p>
                                                    <div class="collapse p-3 pt-0" id="collapseExample">
                                                        <p class="h3 mt-2 mb-0">Summary</p>
                                                        <form action="" class="form">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form__div mb-2">
                                                                        <input type="text" class="form-control-custom" placeholder="Amount">
                                                                        <!-- <label for="" class="form__label">Card Number</label> -->
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="btn btn-primary w-100">Sumbit</div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <p class="mb-0">
                                                            <span class="fw-bold">Product:</span>
                                                            <span class="c-green">: Name of product</span>
                                                        </p>
                                                        <p class="mb-0"><span class="fw-bold">Price:</span><span
                                                                class="c-green">:$452.90</span></p>
                                                        <p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque
                                                            nihil neque
                                                            quisquam aut
                                                            repellendus, dicta vero? Animi dicta cupiditate, facilis provident quibusdam ab
                                                            quis,
                                                            iste harum ipsum hic, nemo qui!</p>
                                                    </div>
                                                </div>
                                                <div class="card-body border p-0 mt-3">
                                                    <p>
                                                        <a class="btn btn-primary p-2 w-100 h-100 d-flex align-items-center justify-content-between"
                                                           data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true"
                                                           aria-controls="collapseExample">
                                                            <span class="fw-bold">Credit Card</span>
                                                            <span class="">
                                                                <span class="fa fa-amex"></span>
                                                                <span class="fa fa-mastercard"></span>
                                                                <span class="fa fa-discover"></span>
                                                            </span>
                                                        </a>
                                                    </p>
                                                    <div class="collapse show p-3 pt-0" id="collapseExample">
                                                        <div class="row">
                                                            <!-- <div class="col-lg-5 mb-lg-0 mb-3">
                                                                <p class="h4 mb-0">Summary</p>

                                                                <p class="mb-0"><span class="fw-bold">Product:</span><span class="c-green">: Name of
                                                                        product</span>
                                                                </p>
                                                                <p class="mb-0">
                                                                    <span class="fw-bold">Price:</span>
                                                                    <span class="c-green">:$452.90</span>
                                                                </p>
                                                                <p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque
                                                                    nihil neque
                                                                    quisquam aut
                                                                    repellendus, dicta vero? Animi dicta cupiditate, facilis provident quibusdam ab
                                                                    quis,
                                                                    iste harum ipsum hic, nemo qui!</p>
                                                            </div> -->
                                                            <div class="col-lg-12">
                                                                <div class="panel panel-default credit-card-box">
                                                                    <div class="panel-heading" >
                                                                        <div class="row">
                                                                            <h4>Payment Details</h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class="panel-body">
                                                                        <!-- @if (session()->has('success')) -->
                                                                        <div class="alert alert-success text-center">
                                                                            <p class="m-0">{{ session()->get('success') }}</p>
                                                                        </div>
                                                                        <!-- @endif -->
                                                                        <br>
                                                                        <form role="form" action="{{ route('page.deposit.stripe') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                                                                            @csrf
                                                                            <div class='form-row row'>
                                                                                <div class='col-xs-12 col-md-12 form-group required'>
                                                                                    <label class='control-label'>Amount</label>
                                                                                    <input class='form-control' id="deposit_amount" size='4' type='text'>
                                                                                </div>
                                                                                <div class='col-xs-12 col-md-6 form-group required'>
                                                                                    <label class='control-label'>Name on Card</label>
                                                                                    <input class='form-control' size='4' type='text'>
                                                                                </div>
                                                                                <div class='col-xs-12 col-md-6 form-group required'>
                                                                                    <label class='control-label'>Card Number</label>
                                                                                    <input autocomplete='off' class='form-control card-number' size='20' type='text'>
                                                                                </div>
                                                                            </div>
                                                                            <div class='form-row row'>
                                                                                <div class='col-xs-12 col-md-4 form-group cvc required'>
                                                                                    <label class='control-label'>CVC</label>
                                                                                    <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                                                                                </div>
                                                                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                                                    <label class='control-label'>Expiration date</label>
                                                                                    <!--<div class="exp-wrapper">
                                                                                        <input autocomplete="off" class="exp card-expiry-month" id="month" maxlength="2" pattern="[0-9]*" inputmode="numerical" placeholder="MM" type="text" data-pattern-validate />
                                                                                        <input autocomplete="off" class="exp card-expiry-year" id="year" maxlength="2" pattern="[0-9]*" inputmode="numerical" placeholder="YY" type="text" data-pattern-validate />
                                                                                    </div>-->
                                                                                    <input autocomplete="off" class="form-control card-expiry-month" id="month" maxlength="2" pattern="[0-9]*" inputmode="numerical" placeholder="MM" type="text" data-pattern-validate />
                                                                                    <input autocomplete="off" class="form-control card-expiry-year" id="year" maxlength="2" pattern="[0-9]*" inputmode="numerical" placeholder="YY" type="text" data-pattern-validate />
                                                                                </div>
                                                                                <!-- <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                                                       <label class='control-label'>Expiration Year</label>
                                                                                       <input class='form-control card-expiry-year' placeholder='YY' size='2' type='text'>
                                                                                </div> -->

                                                                            </div>
                                                                            <div class='form-row row'>
                                                                                <div class='col-md-12 error form-group hide mt-3'>
                                                                                    <div class='alert-danger alert'>Please correct the errors and try
                                                                                        again.
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-row row mt-3">
                                                                                <div class="col-xs-12">
                                                                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-withdraw" role="tabpanel" aria-labelledby="withdrawTab" tabindex="0">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="post-taskbx01">
                                    <div class="profile-viewbx1">
                                        <div class="container">
                                            <div class="row">
                                                <h3>Withdrawal</h3>
                                                <div class="p-0 post-taskbx01 pricing-income-mainbx1">
                                                    <div class="pricing-incomebx1 px-0">
                                                        <ul>
                                                            <li>
                                                                <p>Net Income</p>
                                                                <h4>$3,116.06</h4>
                                                            </li>
                                                            <li>
                                                                <p>Withdrawn</p>
                                                                <h4>$3,116.06</h4>
                                                            </li>
                                                            <li>
                                                                <p>Pending Clearance</p>
                                                                <h4>$300.00</h4>
                                                            </li>
                                                            <li>
                                                                <p>Available for Withdrawal</p>
                                                                <h4>$150.46</h4>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="table-price-mainbx1">
                                                        <div class="table-price-mainbx2 scroll01">
                                                            <div class="withdraw-btnbx01">
                                                                <ul>
                                                                    <li>Withdraw</li>
                                                                    <li class="paypal-btn"><a href="#">Paypal</a></li>
                                                                    <li><a href="#">Bank Transfer</a></li>
                                                                    <li class="payoneer-btn"><a href="#">Payoneer</a></li>
                                                                </ul>
                                                                <p>Get Statement of Earning</p>
                                                            </div>
                                                            <div class="payment-table-bx1">
                                                                <ul>
                                                                    <li>
                                                                        <form>
                                                                            <div class="form-inputrow">
                                                                                <div class="form-group formspace01">
                                                                                    <select class="form-select">
                                                                                        <option>Everything</option>
                                                                                        <option>Option 1</option>
                                                                                        <option>Option 2</option>
                                                                                        <option>Option 3</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group formspace01">
                                                                                    <div class="form-group">
                                                                                        <select class="form-select">
                                                                                            <option>2022</option>
                                                                                            <option>Option 1</option>
                                                                                            <option>Option 2</option>
                                                                                            <option>Option 3</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group formspace01">
                                                                                    <div class="form-group">
                                                                                        <select class="form-select">
                                                                                            <option>All months</option>
                                                                                            <option>Option 1</option>
                                                                                            <option>Option 2</option>
                                                                                            <option>Option 3</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </li>
                                                                    <li class="second-libx1">
                                                                        <div class="price-tblebx11">
                                                                            <p class="datebx1">Date</p>
                                                                            <p class="forbx">For</p>
                                                                            <p class="amountbx">Amount</p>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="price-tblebx11">
                                                                            <p class="datebx1">Sep 22, 22</p>
                                                                            <p class="forbx">Order Revenue</p>
                                                                            <p class="amountbx">$70.56</p>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="price-tblebx11">
                                                                            <p class="datebx1">Sep 22, 22</p>
                                                                            <p class="forbx">Funds Cleared</p>
                                                                            <p class="amountbx red-amount">-$70.56</p>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="price-tblebx11">
                                                                            <p class="datebx1">Sep 22, 22</p>
                                                                            <p class="forbx">Withdrawal Completed Successfully</p>
                                                                            <p class="amountbx">$70.56</p>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="price-tblebx11">
                                                                            <p class="datebx1">Sep 22, 22</p>
                                                                            <p class="forbx">Order Revenue</p>
                                                                            <p class="amountbx">$70.56</p>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="price-tblebx11">
                                                                            <p class="datebx1">Sep 22, 22</p>
                                                                            <p class="forbx">Funds Cleared</p>
                                                                            <p class="amountbx red-amount">-$70.56</p>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="price-tblebx11">
                                                                            <p class="datebx1">Sep 22, 22</p>
                                                                            <p class="forbx">Withdrawal Completed Successfully</p>
                                                                            <p class="amountbx">$70.56</p>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="https://js.stripe.com/v1/"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            console.log('DOMContentLoaded');
            // Check if there's a hash fragment in the URL
            if (window.location.hash) {
                console.log('inn hash');
                const hash = window.location.hash.substring(1); // Remove the '#' character
                const tab = document.querySelector(`#${hash}Tab`);
                if (tab) {
                    $('.bankAccount').removeClass('active');
                    $('.tab-pane').removeClass('show active');
                    tab.classList.add('active'); // Ensure the tab button is marked as active
                    const tabContent = document.querySelector(tab.getAttribute('data-bs-target'));
                    if (tabContent) {
                        tabContent.classList.add('show', 'active'); // Show and mark as active the corresponding tab content
                    }
                }
            }
        });

        $(document).ready(function() {
            /*Connect Bank Account Validation*/
            $("#connectBankForm").validate({
                rules: {
                    business_type: {
                        required: true
                    },
                    first_name: {
                        required: true
                    },
                    last_name: {
                        required: true
                    },
                    bank_country: {
                        required: true
                    },
                    address:{
                        required: true
                    },
                    city:{
                        required: true
                    },
                    zip_code:{
                        required: true
                    },
                    state:{
                        required: true
                    },
                    bank_holder_name:{
                        required: true
                    }
                },
                messages: {
                    business_type: {
                        required: "The business type field is required.",
                    },
                    first_name: {
                        required: "The first name field is required.",
                    },
                    last_name: {
                        required: "This last name field is required.",
                    },
                    bank_country: {
                        required: "This back country field is required.",
                    },
                    address: {
                        required: "This address field is required.",
                    },
                    city: {
                        required: "This city field is required.",
                    },
                    zip_code: {
                        required: "This zip code field is required.",
                    },
                    state: {
                        required: "This state field is required.",
                    },
                    bank_holder_name: {
                        required: "This bank holder name field is required.",
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.attr("type") == "radio") {
                        $('#error-business_type').html(error);
                    } else if(element.is('select')){
                        $('#error-bank_country').html(error);
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: "{{ route('stripe.store.connectBankAccount') }}",
                        type: 'POST',
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status == 1) {
                                toastr.success(response.message, 'Success');
                                window.location.reload();
                            } else if (response.status == 2){
                                var errors = response.errors;
                                var i =1;
                                $.each(errors, function(key, value) {
                                    $('#error-' + key).text(value[0]);
                                    if(i==1){
                                        $('input[name="'+key+'"]').focus();
                                    }
                                    i++;
                                });
                            } else {
                                toastr.error(response.message, 'Error');
                            }
                        }
                    });
                }
            });
        });

        $('#bankCountry').on('change', function(){
            var bankId = $(this).val();
            $.ajax({
                url: "{{ route('stripe.getBankRequiredDetails') }}",
                type: 'POST',
                data: {bankId:bankId},
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    $('#dynamicFields').html(response.inputFields);
                    setJqueryValidation();
                }
            });
        });

        function setJqueryValidation(){
            var min0 = $('#bankDetail_0').attr('minlength');
            var max0 = $('#bankDetail_0').attr('maxlength');
            var field0 = $('#bankDetail_0').attr('data-name');

            var min1 = $('#bankDetail_1').attr('minlength');
            var max1 = $('#bankDetail_1').attr('maxlength');
            var field1 = $('#bankDetail_1').attr('data-name');

            $('#bankDetail_0').rules('add', {
                required: true,
                minlength: min0,
                maxlength: max0,
                messages: {
                    required: "This "+field0+" field is required.",
                    /*minlength: "This "+field0+" field at least "+min0+' character',
                    maxlength: "This "+field0+" field at most "+max0+' character ',*/
                }
            });

            $('#bankDetail_1').rules('add', {
                required: true,
                minlength: min1,
                maxlength: max1,
                messages: {
                    required: "This "+field1+" field is required.",
                    /*minlength: "This "+field1+" field at least "+min1+' character',
                    maxlength: "This "+field1+" field at most "+max1+' character ',*/
                }
            });
        }

        const monthInput = document.querySelector('#month');
        const yearInput = document.querySelector('#year');

        const focusSibling = function(target, direction, callback) {
            const nextTarget = target[direction];
            nextTarget && nextTarget.focus();
            // if callback is supplied we return the sibling target which has focus
            callback && callback(nextTarget);
        }

        // input event only fires if there is space in the input for entry.
        // If an input of x length has x characters, keyboard press will not fire this input event.
        monthInput.addEventListener('input', (event) => {

            const value = event.target.value.toString();
            // adds 0 to month user input like 9 -> 09
            if (value.length === 1 && value > 1) {
                event.target.value = "0" + value;
            }
            // bounds
            if (value === "00") {
                event.target.value = "01";
            } else if (value > 12) {
                event.target.value = "12";
            }
            // if we have a filled input we jump to the year input
            2 <= event.target.value.length && focusSibling(event.target, "nextElementSibling");
            event.stopImmediatePropagation();
        });

        yearInput.addEventListener('keydown', (event) => {
            // if the year is empty jump to the month input
            if (event.key === "Backspace" && event.target.selectionStart === 0) {
                focusSibling(event.target, "previousElementSibling");
                event.stopImmediatePropagation();
            }
        });

        const inputMatchesPattern = function(e) {
            const {
                value,
                selectionStart,
                selectionEnd,
                pattern
            } = e.target;

            const character = String.fromCharCode(e.which);
            const proposedEntry = value.slice(0, selectionStart) + character + value.slice(selectionEnd);
            const match = proposedEntry.match(pattern);

            return e.metaKey || // cmd/ctrl
                e.which <= 0 || // arrow keys
                e.which == 8 || // delete key
                match && match["0"] === match.input; // pattern regex isMatch - workaround for passing [0-9]* into RegExp
        };

        document.querySelectorAll('input[data-pattern-validate]').forEach(el => el.addEventListener('keypress', e => {
            if (!inputMatchesPattern(e)) {
                return e.preventDefault();
            }
        }));

        $(function() {
            var $form = $(".require-validation");

            $('form.require-validation').bind('submit', function(e) {
                console.log("stripe");
                e.preventDefault();
                var $form = $(".require-validation");
                inputSelector = ['input[type=email]', 'input[type=password]', 'input[type=text]', 'input[type=file]', 'textarea'].join(', ');
                $inputs = $form.find('.required').find(inputSelector);
                $errorMessage = $form.find('div.error');
                valid = true;
                $errorMessage.addClass('hide');
                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                });
                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    console.log($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: "20"+$('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }
            });

            function stripeResponseHandler(status, response) {
                var amount = $('#deposit_amount').val();
                console.log(amount);
                console.log(!isNaN(parseFloat(amount)));
                if (!isNaN(parseFloat(amount))) {
                    if (response.error ) {
                        $('.error')
                            .removeClass('hide')
                            .find('.alert')
                            .text(response.error.message);
                    } else {
                        /* token contains id, last4, and card type */
                        var token = response['id'];
                        $form.find('input[type=text]').empty();
                        $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                        $form.append("<input type='hidden' name='deposit_amount' value='" + amount + "'/>");
                        console.log($form.get(0));

                        //$form.get(0).submit();

                        $.ajax({
                            url: "{{ route('page.deposit.stripe') }}",
                            type: 'POST',
                            data: $('#payment-form').serialize(),
                            success: function(response) {
                                if (response.status == 1) {
                                    $('#payment-form')[0].reset();
                                    toastr.success(response.message,'Success');
                                }else {
                                    toastr.error(response.message,'Error');
                                }
                            }
                        });
                    }
                } else {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                }

            }
        });

        $('#verifyAccount').on('click', function(){
            $.ajax({
                url: "{{ route('stripe.linkGenerate') }}",
                type: 'POST',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    console.log(response);
                    if(response.status == 1){
                        window.location.href = response.url;
                    }else{
                        toastr.error(response.message, 'Error');
                    }
                }
            });
        });
    </script>
@endsection
