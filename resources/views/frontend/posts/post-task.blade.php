@extends('frontend.layouts.app')
@section('content')
    @section('style')
        <style>
            .pointer {cursor: pointer}
        </style>
    @endsection
    <div class="main-content-bx01 bg-colorbx">
        <div class="container">
            <div class="row">
                <div class="post-task-title">
                    <h1>Post a task</h1>
                </div>
                <div class="post-taskbx01">
                    <div class="form-spacebx1">
                        <h2>Let's start with the basics</h2>
                        <!-- @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach -->

                        <form method="post" action="{{ route('posts.store') }}" id="post_task" enctype="multipart/form-data">
                            @csrf
                            <p>Title</p>
                            <div class="form-group required-fieldbx row">
                                <div class="col-md-9">
                                    <input type="text" name="name" value="{{ old('name') }}"
                                           class="form-control form-control-lg {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                           placeholder="e.g Help move my home furnititure" id="job_post_title">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <button type="button" id="auto_writing_button" class="btn btn-primary mt-sm-2 mt-md-0" onclick="getQuestions()">
                                        <i class="fa fa-edit"></i> Write
                                    </button>
                                </div>
                            </div>

                            <!--CHAT GPT CONTENT START-->
                            <div id="job_post_question0_container" class="row accordion  mb-3" style="display: none;">
                                <div class="accordion-item">
                                    <p id="job_post_question0_label" class="mt-3 mb-1 pointer" data-bs-toggle="collapse" data-bs-target="#job_post_question0_content" aria-expanded="true" aria-controls="job_post_question0_content" onclick="openOptions(0)"></p>
                                    <div id="job_post_question0_content" class="accordion-collapse collapse show" aria-labelledby="job_post_question0_label" data-bs-parent="#job_post_question1_container" style="height: auto!important;">
                                        <div class="accordion-body">
                                            <div id="job_post_question0_options" class="job-post-option-container"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="job_post_question1_container" class="row accordion mb-3" style="display: none;">
                                <div class="accordion-item">
                                    <p id="job_post_question1_label" class="mt-3 mb-1 pointer" data-bs-toggle="collapse" data-bs-target="#job_post_question1_content" aria-expanded="true" aria-controls="job_post_question1_content" onclick="openOptions(1)"></p>
                                    <div id="job_post_question1_content" class="accordion-collapse collapse show" aria-labelledby="job_post_question1_label" data-bs-parent="#job_post_question1_container" style="height: auto!important;">
                                        <div class="accordion-body">
                                            <div id="job_post_question1_options" class="job-post-option-container"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="job_post_question2_container" class="row accordion mb-3" style="display: none;">
                                <div class="accordion-item">
                                    <p id="job_post_question2_label" class="mt-3 mb-1 pointer" data-bs-toggle="collapse" data-bs-target="#job_post_question2_content" aria-expanded="true" aria-controls="job_post_question2_content" onclick="openOptions(2)"></p>
                                    <div id="job_post_question2_content" class="accordion-collapse collapse show" aria-labelledby="job_post_question2_label" data-bs-parent="#job_post_question1_container" style="height: auto!important;">
                                        <div class="accordion-body">
                                            <div id="job_post_question2_options" class="job-post-option-container"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--CHAT GPT CONTENT END-->

                            <!--<p>Add Images</p>
                            <div class="form-group">
                                <div class="form-inputrow2">
                                    <div class="image-uploadfile">
                                        <label for="post_image">
                                        <img src="{{ asset('assets/images/upload-ow.png') }}">
                                        <p>Click to upload
                                            <br>
                                            <span>Maximum file size 10MB</span>
                                        </p>

                                        </label>
                                        <input type="file" name="images[]" id="post_image"
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
                            </div>-->

                            <!--<p>Date</p>
                            <div class="row">
                                <div class="form-inputrow">
                                    <div class="form-group formspace01 date-inputbx1">
                                        <label>On Date</label>
                                        <input type="date" name="date"
                                            class="form-control form-control-lg datepicker  {{ $errors->has('date') ? 'is-invalid' : '' }}"
                                            min="{{ \Carbon\Carbon::today()->format('m/d/Y') }}" placeholder="Date">
                                    </div>
                                    <div class="form-group formspace01 date-inputbx1">
                                        <div class="form-group">
                                            <label>Before Date</label>
                                            <input type="date" name="before_date"
                                                class="form-control form-control-lg datepicker {{ $errors->has('before_date') ? 'is-invalid' : '' }}"
                                                min="{{ \Carbon\Carbon::today()->format('m/d/Y') }}"
                                                placeholder="Before Date">
                                        </div>
                                    </div>
                                    <div class="form-group formspace01 flexible-btn">
                                        <input type="checkbox" name="is_flexible" value="1"
                                            class="hidden flexible-bx1 datepicker" id="cb"
                                            {{ old('is_flexible') == true ? 'checked' : '' }}>
                                        <label for="cb">I’m flexible </label>
                                    </div>
                                </div>
                            </div>
                            <div class="certain_time d-none mb-0">
                                <input type="checkbox" name="certain_time"
                                    class="certian pl-5 {{ $errors->has('certain_time') ? 'is-invalid' : '' }}"
                                    value="1" {{ old('certain_time') == true ? 'checked' : '' }}>
                                <label for="certain_time">I need a certain time of day</label>
                                @error('certain_time')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="row ">
                                <div
                                    class="form-inputrow flexible d-none {{ $errors->has('flexible') ? 'is-invalid' : '' }}">
                                    @foreach ($flexibles as $flexible)
                                        <div class="form-group checkbxes01">
                                            <input type="checkbox" name="flexible[]" value="{{ $flexible->id }}">
                                            <div class="checkbxesalige-bx1">
                                                <img src="{{ asset('assets/images/' . $flexible->icon) }}">
                                                <label for="vehicle1">{{ $flexible->name }}</label>
                                                <p>{{ $flexible->time }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @error('flexible')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>-->

                            <p>Provide more details</p>
                            <div class="form-group required-fieldbx">
                                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" rows="7"
                                    id="comment" placeholder="What are the details?">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-2 text-center hide" id="catErrorMsg"></div>

                            <p>Category</p>
                            <div class="form-group required-fieldbx">
                                <div class="form-group" id="mainCatDiv">
                                    <select class="form-select {{ $errors->has('category') ? 'is-invalid' : '' }}"
                                            name="category" id="category">
                                        <option value="">Please Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>


                            <p>Sub Category</p>
                            <div class="form-group required-fieldbx">
                                <div class="form-group">
                                    <select class="form-select {{ $errors->has('sub_category') ? 'is-invalid' : '' }}" name="sub_category" id="sub_category">
                                    </select>
                                    @error('sub_category')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <p>Skills</p>
                            <div class="form-group required-fieldbx">
                                <div class="form-group">
                                    <select class="form-select select2 skills {{ $errors->has('skills[]') ? 'is-invalid' : '' }}"
                                        name="skills[]" multiple id="skillList" style="height:100px !important">
                                        <option value="">Please Select Category for skill selection</option>
                                    </select>
                                    @error('skills[]')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!--<p>Address</p>
                            <div class="form-group required-fieldbx">
                                <input type="hidden" name="latitude" id="latitude">
                                <input type="hidden" name="longitude" id="longitude">
                                <div class="address-bx11 {{ $errors->has('address') ? 'is-invalid' : '' }}">
                                    <div class="address-iconbx">
                                        <img src="{{ asset('assets/images/map-icon.png') }}">
                                    </div>
                                    <div id="autocomplete" style="width:100%"></div>
                                    <input type="hidden" name="address" value="{{ old('address') }}"
                                        class="form-control form-control-lg {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                        id="address" autocomplete="on" />
                                </div>
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>-->

                            <!--<p>Price</p>
                            <div class="form-group required-fieldbx">
                                <div class="address-bx11 {{ $errors->has('amount') ? 'is-invalid' : '' }}">
                                    <div class="address-iconbx">$</div>
                                    <input type="number" name="amount" value="{{ old('amount') }}"
                                        class="form-control form-control-lg {{ $errors->has('amount') ? 'is-invalid' : '' }}"
                                        placeholder="Amount eg. 5">
                                </div>
                                @error('amount')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>-->

                            <div id="job_post_working_type_container" class="working-type-container mt-3" style="display: none;">
                                <p class="text-light mb-1">What kind of project are you going to post?</p>
                                <div class="row">
                                    <div class="col-md-6" onclick="setWorkingType('hourly')">
                                        <div class="d-flex bg-light px-1 py-4 rounded">
                                            <div class="col-md-2 working-type-icon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <h5 class="text-dark m-0">Hourly Type</h5>
                                                <p class="m-0">You should pay for your freelancer according to working hour...
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6" onclick="setWorkingType('fixed')">
                                        <div class="d-flex bg-light px-1 py-4 rounded">
                                            <div class="col-md-2 working-type-icon">
                                                <i class="fa fa-dollar"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <h5 class="text-dark m-0">Fixed Type</h5>
                                                <p class="m-0">You should pay for your freelancer within fixed budget...
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="budget" id="hiddenBudget">

                            <div id="job_post_budget_container" class="row mt-3" style="display: none;">
                                <div class="form-group required-fieldbx">
                                    <div class="form-group">
                                        <select id="job_post_budget" name="amount" class="form-select select2 mb-3" aria-label=".form-select-lg example" style="width: 100%!important;" onchange="budgetSelected(this)">
                                        </select>
                                    </div>
                                </div>

                                <div id="job_post_minimum_budget" class="col-md-3" style="display: none;">
                                    <p>Minimum Amount</p>
                                        <input id="custom_minimum_budget" type="number" name="minimum" class="form-control form-control-lg" onchange="minimumBudgetSelected(this)"/>
                                </div>
                                <div id="job_post_maximum_budget" class="col-md-3" style="display: none;">
                                    <p>Maximum Amount</p>
                                        <input id="custom_maximum_budget" type="number" name="maximum" class="form-control form-control-lg" onchange="maximumBudgetSelected(this)"/>
                                </div>

{{--                                <div class="col-md-12 col-sm-12 gap-3 d-flex align-items-center justify-content-start">--}}
{{--                                    <button type="button" id="auto_writing_button" class="btn btn-primary" onclick="selectBudget()">--}}
{{--                                        <i class="fa fa-check"></i> Confirm--}}
{{--                                    </button>--}}
{{--                                </div>--}}
                            </div>

                            <!-- <p>What is your budget Type (Per Day, Per Project, Per Hour)?</p> -->
                             <!--<div class="form-group required-fieldbx">
                                <select name="budget" id="budget"
                                    class="form-select form-control-lg {{ $errors->has('budget') ? 'is-invalid' : '' }}">
                                    <option value="0">Please Select Budget Type</option>
                                    @foreach ($bugets as $budget)
                                        <option value="{{ $budget->id }}"
                                            {{ old('budget') == $budget->id ? 'selected' : '' }}>{{ $budget->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('budget')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>-->
                            <div class="submit-btnbx0 mt-3">
                                <button type="submit" id="post_task_submit" class="btn btn-primary text-white">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="overlay"></div>
    <div class="spanner">
        <div class="loader"></div>
        <p>Please wait for a minute.</p>
    </div>
@endsection

@section('script')
<script>
    const dt = new DataTransfer();
    $(document).ready(function() {
        Radar.initialize("{{env('RADAR_MAPS_API_CLIENT_KEY')}}");
        Radar.ui.autocomplete({
            container: 'autocomplete',
            width:'100%',
            onSelection: (address) => {
                $('#address').val(address.formattedAddress);

                $('#latitude').val(address.latitude);
                $('#longitude').val(address.longitude);
            },
        });

        // var autocomplete = new google.maps.places.Autocomplete($("#address")[0], {});
        // autocomplete.setTypes(['geocode']);

        // google.maps.event.addListener(autocomplete, 'place_changed', function() {
        //     var place = autocomplete.getPlace();
        //     if (place.geometry) {
        //     $('#latitude').val(place.geometry.location.lat());
        //     $('#longitude').val(place.geometry.location.lng());
        //     }
        // });

        // $("#address").on("keyup", function() {
        //     if ($(this).val().length >= 2) {
        //     autocomplete.setBounds(new google.maps.LatLngBounds(new google.maps.LatLng(0, 0), new google.maps.LatLng(0, 0)));
        //     autocomplete.setOptions({
        //         types: ['geocode']
        //     });
        //     autocomplete.input = this;
        //     autocomplete.addListener('place_changed', function() {
        //         var place = autocomplete.getPlace();
        //         if (place.geometry) {
        //         $('#latitude').val(place.geometry.location.lat());
        //         $('#longitude').val(place.geometry.location.lng());
        //         }
        //     });
        //     }
        // });
    });

    $('input[type="file"][name="images[]"]').on('change', function() {

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

    $('#category').on('change', function(){
        var categoryId = $(this).val();
        $.ajax({
            url: '{{url('getSubCategory')}}',
            method: 'POST',
            data: { categoryId: categoryId },
            success: function(response) {
                if(response.result == 1){
                    $("#sub_category").empty();
                    $("#sub_category").append('<option value="">Please Select Sub Category</option>');
                    $("#sub_category").append(response.option);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    })

    $('#sub_category').on('change', function(){
        var categoryId = $(this).val();
        $.ajax({
            url: '{{url('getSkills')}}',
            method: 'POST',
            data: { category_id: categoryId },
            success: function(response) {
                $("#skillList").empty();
                $("#skillList").attr('data-placeholder','Please select skills');
                $("#skillList").append(response.option);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    })

</script>
@endsection