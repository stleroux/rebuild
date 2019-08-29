<div class="text-center">

	@if ($message = Session::get('primary'))
		<div class="bg-primary text-light py-0" id="success-alert">{{ $message }}</div>
		<div class="py-0" id="success-empty"><br /></div>
	
	@elseif ($message = Session::get('secondary'))
		<div class="bg-secondary text-dark py-0" id="success-alert">{{ $message }}</div>
		<div class="py-0" id="success-empty"><br /></div>

	@elseif ($message = Session::get('success'))
		<div class="bg-success text-dark py-0" id="success-alert">{{ $message }}</div>
		<div class="py-0" id="success-empty"><br /></div>
	
	@elseif ($message = Session::get('danger'))
		<div class="bg-danger text-dark py-0" id="success-alert">{{ $message }}</div>
		<div class="py-0" id="success-empty"><br /></div>

	@elseif ($message = Session::get('warning'))
		<div class="bg-warning text-dark py-0" id="success-alert">{{ $message }}</div>
		<div class="py-0" id="success-empty"><br /></div>

	@elseif ($message = Session::get('info'))
		<div class="bg-info text-dark py-0" id="success-alert">{{ $message }}</div>
		<div class="py-0" id="success-empty"><br /></div>

	{{-- @elseif ($errors->any())
		@foreach ($errors->all() as $error)
			<div class="bg-danger text-dark py-0" id="success-alert">{{ $error }}</div>
			<div class="py-0" id="success-empty"><br /></div>
		@endforeach --}}
	
	@else
		<div class="px-0 mx-0"><br /></div>
	@endif

{{-- @if ($errors->any())
        {{ implode('', $errors->all('<div class="bg-danger text-dark py-0" id="success-alert">:message</div>')) }}
@endif --}}


</div>