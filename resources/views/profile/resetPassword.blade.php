@extends('layouts.master')

@section ('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@stop 

@section('left_column')
	{{-- @include('blocks.main_menu') --}}
@endsection

@section('right_column')
	   @include('blocks.member')
@endsection

@section('content')
<form method="POST" action="{{ route('resetPassword.update', $user->id) }}">
	@method('PUT')
   @csrf

	<div class="col">
		<div class="card mb-2">
			<div class="card-header section_header p-2">
				<i class="fas fa-user-lock"></i>
				Reset My Password
				<span class="float-right">
					<div class="btn-group">
						{{ Form::button('<i class="fa fa-save"></i> Reset Password', array('type'=>'submit', 'class'=>'btn btn-xs btn-primary')) }}
					</div>
				</span>
			</div>

			<div class="card-body section_body p-2">
				<div class="row">
					<div class="col-xs-12 col-sm-4">
						<div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
							<label for="current-password" class="required">Current Password</label>
								<input id="current-password" type="password" class="form-control form-control-sm" name="current-password" autofocus="autofocus">
								{{-- @if ($errors->has('current-password')) --}}
									{{-- <span class="text-danger">
										<strong>{{ $errors->first('current-password') }}</strong>
									</span> --}}
									{{-- {{ Session::flash ('danger', 'Current password is required!') }} --}}
								{{-- @endif --}}
						</div>

						<div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
							<label for="new-password" class="required">New Password</label>
								<input id="new-password" type="password" class="form-control form-control-sm" name="new-password">
								{{-- @if ($errors->has('new-password'))
									<span class="help-block">
										<strong>{{ $errors->first('new-password') }}</strong>
									</span>
								@endif --}}
						</div>

						<div class="form-group">
							<label for="new-password-confirm" class="required">Confirm New Password</label>
								<input id="new-password-confirm" type="password" class="form-control form-control-sm" name="new-password_confirmation">
						</div>
					</div>
				</div>
			</div>

			<!-- CARD FOOTER -->
         <div class="card-footer pt-1 pb-1 pl-2">
            Fields marked with an <span class="required"></span> are required
         </div>

		</div>
	</div>
</form>
@endsection

@section('scripts')
{{-- 	<script>
		//redirect to specific tab
		$(document).ready(function () {
			$('#tabMenu a[href="#{{ old('tab') }}"]').tab('show')
		});
	</script> --}}
@endsection
