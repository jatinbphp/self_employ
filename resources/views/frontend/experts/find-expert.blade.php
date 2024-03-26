@extends('frontend.layouts.app')

@section('content')
<div class="main-content-bx01 bg-colorbx">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="form-serch-bx2">
                    <h2>Find & Hire Expert Freelancer</h2>
                    <p>Forget the old rules. You can have the best people. Right now. Right here.</p>
                    <div class="input-group mb-3">
                        <div class="search-bx1">
                            <input type="text" class="form-control form-control-lg" placeholder="Search for Project">
                            <button type="submit" class="input-group-text btn-success"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <div class="find-job-navbx01">
                        <ul>
                            <li><a href="#">graphic designer</a></li>
                            <li><a href="#">web development</a></li>
                            <li><a href="#">Virtual Assistant</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="filter-result-bx01 filter-result-bx02">
                    <div class="filter-resultsbx02">
                        <div class="job-img"><img src="{{asset('assets/images/rectangle.png')}}"></div>
                        <div class="job-description">
                            <div class="hours-bx1">
                                <h3>Need ASP.net Project</h3>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500ss,</p>
                                <div class="info-detail-menubx02">
                                    <ul>
                                        <li><a href="#">design</a></li>
                                        <li><a href="#">frontend developer</a></li>
                                        <li><a href="#">magang</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="job-rp-bx02">
                            <h3>$99</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="pagination-bx1">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left" aria-hidden="true"></i>
                                </a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">...</li>
                            <li class="page-item"><a class="page-link" href="#">10</a></li>
                            <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>
                                </a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection