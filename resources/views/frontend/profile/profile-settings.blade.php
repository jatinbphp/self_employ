@extends('frontend.layouts.app')
@section('content')
<div class="main-content-bx01 login-page">
    <div class="container">
        <div class="d-flex align-items-start profile-tabssetting">
            <div class="nav profile-tb-btn1 flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <!--<button class="userAccount nav-link active " id="profileTab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="true">Profile</button>-->
                <button class="userAccount nav-link active" id="profileSettingsTab" data-bs-toggle="pill" data-bs-target="#v-pills-profileSetting" type="button" role="tab" aria-controls="v-pills-profileSetting" aria-selected="true">Profile Setting</button>
                <button class="userAccount nav-link " id="passwordTab" data-bs-toggle="pill" data-bs-target="#v-pills-password" type="button" role="tab" aria-controls="v-pills-password" aria-selected="false">Password</button>
                <button class="userAccount nav-link" id="emailNotificationTab" data-bs-toggle="pill" data-bs-target="#v-pills-email" type="button" role="tab" aria-controls="v-pills-email" aria-selected="false">Email & Notification</button>
                <button class="userAccount nav-link" id="paymentFinancialTab" data-bs-toggle="pill" data-bs-target="#v-pills-payment" type="button" role="tab" aria-controls="v-pills-payment" aria-selected="false">Payment & Financials</button>
                <button class="userAccount nav-link" id="accountTab" data-bs-toggle="pill" data-bs-target="#v-pills-account" type="button" role="tab" aria-controls="v-pills-account" aria-selected="false">Account</button>
            </div>
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-profileSetting" role="tabpanel" aria-labelledby="profileSettingsTab" tabindex="0">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="post-taskbx01">
                                <form id="profileSettingsForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="name-field-bx1 ">
                                        <p>Name</p>
                                        <div class="form-spacebx1">
                                            <div class="form-group">
                                                <input type="text" name="first_name" value="{{auth()->user()->first_name}}" class="form-control form-control-lg" placeholder="First Name">
                                                <span class="text-danger" id="error-first_name"></span>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="last_name" value="{{auth()->user()->last_name}}" class="form-control form-control-lg" placeholder="Last Name">
                                                <span class="text-danger" id="error-last_name"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-spacebx1">
                                        <p>Address</p>
                                        <div class="form-group">
                                            <input type="text" name="address" value="{{auth()->user()->address}}" class="form-control form-control-lg" placeholder="Appartment">
                                            <span class="text-danger" id="error-address"></span>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="address2" value="{{auth()->user()->address2}}" class="form-control form-control-lg" placeholder="Street">
                                        </div>
                                        <p>City/Town</p>
                                        <div class="form-group">
                                            <input type="text" name="city" value="{{auth()->user()->city}}" class="form-control form-control-lg" placeholder="City">
                                            <span class="text-danger" id="error-city"></span>
                                        </div>
                                        <div class="form-inputrow">
                                            <div class="form-group formspace02">
                                                <p>ZIP/Postal Code</p>
                                                <input type="text" name="zip_code" value="{{auth()->user()->zip_code}}" class="form-control form-control-lg" placeholder="Zip Code/Postal Code">
                                                <span class="text-danger" id="error-zip_code"></span>
                                            </div>
                                            <div class="form-group formspace02">
                                                <p>State/Region</p>
                                                <input type="text" name="state" value="{{auth()->user()->state}}" class="form-control form-control-lg" placeholder="State">
                                                <span class="text-danger" id="error-state"></span>
                                            </div>
                                        </div>
                                        <p>Country</p>
                                        <div class="form-group">
                                            <input type="text" name="country" value="{{auth()->user()->country}}" class="form-control form-control-lg" placeholder="Country">
                                            <span class="text-danger" id="error-country"></span>
                                        </div>
<!--                                         <p>About</p>
                                        <div class="form-group profile-text-areabx01 ow-textarea">
                                            <textarea name="about" class="form-control form-control-lg" placeholder="About yourself">{{auth()->user()->about}}</textarea>
                                        </div> -->

                                        <p>Company Name</p>
                                        <div class="form-group">
                                            <input type="text" name="company_name" value="{{auth()->user()->company_name}}" class="form-control form-control-lg" placeholder="Company Name">
                                        </div>
                                        <p>Designation</p>
                                        <div class="form-group">
                                            <input type="text" name="designation" value="{{auth()->user()->designation}}" class="form-control form-control-lg" placeholder="Designation">
                                        </div>
                                        <p>Select Language</p>
                                        <div class="form-group">
                                            <div class="form-group">
                                                <select name="language_id" class="form-select select2">
                                                    <option value="">Select Language</option>
                                                    <option value="1" {{(auth()->user()->language_id == 1 ? 'selected':'')}}>English (US)</option>
                                                    <option value="2" {{(auth()->user()->language_id == 2 ? 'selected':'')}}>Swidish</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="submit-btnbx0">
                                            <button type="submit" class="btn btn-primary" name="update" value="update">Save Settings</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="v-pills-password" role="tabpanel" aria-labelledby="passwordTab" tabindex="0">
                    <div class="post-taskbx01">
                        <form  id="passwordUpdateForm" enctype="multipart/form-data">
                            @csrf
                            <div class="form-spacebx1">
                                <h3>Password</h3>
                                <p>Change Password</p>
                                <div class="form-group">
                                    <input type="password" name="old_password" class="form-control form-control-lg" placeholder="Current Password">
                                    <span class="text-danger" id="error-old_password"></span>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="newPassword" class="form-control form-control-lg" placeholder="New Password">
                                    <span class="text-danger" id="error-password"></span>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password_confirmation" class="form-control form-control-lg" placeholder="Confirm Password">
                                    <span class="text-danger" id="error-password_confirmation"></span>
                                </div>
                                <div class="submit-btnbx0">
                                    <button type="submit" class="btn btn-primary" name="update" value="change_password">Save Settings</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="tab-pane fade" id="v-pills-email" role="tabpanel" aria-labelledby="emailNotificationTab" tabindex="0">
                    <div class="post-taskbx01">
                        <form id="emailUpdateForm" enctype="multipart/form-data">
                            @csrf
                            <div class="form-spacebx1">
                                <h3>Email</h3>
                                <div class="form-spacebx1">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <p>Email</p>
                                                <input type="text" name="email" value="{{auth()->user()->email}}" class="form-control form-control-lg" placeholder="Email">
                                                <span class="text-danger" id="error-email"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <p>Password</p>
                                                <input type="password" name="password" value="" class="form-control form-control-lg" placeholder="Password">
                                                <span class="text-danger" id="error-password"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="submit-btnbx0">
                                        <button type="submit" class="btn btn-primary" name="update" value="change_password">Update Email Address</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="tab-pane fade" id="v-pills-payment" role="tabpanel" aria-labelledby="paymentFinancialTab" tabindex="0">
                    <div class="post-taskbx01">
                        <form  id="addCardForm" enctype="multipart/form-data">
                            @csrf
                            <div class="form-spacebx1">
                                <h3>Payment & Financials</h3>
                                <p>Payment Method</p>
                                <div id="cardContent">
                                    @if(count($userCards) > 0)
                                        @foreach($userCards as $card)
                                            <div class="pricing-incomebx1 border-bottom-0 mt-1" id="card_{{$card['id']}}">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <i class="fa fa-credit-card fa-3x"></i>
                                                        {{ get_card_number($card['card_number']) }}
                                                    </div>
                                                    <div class="col-md-1">
                                                        <button type="button" class="btn card-delete" data-id="{{$card['id']}}"><i class="fa fa-times"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <button type="button" class="btn btn-primary btn-sm mt-3" id="toggleCard"><i class="fa  fa-plus"></i> Add Payment Method</button>
                                <div class="d-none mt-3 border p-2" id="addCardDiv">
                                    <div class="form-group">
                                        <input type="text" name="card_number" class="form-control form-control-lg" placeholder="Card Number">
                                        <span class="text-danger" id="error-card_number"></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="cvv" id="cvv" class="form-control form-control-lg" placeholder="CVV">
                                        <span class="text-danger" id="error-cvv"></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="expiry_month" id="expiry_month" class="form-control form-control-lg" placeholder="MM / YY">
                                        <span class="text-danger" id="error-expiry_month"></span>
                                    </div>
                                    <div class="submit-btnbx0">
                                        <button type="submit" class="btn btn-primary" name="update" value="change_password">Save Settings</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="tab-pane fade" id="v-pills-account" role="tabpanel" aria-labelledby="accountTab" tabindex="0">
                    <div class="post-taskbx01">
                        <div class="form-spacebx1">
                            <h3>Deactivate Or Delete Account</h3>
                            <div class="border p-3" id="deactivateAccount">
                                <h6>Deactivate Account</h6>
                                <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                </p>
                                <button type="button" class="btn btn-primary btn-sm mt-2" id="deactivateBtn">Deactivate Account</button>
                            </div>

                            <div class="border p-3 mt-3" id="deleteAccount">
                                <h6>Request Permanent Deletion</h6>
                                <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                </p>
                                <button type="button" class="btn btn-primary btn-sm mt-2" id="deletionBtn">Delete Account</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('frontend.modals.modal-login')
@include('frontend.modals.modal-hire')
@include('frontend.modals.modal-add-portfolio')
@include('frontend.modals.modal-read-portfolio')
@include('frontend.modals.modal-create-team')

@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            console.log('DOMContentLoaded');
            // Check if there's a hash fragment in the URL
            if (window.location.hash) {
                console.log('inn hash');
                const hash = window.location.hash.substring(1); // Remove the '#' character
                const tab = document.querySelector(`#${hash}Tab`);
                if (tab) {
                    $('.userAccount').removeClass('active');
                    $('.tab-pane').removeClass('show active');
                    tab.classList.add('active'); // Ensure the tab button is marked as active
                    const tabContent = document.querySelector(tab.getAttribute('data-bs-target'));
                    if (tabContent) {
                        tabContent.classList.add('show', 'active'); // Show and mark as active the corresponding tab content
                    }
                }
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            var button = document.getElementById("toggleCard");
            var content = document.getElementById("addCardDiv");

            // Toggle the visibility of the content div on button click
            button.addEventListener("click", function() {
                // Toggle the 'd-none' class to show/hide the content div
                content.classList.toggle("d-none");

                // If content is shown, add the 'show' class to trigger smooth transition
                if (!content.classList.contains("d-none")) {
                    content.classList.add("show");
                } else {
                    // If content is hidden, remove the 'show' class after a short delay
                    // This delay ensures that the transition completes before removing the class
                    setTimeout(function() {
                        content.classList.remove("show");
                    }, 300); // Adjust the delay to match transition duration (300ms in Bootstrap)
                }
            });
        });

        $(document).ready(function() {
            console.log(window.location.hash)
            /*if (window.location.hash == '#client') {
                $('.switch-profile').trigger('click');
            }*/

            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            /* initialize the external events
            -----------------------------------------------------------------*/
            $('#external-events div.external-event').each(function() {
                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };
                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);
                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 999,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0 //  original position after the drag
                });
            });

            /* initialize the calendar
            -----------------------------------------------------------------*/
            var calendar = $('#calendar').fullCalendar({
                header: {
                    left: 'title',
                    //center: 'agendaDay,agendaWeek,month',
                    right: 'prev,next' // today'
                },
                editable: true,
                firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
                selectable: true,
                defaultView: 'month',
                axisFormat: 'h:mm',
                columnFormat: {
                    month: 'ddd', // Mon
                    week: 'ddd d', // Mon 7
                    day: 'dddd M/d', // Monday 9/7
                    agendaDay: 'dddd d'
                },
                titleFormat: {
                    month: 'MMMM yyyy', // September 2009
                    week: "MMMM yyyy", // September 2009
                    day: 'MMMM yyyy' // Tuesday, Sep 8, 2009
                },
                allDaySlot: false,
                selectHelper: true,
                select: function(start, end) {
                    var check = $.fullCalendar.formatDate(start, 'yyyy-MM-dd');
                    var today = $.fullCalendar.formatDate(new Date(), 'yyyy-MM-dd');
                    if (check >= today) {
                        if ("{{ auth()->check() }}" == true) {
                            $('.hire_me').modal('show');
                            $('.hire_me').find('#title').val(
                                "{{ auth()->check() ? 'Project By ' . auth()->user()->username : '' }}"
                            );
                            $('.hire_me').find('#starts-at').val(convertFullDateYear(start));
                            $('.hire_me').find('#description').val(
                                "Hi {{ auth()->check() ? auth()->user()->username : '' }}, I noticed your profile and would like to offer you my project. We can discuss any details over chat."
                            );
                            $('.hire_me').find('#ends-at').val(convertFullDateYear(end));
                        } else {
                            $('.login-modal').modal('show');
                        }
                    }
                },
                eventClick: function(event, element) {
                    // Display the modal and set the values to the event values.
                    $('.hire_me').modal('show');
                    $('.hire_me').find('#title').val(event.title);
                    $('.hire_me').find('#starts-at').val(event.start);
                    $('.hire_me').find('#ends-at').val(event.end);
                },
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                droppable: false, // this allows things to be dropped onto the calendar !!!
                drop: function(date, allDay) { // this function is called when something is dropped
                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject');
                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject);
                    // assign it the date that was reported
                    copiedEventObject.start = date;
                    copiedEventObject.allDay = allDay;
                    // render the event on the calendar
                    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove();
                    }
                },
                events: "{{ route('profile.getProjects', ['id' => request()->id]) }}",
            });

            // Bind the dates to datetimepicker.
            // You should pass the options you need
            //$("#starts-at, #ends-at").datetimepicker();
            // Whenever the user clicks on the "save" button om the dialog

            $(".hire_me form").validate({
                rules: {
                    title: {
                        required: true
                    },
                    date: {
                        required: true
                    },
                    beforedate: {
                        required: true
                    },
                    description: {
                        required: true
                    },
                    budget: {
                        required: true
                    },
                    amount: {
                        required: true
                    },
                },
                messages: {
                    title: {
                        required: "Please enter Check Title",
                    },
                    starts_at: {
                        request: "Please enter Start Date"
                    },
                    ends_at: {
                        request: "Please enter End Date"
                    },
                    description: {
                        request: "Please enter Description"
                    },
                    budget: {
                        request: "Please enter Budget Type"
                    },
                    amount: {
                        request: "Please enter amount"
                    },
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: "{{ route('projects.hire') }}",
                        type: 'POST',
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.success == true) {
                                successToast(response.message);
                                $('.hire_me').modal('toggle');
                                setTimeout((function() {
                                    window.location
                                        .reload();
                                }), 500);

                                $('#save-event').on('click', function() {
                                    var title = $('#title').val();
                                    if (title) {
                                        var eventData = {
                                            title: title,
                                            start: $('#starts-at').val(),
                                            end: $('#ends-at').val()
                                        };
                                        $('#calendar').fullCalendar('renderEvent',
                                            eventData, true); // stick? = true
                                    }
                                    $('#calendar').fullCalendar('unselect');
                                    $('.modal').find('input').val('');
                                    $('.modal').modal('hide');
                                });
                            } else {
                                errorToast(response.message);
                            }
                        }
                    });
                }
            });

            /*Profile Settings Validation*/
            $("#profileSettingsForm").validate({
                rules: {
                    first_name: {
                        required: true
                    },
                    last_name: {
                        required: true
                    },
                    address: {
                        required: true
                    },
                    city:{
                        required: true
                    },
                    zip_code:{
                        required: true
                    },
                    state:{
                        required: true
                    },
                    country:{
                        required: true
                    }
                },
                messages: {
                    first_name: {
                        required: "The first name field is required.",
                    },
                    last_name: {
                        required: "This last name field is required.",
                    },
                    address: {
                        required: "This address field is required.",
                    },
                    city: {
                        required: "This city field is required.",
                    },
                    zip_code: {
                        required: "This zip code field is required.",
                    },
                    state: {
                        required: "This state field is required.",
                    },
                    country: {
                        required: "This country field is required.",
                    }
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: "{{ route('profile.profile_settings.update') }}",
                        type: 'POST',
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status == 1) {
                                toastr.success(response.message, 'Success');
                            } else if (response.status == 2){
                                var errors = response.errors;
                                var i =1;
                                $.each(errors, function(key, value) {
                                    $('#error-' + key).text(value[0]);
                                    if(i==1){
                                        $('input[name="'+key+'"]').focus();
                                    }
                                    i++;
                                });
                            } else {
                                toastr.error(response.message, 'Error');
                            }
                        }
                    });
                }
            });

            /*Password Update Validation*/
            $("#passwordUpdateForm").validate({
                rules: {
                    old_password: {
                        required: true,
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: '#newPassword',
                        minlength: 6
                    }
                },
                messages: {
                    old_password: {
                        required: "This old password field is required.",
                    },
                    password: {
                        required: "This password field is required.",
                        minlength: "Please enter at least 6 characters."
                    },
                    password_confirmation: {
                        required: "This confirm password field is required.",
                        equalTo: "The password confirmation does not match.",
                        minlength: "Please enter at least 6 characters."
                    }
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: "{{ route('profile.password.update') }}",
                        type: 'POST',
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status == 1) {
                                $(form)[0].reset();
                                toastr.success(response.message,'Success');
                            } else if (response.status == 2){
                                var errors = response.errors;
                                var i =1;
                                $.each(errors, function(key, value) {
                                    $('#error-' + key).text(value[0]);
                                    if(i==1){
                                        $('input[name="'+key+'"]').focus();
                                    }
                                    i++;
                                });
                            } else {
                                toastr.error(response.message,'Error');
                            }
                        }
                    });
                }
            });

            /*Email Update Validation*/
            $("#emailUpdateForm").validate({
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
                        required: "This email field is required.",
                        email: "Please enter a valid email."
                    },
                    password: {
                        required: "This password field is required."
                    }
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: "{{ route('profile.email.update') }}",
                        type: 'POST',
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status == 1) {
                                toastr.success(response.message, 'Success');
                            } else if (response.status == 2){
                                var errors = response.errors;
                                var i =1;
                                $.each(errors, function(key, value) {
                                    $('#error-' + key).text(value[0]);
                                    if(i==1){
                                        $('input[name="'+key+'"]').focus();
                                    }
                                    i++;
                                });
                            }else {
                                toastr.error(response.message, 'Error');
                            }
                        }
                    });
                }
            });

            /*Add Card Validation*/
            $.validator.addMethod("expiry_month", function (value, element) {
                // Regular expression to match "MM/YY" format
                var regex = /^(0[1-9]|1[0-2])\/\d{2}$/;
                return regex.test(value);
            }, "Please enter a valid expiry date in the format MM/YY.");

            $("#addCardForm").validate({
                rules: {
                    card_number: {
                        required: true,
                    },
                    cvv: {
                        required: true
                    },
                    expiry_month: {
                        required: true,
                        expiry_month: true
                    }
                },
                messages: {
                    card_number: {
                        required: "This card number field is required.",
                    },
                    cvv: {
                        required: "This cvv field is required."
                    },
                    expiry_month: {
                        required: "This expiry month field is required.",
                    }
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: "{{ route('profile.card.add') }}",
                        type: 'POST',
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status == 1) {
                                $(form)[0].reset();
                                toastr.success(response.message,'Success');
                                var content = '<div class="pricing-incomebx1 border-bottom-0 mt-1" id="card_'+response.card.id+'">'+
                                                        '<div class="row">'+
                                                        '<div class="col-md-11">'+
                                                        '<i class="fa fa-credit-card fa-3x"></i>'+response.card.card_number+'</div>'+
                                                        '<div class="col-md-1">'+
                                                        '<button type="button" class="btn card-delete" data-id="'+response.card.id+'" onclick="deleteCard('+response.card.id+')"><i class="fa fa-times"></i></button>'+
                                                        '</div>'+
                                                        '</div>'+
                                                        '</div>';
                               $('#cardContent').append(content);
                            } else if (response.status == 2){
                                var errors = response.errors;
                                var i =1;
                                $.each(errors, function(key, value) {
                                    $('#error-' + key).text(value[0]);
                                    if(i==1){
                                        $('input[name="'+key+'"]').focus();
                                    }
                                    i++;
                                });
                            } else {
                                toastr.error(response.message,'Error');
                            }
                        }
                    });
                }
            });
        });

        $('#expiry_month').on('input', function() {
            var value = $(this).val();
            if (value.length === 2 && !value.includes('/')) {
                $(this).val(value + '/');
            }
        });

        function convertFullDateYear(str) {
            var date = new Date(str),
                mnth = ("0" + (date.getMonth() + 1)).slice(-2),
                day = ("0" + date.getDate()).slice(-2);
            hours = ("0" + date.getHours()).slice(-2);
            minutes = ("0" + date.getMinutes()).slice(-2);
            return [date.getFullYear(), mnth, day].join("-");
            return [date.getFullYear(), mnth, day, hours, minutes].join("-");
        }

        const dt_new = new DataTransfer();
        $('input[type="file"][name="images[]"]').on('change', function() {
            console.log("file changeing");
            var previewImagesZone = $('.preview-images-zone');

            // Clear preview zone
            previewImagesZone.empty();
            for (let file of this.files) {
                dt_new.items.add(file);
            }
            // Mise à jour des fichiers de l'input file après ajout
            this.files = dt_new.files;
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
                console.log(dt_new.files);

                for (let i = 0; i < files.length; i++) {
                    console.log("sdfsdfsdfsd");
                    if (delete_id == i) {
                        console.log("deleted_id", delete_id);
                        dt_new.items.remove(i);
                        delete_id = null;
                    }
                }
                input.get(0).files = dt_new.files
                reRenderPreview();
            });

            $(document).unbind().on('click', '#btn_close',  function(e) {
                e.preventDefault();
                e.stopPropagation();
                dt_new.clearData();
                var previewImagesZone = $('.preview-images-zone');
                previewImagesZone.empty();
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
            console.log(client_id);

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
                $("#read-portfolio-skill-container").append(skillSpan);
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
            if (JSON.parse("\"{{ json_encode(auth()->user()) }}\"") != "null"){
                var user_id = JSON.parse("{{ json_encode(auth()->check() ? auth()->user()->id : null) }}");
            } else {
                var user_id = null
            }
            console.log(user_id);

            if (client_id == user_id && status =="pending") {
                $('#portfolio_action_form').css('display', 'flex')
                $('#portfolio_approve').val(portfolio_id);
                $('#portfolio_reject').val(portfolio_id);
            } else {
                $('#portfolio_action_form').css('display', 'none')
            }
        });

        let profile=true;

        $('.switch-profile').on('click', function() {
            if (profile) {
                $('#client-profile').css('display', 'flex');
                $('#freelancer-profile').css('display', 'none');
                $('.freelancer-profile-calender').css('visibility', 'hidden');
                $('.freelancer-profile-experience').css('display', 'none');
                $('.freelancer-profile-portfolio').css('display', 'none');
                $('#team_visit_container').css('display', 'none');
                $('.switch-profile-text')[0].innerHTML='View Freelancer Profile';
                profile=!profile;
            } else {
                $('#client-profile').css('display', 'none');
                $('#freelancer-profile').css('display', 'flex');
                $('.freelancer-profile-calender').css('visibility', 'visible');
                $('.freelancer-profile-experience').css('display', 'block');
                $('.freelancer-profile-portfolio').css('display', 'flex');
                $('#team_visit_container').css('display', 'block');
                $('.switch-profile-text').text('View Client Profile');
                profile=!profile;
            }
        })

        $(document).on('click', '#about_edit', function(e) {
            e.preventDefault();
            $('.about-submit-btnbx').css('display', 'flex');
            $('#about_edit').css('display', 'none');
            $('#profile-about-content').css('display', 'none');
            $('.profile-about-form').css('display', 'block');
        });

        $(document).on('click', '#about-submit_cancel', function(e) {
            e.preventDefault();
            $('#about_edit').css('display', 'block');
            $('.about-submit-btnbx').css('display', 'none');
            $('#profile-about-content').css('display', 'block');
            $('.profile-about-form').css('display', 'none');
        });

        $(document).on('click', '#about-submit-temp', function(e) {
            e.preventDefault();
            $('#about_submit').trigger('click');
        });

        $(document).on('click', '#skill_edit', function(e) {
            e.preventDefault();
            $('.skill-submit-btnbx').css('display', 'flex');
            $('#skill_edit').css('display', 'none');
            $('#profile-skill-content').css('display', 'none');
            $('.profile-skill-form').css('display', 'block');
        });

        $(document).on('click', '#skill-submit_cancel', function(e) {
            e.preventDefault();
            $('#skill_edit').css('display', 'block');
            $('.skill-submit-btnbx').css('display', 'none');
            $('#profile-skill-content').css('display', 'block');
            $('.profile-skill-form').css('display', 'none');
        });

        $(document).on('click', '#skill-submit-temp', function(e) {
            e.preventDefault();
            $('#skill_submit').trigger('click');
        });

        $('.card-delete').on('click', function(){
            var cId = $(this).attr('data-id');
            deleteCard(cId)
        });

        function deleteCard(cId){
            swal({
                    title: "Are you sure?",
                    text: "You want to delete this card?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Yes, Delete',
                    cancelButtonText: "No, cancel",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "{{ route('profile.card.delete') }}",
                            type: "POST",
                            data: {cId: cId,_token: '{{csrf_token()}}' },
                            success: function(data){
                                $('#card_'+cId).remove();
                                swal("Deleted", "Your card successfully deleted!", "success");
                            }
                        });
                    } else {
                        swal("Cancelled", "Your card is safe", "error");
                    }
                });
        }

        $('#deactivateBtn').on('click', function(){
            var cId = $(this).attr('data-id');
            swal({
                title: "Are you sure?",
                text: "You want to deactivate your account?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, Deactivate',
                cancelButtonText: "No, cancel",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "{{ route('profile.account.deactivate') }}",
                        type: "POST",
                        data: {cId: cId,_token: '{{csrf_token()}}' },
                        success: function(data){
                            swal({
                                title: "Account Deactivated!",
                                text: "Your account has been deactivated successfully!",
                                type: "success",
                                showCancelButton: false,
                                confirmButtonColor: '#8CD4F5',
                                confirmButtonText: 'Ok',
                                closeOnConfirm: false,
                                closeOnCancel: false
                            },function(isConfirm) {
                                if (isConfirm) {
                                    $('#frm-logout').submit();
                                }
                            });
                        }
                    });
                } else {
                    swal("Cancelled", "Your account is safe", "error");
                }
            });
        });

        $('#deletionBtn').on('click', function(){
            var cId = $(this).attr('data-id');
            swal({
                    title: "Are you sure?",
                    text: "You want to delete your account?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Yes, Delete',
                    cancelButtonText: "No, cancel",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "{{ route('profile.account.deactivate') }}",
                            type: "POST",
                            data: {cId: cId,_token: '{{csrf_token()}}' },
                            success: function(data){
                                swal({
                                    title: "Account Deleted!",
                                    text: "Your account has been deleted successfully!",
                                    type: "success",
                                    showCancelButton: false,
                                    confirmButtonColor: '#8CD4F5',
                                    confirmButtonText: 'Ok',
                                    closeOnConfirm: false,
                                    closeOnCancel: false
                                },function(isConfirm) {
                                    if (isConfirm) {
                                        $('#frm-logout').submit();
                                    }
                                });
                            }
                        });
                    } else {
                        swal("Cancelled", "Your account is safe", "error");
                    }
                });
        });
    </script>
 @endsection
