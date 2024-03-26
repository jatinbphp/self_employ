@extends('backend.layouts.app')

@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{$user->name}} - Projects</h1>
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

                        <a href="{{route('admin.jobs')}}" class="breadcrumb-item text-muted text-hover-primary">Projects</a>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-200 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-dark">{{$user->name}} - Projects</li>
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
                <!--begin::Stats-->
                <div class="row g-6 g-xl-9">
                    <div class="col-lg-6 col-xxl-4">
                        <!--begin::Card-->
                        <div class="card h-100">
                            <!--begin::Card body-->
                            <div class="card-body p-9">
                                <!--begin::Heading-->
                                <div class="fs-2hx fw-bolder">{{count($posts)}}</div>
                                <div class="fs-4 fw-bold text-gray-400 mb-7">Current Projects</div>
                                <!--end::Heading-->
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-wrap">
                                    <!--begin::Chart-->
                                    <div class="d-flex flex-center h-100px w-100px me-9 mb-5">
                                        <canvas id="kt_project_list_chart"></canvas>
                                    </div>
                                    <!--end::Chart-->
                                    <!--begin::Labels-->
                                    <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11 mb-5">
                                        <!--begin::Label-->
                                        <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                            <div class="bullet bg-primary me-3"></div>
                                            <div class="text-gray-400">Active</div>
                                            <div class="ms-auto fw-bolder text-gray-700">{{count($posts)}}</div>
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Label-->
                                        <div class="d-flex fs-6 fw-bold align-items-center mb-3">
                                            <div class="bullet bg-success me-3"></div>
                                            <div class="text-gray-400">Completed</div>
                                            <div class="ms-auto fw-bolder text-gray-700">{{count($posts_completed)}}</div>
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Label-->
                                        <div class="d-flex fs-6 fw-bold align-items-center">
                                            <div class="bullet bg-gray-300 me-3"></div>
                                            <div class="text-gray-400">Yet to start</div>
                                            <div class="ms-auto fw-bolder text-gray-700">{{count($posts_in_progress)}}</div>
                                        </div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Labels-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    {{-- <div class="col-lg-6 col-xxl-4">
                        <div class="card h-100">
                            <div class="card-body p-9">
                                <div class="fs-2hx fw-bolder">$3,290.00</div>
                                <div class="fs-4 fw-bold text-gray-400 mb-7">Project Finance</div>
                                <div class="fs-6 d-flex justify-content-between mb-4">
                                    <div class="fw-bold">Avg. Project Budget</div>
                                    <div class="d-flex fw-bolder">
                                        <span class="svg-icon svg-icon-3 me-1 svg-icon-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M13.4 10L5.3 18.1C4.9 18.5 4.9 19.1 5.3 19.5C5.7 19.9 6.29999 19.9 6.69999 19.5L14.8 11.4L13.4 10Z"
                                                    fill="black" />
                                                <path opacity="0.3" d="M19.8 16.3L8.5 5H18.8C19.4 5 19.8 5.4 19.8 6V16.3Z"
                                                    fill="black" />
                                            </svg>
                                        </span>$6,570
                                    </div>
                                </div>
                                <div class="separator separator-dashed"></div>
                                <div class="fs-6 d-flex justify-content-between my-4">
                                    <div class="fw-bold">Lowest Project Check</div>
                                    <div class="d-flex fw-bolder">
                                        <span class="svg-icon svg-icon-3 me-1 svg-icon-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M13.4 14.8L5.3 6.69999C4.9 6.29999 4.9 5.7 5.3 5.3C5.7 4.9 6.29999 4.9 6.69999 5.3L14.8 13.4L13.4 14.8Z"
                                                    fill="black" />
                                                <path opacity="0.3"
                                                    d="M19.8 8.5L8.5 19.8H18.8C19.4 19.8 19.8 19.4 19.8 18.8V8.5Z"
                                                    fill="black" />
                                            </svg>
                                        </span>$408
                                    </div>
                                </div>
                                <div class="separator separator-dashed"></div>
                                <div class="fs-6 d-flex justify-content-between mt-4">
                                    <div class="fw-bold">Ambassador Page</div>
                                    <div class="d-flex fw-bolder">
                                        <span class="svg-icon svg-icon-3 me-1 svg-icon-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M13.4 10L5.3 18.1C4.9 18.5 4.9 19.1 5.3 19.5C5.7 19.9 6.29999 19.9 6.69999 19.5L14.8 11.4L13.4 10Z"
                                                    fill="black" />
                                                <path opacity="0.3" d="M19.8 16.3L8.5 5H18.8C19.4 5 19.8 5.4 19.8 6V16.3Z"
                                                    fill="black" />
                                            </svg>
                                        </span>$920
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <!--end::Stats-->
                <!--begin::Toolbar-->
                <div class="d-flex flex-wrap flex-stack my-5">
                    <!--begin::Heading-->
                    <h2 class="fs-2 fw-bold my-2">Projects
                        <span class="fs-6 text-gray-400 ms-1">by Status</span>
                    </h2>
                    <!--end::Heading-->
                    <!--begin::Controls-->
                    <div class="d-flex flex-wrap my-1">
                        <!--begin::Select wrapper-->
                        <div class="m-0">
                            <!--begin::Select-->
                            <select name="status" data-control="select2" data-hide-search="true"
                                class="form-select form-select-white form-select-sm fw-bolder w-125px">
                                <option value="Active" selected="selected">Active</option>
                                <option value="Approved">In Progress</option>
                                <option value="Declined">To Do</option>
                                <option value="In Progress">Completed</option>
                            </select>
                            <!--end::Select-->
                        </div>
                        <!--end::Select wrapper-->
                    </div>
                    <!--end::Controls-->
                </div>
                <!--end::Toolbar-->
                <!--begin::Row-->
                <div class="row g-6 g-xl-9">
                    @foreach ($posts as $post)
                        <!--begin::Col-->
                        <div class="col-md-6 col-xl-4">
                            <!--begin::Card-->
                            <a href="#" class="card border border-2 border-gray-300 border-hover">
                                <!--begin::Card header-->
                                <div class="card-header border-0 pt-9">
                                    <!--begin::Card Title-->
                                    <div class="card-title m-0">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-50px w-50px bg-light">
                                            <img src="{{ count($post->getPostImages) > 0 ? $post->getPostImages[0]->post_images : env('APP_URL').'uploads/posts/post_images/post.jpg' }}" alt="image"
                                                class="p-3" />
                                        </div>
                                        <!--end::Avatar-->
                                    </div>
                                    <!--end::Car Title-->
                                    <!--begin::Card toolbar-->
                                    <div class="card-toolbar">
                                        <span
                                            class="badge badge-light-primary fw-bolder me-auto px-4 py-3">{{ ucfirst($post->status) }}</span>
                                    </div>
                                    <!--end::Card toolbar-->
                                </div>
                                <!--end:: Card header-->
                                <!--begin:: Card body-->
                                <div class="card-body p-9">
                                    <!--begin::Name-->
                                    <div class="fs-3 fw-bolder text-dark">{{ $post->name }}</div>
                                    <!--end::Name-->
                                    <!--begin::Description-->
                                    <p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">{{ $post->description }}</p>
                                    <!--end::Description-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-wrap mb-5">
                                        <!--begin::Due-->
                                        <div
                                            class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
                                            <div class="fs-6 text-gray-800 fw-bolder">{{ $post->due_date }}</div>
                                            <div class="fw-bold text-gray-400">Due Date</div>
                                        </div>
                                        <!--end::Due-->
                                        <!--begin::Budget-->
                                        <div
                                            class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
                                            <div class="fs-6 text-gray-800 fw-bolder">${{ $post->amount }} /
                                                {{ $post->getBudgetTypes->name }}</div>
                                            <div class="fw-bold text-gray-400">Budget</div>
                                        </div>
                                        <!--end::Budget-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Progress-->
                                    <div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip"
                                        title="This project 70% completed">
                                        <div class="bg-primary rounded h-4px" role="progressbar" style="width: 70%"
                                            aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <!--end::Progress-->
                                    <!--begin::Users-->
                                    <div class="symbol-group symbol-hover">
                                        <!--begin::User-->
                                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip"
                                            title="Melody Macy">
                                            <img alt="Pic"
                                                src="{{ asset('dashboard/assets/media/avatars/150-3.jpg') }}" />
                                        </div>
                                        <!--begin::User-->
                                    </div>
                                    <!--end::Users-->
                                </div>
                                <!--end:: Card body-->
                            </a>
                            <!--end::Card-->
                        </div>
                        <!--end::Col-->
                    @endforeach
                </div>
                <!--end::Row-->
                <!--begin::Pagination-->
                <div class="d-flex flex-stack flex-wrap pt-10 pagination">
                    <div class="fs-6 fw-bold text-gray-700">
                        <!--begin::Pages-->
                        <ul class="pagination">
                            {{ $posts->links() }}
                        </ul>
                        <!--end::Pages-->
                    </div>
                    <!--end::Pagination-->

                </div>
                <!--end::Container-->
            </div>
            <!--end::Post-->
        </div>
        <!--end::Content-->
    @endsection
