@extends('Invoicer::layouts.app')

@section('content')

	<div class="card">

		<div class="card-header">
			Welcome to the Invoicer Dashboard
			<span class="float-right"><small>V {{ Config::get('invoicer.version') }}</small></span>
		</div>

		<div class="card-body">
			<div class="row">
				<div class="col-12">
					@include('Invoicer::dashboard.inc.totals')
				</div>
			</div>
			
			<div class="row mt-2">
				<div class="col-xs-12 col-sm-3">
					@include('Invoicer::dashboard.inc.invoices')
				</div>

				<div class="col-xs-12 col-sm-6">
					@include('Invoicer::dashboard.inc.clients')
				</div>

				<div class="col-xs-12 col-sm-3">
					@include('Invoicer::dashboard.inc.products')
				</div>
			</div>
		</div>

	</div>

@endsection
