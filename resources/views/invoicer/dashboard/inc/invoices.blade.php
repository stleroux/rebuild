
<div class="card">

	<div class="card-header">
		Invoices
		<span class="float-right"><small><b>Total :</b> {{ $invoicesTotal->count() }}</small></span>
	</div>
	
	<table class="table table-hover table-sm">
		<tr>
			<td><a href="{{ route('invoices.logged') }}">Logged</a></td>
			<td class="text-right">
				{{-- {{ App\Modules\Invoicer\Entities\Invoice::where('status', 'logged')->count() }} --}}
				{{ $invoicesLogged->count() }}
			</td>
		</tr>
		<tr>
			<td><a href="{{ route('invoices.invoiced') }}">Invoiced</a></td>
			<td class="text-right">
				{{-- {{ App\Modules\Invoicer\Models\Invoice::where('status', 'invoiced')->count() }} --}}
				{{ $invoicesInvoiced->count() }}
			</td>
		</tr>
		<tr>
			<td><a href="{{ route('invoices.paid') }}">Paid</a></td>
			<td class="text-right">
				{{-- {{ App\Modules\Invoicer\Models\Invoice::where('status', 'paid')->count() }} --}}
				{{ $invoicesPaid->count() }}
			</td>
		</tr>
	</table>

</div>