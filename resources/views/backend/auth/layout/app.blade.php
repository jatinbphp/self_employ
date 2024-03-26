<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<head>
    <title>Self Employment</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="" />
    <meta property="og:url" content="#" />
    <meta property="og:site_name" content="SelfEmployment | Auth" />
    <link rel="canonical" href="#" />
    <link rel="shortcut icon" href="{{asset('dashboard/assets/media/logos/favicon.ico')}}" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{asset('dashboard/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('dashboard/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->

    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.css" integrity="sha512-VSD3lcSci0foeRFRHWdYX4FaLvec89irh5+QAGc00j5AOdow2r5MFPhoPEYBUQdyarXwbzyJEO7Iko7+PnPuBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="bg-dark">
    <!-- Include main Content Section -->
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url({{env('APP_URL')}}dashboard/assets/media/illustrations/unitedpalms-1/14-dark.png">
            @yield('content')

            @include('backend.auth.layout.footer')
        </div>
        <!--end::Authentication Content-->
    </div>
    <!--end::Main-->

    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{asset('dashboard/assets/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{asset('dashboard/assets/js/scripts.bundle.js')}}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <!-- <script src="{{asset('dashboard/assets/js/custom/authentication/sign-in/general.js')}}"></script> -->
    <!--end::Page Custom Javascript-->

    <!--begin::Page Custom Javascript(used by this page)-->
    <script src="{{asset('dashboard/assets/js/custom/authentication/password-reset/password-reset.js')}}"></script>
    <!--end::Page Custom Javascript-->

    <!--begin::Page Custom Javascript(used by this page)-->
    <script src="{{asset('dashboard/assets/js/custom/authentication/password-reset/new-password.js')}}"></script>
    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.js" integrity="sha512-MnKz2SbnWiXJ/e0lSfSzjaz9JjJXQNb2iykcZkEY2WOzgJIWVqJBFIIPidlCjak0iTH2bt2u1fHQ4pvKvBYy6Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function successToast(message) {
            Toastify({
                text: message,
                duration: 2500,
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                // className: "alert-success",
                // style: {
                //     background: "linear-gradient(to right, #00b09b, #96c93d)",
                // },
            }).showToast();
        }
    </script>
</body>
<!--end::Body-->

</html>