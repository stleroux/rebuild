@auth
{{-- @if(checkACL('user')) --}}
	<div class="card mb-3">
		
		<div class="card-header block_header p-2">
			<i class="fa fa-comment" aria-hidden="true"></i>
			Leave a comment
		</div>
		
		<div class="card-body p-2">
			{{ Form::open(['route' => ['recipes.storeComment', $recipe->id], 'method' => 'POST']) }}
{{-- 			<div class="row">
				<div class="col-xs-12">
					<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
						{{ Form::label('name', "Name:") }}
						@if(Auth::check())
							{{ Form::text('name', Auth::user()->username, ['class' => 'form-control', 'readonly'=>'readonly']) }}
						@else
							{{ Form::text('name', null, ['class' => 'form-control']) }}
						@endif
						<span class="text-danger">{{ $errors->first('name') }}</span>
					</div>
				</div>
			</div> --}}
{{-- 			<div class="row">
				<div class="col-md-12">
					<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
						{{ Form::label('email', 'Email:') }}
						@if(Auth::check())
							{{ Form::text('email', Auth::user()->email, ['class' => 'form-control', 'readonly'=>'readonly']) }}
						@else
							{{ Form::text('email', null, ['class' => 'form-control']) }}
						@endif
						<span class="text-danger">{{ $errors->first('email') }}</span>
					</div>
				</div>
			</div> --}}
			<div class="row">
				<div class="col-md-12">
					<div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}">
						{{-- {{ Form::label('comment', "Comment:") }} --}}
						{{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5']) }}
						<span class="text-danger">{{ $errors->first('comment') }}</span>
				</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					{{-- {{ Form::submit('Add Comment', ['class' => 'btn btn-success btn-block', 'style' => 'margin-top:15px;']) }} --}}
					{{ Form::button('<i class="fa fa-plus-circle"></i> Add Comment', ['type' => 'submit', 'class' => 'btn btn-sm btn-success btn-block'] )  }}
				</div>
			</div>
			{{ Form::close() }}
		</div>

		<div class="card-footer p-1">
			Be a sport and keep your comments clean, otherwise they will be removed and you risk being banned from the site.
		</div>
		
	</div>
{{-- @endif --}}
@endauth