@extends('frontend.layouts.app')

@section('content')
    <div class="main-content-bx01 bg-colorbx">
        <div class="container">
            <div class="row">
                <div class="post-task-title pricing-income-titlebx">
                    <h3>Connect Bank Account With Stripe</h3>
                </div>
                <div class="post-taskbx01 pricing-income-mainbx1">
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
                    <div class="table-price-mainbx1">
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
                                    <button type="submit" class="btn btn-primary" id="connectBankBtn" name="update" value="update">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="https://js.stripe.com/v1/"></script>
    <script>
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
                    //$('#connectBankForm :input').prop('disabled', true);
                    $('#connectBankBtn').html('Please Wait...');
                    $('#connectBankBtn').prop('disabled', true);

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
