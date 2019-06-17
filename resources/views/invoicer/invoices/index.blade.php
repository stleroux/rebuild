@extends('layouts.invoicer.app')

@section('content')

	<ul class="nav nav-tabs justify-content-end">
		<li class="nav-item">
			<a class="nav-link {{ (Request::is('invoicer/invoices') ? 'active' : '') }}" href="{{ route('invoicer.invoices') }}">
				<i class="fas fa-list"></i>
				All
				<span class="badge badge-info">{{ App\Models\Invoicer\Invoice::all()->count() }}</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link {{ (Request::is('invoicer/invoices/logged') ? 'active' : '') }}" href="{{ route('invoices.logged') }}">
				<i class="fas fa-sign-out-alt"></i>
				Logged
				<span class="badge badge-info text-right">{{ App\Models\Invoicer\Invoice::where('status', 'logged')->count() }}</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link {{ (Request::is('invoicer/invoices/invoiced') ? 'active' : '') }}" href="{{ route('invoices.invoiced') }}">
				<i class="far fa-file-alt"></i>
				Invoiced
				<span class="badge badge-info text-right">{{ App\Models\Invoicer\Invoice::where('status', 'invoiced')->count() }}</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link {{ (Request::is('invoicer/invoices/paid') ? 'active' : '') }}" href="{{ route('invoices.paid') }}">
				<i class="far fa-money-bill-alt"></i>
				Paid
				<span class="badge badge-info text-right">{{ App\Models\Invoicer\Invoice::where('status', 'paid')->count() }}</span>
			</a>
		</li>
	</ul>

	<div class="card">
		<div class="card-header">
			
			<span class="h3">Invoices
				{{ (Request::is('invoicer/invoices/logged') ? '- Logged':'') }}
				{{ (Request::is('invoicer/invoices/invoiced') ? '- Invoiced':'') }}
				{{ (Request::is('invoicer/invoices/paid') ? '- Paid':'') }}
			</span>
			
			<span class="float-right">
				@if(checkPerm('invoicer_invoice_edit'))
					@if(Request::is('invoicer/invoices/logged'))
						<a href="{{ route('invoices.status_invoiced_all') }}" class="btn btn-sm btn-outline-primary">
							<i class="far fa-file-alt"></i>
							Mark All as Invoiced
						</a>
					@endif
					@if(Request::is('invoicer/invoices/invoiced'))
						<a href="{{ route('invoices.status_paid_all') }}" class="btn btn-sm btn-outline-primary">
							<i class="far fa-money-bill-alt"></i>
							Mark All as Paid
						</a>
					@endif
				@endif

				@if(checkPerm('invoicer_invoice_create'))
					<a href="{{ route('invoicer.invoices.create') }}" class="btn btn-sm btn-secondary">
						<i class="far fa-plus-square"></i>
						Add New Invoice
					</a>
				@endif
			</span>
		</div>
		{{-- <div class="card-body"> --}}
			@if($invoices->count() > 0)
				<table id="" class="table table-hover table-stripped table-sm">
					<thead>
						<tr>
							<th>@sortablelink('id','Invoice #') </th>
							@if(Request::is('invoicer/invoices/logged'))
								<th>@sortablelink('created_at','Logged Date')</th>
							@endif
							@if(Request::is('invoicer/invoices/invoiced'))
								<th>@sortablelink('invoiced_at','Invoiced Date')</th>
							@endif
							@if(Request::is('invoicer/invoices/paid'))
								<th>@sortablelink('paidd_at','Paid Date')</th>
							@endif
							@if(Request::is('invoicer/invoices'))
								<th>@sortablelink('status','Status')</th>
							@endif
							<th>@sortablelink('client.company_name','Company Name')</th>
							<th class="text-right">@sortablelink('amount_charged','Charged')</th>
							<th class="text-right">@sortablelink('total','Net Total')</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($invoices as $invoice)
						<tr>
							<td>{{ $invoice->id }}</td>
							@if(Request::is('invoicer/invoices/logged'))
								<td>{{ $invoice->created_at->format('M d Y') }}</td>
							@endif
							@if(Request::is('invoicer/invoices/invoiced'))
								<td>{{ $invoice->invoiced_at->format('M d Y') }}</td>
							@endif
							@if(Request::is('invoicer/invoices/paid'))
								<td>{{ $invoice->paid_at->format('M d Y') }}</td>
							@endif
							@if(Request::is('invoicer/invoices'))
								<td>{{ ucfirst($invoice->status) }}</td>
							@endif
							<td><a href="{{ route('invoicer.clients.show', $invoice->client->id) }}">{{ $invoice->client->company_name }}</a></td>
							<td class="text-right">{{ number_format($invoice->sub_total, 2, '.', ', ') }}$</td>
							<td class="text-right">{{ number_format($invoice->total, 2, '.', ', ') }}$</td>
							<td>
								<form action="{{ route('invoicer.invoices.destroy',[$invoice->id]) }}" method="POST" 
									onsubmit="return confirm('Do you really want to delete this invoice?');"
									class="float-right">
									{{ csrf_field() }}

									@if(checkPerm('invoicer_invoice_edit'))
										@if($invoice->status == 'logged')
											<a href="{{ route('invoices.status_invoiced', $invoice->id) }}" class="btn btn-sm btn-outline-primary" title="Invoice">
												<i class="far fa-file-alt"></i>
												Invoice
											</a>
										@endif
										@if($invoice->status == 'invoiced')
											<a href="{{ route('invoices.status_paid', $invoice->id) }}" class="btn btn-sm btn-outline-primary" title="Paid">
												<i class="far fa-money-bill-alt"></i>
												Paid
											</a>
										@endif
									@endif

									@if(checkPerm('invoicer_invoice_show'))
										<a href="{{ route('invoicer.invoices.show', $invoice->id) }}" class="btn btn-sm btn-outline-primary" title="View invoice">
											<i class="fa fa-eye"></i>
											View
										</a>
									@endif

									@if(checkPerm('invoicer_invoice_edit'))
										<a href="{{ route('invoicer.invoices.edit', $invoice->id) }}" class="btn btn-sm btn-primary" title="Edit invoice">
											<i class="fa fa-edit"></i>
											Edit
										</a>
									@endif

									<input type="hidden" name="_method" value="DELETE" />
									@if(checkPerm('invoicer_invoice_delete'))
										<button type="submit" class="btn btn-sm btn-danger">
											<i class="fa fa-trash-alt"></i>
											Delete
										</button>
									@endif
								</form>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			@else
				<div class="card-body">
					No invoices found in the system.
				</div>
			@endif
		{{-- </div> --}}

		@if($invoices->count() > 0)
			<div class="card-footer">
				<div class="row">
					<div class="col-sm-6 text-left">
						Showing records {{ $invoices->firstItem() }} to {{ $invoices->lastItem() }} of {{ $invoices->total() }}
					</div>
					<div class="col-sm-6 text-right">
						{!! $invoices->appends(request()->except('page'))->render() !!}
					</div>
				</div>
			</div>
		@endif
	</div>

@endsection