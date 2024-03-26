@if(count($faqs) > 0)
    <div class="accordion" id="accordionExample">
        @foreach($faqs as $key => $list)
            <div class="accordion-item">
                <h2 class="accordion-header mb-0" id="question{{$list['id']}}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$list['id']}}" aria-expanded="true" aria-controls="collapse{{$list['id']}}">
                        {{$list['question']}}
                    </button>
                </h2>
                <div id="collapse{{$list['id']}}" class="accordion-collapse collapse @if($key == 0) show @endif" aria-labelledby="question{{$list['id']}}" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        {{$list['answer']}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="job-description">
        <div class="hours-bx1">
            <h5>No FAQs Found</h5>
        </div>
    </div>
@endif
