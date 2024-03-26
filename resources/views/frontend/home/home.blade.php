@extends('frontend.layouts.app')

@section('content')
    <div class="main-content-bx01" style="padding-top:0;">
        <div class="container">
            <div class="row">
            <div class="col-xl-12">
                <div class="icon-rowbx1">
                    <ul>
                        <li>
                             <a href="{{ route('jobs.index', ['category_id' => 1]) }}">
                                <img src="{{ asset('assets/images/icon-img2.png') }}"> Data & IT
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('jobs.index', ['category_id' => 2]) }}">
                                <img src="{{ asset('assets/images/icon-img1.png') }}"> Bygga & Renovera
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('jobs.index', ['category_id' => 3]) }}">
                                <img src="{{ asset('assets/images/icon-img3.png') }}"> Flytt & Transport
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('jobs.index', ['category_id' => 4]) }}">
                                <img src="{{ asset('assets/images/icon-img4.png') }}"> Mark & Tomt
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('jobs.index', ['category_id' => 5]) }}">
                                <img src="{{ asset('assets/images/icon-img5.png') }}"> Städning
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('jobs.index', ['category_id' => 6]) }}">
                                <img src="{{ asset('assets/images/icon-img6.png') }}"> Foto & Bild
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('jobs.index', ['category_id' => 7]) }}">
                                <img src="{{ asset('assets/images/icon-img7.png') }}"> Marknadsföring
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('jobs.index', ['category_id' => 8]) }}">
                                <img src="{{ asset('assets/images/icon-img8.png') }}"> Övrigt
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        </div>
        <div class="container-fluid">
        <div class="row">
            <div class="col svg-imgbx01">
                <!--<div class="img-svg01"><img src="{{ asset('assets/images/svg-img0012.png') }}"></div>-->
            </div>
            <div class="col-xl-5">
                <div class="form-bx001">
                        <!--<h1>Valkommen till Blocket</h1>-->
                        <form action="{{ route('home.job.search') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="latitude" id="latitude">
                            <input type="hidden" name="longitude" id="longitude">
                            <input type="hidden" name="address" id="address" />
                            <p>Sok</p>
                        <div class="input-group mb-3">
                            <input type="text" name="search" class="form-control form-control-lg"
                                    placeholder="Vad vill du saka efter...">
                            <button type="button" class="input-group-text btn-success">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </div>
                        <p>Valj Plats</p>
                        <div class="form-group range-bx01">
                                <p>0</p>
                                <input type="range" name="radius" value="1" min="1" max="100"
                                    class="form-control-range" id="formControlRange myinput"
                                    oninput="this.nextElementSibling.value = this.value">
                                <output id="output">1</output>
                                <!-- <input type="range" class="form-control-range" id="formControlRange"> -->
                        </div>
                        <div class="form-group sibmit-btn01">
                          <input type="submit" class="subt-btn1" id="formControlRange" value="Hitta annonser">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col svg-imgbx01">
                <!--<div class="img-svg01"><img src="{{ asset('assets/images/svg-img0013.png') }}"></div>-->
            </div>
        </div>
        <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="information-bx1">
                    <h2>Hur det fungerar</h2>
                    <ul>
                        <li>
                            <div class="icon-img1"><img src="{{ asset('assets/images/phone-icon.png') }}"></div>
                            <div class="contentbx001">
                                <h3>Kontakt</h3>
                                <p>
                                    Genom att föra en dialog med en av våra experter får du all information som är
                                                nödvändig för att du ska kunna fatta ett beslut
                                 </p>
                            </div>
                        </li>
                        <li>
                            <div class="icon-img1"><img src="{{ asset('assets/images/hand-shack.png') }}"></div>
                            <div class="contentbx001">
                                <h3>Prisförslag</h3>
                                <p>Du kommer att få ett prisförslag från oss och därefter kommer du kunna fatta ett
                                                beslut. När du har gjort det och godkänt vår offert är vi redo att köra igång</p>
                            </div>
                        </li>
                        <li>
                            <div class="icon-img1"><img src="{{ asset('assets/images/check-icon.png') }}"></div>
                            <div class="contentbx001">
                                <h3>Komma igång</h3>
                                    <p>Det är när du blivit kund hos oss som vi påbörjar samarbetet. Vi kommer göra allt för
                                                att säkerställa att du är en nöjd kund hos oss länge</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--<div class="bottom-img-bx1"><img src="{{ asset('assets/images/footer-img.png') }}"></div>-->
</div>
@endsection
