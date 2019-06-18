@extends('layouts.invoicer.app')

@section('content')

	<div class="card">

		<div class="card-header">
			<span class="h3">Dashboard</span>
			<span class="float-right">
				<small>V {{ Setting('invoicer.version') }}</small>
			</span>
		</div>

		<div class="card-body">
			<div class="row">
				<div class="col-12">
					@include('invoicer.dashboard.inc.totals')
				</div>
			</div>
			
			<div class="row mt-2">
				<div class="col-xs-12 col-sm-3">
					@include('invoicer.dashboard.inc.invoices')
				</div>

				<div class="col-xs-12 col-sm-6">
					@include('invoicer.dashboard.inc.clients')
				</div>

				<div class="col-xs-12 col-sm-3">
					@include('invoicer.dashboard.inc.products')
				</div>
			</div>
		</div>

	</div>

@endsection
