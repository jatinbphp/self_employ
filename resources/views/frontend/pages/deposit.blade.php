@extends('frontend.layouts.app')

@section('content')
	<div class="container">
        <div class="row">
            <div class="col-12 mt-4">
                <div class="card p-3">
                    <p class="mb-0 fw-bold h4">Payment Methods</p>
                </div>
            </div>
            <div class="col-12">
                <div class="card p-3">
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
                            <div class="row">
                                <div class="col-8">
                                    <p class="h4 mb-0">Summary</p>
                                    <form action="" class="form">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form__div">
                                                    <input type="text" class="form-control-custom" placeholder="Amount">
                                                    <!-- <label for="" class="form__label">Card Number</label> -->
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="btn btn-primary w-100">Sumbit</div>
                                            </div>
                                        </div>
                                    </form>
                                    <p class="mb-0"><span class="fw-bold">Product:</span><span class="c-green">: Name of
                                            product</span></p>
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
                        </div>
                    </div>
                    <div class="card-body border p-0">
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
						                              	<div class="exp-wrapper">
														  	<input autocomplete="off" class="exp card-expiry-month" id="month" maxlength="2" pattern="[0-9]*" inputmode="numerical" placeholder="MM" type="text" data-pattern-validate />
														  	<input autocomplete="off" class="exp card-expiry-year" id="year" maxlength="2" pattern="[0-9]*" inputmode="numerical" placeholder="YY" type="text" data-pattern-validate />
														</div>
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
            </div>
           <!--  <div class="col-12">
                <div class="btn btn-primary payment">
                    Make Payment
                </div>
            </div> -->
        </div>
    </div>



@endsection

@section('script')

<script type="text/javascript" src="https://js.stripe.com/v1/"></script>
<script type="text/javascript">
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

		          	$form.get(0).submit();
		      	}
	  		} else {
	  			$('.error')
	              	.removeClass('hide')
	              	.find('.alert')
	              	.text(response.error.message);
	  		}

	  	}
	});
</script>

@endSection
