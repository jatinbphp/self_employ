@extends('frontend.layouts.app')

@section('content')
    <div class="main-content-bx01 bg-colorbx">
        <div class="container">
            <div class="row">
                <div class="post-task-title">
                    <h3>Dispute</h3>
                </div>
                <div class="post-taskbx01 request-disputebx01">
                    <div class="disputebx-left">
                        <h3>Project Name: <b>WordPress Page Upgrade</b></h3>
                        <p>Dispute: Mark George Vs Clinton Henry</p>
                        <p>Category: Employer Won't Release Funds</p>
                        <br>
                        <p class="negotiation">Negotiation :</p>
                        <div class="negotiation-bx1">
                            <div class="nego-img"><img src="images/disput-img.png"></div>
                            <div class="nego-text-bx1">
                                <h6>Clinton Henry</h6>
                                <i>April 02, 2022 at 19:55 PKT</i>
                                <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                                    dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                                    mollit anim id est laborum."</p>
                            </div>
                        </div>
                        <div class="dispute-formbx1">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Write Message here..."></textarea>
                            <div class="dispute-form-submit-btn">
                                <div class="file-uploadbx">
                                    <label for="first-img2"><em>Attach a file</em> <i>Up to 25 MB</i></label>
                                    <input type="file" name="" id="first-img2"
                                        style="display: none;visibility: none;">
                                </div>
                                <button type="submit" class="btn btn-primary mb-3">submit</button>
                            </div>
                        </div>
                    </div>
                    <div class="disputebx-right">
                        <div class="disput-amoutbx">
                            <p>Total Amount Disputed: <b>$35</b> </p>
                            <div class="disput-amoutbx01">
                                <div class="disput-amoutleft">
                                    <p>Freelancer(You) want to recieve:</p> <b>$35</b>
                                </div>
                                <div class="disput-amoutright">
                                    <p>Employer (clinton) wants to pay:</p> <b>$35</b>
                                </div>
                            </div>
                            <p class="disput-result1">Result: <b>$35</b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
