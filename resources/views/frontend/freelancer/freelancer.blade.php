@extends('frontend.layouts.app')
@section('content')

    <div class="main-content-bx01 bg-colorbx cart-mainbx1">
        <div class="container">
            <form action="{{route('user.view.freelancer')}}" method="get" id="userFilterForm">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-serch-bx">
                            <h2>Browser</h2>
                            <!-- @csrf -->
                            <div class="input-group mb-3">
                                <div class="search-bx1">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    <input type="search" name="name" id="freelancerName" autocomplete="off" class="form-control form-control-lg search-filter-post"
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
                <div class="row" id="freelancerList">
                    @include('frontend.freelancer.list')
                </div>
            </form>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-xl-12">
            <div class="pagination-bx1">
                {{ $users->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection

<style type="text/css">
    .job-post-mainbx1 .row {
        row-gap: calc(var(--bs-gutter-x)* 1);
    }
</style>
@section('script')
<script>
    $(document).on('click', 'input[name="userSkill"]', function() {
        $('input[type="checkbox"]').not(this).prop('checked', false);
        filterCallOut();
    });

    $('#categories, #sub_categories').on('change', function(){
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
        var freelancerName = $('#freelancerName').val();
        var categoryId = $('#categories').val();
        var subcategorId = $('#sub_categories').val();
        var userSkill = $("input[name='userSkill']:checked").val();
        console.log(freelancerName);

        $.ajax({
            url: '{{route('user.getFreelancerList')}}'+ '?page=' + page,
            method: 'POST',
            data: {freelancerName:freelancerName, categoryId: categoryId, subcategorId: subcategorId, userSkill:userSkill},
            success: function(response) {
                if(response.subcatChange == 1){
                    $("#sub_categories").empty();
                    $("#sub_categories").append('<option value="">Please Select Sub Category</option>');
                    $("#sub_categories").append(response.option);
                }
                $('#freelancerList').html(response.content);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

</script>
@endsection
