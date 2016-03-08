@extends('app')

@section('title')
	Register User
@endsection

@section('content')
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<form method="post" action='{{ url("/auth/register") }}'>
				{!! csrf_field() !!}
				<div class="form-group">
					<label for="name">Name:</label>
					<input type="text" class="form-control" id="name" name="name" value="" placeholder="Fullname">
				</div>
				<div class="form-group">
					<label for="email">Email:</label>
					<input type="email" class="form-control" id="email" name="email" value="" placeholder="Email">
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input type="password" class="form-control" id="password" name="password" placeholder="Password">
				</div>
				<div class="form-group">
					<label for="password_confirmation">Confirm Password:</label>
					<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
				</div>

				<input type="submit" name="submit" value="Register" class="btn btn-block btn-success" />
			</form>
		</div>
	</div>
@endsection