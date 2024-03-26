@extends('frontend.layouts.app')

@section('content')

    <div class="main-content-bx01 bg-colorbx">
        <div class="container">
            <div class="row">
                <div class="profile-title">
                    <h1 style="color:#fff;">Profile</h1>
                </div>
            </div>
            <div class="row ">
                <div class="profile-viewbx1">
                    <div class="profile-header1"><img id="cover_image" src="{{ auth()->user()->cover_image }}" />

                    </div>
                    <div class="row prfile-imgrow">
                        <div class="col-xl-2 col-lg-2 ">
                            <div class="profile-img"><img src="{{ auth()->user()->profile_image }}"></div>
                        </div>
                        <div class="col-xl-5 col-lg-5 alignverticle-colbx1">
                            <div class="profile-detailbx">
                                <h4>{{ auth()->user()->name }} <div class="online" id="profile-online"></div></h4>
                                <p>
                                    Last online {{ auth()->user()->last_login }}<br>
                                    {{ auth()->user()->user_address }}<br>
                                    Member since {{ auth()->user()->created }}
                                </p>
                                {{-- <a href="#">Send Message</a> --}}
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5">
                            <div class="profile-menubx1">
                                <ul>
                                    <li class="envalop-icon"><a href="#">Email Verified</a></li>
                                    <li class="phone-icon"><a href="#">Phone Verified</a></li>
                                    <li class="user-icon"><a href="#">Identity Verified</a></li>
                                    <li class="payment-icon"><a href="#">Payment Verified</a></li>
                                    <li class="portfolio-icon test"><a href="{{ route('portfolio.index') }}">Portfolio (5)</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row prfile-exprow">

                        <div class="col-xl-7 col-lg-7">
                            <div class="profile-content-bx1">
                                <h3 class="exp01 about-icon1">About:</h3>
                                <p>{{ auth()->user()->about}}</p>
                            </div>
                            <div class="profile-content-bx1">
                                <h3 class="exp01">Experience:</h3>
                                <ul>
                                    @if (count($userSkills) > 0)
                                        @foreach ($userSkills as $skills)
                                            <li>
                                                <a href="#">{{ $skills->getSkills->name }}</a>
                                            </li>
                                        @endforeach
                                    @else
                                        No Skills Added
                                    @endif
                                    {{-- <a href="#" class="seemore-btn">See more</a> --}}
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5">
                            <div id='wrap' class="mt-2 mb-4 calendar-wrapbx1">
                                <h3>Check {{ auth()->user()->name }} Availability</h3>
                                <div id='calendar'></div>
                                <div style='clear:both'></div>
                            </div>
                        </div>
                        <div class="col-xl-2"></div>
                    </div>
                    <div class="row profile-review-bx1 prfile-exprow">
                        <div class="col-xl-12">
                            <div class="reviews-alignbx1">
                                <h4>Reviews</h4>
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
                        </div>
                    </div>
                    <!--<div class="row prfile-exprow" style="margin-top: 0;">-->
                    <!--    <div class="reviews-alignbx2">-->
                    <!--        <h4>Portfolio over completed Job</h4>-->
                    <!--        <ul>-->
                    <!--            <li>-->
                    <!--                <a href="#">-->
                    <!--                    <h5>Project Name</h5>-->
                    <!--                    <div class="project-img1"><img src="{{ asset('assets/images/project-img1.png') }}">-->
                    <!--                    </div>-->
                    <!--                </a>-->
                    <!--            </li>-->
                    <!--            <li>-->
                    <!--                <a href="#">-->
                    <!--                    <h5>Project Name</h5>-->
                    <!--                    <div class="project-img1"><img src="{{ asset('assets/images/project-img1.png') }}">-->
                    <!--                    </div>-->
                    <!--                </a>-->
                    <!--            </li>-->
                    <!--            <li>-->
                    <!--                <a href="#">-->
                    <!--                    <h5>Project Name</h5>-->
                    <!--                    <div class="project-img1"><img src="{{ asset('assets/images/project-img1.png') }}">-->
                    <!--                    </div>-->
                    <!--                </a>-->
                    <!--            </li>-->
                    <!--            <li>-->
                    <!--                <a href="#">-->
                    <!--                    <h5>Project Name</h5>-->
                    <!--                    <div class="project-img1"><img src="{{ asset('assets/images/project-img1.png') }}">-->
                    <!--                    </div>-->
                    <!--                </a>-->
                    <!--            </li>-->
                    <!--        </ul>-->
                    <!--        <a href="#" class="load-morebtn">Load more</a>-->
                    <!--        <div class="seeallrevewsbx">-->
                    <!--            <a href="#">See all revews <i class="fa fa-angle-right" aria-hidden="true"></i></a>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade hire_me" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog madeoferopup">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Hire Me</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-bx001">
                        <h1>Hire Me:</h1>
                        <form action="#" method="post">
                            @csrf
                            <input type="hidden" name="post_id" value="">
                            <input type="hidden" name="user_id" value="">
                            <div class="row form-group">
                                <div class="col-xs-12">
                                    <label class="col-xs-4" for="title">Wants to Hire</label>
                                    <input class="form-control" type="text" name="title" id="title" />
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xs-12">
                                    <label class="col-xs-4" for="starts-at">Starts at</label>
                                    <input type="date" name="starts_at" id="starts-at"
                                        class="form-control form-control-lg datepicker" min="12/29/2022"
                                        placeholder="Date">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xs-12">
                                    <label class="col-xs-4" for="ends-at">Ends at</label>
                                    <input type="date" name="ends_at" id="ends-at"
                                        class="form-control form-control-lg datepicker" min="12/29/2022"
                                        placeholder="Date">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xs-12">
                                    <label class="col-xs-4" for="ends-at">Description</label>
                                    <textarea class="form-control" name="description" rows="5" id="description" placeholder="Write here......"></textarea>
                                </div>
                            </div>

                            <div class="modal-footer sibmit-btn01 sibmit-btnModal">
                                <input type="button" class="btn btn-secondary btn-close1"data-bs-dismiss="modal"
                                    aria-label="Close" value="Close">
                                <input type="submit" class="subt-btn1" id="save-event" value="Hire">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
    </script>
@endsection
