@extends('frontend.layouts.app')
@section('content')

    <div class="main-content-bx01 bg-colorbx">
        <div class="container">
            <form action="{{route('jobs.index')}}" method="get" id="jobFilterForm">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-serch-bx">
                            <h2>Browser</h2>
                                <!-- @csrf -->
                                <div class="input-group mb-3">
                                    <div class="search-bx1">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                        <input type="search" name="jobName" id="jobName" autocomplete="off" class="form-control form-control-lg search-filter-post"
                                            placeholder="Search for Project" value="{{$search_name}}">
                                    </div>
                                    <button type="button" class="input-group-text btn-success" id="search_jobs">Search</button>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group required-fieldbx">
                                                <div class="form-group" id="mainCatDiv">
                                                    <label class="text-white pb-2">Select Category</label>
                                                    <select class="form-select" name="category" id="categories">
                                                        <option value="">Please Select Category</option>
                                                        @foreach ($allCategory as $category)
                                                            <option value="{{ $category->id }}" @if($selected_cat ==$category->id ) selected @endif>{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group required-fieldbx">
                                                <div class="form-group" id="mainCatDiv">
                                                    <label class="text-white pb-2">Please Select Sub Category</label>
                                                    <select class="form-select" name="sub_category" id="sub_categories">
                                                        <option value="">Please Select Subcategory</option>
                                                        @foreach ($subCategory as $scat)
                                                            <option value="{{ $scat->id }}" @if($selected_sub_cat ==$scat->id ) selected @endif>{{ $scat->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="top-result-bx">
                        <div class="result-leftbx1">
                            <ul>
                                <li>
                                    <b>Top result</b>
                                </li>
                                <li>
                                    <a href="#">1 - 20 of 4k results</a>
                                </li>
                                <li>
                                    <i class="fa fa-bell" aria-hidden="true"></i>
                                    Receive alerts for this search
                                </li>
                                <li>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="flexSwitchCheckChecked" checked />
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="result-rightbx1">
    <!--                         <p>Sort by</p>
                            <div class="dropdown">
                                <select class="form-select form-select-lg" name="orderBy" id="search_select" aria-label="Latest">
                                    <option value="DESC" selected>Latest</option>
                                    <option value="ASC">Old</option>
                                </select>
                            </div> -->
                            <!-- <div class="custom-select" style="width:200px;">
                                <select  name="orderBy"  aria-label="Sort By" >
                                    <option value="method" selected>Sort By</option>
                                    <option value="DESC" >Latest</option>
                                    <option value="ASC">Old</option>
                                </select>
                            </div> -->
                            <div style="width:200px;">
                                <select class="form-control" id="sort_posts" name="filterBy"  aria-label="Sort By">
                                    <option value="DESC">Latest</option>
                                    <option value="ASC">Old</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="jobList">
                    @include('frontend.jobs.list')
                </div>

            </form>
        </div>
    </div>
@endsection

@section('script')
<script>
    $('#category').on('change', function(){
        var categoryId = $(this).val();
        $.ajax({
            url: '{{url('getJobSubCategory')}}',
            method: 'POST',
            data: { categoryId: categoryId},
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

    $(document).on('click', 'input[name="jobSkills"]', function() {
        $('input[type="checkbox"]').not(this).prop('checked', false);
        filterCallOut();
    });

    $('#categories, #sub_categories, #sort_posts').on('change', function(){
        filterCallOut();
    });

    $('#search_jobs').on('click', function(){
        filterCallOut();
    });

    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        filterCallOut(page);
    });

    function filterCallOut(page = 1){
        var jobName = $('#jobName').val();
        var categoryId = $('#categories').val();
        var subcategorId = $('#sub_categories').val();
        var filterBy = $('#sort_posts').val();
        var jobSkills = $("input[name='jobSkills']:checked").val();

        $.ajax({
            url: '{{route('jobs.getJobList')}}' + '?page=' + page,
            method: 'POST',
            data: {jobName:jobName, categoryId: categoryId, subcategorId: subcategorId, jobSkills:jobSkills, filterBy:filterBy},
            success: function(response) {
                if(response.subcatChange == 1){
                    $("#sub_categories").empty();
                    $("#sub_categories").append('<option value="">Please Select Sub Category</option>');
                    $("#sub_categories").append(response.option);
                }
                $('#jobList').html(response.content);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }


</script>
@endsection
