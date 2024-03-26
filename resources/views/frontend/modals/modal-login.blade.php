    <!-- Modal -->
    <div class="modal fade login-modal" id="LoginModaldrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="LoginModalLabel" aria-hidden="true">
        <div class="modal-dialog madeoferopup">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-bx001">
                        <h1>Login</h1>
                        <form method="post" action="{{ route('auth.login.process.modal') }}">
                            @csrf
                            <p>Mejl</p>
                            <div class="form-group mb-3">
                                <input type="email" name="email" class="form-control form-control-lg"
                                    placeholder="Enter your email" id="email1">
                            </div>
                            <p>Losenord</p>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-control-lg"
                                    id="pasword11" placeholder="Enter your Password">
                            </div>
                            <div class="form-group sibmit-btn01">
                                <input type="submit" class="subt-btn1" id="formControlRange" value="Hitta annonser">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
