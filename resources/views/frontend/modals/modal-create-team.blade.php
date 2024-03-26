    <!-- Modal -->
    <div class="modal fade" id="createTeam" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog madeoferopup">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5> -->
                    <button type="button" id="btn_close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-bx001">
                        <h1>Create Your Team</h1>
                        <form action="{{ route('team.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <input class="form-control mb-3" type="text" name="name" value="" placeholder="Please input team name">
                            
                            <!-- <div class="form-group">
                                <div class="form-inputrow2">
                                    <div class="image-uploadfile" style="width: 100%;">
                                        <label for="first-img1">
                                        <img src="{{ asset('assets/images/upload-ow.png') }}">
                                        <p>Click to upload Your Team Logo
                                            <br>
                                            <span>Maximum file size 10MB</span>
                                        </p>d

                                        </label>
                                        <input type="file" name="images[]" id="first-img1"
                                            class="select-file-image {{ $errors->has('images[]') ? 'is-invalid' : '' }}"
                                            style="display: none;visibility: none;" >
                                            <div class="preview-images-zone d-flex align-items-center justify-content-center"></div>
                                        	@error('images[]')
	                                            <div class="invalid-feedback">
	                                                {{ $message }}
	                                            </div>
                                        	@enderror
                                    </div>
                                </div>
                            </div> -->
                            <div class="form-group sibmit-btn01">
                                <input type="submit" class="subt-btn1" id="formControlRange" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
