@extends('layouts.invoicer.app')

@section('content')

	<div class="text-right no-print">
		@if($invoice->status != 'paid')
			@if(checkPerm('invoicer_invoice_edit'))
				<a href="{{ route('invoicer.invoices.edit', $invoice->id) }}" class="btn btn-sm btn-outline-secondary d-print-none">
					<i class="fa fa-edit"></i>
					Edit Invoice
				</a>
			@endif
		@endif
		<button onClick="window.print()" class="btn btn-sm btn-outline-secondary d-print-none">
			<i class="fa fa-print"></i>
			Print this page
		</button>
		<a href="{{ route('invoicer.invoices') }}" class="btn btn-sm btn-primary d-print-none">
			<i class="fa fa-list"></i>
			Invoices List
		</a>
		<br /><br />
	</div>

	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="col-sm-4">
					<h1 class="text-center">INVOICE</h1>
				</div>
				<div class="col-sm-8">
					<div class="col-sm-12">
						<h3 class="text-center">
							{{ Setting('invoicer.companyName') }}
						</h3>
					</div>
					<div class="row">
						<div class="col-sm-12 text-center">
							{{ Setting('invoicer.address_1') . ', ' }}
							{{ (Setting('invoicer.address_2')) ? Setting('invoicer.address_2') . ', ' : '' }}
							{{ (Setting('invoicer.city')) ? Setting('invoicer.city') . ', ' : '' }}
							{{ (Setting('invoicer.state')) ? Setting('invoicer.state') . ', ' : '' }}
							{{ (Setting('invoicer.zip')) ? Setting('invoicer.zip') : '' }}
							<br />
							@if(Setting('invoicer.telephone') && (Setting('invoicer.fax')))
								<i class='fas fa-phone'></i> {{ Setting('invoicer.telephone') }} &nbsp;
								<i class="fas fa-fax"></i> {{ Setting('invoicer.fax') }}
							@elseif(Setting('invoicer.telephone'))
								<i class='fas fa-phone'></i> {{ Setting('invoicer.telephone') }}
							@elseif (Setting('invoicer.fax'))
								<i class="fas fa-fax"></i> {{ Setting('invoicer.fax') }}
							@endif

							<br />
							@if(Setting('invoicer.email') && (Setting('invoicer.website')))
								<i class="fas fa-at"></i> {{ Setting('invoicer.email') }} &nbsp;
								<i class="fas fa-newspaper"></i> {{ Setting('invoicer.website') }}
							@elseif(Setting('invoicer.email'))
								<i class="fas fa-at"></i> {{ Setting('invoicer.email') }}
							@elseif(Setting('invoicer.website'))
								<i class="fas fa-newspaper"></i> {{ Setting('invoicer.website') }}
							@endif

							<br />
							@if(Setting('invoicer.wsibNo') && (Setting('invoicer.hstNo')))
								WSIB N<sup>o</sup>: {{ Setting('invoicer.wsibNo') }} &nbsp;
								HST N<sup>o</sup>: {{ Setting('invoicer.hstNo') }}
							@elseif(Setting('invoicer.wsibNo'))
								WSIB N<sup>o</sup>: {{ Setting('invoicer.wsibNo') }}
							@elseif(Setting('invoicer.hstNo'))
								HST N<sup>o</sup>: {{ Setting('invoicer.hstNo') }}
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="card-body">
			<div class="row">
				<div class="col-sm-12">
					<div class="card">
						<div class="card-header">Invoice Information</div>
						<div class="card-body">
							<div class="row">
								<div class="col-sm-4">
									<div><strong>Billed To</strong></div>
										<div>{{ $invoice->client->company_name }}</div>
										<div>{{ $invoice->client->address }}</div>
										<div>{{ $invoice->client->city }}, {{ $invoice->client->state }}</div>
										<div>{{ $invoice->client->zip }}</div>
								</div>
								<div class="col-sm-3">
									<div><strong>Invoice N<sup>o</sup></strong></div>
									<div>{{ $invoice->id }}</div>
								</div>
								<div class="col-sm-3">
									{{-- <div>&nbsp;</div> --}}
									@if($invoice->invoiced_at)
										<div><strong>Invoiced</strong></div>
										<div>{{ $invoice->invoiced_at->format('M d, Y') }}</div>
									@else
										<div><strong>Logged</strong></div>
										<div>{{ $invoice->created_at->format('M d, Y') }}</div>
									@endif
								</div>
								<div class="col-sm-2">
									<div><strong>Paid</strong></div>
										<div>{{ ($invoice->paid_at ? $invoice->paid_at->format('M d, Y') : 'N/A') }}</div>
								</div>
							</div>
							@if($invoice->work_description)
								<div class="row">
									<div class="col-sm-12">
										<div class="text-muted">Work Description</div>
										<div class="table" style="padding: 10px">{{ $invoice->work_description }}</div>
									</div>
								</div>
							@endif
						</div>
					</div>
				</div>
			</div>

			<br />

			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">Billable Items</div>
						{{-- <div class="card-body"> --}}
						@if($invoice->invoiceItems->count() > 0)
							<table class="table table-sm table-striped">
								<thead>
									<tr>
										{{-- <th>ID</th> --}}
										<th>Product</th>
										<th nowrap="nowrap">Work Date</th>
										<th>Notes</th>
										<th class="text-center">Quantity</th>
										<th class="text-right">Price</th>
										<th class="text-right">Amount</th>
									</tr>
								</thead>
								<tbody>
									@foreach($invoice->invoiceItems->sortByDesc('work_date') as $item)
										<tr>
											<td>{{ $item->product->details }}</td>
											<td nowrap="nowrap">{{ $item->work_date->format('M d, Y') }}</td>
											<td>{!! nl2br(e($item->notes)) !!}</td>
											<td class="text-center" nowrap="nowrap">{{ $item->quantity }}</td>
											<td class="text-right" nowrap="nowrap">{{ number_format($item->price, 2, '.', ' ') }}$</td>
											<td class="text-right" nowrap="nowrap">{{ number_format($item->total, 2, '.', ' ') }}$</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						@else
							<div class="card-body">
								No related billable items found.
							</div>
						@endif
						{{-- </div> --}}
					</div>
				</div>
			</div>

			<br />
			
			<div class="col-sm-12">
				<div class="row">
					<div class="card w-75">
						{{ Setting('invoicer.termsAndConditions') }}
					</div>
					<div class="card w-25 border-0">
						{{-- <div class="col-sm-2 text-right"> --}}
							<div class="row">
								<div class="col-sm-6 text-right">
									<b>SubTotal</b>
								</div>
								<div class="col-sm-6">
									<span class="float-right">{{ ($invoice->amount_charged ? number_format($invoice->amount_charged, 2, '.', ' ') : '0.00') }}$</span>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6 text-right">
									<b>HST</b>
								</div>
								<div class="col-sm-6">
									<span class="float-right">{{ number_format($invoice->hst, 2, '.', ' ') }}$</span>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6 text-right">
									<strong>Total</strong>
								</div>
								<div class="col-sm-6">
									<span class="float-right">{{ number_format($invoice->sub_total, 2, '.', ' ') }}$</span>
								</div>
							</div>
						{{-- </div> --}}
					</div>
				</div>
			</div>

		</div>
{{-- 			<div class="card border-0">
				<div class="row">
					<div class="col-sm-10 text-right">
						<b>SubTotal</b>
					</div>
					<div class="col-sm-2">
						<span class="pull-right">{{ ($invoice->amount_charged ? number_format($invoice->amount_charged, 2, '.', ' ') : '0.00') }}$</span>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-10 text-right">
						<b>HST</b>
					</div>
					<div class="col-sm-2">
						<span class="pull-right">{{ number_format($invoice->hst, 2, '.', ' ') }}$</span>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-10 text-right">
						<strong>Total</strong>
					</div>
					<div class="col-sm-2">
						<span class="pull-right">{{ number_format($invoice->sub_total, 2, '.', ' ') }}$</span>
					</div>
				</div>
			</div> --}}
			
		</div>
{{-- 		<div class="card-footer">
			{!! Config::get('invoicer.termsAndConditions') !!}
		</div> --}}
	</div>

@endsection
				