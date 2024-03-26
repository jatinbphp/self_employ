<div class="modal fade" id="readPortfolio" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-read-portfolio-container">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <div class="row w-100">
                    <div class="col-12 col-md-7">
                        <div class="form-bx001 form-bx-read-portfolio">
                            <a href="" id="portfolio_name_link"> <h1 id="portfolio_name">Read Portfolio</h1></a>
                            
                            <div id="slider_container">
                                <div class="slider" id="slider_portfolio" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "autoplay": false}'>
                             
                                </div>
                            </div>
                            
                            <div id="portfolio_action_form" style="display: none;">
                                <form action="{{ route('portfolio.approve') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="portfolio_id" id="portfolio_approve" value="">
                                    <div class="form-group sibmit-btn01">
                                        <input type="submit" class="subt-btn1"  value="Approve">
                                    </div>
                                </form>
                                <form action="{{ route('portfolio.reject') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="portfolio_id" id="portfolio_reject" value="">
                                    <div class="form-group sibmit-btn01">
                                        <input type="submit" class="subt-btn1-reject" value="Reject">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="mt-2">
                            <h4 class="text-primary-custom">About the Project</h4>
                            <p id="portfolio_description"></p>
                        </div>
                        <h4 class="text-primary-custom mt-2">Skills</h4>
                        <div id="read-portfolio-skill-container">
                            
                            
                        </div>
                    </div>

                </div>
                

                
            </div>
        </div>
    </div>
</div>

