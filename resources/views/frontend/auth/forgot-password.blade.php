@extends('frontend.layouts.app')

@section('content')
<div class="main-content-bx01 login-page">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				<div class="form-bx001">
					<h1>Återställ ditt lösenord.</h1>
					@foreach ($errors->all() as $error)
					@endforeach
					<form class="needs-validation" method="post" action="{{route('auth.forgot.pass.process')}}" novalidate="">
						@csrf
						<p>E-Postadress</p>
						<div class="input-group mb-3">
							<input type="email" name="email" class="form-control form-control-lg  {{$errors->has('email') ? 'is-invalid' : ''}}" placeholder="Ange din e-postadress" value="{{old('email')}}">
							@error('email')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
							@enderror
						</div>
						<div class="form-group sibmit-btn01">
							<input type="submit" class="subt-btn1" id="formControlRange" value="Hitta annonser">
						</div>
						<div class="forget-passbx01">
							<ul>
								<li><a href="{{ route('auth.login.showform') }}">Logga in</a></li>
								{{-- <li>
									<a href="#">
										<div class="bankid-img"><img src="{{asset('assets/images/bankid.png')}}"></div>
										Create Account
									</a>
								</li> --}}
							</ul>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
