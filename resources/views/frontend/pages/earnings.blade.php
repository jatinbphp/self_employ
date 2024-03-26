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
@endsection
