@extends('invoicer::layouts.app')

@section('content')

	<div class="card">
		<div class="card-header">
			Welcome to the Invoicer
			<span class="float-right"><small>V {{ Config::get('invoicer.version') }}</small></span>
		</div>
		<div class="card-body">
			<h5 class="card-title"></h5>
			<p class="card-text">
				This will be the main user page.<br />
				No special access will be required to access this page.
			</p>
		</div>
	</div>

@endsection
