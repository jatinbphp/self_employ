<footer>
    <div class="footer-bx01">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="footer-nav01">
                        <ul>
                            <li>
                                <a class="{{(request()->route()->uri) == 'contact' ? 'active':''}}" href="{{route('page.contact')}}">Kontakt</a>
                            </li>
                            <li>
                                <a class="{{(request()->route()->uri) == 'about' ? 'active':''}}" href="{{route('page.about')}}">Om Oss</a>
                            </li>
                            <li>
                                <a class="{{(request()->route()->uri) == 'terms' ? 'active':''}}" href="{{route('page.terms')}}">Villkor</a>
                            </li>
                            <li>
                                <a class="{{(request()->route()->uri) == 'faqs' ? 'active':''}}" href="{{route('page.faqs')}}">FAQ</a>
                            </li>
                            @auth
                            <li>
                                <a class="{{(request()->route()->uri) == 'chat' ? 'active':''}}" href="{{route('chat.users')}}">Chat</a>
                            </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
