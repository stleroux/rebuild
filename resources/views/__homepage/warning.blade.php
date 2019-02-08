@auth
	{{-- @if(
		(Auth::user()->profile->first_name == '') OR
		(Auth::user()->profile->last_name == '') OR
		(Auth::user()->profile->telephone == '')) --}}
			<div class="card mb-2">
				<div class="card-header text-white bg-danger">
					<i class="fa fa-exclamation" aria-hidden="true"></i>
					Your user profile is incomplete!
				</div>
				<div class="card-body">
					Please rectify this oversight by clicking <a href="{{-- {{ route('profile', Auth::user()->id) }} --}}">here</a>
				</div>
			</div>
	{{-- @endif --}}
@endauth