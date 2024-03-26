@extends('frontend.layouts.app')

@section('content')

    <div class="main-content-bx01" style="padding-bottom: 80px;">
	<div class="container">
		<div class="portfolio-bx01">
			<div class="btn-bx01">
                @if (auth()->user()->id == $user->id)
	                <ul style="justify-content: end;">
	                    <li class="orang-btnbx text-white">
	                        <a data-bs-toggle="modal" data-bs-target="#{{ !auth()->user() ? 'LoginModaldrop' : 'addPortfolio' }}"
	                            ><em>+</em> Add Portfolio</a>
	                    </li>
	                </ul>
                @endif
            </div>
			<div class="row">
				@foreach ($portfolios as $portfolio)
					@if ($portfolio->status == "approve")
						<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 portfolio-column01">
							<div class="portfolio-colbx01">
								<h3>{{$portfolio->name}}</h3>
								<div class="position-relative">
									<div class="portfolio-img01">
										@if (count($portfolio->getPortfolioImages) > 0)
											<img src="{{ $portfolio->getPortfolioImages[0]->portfolio_images}}">
										@else
											<img src="{{ asset('assets/images/default-image.png') }}">
										@endif
									</div>
									<div class="portfolio-hover-content">
										<div class="text-center">
											<div class="portfolio-count">
											{{count($portfolio->getPortfolioImages)}}
											</div>
											<a 
												class="btn-read-more" 
												data-bs-toggle="modal" 
												data-bs-target="#readPortfolio" 
												data-name="{{$portfolio->name}}"
												data-description="{{$portfolio->description}}"
												data-image="{{$portfolio->getPortfolioImages}}"
												data-user="{{$user->id}}"
												data-client="{{$portfolio->getProjectId->getJobPost->user_id}}"
												data-status="{{$portfolio->status}}"
												data-id="{{$portfolio->id}}"
		                            		>
				                            	Read more
				                            </a>
										</div>
										
									</div>
								</div>
								
								<!-- <div class="review-starbx">
									<h4>Employer Review</h4>
									<div class="ratings">
					                	<i class="fa fa-star rating-color"></i>
					                	<i class="fa fa-star rating-color"></i>
					                	<i class="fa fa-star rating-color"></i>
					                	<i class="fa fa-star rating-color"></i>
					                	<i class="fa fa-star"></i>
					            	</div>
								</div> -->
								<div class="portfolio-contentbx01">
									<p>{{$portfolio->description}}</p>
									<!-- <a href="#">read more</a> -->
								</div>
							</div>
						</div>
					@endif
				@endforeach
			</div>
			<div class="row">
				@php
					$i=0;
				@endphp
				@foreach ($portfolios as $portfolio) 
					@if ($portfolio->status == "pending")
						@if ($portfolio->getProjectId->getJobPost->user_id == auth()->user()->id || auth()->user()->id == $user->id)
							@if ($i == 0)
								<h4 class="text-section-portfolio">Pending</h4>
								@php
									$i++;
								@endphp
							@endif
							<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 portfolio-column01">
								<div class="portfolio-colbx01">
									<h3 class="text-header-portfolio">{{$portfolio->name}}</h3>
									<div class="position-relative">
										<div class="portfolio-img01">
											@if (count($portfolio->getPortfolioImages) > 0)
												<img src="{{ $portfolio->getPortfolioImages[0]->portfolio_images}}">
											@else
												<img src="{{ asset('assets/images/default-image.png') }}">
											@endif
										</div>
										<div class="portfolio-hover-content">
											<div class="text-center">
												<div class="portfolio-count">
													{{count($portfolio->getPortfolioImages)}}
												</div>
												<a 
													class="btn-read-more" 
													data-bs-toggle="modal" 
													data-bs-target="#readPortfolio" 
													data-name="{{$portfolio->name}}"
													data-description="{{$portfolio->description}}"
													data-image="{{$portfolio->getPortfolioImages}}"
													data-user="{{$user->id}}"
													data-client="{{$portfolio->getProjectId->getJobPost->user_id}}"
													data-post-link="{{getenv('APP_URL').'projects/'.$portfolio->getProjectId->getJobPost->id}}"
													data-skill="{{$portfolio->getProjectId->getJobPost->getPostSkills}}"
													data-status="{{$portfolio->status}}"
													data-id="{{$portfolio->id}}"
			                            		>
					                            	Read more
					                            </a>
											</div>
											
										</div>
									</div>
									<div class="portfolio-contentbx01">
										<p>{{$portfolio->description}}</p>
									</div>
								</div>
							</div>
						@endif
					@endif
				@endforeach
				
			</div>
		</div>
	</div>
</div>

@include('frontend.modals.modal-login')
@include('frontend.modals.modal-add-portfolio')
@include('frontend.modals.modal-read-portfolio')

@endsection
@section('script')
    <script>
    	const dt = new DataTransfer();
		$('input[type="file"][name="images[]"]').on('change', function() {
    		console.log("file changeing");
	        var previewImagesZone = $('.preview-images-zone');

	        // Clear preview zone
	        previewImagesZone.empty();
	        for (let file of this.files) {
	            dt.items.add(file);
	        }
	        // Mise à jour des fichiers de l'input file après ajout
	        this.files = dt.files;
	        var files = $(this).get(0).files;

	        // Loop through selected files and display them
	        for (let i = 0; i < files.length; i++) {
	            var file = files[i];
	            var reader = new FileReader();

	            reader.onload = function(e) {
	                var img_container = $('<div class="select-img-box py-3 px-3">');
	                var img = $('<img class="img-fluid" width="150px" height="150px">').attr('src', e.target.result);
	                var hover_container = $('<div class="hover-delete-container">').attr('data-file-id', i);
	                hover_container.html('<i class="fa fa-times select-img-icon"></i>')
	                img.appendTo(img_container);
	                hover_container.appendTo(img_container);
	                img_container.appendTo(previewImagesZone);
	            }
	            reader.readAsDataURL(file);
		    }

		    $(document).unbind().on('click', '.hover-delete-container',  function(e) {
		        e.preventDefault();
		        e.stopPropagation();
		        var delete_id = $(this).data('file-id')
		        var input = $('.select-file-image')
		        var files = input.get(0).files;
		        console.log(dt.files);
		        
		        for (let i = 0; i < files.length; i++) {
		            console.log("sdfsdfsdfsd");
		            if (delete_id == i) {
		                console.log("deleted_id", delete_id);
		                dt.items.remove(i);
		                delete_id = null;
		            }
		        }
		        input.get(0).files = dt.files
		        reRenderPreview();
		    });

		    function reRenderPreview() {
		        var previewImagesZone = $('.preview-images-zone');
		        previewImagesZone.empty();
		        var files = $('.select-file-image').get(0).files;

		        for (let i = 0; i < files.length; i++) {
		            var file = files[i];
		            var reader = new FileReader();

		            reader.onload = function(e) {
		                var img_container = $('<div class="select-img-box py-3 px-3">');
		                var img = $('<img class="img-fluid" width="150px" height="150px">').attr('src', e.target.result);
		                var hover_container = $('<div class="hover-delete-container">').attr('data-file-id', i);
		                hover_container.html('<i class="fa fa-times select-img-icon"></i>')
		                img.appendTo(img_container);
		                hover_container.appendTo(img_container);
		                img_container.appendTo(previewImagesZone);
		            }
		            reader.readAsDataURL(file);
		        }
		    }
	    });

	    $('.btn-read-more').on('click', function() {
	    	$("#slider_container").empty();
	    	var slide_element = $('<div id="slider_portfolio"></div>')
	    	$("#slider_container").append(slide_element);
	    	var name = $(this).data('name');
	    	var description = $(this).data('description');
	    	var images = $(this).data('image');
	    	var client_id = $(this).data('client');
	    	var portfolio_id = $(this).data('id');
	    	var status = $(this).data('status');
	    	var skill = $(this).data('skill');
	    	var postLink = $(this).data('post-link');
	    	console.log(postLink);

	    	$("#read-portfolio-skill-container").empty();
	    	$('#portfolio_name_link').attr('href', postLink);

	    	skill.forEach((item)=>{
	    		var skillSpan = $('<span class="read-portfolio-skill-span"></span>')
	    		skillSpan.text(item.get_s_kills.name);
	    		console.log(item.get_s_kills.name);
	    		console.log(skillSpan);
	    		$("#read-portfolio-skill-container").append(skillSpan)
	    		
	    	})

	    	$('#portfolio_name').text(name);
	    	$('#portfolio_description').text(description);

	    	for (var i = 0; i < images.length; i++) {
	    		var html_str = '<div class="project-slide0' + '" ><img src="' + images[i].portfolio_images + '" style="margin:auto; width:100%"></div>';
	    		slide_element.append($(html_str));
	    	}

	    	$("#slider_portfolio").slick({
	    		fade: true,
  				cssEase: 'linear',
	    		dots: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode:true,
                arrow: true,
                autoplay: false,
                autoplaySpeed: 2000,
                prevArrow:"<button type='button' class='slick-prev pull-left'><i class='fa fa-angle-left' style='font-size:40px; color:black' aria-hidden='true'></i></button>",
            	nextArrow:"<button type='button' class='slick-next pull-right'><i class='fa fa-angle-right' style='font-size:40px; color:black' aria-hidden='true'></i></button>",
                responsive: [
	                {
	                  	breakpoint:576,
	                  	settings: {
		                    slidesToShow: 1,
		                    slidesToScroll: 1,
	                  	}
	                }	
                ]
            });

            $('.slick-track').css('width', '100%');
            $('.slick-slide').css('width', '490px');
            var user_id = JSON.parse("{{ json_encode(auth()->user()->id) }}");
            console.log(user_id)
            if (client_id == user_id && status =="pending") {
            	$('#portfolio_action_form').css('display', 'flex')
            	$('#portfolio_approve').val(portfolio_id);
            	$('#portfolio_reject').val(portfolio_id);
            } else {
            	$('#portfolio_action_form').css('display', 'none')
            }
	    });
    </script>
@endsection
