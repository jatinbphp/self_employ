<!DOCTYPE html>
<html>

<head>
    <title>SELF EMPLOY</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Chat CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/stellarnav.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/chat-gpt-styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick-theme.css') }}">
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.css"
        integrity="sha512-VSD3lcSci0foeRFRHWdYX4FaLvec89irh5+QAGc00j5AOdow2r5MFPhoPEYBUQdyarXwbzyJEO7Iko7+PnPuBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/chat.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/calender.css') }}" />
    <link href="https://js.radar.com/v4.0.0/radar.css" rel="stylesheet">
    <style>
        .select2{width: 100%!important;}
    </style>


    @yield('style')
</head>

<body id="{{ str_replace('/', '-', request()->path()) }}">
    <!-- Include Header Section -->
    @include('frontend.layouts.header')

    <!-- Include main Content Section -->
    @yield('content')

    <div class="mLoader" style=" display: none; ">
        <div class="loader4"></div>
    </div>

    <div id="chat-overlay" class="row"></div>

    <audio id="chat-alert-sound" style="display: none" >
        <source src="{{ asset('assets/sound/facebook_chat.mp3') }}" />
    </audio>

    @include('frontend.Chat.chat-box')
    <input type="hidden" id="current_user" value="{{ auth()->check() ? auth()->user()->id : '' }}" />
    <input type="hidden" id="pusher_app_key" value="{{ env('PUSHER_APP_KEY') }}" />
    <input type="hidden" id="pusher_cluster" value="{{ env('PUSHER_APP_CLUSTER') }}" />

    @include('frontend.Chat.chat-box')
    <!-- Include Footer Section -->
    @include('frontend.layouts.footer')

    <!-- Script Section -->

    {{-- Chat JS FIles --}}
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.js"></script>
    <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{ asset('assets/js/slick.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ asset('assets/js/idle.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ asset('assets/js/bootstrap-calender.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key={{ env('GOOGLE_MAPS_API_KEY') }}">
    </script>
    <script src="https://js.radar.com/v4.0.0/radar.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.15.0/echo.iife.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    {{-- <script src="http//code.jquery.com/jquery-1.11.1.min.js"></script> --}}
    {!! Toastr::message() !!}

    <script type="text/javascript" src="{{ asset('assets/js/stellarnav.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            jQuery('.stellarnav').stellarNav({
                theme: 'light',
                breakpoint: 991,
                position: 'right'
            });
        });
    </script>

    <script type="text/javascript">
        var base_url = "{{ url('/') }}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script type="text/javascript">
        var searchInput = 'address';
        var geoLocation;
        var autocomplete;
        var memberList=[];
        var presenseTemp;



        function getLocation() {
            if (window.navigator.geolocation) {
                geoLocation = navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                console.log("Geolocation is not supported by this browser.");
            }
        }
        //custom select
        var x, i, j, l, ll, selElmnt, a, b, c;
        /* Look for any elements with the class "custom-select": */
        x = document.getElementsByClassName("custom-select");
        l = x.length;
        for (i = 0; i < l; i++) {
          selElmnt = x[i].getElementsByTagName("select")[0];
          ll = selElmnt.length;
          /* For each element, create a new DIV that will act as the selected item: */
          a = document.createElement("DIV");
          a.setAttribute("class", "select-selected");
          a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
          x[i].appendChild(a);
          /* For each element, create a new DIV that will contain the option list: */
          b = document.createElement("DIV");
          b.setAttribute("class", "select-items select-hide");
          for (j = 1; j < ll; j++) {
            /* For each option in the original select element,
            create a new DIV that will act as an option item: */
            c = document.createElement("DIV");
            c.innerHTML = selElmnt.options[j].innerHTML;
            c.addEventListener("click", function(e) {
                /* When an item is clicked, update the original select box,
                and the selected item: */
                var y, i, k, s, h, sl, yl;
                s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                sl = s.length;
                h = this.parentNode.previousSibling;
                for (i = 0; i < sl; i++) {
                  if (s.options[i].innerHTML == this.innerHTML) {
                    s.selectedIndex = i;
                    h.innerHTML = this.innerHTML;
                    y = this.parentNode.getElementsByClassName("same-as-selected");
                    yl = y.length;
                    for (k = 0; k < yl; k++) {
                      y[k].removeAttribute("class");
                    }
                    this.setAttribute("class", "same-as-selected");
                    break;
                  }
                }
                h.click();
            });
            b.appendChild(c);
          }
          x[i].appendChild(b);
          a.addEventListener("click", function(e) {
            /* When the select box is clicked, close any other select boxes,
            and open/close the current select box: */
            e.stopPropagation();
            closeAllSelect(this);
            this.nextSibling.classList.toggle("select-hide");
            this.classList.toggle("select-arrow-active");
          });
        }

        function closeAllSelect(elmnt) {
          /* A function that will close all select boxes in the document,
          except the current select box: */
          var x, y, i, xl, yl, arrNo = [];
          x = document.getElementsByClassName("select-items");
          y = document.getElementsByClassName("select-selected");
          xl = x.length;
          yl = y.length;
          for (i = 0; i < yl; i++) {
            if (elmnt == y[i]) {
              arrNo.push(i)
            } else {
              y[i].classList.remove("select-arrow-active");
            }
          }
          for (i = 0; i < xl; i++) {
            if (arrNo.indexOf(i)) {
              x[i].classList.add("select-hide");
            }
          }
        }

        /* If the user clicks anywhere outside the select box,
        then close all select boxes: */
        document.addEventListener("click", closeAllSelect);


        //custom select end

        $(document).ready(function() {
            $('input:-webkit-autofill').each(function(){
                var text = $(this).val();
                var name = $(this).attr('name');
                $(this).after(this.outerHTML).remove();
                $('input[name=' + name + ']').val(text);
            });
            // $("input[type='text']").bind('focus', function() {
            //    $(this).css('background-color', 'white');
            // });
            getLocation();
        });

        function showPosition(position) {
            lat = position.coords.latitude;
            lon = position.coords.longitude;
            displayLocation(lat, lon);
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    console.log("User denied the request for Geolocation.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    console.log("Location information is unavailable.");
                    break;
                case error.TIMEOUT:
                    console.log("The request to get user location timed out.");
                    break;
                case error.UNKNOWN_ERROR:
                    console.log("An unknown error occurred.");
                    break;
            }
        }

        function displayLocation(latitude, longitude) {
            console.log("display location");
            var geocoder;
            geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(latitude, longitude);
            geocoder.geocode({
                    'latLng': latlng
                },
                function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            $('#latitude').val(latitude);
                            $('#longitude').val(longitude);
                            var add = results[0].formatted_address;
                            $('#address').val(add);
                            var value = add.split(",");
                            count = value.length;
                            country = value[count - 1];
                            state = value[count - 2];
                            city = value[count - 3];
                            //x.innerHTML = "city name is: " + city;
                        } else {
                            // x.innerHTML = "address not found";
                        }
                    } else {
                        //x.innerHTML =
                        console.log("Geocoder failed due to: " + status);
                    }
                }
            );
        }

        $(document).ready(function() {
            $('.select2').select2();
        });

        function successToast(message) {
            Toastify({
                text: message,
                duration: 2500,
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
            }).showToast();
        }

        function errorToast(message) {
            Toastify({
                text: message,
                duration: 2500,
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                // className: "alert alert-danger",
                // style: {
                //     background: "linear-gradient(to right, #000, #000)",
                // },
            }).showToast();
        }


        $(function() {
            $("#staticBackdrop form").validate({
                rules: {
                    amount: {
                        required: true
                    },
                    description: {
                        required: true
                    }
                },
                messages: {
                    amount: {
                        required: "Please enter Amount",
                    },
                    description: {
                        request: "Why are you the best person for this task?"
                    }
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: "{{ route('projects.makeoffer') }}",
                        type: 'POST',
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.success == true) {
                                successToast(response.message);
                                $('#staticBackdrop').modal('toggle');
                                setTimeout((function() {
                                    window.location.reload();
                                }), 500);
                            } else {
                                $('#staticBackdrop').modal('toggle');
                                errorToast(response.message);
                            }
                        }
                    });
                }
            });
        });

        $(function() {
            $("#LoginModaldrop form").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                },
                messages: {
                    email: {
                        required: "Please Enter Valid Email",
                    },
                    password: {
                        request: "Password is required"
                    }
                },

                submitHandler: function(form, e) {
                    e.preventDefault();
                    $.ajax({
                        url: "{{ route('auth.login.process.modal') }}",
                        type: 'POST',
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.success == true) {
                                successToast(response.message);
                                setTimeout((function() {
                                    window.location.reload();
                                }), 500);
                            } else {
                                errorToast(response.message);
                            }
                        }
                    });
                }
            });
        });

        $(document).ready(function() {
            $(".center").slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                centerMode: false,
                arrow: true,
                autoplay: true,
                autoplaySpeed: 2000,
                responsive: [
                {
                  breakpoint:767,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                  }
                }

                ]
            });
        });

        function readProfile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#profile-preview')
                        .attr('src', e.target.result)
                        .width(120)
                        .height(120);
                };
                $(input).next().removeClass('d-none')
                reader.readAsDataURL(input.files[0]);
            }
        }

        function readCover(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#cover-preview')
                        .attr('src', e.target.result)
                        .width(100)
                        .height(120);
                };
                $(input).next().removeClass('d-none')
                reader.readAsDataURL(input.files[0]);
            }
        }
        //Post BLade Scripts
        var dateToday = new Date();
        $(function() {
            $("#datepicker").datepicker({
                format: "dd/mm/yyyy",
                startDate: new Date()
            });

            $("#beforeDatepicker").datepicker({
                defaultDate: "+1w",
                format: "dd/mm/yyyy",
                startDate: new Date()
            });
        });

        $(document).on('change', '.datepicker', function() {
            $('.certain_time').removeClass('d-none');
        });

        $(document).on('change', '.certian', function() {
            if ($('.certian').prop('checked')) {
                $('.flexible').removeClass('d-none');
            } else {
                $('.flexible').addClass('d-none');
            }
        });

        $(document).on('click', '.viewoffer-btn', function() {
            $(this).parent().parent().parent().find('.hidden-content').removeClass('d-none');
            $(this).removeClass('viewoffer-btn').addClass('viewless-offerbtn').html(
                'View Less Offer <i class="fa fa-angle-right" aria-hidden="true"></i>');
        });
        $(document).on('click', '.viewless-offerbtn', function() {
            $(this).parent().parent().parent().find('.hidden-content').addClass('d-none');
            $(this).addClass('viewoffer-btn').removeClass('viewless-offerbtn').html(
                'View all Offers <i class="fa fa-angle-right" aria-hidden="true"></i>');
        });

        $(document).ready(function() {
            if ($('input[name="is_flexible"]').prop("checked") == true) {
                $('.certain_time').removeClass('d-none');
            }

            if ($('input[name="certain_time"]').prop("checked") == true) {
                $('.flexible').removeClass('d-none');
            }
        });

        $('#category').on('change', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{ route('posts.getSkills') }}",
                data: {
                    '_token': $('input[name="_token"]').val(),
                    category_id: $(this).val(),
                    user_id: "{{ auth()->check() ? auth()->user()->id : '' }}",
                    post_id: "{{ request('id') }}"
                },
                success: function(data) {
                    if (data.success == true) {
                        var html = '';
                        var array = data.userSkills;
                        $('.skills').empty();
                        $.each(data.skills, function(index, item) {
                             html += '<option value="' + item.id + '">' + item.name +
                                    '</option>';
                            // if ($.inArray(item.id, array) !== -1) {
                            //     html += '<option value="' + item.id + '" selected>' +
                            //         item.name + '</option>';
                            // } else {
                            //     html += '<option value="' + item.id + '">' + item.name +
                            //         '</option>';
                            // }
                        });
                        $('.skills').append(html);
                    }
                }
            });
        })

        $(document).on('change', '#category', function(e) {
            console.log("category selected");
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{ route('posts.getSkills') }}",
                data: {
                    '_token': $('input[name="_token"]').val(),
                    category_id: $(this).val(),
                    user_id: "{{ auth()->check() ? auth()->user()->id : '' }}",
                    post_id: "{{ request('id') }}"
                },
                success: function(data) {
                    if (data.success == true) {
                        var html = '';
                        var array = data.userSkills;
                        $('.skills').empty();
                        $.each(data.skills, function(index, item) {
                             html += '<option value="' + item.id + '">' + item.name +
                                    '</option>';
                            // if ($.inArray(item.id, array) !== -1) {
                            //     html += '<option value="' + item.id + '" selected>' +
                            //         item.name + '</option>';
                            // } else {
                            //     html += '<option value="' + item.id + '">' + item.name +
                            //         '</option>';
                            // }
                        });
                        $('.skills').append(html);
                    }
                }
            });
        });

        $('#category').trigger('change');

        $(document).on('click', '#cover_edit', function(e) {
            e.preventDefault();
            const selfieInput = $('#cover_input');
            selfieInput.trigger('click');
        });

        $(document).on('change', '#cover_input', function(e) {
            e.preventDefault();
            if (e.target.files && e.target.files[0]) {
                const i = e.target.files[0];

                let fileReader = new FileReader();

                fileReader.onloadend = () => {
                    if (fileReader.result !== null) {
                        var cover_image = $('#cover_image');
                        cover_image.attr("src", fileReader.result.toString());
                        $('.cover-submit-btnbx').css('display', 'flex');
                        $('#cover_edit').css('display', 'none');
                    }
                };
                fileReader.readAsDataURL(i);
            } else {
              setErrorSelfie(true);
            }
        });

        $(document).on('click', '#cover-submit_cancel', function(e) {
            e.preventDefault();
            $('#cover_edit').css('display', 'block');
            $('.cover-submit-btnbx').css('display', 'none');
            var cover_image = $('#cover_image');
            cover_image.attr("src", cover_image[0].dataset.imageUrl);
        });

        $(document).on('click', '#image_edit', function(e) {
            e.preventDefault();
            const selfieInput = $('#image_input');
            selfieInput.trigger('click');
        });

        $(document).on('change', '#image_input', function(e) {
            e.preventDefault();
            if (e.target.files && e.target.files[0]) {
                const i = e.target.files[0];

                let fileReader = new FileReader();

                fileReader.onloadend = () => {
                    if (fileReader.result !== null) {
                        var profile_image = $('#profile_image');
                        profile_image.attr("src", fileReader.result.toString());
                        $('.image-submit-btnbx').css('display', 'flex');
                        $('#image_edit').css('display', 'none');
                    }
                };
                fileReader.readAsDataURL(i);
            } else {
              setErrorSelfie(true);
            }
        });

        $(document).on('click', '#image_submit_cancel', function(e) {
            e.preventDefault();
            $('#image_edit').css('display', 'block');
            $('.image-submit-btnbx').css('display', 'none');
            var profile_image = $('#profile_image');
            profile_image.attr("src", profile_image[0].dataset.imageUrl);
        });

        $(document).on('click', "#award_btn", function() {
            var pid = $(this).attr('data-pid');
            var touserid = $(this).attr('data-touserid');
            $(this).attr("disabled", "");
            $.ajax({
                url: base_url + "/projects/acceptoffer",
                data: {
                    post_id: pid,
                    touserid: touserid,
                    _token: $("meta[name='csrf-token']").attr("content")
                },
                method: "POST",
                dataType: "json",
                success: function(response) {
                    $("#award_btn").removeAttr("disabled");
                    if (response.state == 1) {
                        $("#delete_project_btn").css("display", "none");
                        $("#award_btn.accept_offer span").text("Award pending");
                        $("#award_btn.accept_offer").css({'pointer-events':'none', 'cursor':'default', 'border':'0px'});
                        $(".mileston-bx button").text("Award pending");
                        $(".mileston-bx button").css({'pointer-events':'none', 'cursor':'default', 'background-color':'#c1cbc5', 'color':'black', 'border':'0px'});
                        $(".chat-toggle").attr("data-pstatus", "awarded");
                        send(touserid, "Job has been awarded  and pending accept.", pid, null, 1);
                    }
                }
            });
        });

        $(document).on('click', "#accept_offer_btn", function() {
            var pid = $(this).attr('data-pid');
            $(this).attr("disabled", "");
            $.ajax({
                url: base_url + "/projects/useracceptoffer",
                data: {
                    post_id: pid,
                    _token: $("meta[name='csrf-token']").attr("content")
                },
                method: "POST",
                dataType: "json",
                success: function(response) {
                    if (response.state == 1) {
                        $("#accept_offer_btn").css('display', 'none');
                        $("#accept_offer_btn").removeAttr("disabled");
                        send(response.to_user_id, "The awarded project has been accepted. You can now begin to negotiate terms and price before creating a milestone.", pid, null, 2);
                    }
                }
            });
        });

        $(document).on("click", "#request_milestone", function() {
            var amount = $("#milestone_amount").val();
            var description = $("#milestone_description").val();
            var project_id = $("#milestone_project_id").val();
            if(Number(amount) <= 0) {
                $(".alert-wrapper").append("<div class='alert alert-warning alert-dismissible'><button type='button' class='btn-close' data-bs-dismiss='alert'></button><p>The milestone amount must be bigger than 0.</p></div>");
                preventModalHide();
            } else if(description.trim().length == 0) {
                $(".alert-wrapper").append("<div class='alert alert-warning alert-dismissible'><button type='button' class='btn-close' data-bs-dismiss='alert'></button><p>Please input the milestone description.</p></div>");
                preventModalHide();
            } else if(description.length > 500) {
                $(".alert-wrapper").append("<div class='alert alert-warning alert-dismissible'><button type='button' class='btn-close' data-bs-dismiss='alert'></button><p>Description can't be longer than 50 characters.</p></div>");
                preventModalHide();
            } else {
                $(this).attr('disabled', 'disabled');
                $(".alert.alert-warning").css("display", "none");
                $.ajax({
                url: base_url + "/projects/createmilestone",
                data: {
                    project_id: project_id,
                    description: description,
                    amount: amount,
                    _token: $("meta[name='csrf-token']").attr("content")
                },
                method: "POST",
                dataType: "json",
                success: function(response) {
                    $("#request_milestone").removeAttr('disabled');
                    if (response.state == 1) {
                        $("#createMilestoneModal").modal("hide");
                        $("#milestone_amount").val("");
                        $("#milestone_description").val("");
                        successToast("Successfully Created!");
                        send(response.to_user_id, "Milestone created!<br>Description: "+description+"<br>Amount: $"+amount+" USD", project_id, null, 3);
                        if(window.location.pathname.includes("/projects/") && $("#payment").hasClass("active")) {
                            $(".profile-detail p").text("$"+response.balance);
                            var milestones = response.milestones;
                            var requested = 0;
                            var inprogress = 0;
                            var released = 0;
                            var milestones_wrapper = $("#created_milestones_wrapper");
                            milestones_wrapper.empty();
                            for(var i=0; i<milestones.length; i++) {
                                if(milestones[i]["status"] == "active")
                                    inprogress += milestones[i]["amount"];
                                else if(milestones[i]["status"] == "done") {
                                    released += milestones[i]["amount"];
                                }

                                var milestone_item = $("<div>").attr("class", "milestone-item mileston-created");
                                var date_div = $("<div>").attr("class", "created-info");
                                    $("<p>").text(milestones[i]["created"]).appendTo(date_div);
                                    date_div.appendTo(milestone_item);
                                var desc_div = $("<div>").attr("class", "created-info");
                                    $("<p>").text(milestones[i]["description"]).appendTo(desc_div);
                                    desc_div.appendTo(milestone_item);
                                var status_div = $("<div>").attr("class", "created-info");
                                    if(milestones[i]["status"] == "active")
                                        $("<p>").css("font-size", "16px").text("In Progress").appendTo(status_div);
                                    else if(milestones[i]["status"] == "done")
                                        $("<p>").css({"font-size":"16px", "color":"green"}).text("Released").appendTo(status_div);
                                    status_div.appendTo(milestone_item);
                                var amount_div = $("<div>").attr("class", "created-info");
                                    $("<p>").text(milestones[i]["amount"]).appendTo(amount_div);
                                    amount_div.appendTo(milestone_item);
                                var dropdown_div = $("<div>").attr("class", "dropdown dropdownbtn01");
                                var dropdown_wrapper = $("<div>").attr("class", "created-info");
                                if(milestones[i]["status"] == "active") {
                                    var dropdown_div = $("<div>").attr("class", "dropdown dropdownbtn01");
                                    var release_btn = $("<button>").attr({"class":"btn btn-primary dropdown-toggle",
                                        'data-bs-toggle':"dropdown"}).text("Management");
                                        release_btn.appendTo(dropdown_div)
                                    var ul = $("<ul>").attr("class", "dropdown-menu");
                                    var li1 = $("<li>");
                                        $("<a>").attr({"class":"dropdown-item", "href":"javascript:void(0)", "id":"release_btn",
                                            "data-mid":milestones[i]["id"], "data-amount":milestones[i]["amount"], "data-description":milestones[i]["description"],
                                            "data-pid":milestones[i]["project_id"],
                                            "onclick":"releaseMilestone(this)", "data-bs-toggle":"modal", "data-bs-target":"#releaseConfirmModal"}).text("Release Milestone").appendTo(li1);
                                        li1.appendTo(ul);
                                    var li2 = $("<li>");
                                        $("<a>").attr({"class":"dropdown-item", "href":"javascript:void(0)"}).text("Cancel Milestone").appendTo(li2);
                                        li2.appendTo(ul);
                                        ul.appendTo(dropdown_div);
                                        dropdown_div.appendTo(dropdown_wrapper);
                                        dropdown_wrapper.appendTo(milestone_item);
                                } else if(milestones[i]["status"] == "done") {
                                    var invoice_wrapper = $("<div>").css("text-align", "center").attr("class", "created-info");
                                        $("<button>").attr("class", "btn btn-info").text("View Invoice").appendTo(invoice_wrapper);
                                    invoice_wrapper.appendTo(milestone_item);
                                }
                                milestone_item.appendTo(milestones_wrapper);
                            }

                            $("#in_progress_amount").text("$"+inprogress+" USD");
                            $("#released_amount").text("$"+released+" USD");
                        }

                        // send(touserid, "Congratlations! This project is awarded.", pid, null, 1);
                    } else {
                        $(".alert-wrapper").append("<div class='alert alert-warning alert-dismissible'><button type='button' class='btn-close' data-bs-dismiss='alert'></button><p>The milestone amount can't be bigger than your holding amount.</p></div>");
                        preventModalHide();
                    }
                }
            });
            }
        });

    </script>

    {{-- Pusher Chat Functionality --}}

    @if (!Illuminate\Support\Facades\Request::is('fullchat'))
        <script>
        $(document).on('click', '.emoji-bx', function() {
            $('.emoji-list').toggle();
        })

        $(document).on('click', '.chat_input', function() {
            var post_id = $(this)[0].dataset.post_id;
            $.ajax({
                url: base_url + "/read-messages",
                data: {
                    project_id: $(this)[0].dataset.post_id,
                    _token: $("meta[name='csrf-token']").attr("content")
                },
                method: "GET",
                dataType: "json",
                success: function(response) {
                    if (response.state == 1) {
                        $('#unread_badge_' + post_id).remove();
                        $('#total_unread_badge').text(response.unread);
                    }
                }
            });
        });

        $(document).on('ended', '#chat-alert-sound', function() {
            $(this).pause();
            console.log("end");

        })
        $(function() {
            let pusher = new Pusher($("#pusher_app_key").val(), {
                cluster: $("#pusher_cluster").val(),
                encrypted: true
            });
            let pusher_notification = new Pusher($("#pusher_app_key").val(), {
                cluster: $("#pusher_cluster").val(),
                encrypted: true,
            });

            let channel_notification = pusher_notification.subscribe('notification');


            channel_notification.bind('notification-event', function(message) {
                let post_id = message.post_id;
                let post_name = message.from_user_name;
                let team_id = message.from_team_id;
                let post_image = message.post_image;
                let post_content = message.content;
                let post_date = message.post_date;
                let to_user = message.to;
                let type = message.type;

                if (to_user == undefined) {
                    var post_date_elements = $('.post_date');
                    post_date_elements.each(function (index, item) {
                        item.innerText = getDiffHuman(item.dataset.postDate)
                    })

                    var notificationList = $('.notification-list')[0];
                    var div = document.createElement('li');
                    div.classList.add("user-notifictionli1");
                    div.innerHTML = "<a href='/projects/" + post_id +
                    "'><div class='notification-image-container'><img class='notification-image' src='" + post_image +
                    "'></div><div class='notification-contentbx'><div class='title-row'><h3>"+ post_name +"</h3><p class='post_date' data-post-date='" + post_date + "'>just now</p></div><p>" + post_content + "</p></div></a>";
                    notificationList.prepend(div);
                    $('#notification_count').text(parseInt($('#notification_count').text()) + 1);

                } else if (type=="1") {

                    var auth = JSON.parse("{{ json_encode(auth()->check()) }}");
                    if (auth == true) {
                        $('#chat-alert-sound')[0].play();
                        var userId = JSON.parse("{{ json_encode(auth()->user() == null ? "" : auth()->user()->id) }}");
                        if (to_user == userId) {
                            var post_date_elements = $('.post_date');
                            post_date_elements.each(function (index, item) {
                                item.innerText = getDiffHuman(item.dataset.postDate)
                            })

                            var notificationList = $('.notification-list')[0];
                            var div = document.createElement('li');
                            div.classList.add("user-notifictionli1");
                            div.innerHTML = "<a href='/projects/" + post_id +
                            "'><div class='notification-image-container'><img class='notification-image' src='" + post_image +
                            "'></div><div class='notification-contentbx'><p>" + post_content + "</p><p class='post_date' style='text-align:right' data-post-date='" + post_date + "'>just now</p></div></a>";
                            notificationList.prepend(div);
                            $('#notification_count').text(parseInt($('#notification_count').text()) + 1);
                            Toastify({
                                text: post_content,
                                duration: 2500,
                                gravity: "bottom", // `top` or `bottom`
                                position: "left", // `left`, `center` or `right`
                                stopOnFocus: true, // Prevents dismissing of toast on hover
                            }).showToast();
                        }
                    }

                } else if (type=="2") {
                    console.log("notified");
                    var auth = JSON.parse("{{ json_encode(auth()->check()) }}");
                    if (auth == true) {
                        $('#chat-alert-sound')[0].play();
                        var userId = JSON.parse("{{ json_encode(auth()->user() == null ? "" : auth()->user()->id) }}");
                        if (to_user == userId) {
                            var post_date_elements = $('.post_date');
                            post_date_elements.each(function (index, item) {
                                item.innerText = getDiffHuman(item.dataset.postDate)
                            })

                            var notificationList = $('.notification-list')[0];
                            var div = document.createElement('li');
                            div.classList.add("user-notifictionli1");
                            div.innerHTML = "<a href='/team/profile/" + team_id +
                            "'><div class='notification-image-container'><img class='notification-image' src='" + post_image +
                            "'></div><div class='notification-contentbx'><p>" + post_content + "</p><p class='post_date' style='text-align:right' data-post-date='" + post_date + "'>just now</p></div></a>";
                            notificationList.prepend(div);
                            $('#notification_count').text(parseInt($('#notification_count').text()) + 1);
                            Toastify({
                                text: post_content,
                                duration: 2500,
                                gravity: "bottom", // `top` or `bottom`
                                position: "left", // `left`, `center` or `right`
                                stopOnFocus: true, // Prevents dismissing of toast on hover
                            }).showToast();
                        }
                    }
                }
            });

            $(document).on('click', '#count_reset', function() {
                $.ajax({
                        url: "{{ route('notification.read') }}",
                        type: 'GET',
                        success: function(response) {

                            if (response.success == true) {
                                $('#notification_count').text(0);
                            } else {
                                $('#notification_count').text(0);
                            }
                        }
                    });
            })

             $(document).on('click', '#notification_container', function() {
                console.log("notification read");
                var url = $(this).data('url');
                $.ajax({
                        url: "{{ route('notification.read') }}",
                        type: 'GET',
                        success: function(response) {
                            location.href = url;
                            if (response.success == true) {
                                $('#notification_count').text(0);
                            } else {
                                $('#notification_count').text(0);
                            }
                        }
                    });

            })

            function getDiffHuman(oldDate) {
                const olderDate = new Date(oldDate);
                const currentDate = Date.now()
                const diff = olderDate - currentDate;
                const formatter = new Intl.RelativeTimeFormat('en', { numeric: 'auto' });
                if (Math.abs(diff / 86400000) >= 1) {
                    return formatter.format(Math.round(diff / 86400000), 'day');
                } else if (Math.abs(diff / 3600000) >= 1) {
                    return formatter.format(Math.round(diff / 3600000), 'hour')
                } else {
                    return formatter.format(Math.round(diff / 60000), 'minute')
                }
            }

            window.Echo = new Echo({
                broadcaster: 'pusher',
                key: $("#pusher_app_key").val(),
                wsHost:  `ws-${$("#pusher_cluster").val()}.pusher.com`,
                wsPort:  80,
                wssPort: 443,
                forceTLS: 'https',
                enabledTransports: ['ws', 'wss'],
                authEndpoint: '/pusher/auth',
                auth: {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    }
                }
            });

            window.Echo.join(`online`)
            .here((users) => {
                users.forEach(updateUserStatus);
            })
            .joining((user) => {
                updateUserStatus(user);
            })
            .leaving((user) => {
                memberList = memberList.filter(e => e.user_id != user.user_id);
            }).listenForWhisper('client-status-updated', (e) => {
                updateUserStatus(e);
            })
            .error((error) => {
                console.error("Socket Error");
            });

            function updateUserStatus(userStatus) {
                $(`#chat-online-${userStatus.user_id}`).removeClass('online')
                $(`#chat-online-${userStatus.user_id}`).removeClass('offline')
                $(`#chat-online-${userStatus.user_id}`).removeClass('away')
                $(`#profile-online-${userStatus.user_id}`).removeClass('online')
                $(`#profile-online-${userStatus.user_id}`).removeClass('offline')
                $(`#profile-online-${userStatus.user_id}`).removeClass('away')
                if (userStatus.status == "hidden") {
                    $(`#chat-online-${userStatus.user_id}`).addClass("offline")
                    $(`#profile-online-${userStatus.user_id}`).addClass("offline")
                } else if(userStatus.status == "visible") {
                    $(`#chat-online-${userStatus.user_id}`).addClass("online")
                    $(`#profile-online-${userStatus.user_id}`).addClass("online")
                } else {
                    $(`#chat-online-${userStatus.user_id}`).addClass("away")
                    $(`#profile-online-${userStatus.user_id}`).addClass("away")
                }
                if (memberList.findIndex(e=>e.user_id == userStatus.user_id) == -1) {
                    memberList.push(userStatus);
                } else {
                    memberList[memberList.findIndex(e=>e.user_id == userStatus.user_id)].status = userStatus.status;
                }
            }

            let channel = pusher.subscribe('chat');

            // User state
            var idle = new Idle({
                  onHidden:    function() { sendUserStatus('hidden'); },
                  onVisible:   function() { sendUserStatus('visible'); },
                  onAway:      function() { sendUserStatus('away'); },
                  onAwayBack:  function() { sendUserStatus('visible'); },
                  awayTimeout: 30000 //away with 30 seconds of inactivity
            }).start();

            function sendUserStatus(status) {
                var userStatusUpdate = {
                    "user_id": "{{auth()->check() ? auth()->user()->id : ''}}", // current user unique ID
                    "status": status
                };
                window.Echo.join(`online`)
                .whisper('client-status-updated', {
                    ...userStatusUpdate
                });
            }

            let lastScrollTop = 0;
            $(".chat-area").on("scroll", function(e) {
                let st = $(this).scrollTop();
                if (st < lastScrollTop) {
                    fetchOldMessages($(this).parents(".chat-opened").find("#to_user_id").val(), $(this)
                        .find(".msg_container:first-child").attr("data-message-id"));
                }
                lastScrollTop = st;
            });

            // on click on any chat btn render the chat box
            $(".chat-toggle").on("click", function(e) {
                e.preventDefault();
                $('.chat-opened').removeClass("chat-opened").css('display', 'none')
                let ele = $(this);
                let user_id = ele.attr("data-id");
                let username = ele.attr("data-user");
                let project_id = ele.attr("data-project_id");
                let project_name = ele.attr("data-project_name");
                let is_poster = ele.attr("data-isposter");
                let post_status = ele.attr("data-pstatus");
                cloneChatBox(user_id, username, project_id, project_name, is_poster, post_status, function() {
                    let chatBox = $("#chat_box_" + project_id);
                    if (!chatBox.hasClass("chat-opened")) {
                        chatBox.addClass("chat-opened").slideDown("fast");
                        //chatBox.attr('data-to_user_id', user_id);
                        loadLatestMessages(chatBox, user_id, project_id);
                        // chatBox.find(".chat-area").animate({
                        //     scrollTop: chatBox.find(".chat-area").offset().top + chatBox
                        //         .find(".chat-area").outerHeight(true)
                        // }, 800, 'swing');
                    }
                });
            });

            // on close chat close the chat box but don't remove it from the dom
            $(".close-chat").on("click", function(e) {
                $(this).parents("div.chat-opened").removeClass("chat-opened").slideUp("fast");
            }); // on click the btn send the message

            // on change chat input text toggle the chat btn disabled state
            $(".chat_input").on("change keyup", function(e) {
                if ($(this).val() != "") {
                    $(this).parents(".form-controls").find(".btn-chat").prop("disabled", false);
                } else {
                    $(this).parents(".form-controls").find(".btn-chat").prop("disabled", true);
                }
            });
            // on click the btn send the message
            $(".btn-chat").on("click", function(e) {
                send($(this).attr('data-to-user'), $("#chat_box_" + $(this).attr('data-to-user')).find(
                    ".chat_input").val(), $(this).attr('data-post_id'), null, 0);
            });

            $(".emoji").on("click", function(e) {
                e.preventDefault();
                var textinput = $(this).parents(".chat-opened").find(".chat_input");
                textinput.val(textinput.val() + $(this).text());
                $(this).parents(".chat-opened").find(".btn-chat").prop("disabled", false);
                //send($(this).parents(".chat-opened").find('.to_user_id').val(), $(this).text(), null);
            });

            $(".upload-btn").on("click", function() {
                console.log("upload-btn");
                $(this).parents(".panel-footer").find(".image").trigger("click");
            });

            $(".image").on("change", function() {
                console.log("image");
                $(this).parent(".upload-frm").submit();
            });

            $(".upload-frm").on("submit", function(e) {
                e.preventDefault();
                send($(this).parent().parent().find('.btn-chat').attr('data-to-user'), null, $(this)
                    .parent().parent().find('.btn-chat').attr('data-post_id'), $(this).find('.image')[
                        0].files[0], 0)
                //send($(this).parent().find('.btn-chat').attr('data-to-user'), null, $(this).find('.image')[0].files[0]);
            });

            $(".chat_input").on("change keyup", function(e) {
                if ($(this).val() != "") {
                    $(this).parents(".form-controls").find(".btn-chat").prop("disabled", false);
                } else {
                    $(this).parents(".form-controls").find(".btn-chat").prop("disabled", true);
                }
            }); // handle the scroll top of any chat box

            // listen for the send event, this event will be triggered on click the send btn
            channel.bind('send', function(data) {
                displayMessage(data.data);
            });
            // listen for the oldMsgs event, this event will be triggered on scroll top
            channel.bind('oldMsgs', function(data) {
                displayOldMessages(data);
            });
        });


        /**
         * loaderHtml
         *
         * @returns {string}
         */
        function loaderHtml() {
            return '<i class="fa fa-refresh loader"></i>';
        }

        /**
         * getMessageSenderHtml
         *
         * this is the message template for the sender
         *
         * @param message
         * @returns {string}
         */
        function getMessageSenderHtml(message) {
            var html = "";
            html += `<div class="second-user msg_container base_sent" data-message-id="${message.id}">`;
            html += `<div class="user-title01">`;
            html += `<span>${message.fromUserName.charAt(0)}</span>`;
            html += `</div>`;
            if(message.type == 0)
                html += `<p>`;
            else if(message.type == 2) {
                $(".chat-toggle").attr("data-pstatus", "progress");
                // $('#chat_box_'+message.post_id).find(".mileston-bx").css("display", "block");
                // $('#chat_box_'+message.post_id).find(".mileston-bx > button").text("Create Milestone");
                // $('#chat_box_'+message.post_id).find(".mileston-bx > button").attr('id', 'accept_offer_btn');
                html += `<p style='background-color:lightblue;'>`;
                $("#award_btn.accept_offer span").text("Milestone pending");
            }
            else {
                html += `<p style='background-color:lightblue;'>`;
                if(message.type == 1)
                    $(".chat-toggle").attr("data-pstatus", "awarded");
                if(message.type == 3) {
                    $("#award_btn.accept_offer span").text("Ongoing Project");
                }
            }
            if (message.content === "" || message.content === null) {
                if (((message.image).split("."))[1] == 'png' || ((message.image).split("."))[1] == 'jpg' || ((message.image)
                        .split("."))[1] == 'jpeg') {
                    html += `<img src="${message.image_url}">`;
                } else {
                    html += `<a href="${message.image_url}">${message.image}</a>`;
                }
            } else {
                html += `${message.content}`;
            }
            //html += `${message.content}`;
            html += `<time datetime="${message.dateTimeStr}">`;
            html += `${message.dateHumanReadable}`;
            html += `<img src="{{ asset('assets/images/doubletick.png') }}">`;
            html += `</time>`;
            html += `</p>`;
            html += `</div>`;
            return html;
        }

        /**
         * getMessageReceiverHtml
         *
         * this is the message template for the receiver
         *
         * @param message
         * @returns {string}
         */
        function getMessageReceiverHtml(message) {
            var html = "";
            html += `<div class="my-chat1 second-user msg_container base_receive" data-message-id="${message.id}">`;
            if(message.type == 0)
                html += `<p>`;
            else if(message.type == 1) {
                $(".chat-toggle").attr("data-pstatus", "awarded");
                $('#chat_box_'+message.post_id).find(".mileston-bx").css("display", "block");
                $('#chat_box_'+message.post_id).find(".mileston-bx > button").text("Accept Offer");
                $('#chat_box_'+message.post_id).find(".mileston-bx > button").attr('id', 'accept_offer_btn');
                $('#chat_box_'+message.post_id).find(".mileston-bx > button").attr('data-pid', message.post_id);
                html += `<p style='background-color:darkblue;'>`;
            } else {
                html += `<p style='background-color:darkblue;'>`;
                if(message.type == 2) {
                    $('#chat_box_'+message.post_id).find(".mileston-bx").css("display", "block");
                    $('#chat_box_'+message.post_id).find(".mileston-bx > button").text("Create Milestone");
                    $('#chat_box_'+message.post_id).find(".mileston-bx > button").css({'pointer-events':'inherit', 'cursor':'pointer', 'background-color':'revert-layer', 'color':'revert-layer', 'border':'solid 1px #377de5'});
                    $("#milestone_project_id").val(message.post_id);
                    $('#chat_box_'+message.post_id).find(".mileston-bx > button").attr({"id":"", "data-bs-toggle":"modal", "data-bs-target":"#createMilestoneModal"});
                    $('#chat_box_'+message.post_id).find(".mileston-bx > button").removeAttr("disabled");
                    $(".chat-toggle").attr("data-pstatus", "progress");
                } else if(message.type == 3 || message.type == 4) {
                    if(window.location.pathname.includes("/projects/"))
                        setTimeout((function() {
                            window.location.reload();
                        }), 500);
                }
            }
            if (message.content === "" || message.content === null) {
                if (((message.image).split("."))[1] == 'png' || ((message.image).split("."))[1] == 'jpg' || ((message.image)
                        .split("."))[1] == 'jpeg') {
                    html += `<img src="${message.image_url}">`;
                } else {
                    html += `<a href="${message.image_url}">${message.image}</a>`;
                }
            } else {
                html += `${message.content}`;
            }
            //html += `${message.content}`;
            html += `<time datetime="${message.dateTimeStr}">`;
            html += `${message.dateHumanReadable}`;
            html += `<img src="{{ asset('assets/images/doubletick.png') }}">`;
            html += `</time>`;
            html += `</p>`;
            html += `<div class="user-title01">`;
            html += `<span>${message.fromUserName.charAt(0)}</span>`;
            html += `</div>`;
            html += `</div>`;
            return html;
        }

        /**
         * cloneChatBox
         *
         * this helper function make a copy of the html chat box depending on receiver user
         * then append it to 'chat-overlay' div
         *
         * @param user_id
         * @param username
         * @param callback
         */
        function cloneChatBox(user_id, username, project_id, project_name, is_poster, post_status, callback) {
            if ($("#chat_box_" + project_id).length == 0) {
                let cloned = $("#chat_box").clone(true);
                // change cloned box id
                cloned.attr("id", "chat_box_" + project_id);
                cloned.find(".chat-user").text(username);
                cloned.find(".username11").attr('id', `chat-online-${user_id}`);
                if(post_status=="active" && is_poster == 1) {
                    cloned.find(".mileston-bx").css("display", "block");
                    cloned.find(".mileston-bx > button").text("Award");
                    cloned.find(".mileston-bx > button").attr('id', 'award_btn');
                    cloned.find(".mileston-bx > button").attr('data-touserid', user_id);
                    cloned.find(".mileston-bx > button").attr('data-pid', project_id);
                } else if(post_status=="active" && is_poster == 0) {
                    cloned.find(".mileston-bx").css("display", "none");
                }

                if(post_status=="awarded" && is_poster == 1) {
                    cloned.find(".mileston-bx").css("display", "block");
                    cloned.find(".mileston-bx button").text("Award pending");
                    cloned.find(".mileston-bx button").css({'pointer-events':'none', 'cursor':'default', 'background-color':'#c1cbc5', 'color':'black', 'border':'0px'});
                } else if(post_status=="awarded" && is_poster == 0) {
                    cloned.find(".mileston-bx").css("display", "block");
                    cloned.find(".mileston-bx > button").text("Accept Offer");
                    cloned.find(".mileston-bx > button").attr('id', 'accept_offer_btn');
                    cloned.find(".mileston-bx > button").attr('data-pid', project_id);
                }

                if(post_status=="progress" && is_poster == 1) {
                    cloned.find(".mileston-bx").css("display", "block");
                    cloned.find(".mileston-bx > button").text("Create Milestone");
                    $("#milestone_project_id").val(project_id);
                    cloned.find(".mileston-bx > button").attr({"id":"", "data-bs-toggle":"modal", "data-bs-target":"#createMilestoneModal"});
                    cloned.find(".mileston-bx > button").css({'pointer-events':'inherit', 'cursor':'pointer', 'background-color':'revert-layer', 'color':'revert-layer', 'border':'solid 1px #377de5'});
                    cloned.find(".mileston-bx > button").removeAttr("disabled");
                } else if(post_status=="progress" && is_poster == 0) {
                    cloned.find(".mileston-bx").css("display", "none");
                    // cloned.find(".mileston-bx > button").text("Request Milestone");
                    // cloned.find(".mileston-bx > button").attr('id', 'req_milestone_btn');
                    // cloned.find(".mileston-bx > button").attr('data-pid', project_id);
                }

                var memberIndex = memberList.findIndex(e => e.user_id == user_id );
                if (memberIndex != -1) {
                    if (memberList[memberIndex].status == "hidden") {
                        cloned.find(".username11").addClass('offline');
                    } else if(memberList[memberIndex].status == "visible") {
                        cloned.find(".username11").addClass('online');
                    } else {
                        cloned.find(".username11").addClass( 'away');
                    }
                } else {
                    cloned.find(".username11").addClass('offline');
                }
                cloned.find(".chat-user").attr('href', "{{ route('user.view.profile') }}/" + user_id);
                cloned.find(".project-name").text(project_name);
                cloned.find(".project-name").attr('href', "{{ route('projects.details') }}/" + project_id);
                cloned.find(".btn-chat").attr("data-to-user", user_id);
                cloned.find(".btn-chat").attr("data-post_id", project_id);
                cloned.find(".chat_input").attr("data-post_id", project_id);
                cloned.find("#to_user_id").val(user_id);
                $("#chat-overlay").append(cloned);
            }
            callback();
        }

        /**
         * loadLatestMessages
         *
         * this function called on load to fetch the latest messages
         *
         * @param container
         * @param user_id
         */
        function loadLatestMessages(container, user_id, project_id) {
            let chat_area = container.find(".chat-area");
            chat_area.html("");
            $.ajax({
                url: base_url + "/load-latest-messages",
                data: {
                    user_id: user_id,
                    project_id: project_id,
                    _token: $("meta[name='csrf-token']").attr("content")
                },
                method: "GET",
                dataType: "json",
                beforeSend: function() {
                    if (chat_area.find(".loader").length == 0) {
                        chat_area.html(loaderHtml());
                    }
                },
                success: function(response) {
                    if (response.state == 1) {
                        response.messages.map(function(val, index) {
                            $(val).appendTo(chat_area);
                        });
                    }
                },
                complete: function() {
                    chat_area.find(".loader").remove();
                    container.find(".chat-area").animate({
                            scrollTop: container.find(".msg_container").last().offset().top + container.find(".msg_container").outerHeight()
                        }, 800, 'swing');
                    // container.find(".chat-area").animate({
                    //         scrollTop: container.find(".chat-area").offset().top + container
                    //             .find(".chat-area").outerHeight(true)
                    //     }, 800, 'swing');
                }
            });
        }
        function loadLatestNotifications(container, user_id, project_id) {
            let chat_area = container.find(".chat-area");
            chat_area.html("");
            $.ajax({
                url: base_url + "/load-latest-messages",
                data: {
                    user_id: user_id,
                    project_id: project_id,
                    _token: $("meta[name='csrf-token']").attr("content")
                },
                method: "GET",
                dataType: "json",
                beforeSend: function() {
                    if (chat_area.find(".loader").length == 0) {
                        chat_area.html(loaderHtml());
                    }
                },
                success: function(response) {

                    if (response.state == 1) {
                        response.messages.map(function(val, index) {
                            $(val).appendTo(chat_area);
                        });
                    }
                },
                complete: function() {
                    chat_area.find(".loader").remove();
                }
            });
        }
        /**
         * send
         *
         * this function is the main function of chat as it send the message
         *
         * @param to_user
         * @param message
         */
        /* function send(to_user, message, file = null) {
            let chat_box = $("#chat_box_" + to_user);
            let chat_area = chat_box.find(".chat-area");
            $.ajax({
                url: base_url + "/send",
                data: {
                    to_user: to_user,
                    message: message,
                    _token: $("meta[name='csrf-token']").attr("content")
                },
                method: "POST",
                dataType: "json",
                beforeSend: function() {
                    if (chat_area.find(".loader").length == 0) {
                        chat_area.append(loaderHtml());
                    }
                },
                success: function(response) {},
                complete: function() {
                    chat_area.find(".loader").remove();
                    chat_box.find(".btn-chat").prop("disabled", true);
                    chat_box.find(".chat_input").val("");
                    chat_area.animate({
                        scrollTop: chat_area.offset().top + chat_area.outerHeight(true)
                    }, 800, 'swing');
                }
            });
        } */

        $('input[name="comments1"]').keypress(function(event) {
            if (event.which == 13) {
                event.preventDefault();
                send($(this).parent().parent().parent().find('.btn-chat').attr('data-to-user'), $(this).val(), $(
                    this).parent().parent().parent().find('.btn-chat').attr('data-post_id'), null, 0);
                $(this).val("")
            }
        });

        function send(to_user, message, post_id = null, file = null, type = 0) {
            var chat_box = $("#chat_box_" + post_id);
            var chat_area = chat_box.find(".chat-area");
            var formData = new FormData();
            formData.append("to_user", to_user);
            formData.append("post_id", post_id);
            formData.append("_token", $("meta[name='csrf-token']").attr("content"));
            formData.append("message", message);
            formData.append("image", file);
            formData.append("type", type);
            $.ajax({
                url: base_url + "/send",
                data: formData,
                method: "POST",
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend: function beforeSend() {
                    if (chat_area.find(".loader").length == 0) {
                        chat_area.append(loaderHtml());
                    }
                    chat_box.find(".chat_input").val("");
                },
                success: function success(response) {
                    // if(response.poster != to_user) {

                    // }
                    var appendItem = $(getMessageSenderHtml(response.data))
                    appendItem.appendTo(chat_area);
                    chat_area.animate({
                        scrollTop: chat_area.scrollTop() + 500
                    }, 800, 'swing');
                    // getMessageSenderHtml(response.data);
                    // getMessageReceiverHtml(response.data);
                },
                complete: function complete() {
                    chat_area.find(".loader").remove();
                    chat_box.find(".btn-chat").prop("disabled", true);
                    chat_box.find(".chat_input").val("");
                    //chat_area.animate({scrollTop: chat_area.offset().top + chat_area.outerHeight(true)}, 800, 'swing');
                }
            });
        }
        /**
         * This function called by the send event triggered from pusher to display the message
         *
         * @param message
         */
        function displayMessage(message) {
            let alert_sound = document.getElementById("chat-alert-sound");
            if ($("#current_user").val() == message.from_user_id) {
                // let messageLine = getMessageSenderHtml(message);
                // $("#chat_box_" + message.to_user_id).find(".chat-area").append(messageLine);
            } else if ($("#current_user").val() == message.to_user_id) {
                // alert_sound.play();
                // for the receiver user check if the chat box is already opened otherwise open it
                //cloneChatBox(message.from_user_id, message.fromUserName, function() {
                cloneChatBox(message.from_user_id, message.fromUserName, message.post_id, message.post.name, message.is_poster, message.post_status,
                    function() {
                        let chatBox = $("#chat_box_" + message.post_id);
                        if (!chatBox.hasClass("chat-opened")) {
                            chatBox.addClass("chat-opened").slideDown("fast");
                            loadLatestMessages(chatBox, message.from_user_id, message.post_id);
                            chatBox.find('.chat_area').animate({
                                scrollTop: chatBox.find('.chat_area').scrollTop() + 500
                            }, 800, 'swing');
                        } else {
                            let messageLine = getMessageReceiverHtml(message);
                            // append the message for the receiver user
                            var appendItem = $("#chat_box_" + message.post_id).find(".chat-area");
                            appendItem.append(messageLine);
                            appendItem.animate({
                                scrollTop: appendItem.scrollTop() + 500
                            }, 800, 'swing');

                        }
                    });
            }
        }

        /**
         * fetchOldMessages
         *
         * this function load the old messages if scroll up triggerd
         *
         * @param to_user
         * @param old_message_id
         */
        function fetchOldMessages(to_user, old_message_id) {
            let chat_box = $("#chat_box_" + to_user);
            let chat_area = chat_box.find(".chat-area");
            $.ajax({
                url: base_url + "/fetch-old-messages",
                data: {
                    to_user: to_user,
                    old_message_id: old_message_id,
                    _token: $("meta[name='csrf-token']").attr("content")
                },
                method: "GET",
                dataType: "json",
                beforeSend: function() {
                    if (chat_area.find(".loader").length == 0) {
                        chat_area.prepend(loaderHtml());
                    }
                },
                success: function(response) {},
                complete: function() {
                    chat_area.find(".loader").remove();
                }
            });
        }

        function displayOldMessages(data) {
            if (data.data.length > 0) {
                data.data.map(function(val, index) {
                    $("#chat_box_" + data.to_user).find(".chat-area").prepend(val);
                });
            }
        }

        function getNotification(data) {

        }

        $(document).on('change', '#my_jobs_filter', function(e) {
            console.log(e);
            window.location.href= "/myjobs/?filter= " + e.target.value ;
            // $.get({
            //     url: "{{ route('posts.my.jobs_filter', ['filter', "+e.target.value+"]) }}",
            //     type: 'GET',
            //     data: {'filter':e.target.value},
            //     // success: function(response) {
            //     //     if (response.success == true) {
            //     //         successToast(response.message);
            //     //         $('#staticBackdrop').modal('toggle');
            //     //         setTimeout((function() {
            //     //             window.location.reload();
            //     //         }), 500);
            //     //     } else {
            //     //         $('#staticBackdrop').modal('toggle');
            //     //         errorToast(response.message);
            //     //     }
            //     // }
            // });
        });

        $('#post_task').submit(function(e){
            console.log("submit");
            $('#post_task_submit').attr('disabled', 'disabled');
        });

        $('#make_offer_modal_form').submit(function(e){
            console.log("submit");
            $('#make_offer_modal_form_submit').attr('disabled', 'disabled');
        });

        /*Filter Refresh Code Start*/
        $('.catFilter').on('click', function(){

        });
        /*Filter Refresh Code End*/
        </script>

        @endif

    @yield('script')
    <!-- <script async
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initMap">
    </script>
    <script src="{{ asset('assets/js/mapInput.js') }}"></script> -->
    <!-- <script src="{{ asset('assets/js/custom_script.js') }}"></script> -->

    <!-- Include Axios library -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('assets/js/job.post.js') }}"></script>
</body>
</html>
