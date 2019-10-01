@extends('layouts.invoicer.app')

@section('content')

{{-- <div class="card text-right border-0">
	<div class="col-xs-12">
		<a href="{{ route('invoicer.ledger') }}" class="btn btn-sm {{ (Request::is('invoicer/ledger') ? 'btn-outline-info' : 'btn-outline-default') }}">All</a>
		<a href="{{ route('invoicer.ledger') }}" class="btn btn-sm nav-tabs">All</a>
		<a href="{{ route('invoicer.ledger.logged') }}" class="btn btn-sm {{ (Request::is('invoicer/ledger/logged') ? 'btn-outline-info' : 'btn-outline-default') }}">Logged</a>
		<a href="{{ route('invoicer.ledger.logged') }}" class="btn btn-sm nav-tabs">Logged</a>
		<a href="{{ route('invoicer.ledger.invoiced') }}" class="btn btn-sm {{ (Request::is('invoicer/ledger/invoiced') ? 'btn-outline-info' : 'btn-outline-default') }}">Invoiced</a>
		<a href="{{ route('invoicer.ledger.paid') }}" class="btn btn-sm {{ (Request::is('invoicer/ledger/paid') ? 'btn-outline-info' : 'btn-outline-default') }}">Paid</a>
	</div>
</div> --}}

	<ul class="nav nav-tabs justify-content-end">
		<li class="nav-item">
			<a class="nav-link {{ (Request::is('invoicer/ledger') ? 'active' : '') }}" href="{{ route('invoicer.ledger') }}">
				<i class="fas fa-list"></i>
				All
				<span class="badge badge-info text-right">{{ App\Models\Invoicer\Invoice::all()->count() }}</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link {{ (Request::is('invoicer/ledger/logged') ? 'active' : '') }}" href="{{ route('invoicer.ledger.logged') }}">
				<i class="fas fa-sign-out-alt"></i>
				Logged
				<span class="badge badge-info text-right">{{ App\Models\Invoicer\Invoice::where('status', 'logged')->count() }}</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link {{ (Request::is('invoicer/ledger/invoiced') ? 'active' : '') }}" href="{{ route('invoicer.ledger.invoiced') }}">
				<i class="far fa-file-alt"></i>
				Invoiced
				<span class="badge badge-info text-right">{{ App\Models\Invoicer\Invoice::where('status', 'invoiced')->count() }}</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link {{ (Request::is('invoicer/ledger/paid') ? 'active' : '') }}" href="{{ route('invoicer.ledger.paid') }}">
				<i class="far fa-money-bill-alt"></i>
				Paid
				<span class="badge badge-info text-right">{{ App\Models\Invoicer\Invoice::where('status', 'paid')->count() }}</span>
			</a>
		</li>
	</ul>
					


	<div class="card">
		<div class="card-header">
			<span class="h3">Ledger
				{{ (Request::is('invoicer/ledger/logged') ? '- Logged':'') }}
				{{ (Request::is('invoicer/ledger/invoiced') ? '- Invoiced':'') }}
				{{ (Request::is('invoicer/ledger/paid') ? '- Paid':'') }}
			</span>
		</div>
		{{-- <div class="card-body"> --}}
			@if($invoices->count() > 0)
				<table class="table table-hover table-stripped table-sm">
					<thead>
						<tr>
							<th>@sortablelink('id','Inv #')</th>
							@if(Request::is('invoicer/ledger/logged'))
								<th>@sortablelink('created_at','Logged Date')</th>
							@endif
							@if(Request::is('invoicer/ledger/invoiced'))
								<th>@sortablelink('invoiced_at','Invoiced Date')</th>
							@endif
							@if(Request::is('invoicer/ledger/paid'))
								<th>@sortablelink('paidd_at','Paid Date')</th>
							@endif
							@if(Request::is('invoicer/ledger'))
								<th>@sortablelink('status','Status')</th>
							@endif
							<th>@sortablelink('client.company_name','Company Name')</th>
							<th class="text-right">@sortablelink('amount_charged','Charge')</th>
							<th class="text-right">@sortablelink('hst','HST')</th>
							<th class="text-right" title="SubTotal">@sortablelink('sub_total','SUB')</th>
							<th class="text-right">@sortablelink('wsib','WSIB')</th>
							<th class="text-right" title="Income Taxes">@sortablelink('income_taxes','IT')</th>
							<th class="text-right" title="Total Deductions">@sortablelink('total_deductions','DED')</th>
							<th class="text-right">@sortablelink('total','NET')</th>
						</tr>
					</thead>
					<tfoot>
						<tr class="info">
							<td colspan="3" class="text-right"><b>Totals This Page :&nbsp;</b></td>
							<td class="text-right">{{ number_format($invoices->sum('amount_charged'), 2, '.', ', ') }}$</td>
							<td class="text-right">{{ number_format($invoices->sum('hst'), 2, '.', ', ') }}$</td>
							<td class="text-right">{{ number_format($invoices->sum('sub_total'), 2, '.', ', ') }}$</td>
							<td class="text-right">{{ number_format($invoices->sum('wsib'), 2, '.', ', ') }}$</td>
							<td class="text-right">{{ number_format($invoices->sum('income_taxes'), 2, '.', ', ') }}$</td>
							<td class="text-right">{{ number_format($invoices->sum('total_deductions'), 2, '.', ', ') }}$</td>
							<td class="text-right">{{ number_format($invoices->sum('total'), 2, '.', ', ') }}$</td>
						</tr>
						<tr class="info">
							<td colspan="3" class="text-right"><b>Overall Totals :&nbsp;</b></td>
							<td class="text-right">{{ number_format($totalAmountCharged, 2, '.', ', ') }}$</td>
							<td class="text-right">{{ number_format($totalHST, 2, '.', ', ') }}$</td>
							<td class="text-right">{{ number_format($totalSubTotal, 2, '.', ', ') }}$</td>
							<td class="text-right">{{ number_format($totalWSIB, 2, '.', ', ') }}$</td>
							<td class="text-right">{{ number_format($totalIncomeTaxes, 2, '.', ', ') }}$</td>
							<td class="text-right">{{ number_format($totalTotalDeductions, 2, '.', ', ') }}$</td>
							<td class="text-right">{{ number_format($totalTotal, 2, '.', ', ') }}$</td>
						</tr>
					</tfoot>
					<tbody>
						@foreach($invoices as $invoice)
						<tr>
							<td>
								{{-- <a href="{{ route('invoicer.invoices.show', $invoice->id) }}"> --}}{{ $invoice->id }}
							</td>
							
							@if(Request::is('invoicer/ledger/logged'))
								<td>{{ $invoice->created_at->format('M d Y') }}</td>
							@endif
							@if(Request::is('invoicer/ledger/invoiced'))
								<td>{{ $invoice->invoiced_at->format('M d Y') ?? '' }}</td>
							@endif
							@if(Request::is('invoicer/ledger/paid'))
								<td>{{ $invoice->paid_at->format('M d Y') }}</td>
							@endif
							@if(Request::is('invoicer/ledger'))
								<td>
									@if($invoice->status === 'logged')
										<span class="badge badge-info" style="font-size: 13px">{{ ucfirst($invoice->status) }}</span>
									@elseif($invoice->status === 'invoiced')
										<span class="badge badge-warning" style="font-size: 13px">{{ ucfirst($invoice->status) }}</span>
									@else($invoice->status === 'paid')
										<span class="badge badge-success" style="font-size: 13px">{{ ucfirst($invoice->status) }}</span>
									@endif
								</td>
							@endif
							<td>
								<a href="{{ route('invoicer.clients.show', $invoice->user_id) }}">{{ $invoice->user->company_name }}</a>
							</td>
							<td class="text-right">{{ number_format($invoice->amount_charged, 2, '.' , ', ') }}$</td>
							<td class="text-right">{{ number_format($invoice->hst, 2, '.' , ', ') }}$</td>
							<td class="text-right">{{ number_format($invoice->sub_total, 2, '.', ', ') }}$</td>
							<td class="text-right">{{ number_format($invoice->wsib, 2, '.' , ', ') }}$</td>
							<td class="text-right">{{ number_format($invoice->income_taxes, 2, '.' , ', ') }}$</td>
							<td class="text-right">{{ number_format($invoice->total_deductions, 2, '.' , ', ') }}$</td>
							<td class="text-right">{{ number_format($invoice->total, 2, '.' , ', ') }}$</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			@else
				<div class="card-body">
					No records found in the system.
				</div>
			@endif
		{{-- </div> --}}

		@if($invoices->count() > 0)
			<div class="card-footer">
				<div class="row">
					<div class="col-xs-6 text-left">
						Showing records {{ $invoices->firstItem() }} to {{ $invoices->lastItem() }} of {{ $invoices->total() }}
					</div>
					<div class="col-xs-6 text-right">
						{!! $invoices->appends(request()->except('page'))->render() !!}
					</div>
				</div>
			</div>
		@endif
	</div>

@endsection
