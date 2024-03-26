@extends('frontend.layouts.app')

@section('content')
<div class="main-content-bx01">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="form-bx001">
                    <h1>Valkommen till Blocket</h1>
                    <form action="{{route('home.job.search')}}" class="" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">
                        <input type="hidden" name="address" id="address" />
                        <p>Sok</p>
                        <div class="input-group mb-3">
                            <input type="text" name="search" class="form-control form-control-lg" placeholder="Vad vill du saka efter...">
                            <button type="button" class="input-group-text btn-success"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                        <p>Valj Plats</p>
                        <div class="form-group range-bx01">
                            <p>0</p>
                            <input type="range" name="radius" value="1" min="1" max="100"  class="form-control-range" id="formControlRange myinput" oninput="this.nextElementSibling.value = this.value">
                            <output id="output">1</output>
                            <!-- <input type="range" class="form-control-range" id="formControlRange"> -->
                        </div>
                        <div class="form-group sibmit-btn01">
                            <input type="submit" class="subt-btn1" id="formControlRange" value="Hitta annonser">
                        </div>
                    </form>
                </div>
                <div class="information-bx1">
                    <h2>Hur det fungerar</h2>
                    <ul>
                        <li>
                            <div class="icon-img1"><img src="{{asset('assets/images/phone-icon.png')}}"></div>
                            <div class="contentbx001">
                                <h3>Kontakt</h3>
                                <p>Genom att föra en dialog med en av våra experter får du all information som är nödvändig för att du ska kunna fatta ett beslut</p>
                            </div>
                        </li>
                        <li>
                            <div class="icon-img1"><img src="{{asset('assets/images/hand-shack.png')}}"></div>
                            <div class="contentbx001">
                                <h3>Prisförslag</h3>
                                <p>Du kommer att få ett prisförslag från oss och därefter kommer du kunna fatta ett beslut. När du har gjort det och godkänt vår offert är vi redo att köra igång</p>
                            </div>
                        </li>
                        <li>
                            <div class="icon-img1"><img src="{{asset('assets/images/check-icon.png')}}"></div>
                            <div class="contentbx001">
                                <h3>Komma igång</h3>
                                <p>Det är när du blivit kund hos oss som vi påbörjar samarbetet. Vi kommer göra allt för att säkerställa att du är en nöjd kund hos oss länge</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-img-bx1"><img src="{{asset('assets/images/footer-img.png')}}"></div>
</div>

@endsection
