@extends('frontend.layouts.app')

@section('content')
    <div class="main-content-bx01 bg-colorbx">
        <div class="container">
            <div class="row mobile-rowbx1">
                <div class="post-task-title pricing-income-titlebx">
                    <h3>Support</h3>
                </div>
                <div class="post-taskbx01 pricing-income-mainbx1">
                    <div class="support-searchbx1">
                        <h2>What do you need help with?</h2>
                        <div class="support-searchformbx1">
                            <form>
                                <div class="row height d-flex justify-content-center align-items-center">
                                    <div class="col-md-8">
                                        <div class="search">
                                            <i class="fa fa-search"></i>
                                            <input type="text" class="form-control" id="searchFaqs" name="search_faq" placeholder="Search FAQs">
                                            <button type="button" id="searchBtn" class="btn btn-primary">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="recommended-bx1 mt-4">
                        <div id="faqList">
                            @include('frontend.pages.support_list')
                        </div>

                        <h4 class="mt-3">Recommended for you</h4>
                        <div class="recommended-linkbx1">
                            <ul>
                                <li><a href="#">How SelfEmploy Works</a></li>
                                <li><a href="#">General Account Management</a></li>
                                <li><a href="#">Withdrawal methods</a></li>
                                <li><a href="#">Find a Service & Get a Quote</a></li>
                                <li><a href="#">Payment Issues</a></li>
                                <li><a href="#">Invoices</a></li>
                            </ul>
                            <ul>
                                <li><a href="#">Account & Security</a></li>
                                <li><a href="#">FAQ’s</a></li>
                                <li><a href="#">Create an Account</a></li>
                                <li><a href="#">Categories</a></li>
                                <li><a href="#">Transaction History</a></li>
                                <li><a href="#">Earnings</a></li>
                            </ul>
                        </div>
                        <div class="ned-helpbx1">
                            <div class="need-txtbx1">
                                <h3>Still need help?</h3>
                                <p>We’re here for you.</p>
                                <a href="#">Contact Support</a>
                            </div>
                            <div class="need-img">
                                <img src="{{ asset('assets/images/undraw-img.png') }}">
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
        $('#searchBtn').on('click', function(){
            var search = $('#searchFaqs').val();
            $.ajax({
                url: '{{route('page.searchSupports')}}',
                method: 'POST',
                data: {search:search},
                success: function(response) {
                    $('#faqList').html(response.content);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
    </script>
@endsection
