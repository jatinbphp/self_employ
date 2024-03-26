@extends('frontend.layouts.app')

@section('content')
<div class="main-content-bx01 login-page">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				<div class="form-bx001">
					<h1>Tack</h1>
                    <p>Dear {{ $email }}</p>
                    <p>Email has been sent on your account please check and reset your password</p>
                    <p>If you remember your password click Logga in to login</p>

                    <a href="{{ route('auth.login.showform') }}">Logga in</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
