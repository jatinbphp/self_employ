@extends('backend.layouts.app')

@section('content')

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Edit Skill</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-200 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('page.admin')}}" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('admin.categories')}}" class="text-muted text-hover-primary">Skill</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Edit Skill</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Card-->
            <div class="card">

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                        <!--begin::Wrapper-->
                        <div class="w-lg-550px bg-body rounded p-10 p-lg-15 mx-auto">
                            <!--begin::Form-->
                            @if(count($errors->all) > 0)
                            @foreach ($errors->all() as $error)
                            @endforeach
                            @endif
                            <form class="form w-100" novalidate="novalidate" method="post" action="{{route('admin.skills.update',$categorySkills->id)}}">
                                @csrf
                                <!--begin::Heading-->
                                <div class="text-center mb-10">
                                    <!--begin::Title-->
                                    <h1 class="text-dark mb-3">Edit Skills</h1>
                                    <!--end::Title-->
                                </div>
                                <!--begin::Heading-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <label class="form-label fw-bolder text-dark fs-6">Main Category</label>
                                    <select class="form-select form-select-solid {{$errors->has('category_id') ? 'is-invalid' : ''}}" aria-label="Select example" name="main_category" id="mainCategory" required>
                                        <option value="0">Please Select Main Category</option>
                                        @foreach($category as $cat)
                                            <option value="{{$cat->id}}" @if($categorySkills['getCategory']['parent_id'] == $cat->id) selected @endif>{{$cat->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('main_category')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="fv-row mb-7">
                                    <label class="form-label fw-bolder text-dark fs-6">Sub Category</label>
                                    <select class="form-select form-select-solid {{$errors->has('category_id') ? 'is-invalid' : ''}}" aria-label="Select example" id="sub_category" name="category_id">
                                        <option value="0">Please Select</option>
                                        @foreach($subCategory as $val)
                                        <option value="{{$val->id}}" {{$val->id == $categorySkills->category_id ? 'selected':''}}>{{$val->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="fv-row mb-7 clone_data">
                                    <label class="form-label fw-bolder text-dark fs-6">Skill Name</label>
                                    <input class="form-control form-control-lg form-control-solid {{$errors->has('name') ? 'is-invalid' : ''}}" type="text" placeholder="Enter Name" name="name" value="{{$categorySkills->name}}" autocomplete="off" required />
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>
                                <div class="fv-row mb-7 clone-data2"></div>
                                <!--end::Input group=-->
                                <!--begin::Action-->
                                <div class="text-center">
                                    <button type="submit" id="kt_new_password_submit" class="btn btn-lg btn-primary fw-bolder">
                                        <span class="indicator-label">Update</span>
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>
                                <!--end::Action-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->

        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->

@section('scripts')
<script>
    var i = 0;

    $(document).on('click', '.add-clone', function() {
        var clone = $(this).parent().parent().clone().addClass('cloned_' + i);
        clone.find('.add-clone').removeClass('add-clone').removeClass('btn-primary').addClass('del-clone_' + i).addClass('btn-warning');
        clone.find('.del-clone_' + i).attr('onclick', 'remove(' + i + ')');
        clone.find('.del-clone_' + i).addClass('bi-dash-lg').removeClass('bi-plus-lg');
        $(this).parent().parent().next().append(clone);
        i++;
    });

    function remove(ele, clone) {
        $('.cloned_' + ele).remove();
    }

    $('#mainCategory').on('change', function(){
        $.ajax({
            url: "{{ route('admin.skills.getSubCategory') }}",
            method: 'post',
            data: {
                category: $(this).val(),
                "_token": "{{ csrf_token() }}",
            },
            dataType: 'json',
            success: function(data) {
                if(data.status == 1){
                    $('#sub_category').empty();
                    $('#sub_category').append(data.option);
                }else{
                    $('#sub_category').empty();
                }
            },
        });
    });
</script>
@endsection

@endsection
