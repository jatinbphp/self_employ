@extends('frontend.layouts.app')

@section('content')
    <div class="main-content-bx01 bg-colorbx">
        <div class="container">
            <div class="row">
                <div class="post-task-title pricing-income-titlebx">
                    <h3>Earnings</h3>
                </div>
                <div class="post-taskbx01 pricing-income-mainbx1">
                    <div class="pricing-incomebx1">
                        <ul>
                            <li>
                                <p>Net Income</p>
                                <h4>${{number_format($user['balance'],2)}}</h4>
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
                                <form id="withdrawForm" enctype="multipart/form-data">
                                    <div class="row mt-3">
                                        <h4>Withdraw</h4>
                                        <div class="col-md-6">
                                            <input type="number" step="0.1" name="amount" class="form-control" id="withdrawAmt">
                                        </div>
                                        <div class="col-md-2">
                                            <div class="submit-btnbx0">
                                                <button type="submit" class="btn btn-primary" value="Withdraw">Withdraw</button>
                                            </div>
                                        </div>
                                        <div class="col-md-12 ">
                                            <p>Get Statement of Earning</p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="payment-table-bx1">
                                <ul>
                                    <li>
                                        <form>
                                            <div class="form-inputrow">
                                                <div class="form-group formspace01">
                                                    <select class="form-select filter-select" id="payment_type_filter">
                                                        <option value="all">Everything</option>
                                                        <option value="credit">Credited</option>
                                                        <option value="debit">Debited</option>
                                                    </select>
                                                </div>
                                                <div class="form-group formspace01">
                                                    <div class="form-group">
                                                        @php
                                                            $currentYear = \Carbon\Carbon::now()->year;
                                                        @endphp
                                                        <select class="form-select filter-select" id="year_filter">
                                                            @if(!empty($firstTransactionYear))
                                                                @for ($year = $currentYear; $year >= $firstTransactionYear; $year--)
                                                                    <option value="{{$year}}">{{ $year }}</option>
                                                                @endfor
                                                            @else
                                                                <option value="{{$currentYear}}">{{ $currentYear }}</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group formspace01">
                                                    <div class="form-group">
                                                        <select class="form-select filter-select" id="month_filter">
                                                            <option value="all">All months</option>
                                                            @php
                                                                $months = [
                                                                    'January' => 1,
                                                                    'February' => 2,
                                                                    'March' => 3,
                                                                    'April' => 4,
                                                                    'May' => 5,
                                                                    'June' => 6,
                                                                    'July' => 7,
                                                                    'August' => 8,
                                                                    'September' => 9,
                                                                    'October' => 10,
                                                                    'November' => 11,
                                                                    'December' => 12,
                                                                ];
                                                            @endphp
                                                            @foreach ($months as $name => $value)
                                                                <option value="{{ $value }}">{{ $name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </li>
                                    <div id="transactionData">
                                        @include('frontend.stripe.transactions')
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $("#withdrawForm").validate({
                rules: {
                    amount: {
                        required: true
                    }
                },
                messages: {
                    amount: {
                        required: "The amount field is required.",
                    }
                },
                submitHandler: function(form) {
                    $('.mLoader').css('display', 'flex');

                    $.ajax({
                        url: "{{ route('stripe.payout') }}",
                        type: 'POST',
                        data: $(form).serialize(),
                        success: function(response) {
                            $('.mLoader').css('display', 'none');
                            
                            if (response.status == 1) {
                                $('#payment-form')[0].reset();
                                $('.userBalanceMenu').html('<b>$'+response.main_balance+' USD</b>');
                                $('.userBalance').html('$'+response.main_balance+' USD');
                                toastr.success(response.message,'Success');
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
                                toastr.error(response.message,'Error');
                            }
                        }
                    });
                }
            });
        });

        $('.filter-select').on('change', function () {
            var paymentType = $('#payment_type_filter').val();
            var year = $('#year_filter').val();
            var month = $('#month_filter').val();

            $.ajax({
                url: "{{ route('stripe.filterTransactions') }}",
                type: 'POST',
                data: {paymentType : paymentType, year : year, month : month},
                success: function(response) {
                    if (response.status == 1) {
                        $('#transactionData').html(response.renderTransactions);
                    }
                }
            });
        });
    </script>
@endsection
