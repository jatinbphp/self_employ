@extends('frontend.layouts.app')

@section('content')

    <div class="main-content-bx01 bg-colorbx">
        <div class="container">
            <div class="row">
                <div class="profile-title d-flex justify-content-between">
                    <h1 style="color:#fff;">Team Profile</h1>
                    @if (auth()->check() && $team->owner_id == auth()->user()->id)
                        <div class="d-flex justify-content-center">
                            <div class="switch-profile">
                                <p class=" m-0 switch-profile-text">Delete Team</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row ">
                <div class="profile-viewbx1">
                    <!-- <div class="profile-header1"><img id="cover_image" data-image-url="{{ $team->cover_image }}" src="{{ $team->cover_image }}" />
                        @if (auth()->check() && $team->owner_id == auth()->user()->id)
                         <form class="profile-header-form" method="post" action="{{route('profile.profile_settings.cover_update')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="set-profle-images-bx1">
                                <div class="set-image1">
                                    <div class="cover-submit-cancel">
                                        <button id="cover_edit" class="btn btn-primary" name="update" value="update"><i class="fa fa-edit"></i></button>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-inputrow2" style="display: none;">
                                            <div class="image-uploadfile profile-setting-bx01">
                                                <label for="first-img1"><i><img src="https://labssol.com/dev/selfemployee/SelfEmployee/public/assets/images/upload-ow.png"> </i></label>
                                                <input  type="file" name="cover" id="cover_input" style="display: none;visibility: none;">
                                                <img id="profile-preview" src="#" alt="your image" class="d-none" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cover-submit-btnbx" style="display: none;">
                                <div class="submit-btnbx0">
                                    <button type="submit" class="btn btn-primary" name="update" value="update"><i class="fa fa-save"></i></button>
                                </div>
                                <div class="submit-cancel">
                                    <button id="cover-submit_cancel" class="btn btn-primary" name="update" value="update"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        </form>
                        @endif
                    </div>
 -->

                    <div class="row prfile-imgrow">
                        <div class="col-12">
                            <div>
                                @if(auth()->check() && $team->owner_id == auth()->user()->id)
                                <div class="d-flex justify-content-end">
                                    <a data-bs-toggle="modal" id="create_team_modal" class="create_team_btn" data-bs-target="#{{ !auth()->user() ? 'LoginModaldrop' : 'inviteMember' }}">Invite Team Member</a>
                                </div>
                                @endif
                                @if (!is_null($invited)) 
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p>You are invited to this team as {{$invited->role}}</p>
                                        </div>
                                        <div>
                                            <div  class="submit-accept-btn" data-invite-id="{{$invited->id}}" >
                                                Accept
                                            </div>
                                            <div  class="submit-reject-btn" data-invite-id="{{$invited->id}}">
                                                Reject
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 ">
                            <div class="profile-image-container">
                                <div class="profile-img">
                                    <img id="profile_image" data-image-url="{{ $team->profile_image }}" src="{{ $team->profile_image }}">
                                </div>
                                @if (auth()->check() && $team->owner_id == auth()->user()->id)
                                <form class="profile-image-form" method="post" action="{{route('profile.profile_settings.image_update')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="set-profle-images-bx1">
                                        <div class="set-image1">
                                            <div class="profile-submit-cancel">
                                                <button id="image_edit" class="btn btn-primary" name="update" value="update"><i class="fa fa-edit"></i></button>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-inputrow2" style="display: none;">
                                                    <div class="image-uploadfile profile-setting-bx01">
                                                        <label for="first-img1"><i><img src="https://labssol.com/dev/selfemployee/SelfEmployee/public/assets/images/upload-ow.png"> </i></label>
                                                        <input  type="file" name="image" id="image_input" style="display: none;visibility: none;">
                                                        <img id="profile-preview" src="#" alt="your image" class="d-none" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="image-submit-btnbx" style="display: none;">
                                        <div class="submit-btnbx0">
                                            <button type="submit" class="btn btn-primary" name="update" value="update"><i class="fa fa-save"></i></button>
                                        </div>
                                        <div class="submit-cancel">
                                            <button id="image_submit_cancel" class="btn btn-primary" name="update" value="update"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                </form>
                                @endif
                            </div>
                        </div>

                        <div class="col-xl-5 col-lg-5 alignverticle-colbx1">
                            <div class="profile-detailbx">
                                <div class="d-flex justify-content-between">
                                    <h4 class="exp01 about-icon1 profile-name-container">{{ $team->name }}:</h4>
                                    <div class="profile-submit-cancel">
                                        <button id="name_edit" class="btn btn-primary" name="update" value="update"><i class="fa fa-edit"></i></button>
                                    </div>
                                    <div class="name-submit-btnbx" style="display: none;">
                                        <div class="submit-btnbx0">
                                            <button id="name-submit-temp" class="btn btn-primary" name="update" value="update"><i class="fa fa-save"></i></button>
                                        </div>
                                        <div class="submit-cancel">
                                            <button id="name-submit_cancel" class="btn btn-primary" name="update" value="update"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                </div>
                                
                                @if(auth()->check() && $team->owner_id == auth()->user()->id)
                                     <form class="profile-name-form " style="display:none" method="post" action="{{route('team.name_update')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group profile-text-areabx01 ow-textarea">
                                            <input type="text" name="name" class="form-control form-control-lg" placeholder="Team Name">{{$team->name}}</textarea>
                                        </div>
                                        <button type="submit" id="name_submit" class="btn btn-primary d-none" name="update" value="update"><i class="fa fa-save"></i></button>
                                    </form>
                                @endif


                                <p>
                                    Team created {{ $team->created }}
                                </p>
                                {{-- <a href="#">Send Message</a> --}}
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5">
                            <div class="reviews-alignbx1 d-block profile-review-bx1">
                                <div class="reviews-txtbx1">
                                    <div class="ratings">
                                        <div class="ratings-bxleft">
                                            <i class="fa fa-star rating-color"></i>
                                            <i class="fa fa-star rating-color"></i>
                                            <i class="fa fa-star rating-color"></i>
                                            <i class="fa fa-star rating-color"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="reviews-bx">
                                            <p>4.5 <i>253 Reviews</i></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <p class="pe-2 fw-bold text-review-values">0</p>
                                            <p>Jobs Completed</p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <p class="pe-2 fw-bold text-review-values">N/A</p>
                                            <p>On Budget</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <p class="pe-2 fw-bold text-review-values">N/A</p>
                                            <p>On Time</p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <p class="pe-2 fw-bold text-review-values">N/A</p>
                                            <p>Repeat Hire Rate</p>
                                        </div>
                                    </div>
                                </div>

                            
                        </div>
                        <div class="col-xl-5 col-lg-5" > 
                            <div id='wrap' class="mt-2 mb-4 calendar-wrapbx1 freelancer-profile-calender" >
                                <h3>Check {{ $team->name }} Availability</h3>
                                <div id='calendar'></div>
                                <div style='clear:both'></div>
                            </div>
                        </div>
                    </div>
                    
                   
                    <div class="row prfile-exprow " style="padding-top: 20px;">
                        <div class="col-xl-12 col-lg-12">
                            <div class="profile-content-bx1 pb-5">
                                @foreach($team_users as $member)
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="invite-user-info-content">
                                            <div class="invite-user-profile-img">
                                                <img src="{{$member->getUser->profile_image}}" />
                                            </div>
                                            <div class="informations">
                                                <h5 class="mb-0 fw-bold">{{$member->role}}</h5>
                                                <p class="mb-0 fw-bold">{{$member->getUser->name}}</p>
                                                <div class="reviews-txtbx1">
                                                    <div class="d-flex justify-content-start">
                                                        <div class="ratings-bxleft me-2">
                                                            <i class="fa fa-star text-warning"></i>
                                                            <i class="fa fa-star text-warning"></i>
                                                            <i class="fa fa-star text-warning"></i>
                                                            <i class="fa fa-star text-warning"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <div class="reviews-bx">
                                                            <p>4.5 <i>253 Reviews</i></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="text-reduce">{{$member->getUser->about}}</p>
                                            </div>
                                        </div>
                                        @if (auth()->check() && $team->owner_id == auth()->user()->id)
                                            <div  class="submit-remove-btn" data-user-id="{{ $member->user_id }}">
                                                Remove
                                            </div>
                                        @elseif (auth()->check() && $member->user_id == auth()->user()->id)
                                            <div  class="submit-leave-btn" data-user-id="{{ $member->user_id }}" data-team-id="{{$team->id}}">
                                                Leave
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('frontend.modals.modal-login')
    @include('frontend.modals.modal-hire')
    @include('frontend.modals.modal-invite-member')
    @include('frontend.modals.modal-invite-member-role')
    
@endsection
@section('script')
    <script>
        $(document).ready(function() {
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
            /*$('#save-event').on('click', function() {
                var title = $('#title').val();
                if (title) {
                    var eventData = {
                        title: title,
                        start: $('#starts-at').val(),
                        end: $('#ends-at').val()
                    };
                    $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
                }
                $('#calendar').fullCalendar('unselect');
                $('.modal').find('input').val('');
                $('.modal').modal('hide');
            }); */
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

        $(document).on('click', '.invite-user-btn', function(e) {
            var user_id = $(this).data('user-id');
            $('#invite_user_id').val(user_id);
           
        });

        $(document).on('click', '#name_edit', function(e) {
            e.preventDefault();
            $('.name-submit-btnbx').css('display', 'flex');
            $('#name_edit').css('display', 'none');
            $('.profile-name-container').css('display', 'none');
            $('.profile-name-form').css('display', 'block');
        });

        $(document).on('click', '#name-submit_cancel', function(e) {
            e.preventDefault();
            $('#name_edit').css('display', 'block');
            $('.name-submit-btnbx').css('display', 'none');
            $('.profile-name-container').css('display', 'block');
            $('.profile-name-form').css('display', 'none');
        });

        $(document).on('click', '#name-submit-temp', function(e) {
            e.preventDefault();
            $('#name_submit').trigger('click');
        });

        $('.switch-profile').on('click', function() {
            $.ajax({
                url: base_url + "/team/delete",
                data: {
                    '_token': $('input[name="_token"]').val(),
                },
                method: "POST",
                success: function success(response) {
                    if (response.success) {
                        window.location = response.url;
                    }
                    // Toastify({
                    //     text: response.message,
                    //     duration: 2500,
                    //     gravity: "top", // `top` or `bottom`
                    //     position: "right", // `left`, `center` or `right`
                    //     stopOnFocus: true, // Prevents dismissing of toast on hover
                    // }).showToast();
                }
            });
        });

        $(document).on('click', '.submit-invite-btn', function(e) {
            var user_id = $('#invite_user_id').val();
            var user_role = $('#invite_user_role').val();
            $.ajax({
                url: base_url + "/team/invite",
                data: {
                    '_token': $('input[name="_token"]').val(),
                    'user_id':user_id,
                    'role': user_role
                },
                method: "POST",
                success: function success(response) {
                    if (response.success) {
                        window.location = response.url;
                    }
                }
            });
        });

        $(document).on('click', '.submit-remove-btn', function(e) {
            var user_id = $(this).data('user-id');
            $.ajax({
                url: base_url + "/team/remove",
                data: {
                    '_token': $('input[name="_token"]').val(),
                    'user_id':user_id
                },
                method: "POST",
                success: function success(response) {
                    if (response.success) {
                        window.location = response.url;
                    }
                }
            });
        });

        $(document).on('click', '.submit-leave-btn', function(e) {
            var user_id = $(this).data('user-id');
            var team_id = $(this).data('team-id');
            $.ajax({
                url: base_url + "/team/leave",
                data: {
                    '_token': $('input[name="_token"]').val(),
                    'user_id':user_id,
                    'team_id':team_id,
                },
                method: "POST",
                success: function success(response) {
                    if (response.success) {
                        window.location = response.url;
                    }
                }
            });
        });

        $(document).on('click', '.submit-accept-btn', function(e) {
            var invite_id = $(this).data('invite-id');
            $.ajax({
                url: base_url + "/team/invite/accept",
                data: {
                    '_token': $('input[name="_token"]').val(),
                    'invite_id':invite_id,
                },
                method: "POST",
                success: function success(response) {
                    console.log(response);
                    if (response.success) {
                        window.location=response.url;
                    }
                }
            });
        });

        $(document).on('click', '.submit-reject-btn', function(e) {
            var invite_id = $(this).data('invite-id');
            $.ajax({
                url: base_url + "/team/invite/reject",
                data: {
                    '_token': $('input[name="_token"]').val(),
                    'invite_id':invite_id,
                },
                method: "POST",
                success: function success(response) {
                    console.log(response);
                    if (response.success) {
                        window.location=response.url;
                    }
                }
            });
        });
        

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

        $('#search_freelancer').on('click', function (e) {
            console.log("search button clicked");
            var name = $('#input_search_freelancer').val();
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{ route('team.getFreelancers') }}",
                data: {
                    '_token': $('input[name="_token"]').val(),
                    name: name
                },
                success: function(data) {
                    console.log(data);
                    if (data.success == true) {
                        var html = '';
                        var array = data.userSkills;
                        $('#search_result').empty();
                        $.each(data.users, function(index, item) {
                             html += '<div class=" invite-user-container"> <div class="invite-user-info-content"> <div class="invite-user-profile-img">  <img src="'+ item.profile_image +'" /> </div> <div class="informations"> <p class="mb-0 fw-bold">'+ item.name +'</p> <div class="reviews-txtbx1"> <div class="d-flex justify-content-start"> <div class="ratings-bxleft me-2"> <i class="fa fa-star text-warning"></i> <i class="fa fa-star text-warning"></i> <i class="fa fa-star text-warning"></i> <i class="fa fa-star text-warning"></i> <i class="fa fa-star"></i> </div> <div class="reviews-bx"> <p>4.5 <i>253 Reviews</i></p> </div> </div> </div> <p class="text-reduce">'+ item.about +'</p> </div> </div> <div data-bs-toggle="modal" class="invite-user-btn" data-user-id="' + item.id +'" data-bs-target="#roleMember"> Invite </div> </div>'
                        });
                        $('#search_result').append(html);
                    }
                }
            });
        })
    </script>
@endsection
