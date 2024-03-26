    <!-- Modal -->
    <div class="modal fade" id="addPortfolio" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog madeoferopup">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5> -->
                    <button type="button" id="btn_close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-bx001">
                        <h1>Add Portfolio</h1>
                        <form action="{{ route('portfolio.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <p>What is your best project for portfolio?</p>
                            <input class="form-control mb-3" type="text" name="name" value="" placeholder="Please input title">
                            <textarea class="form-control mb-3" name="description" rows="5" id="description" placeholder="Write description here......"></textarea>
                            <select class="form-control mb-3" name="project_id">
                            	@foreach($projects as $project)
                            		<option value="{{$project->id}}">{{$project->getJobPost->name}}</option>
                            	@endforeach
                            </select>
                            <div class="form-group">
                                <div class="form-inputrow2">
                                    <div class="image-uploadfile" style="width: 100%;">
                                        <label for="portfolio_img">
                                        <img src="{{ asset('assets/images/upload-ow.png') }}">
                                        <p>Click to upload
                                            <br>
                                            <span>Maximum file size 10MB</span>
                                        </p>

                                        </label>
                                        <input type="file" name="images[]" id="portfolio_img"
                                            class="select-file-image {{ $errors->has('images[]') ? 'is-invalid' : '' }}"
                                            style="display: none;visibility: none;" multiple>
                                            <div class="preview-images-zone d-flex align-items-center justify-content-center"></div>
                                        	@error('images[]')
	                                            <div class="invalid-feedback">
	                                                {{ $message }}
	                                            </div>
                                        	@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group sibmit-btn01">
                                <input type="submit" class="subt-btn1"  value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    