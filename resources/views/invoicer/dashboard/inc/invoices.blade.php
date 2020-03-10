
<div class="card">

	<div class="card-header">
		Invoices
		<span class="float-right"><small><b>Total :</b> {{ $invoicesTotal->count() }}</small></span>
	</div>
	
	<table class="table table-hover table-sm">
		<tr>
			<td><a href="{{ route('invoices.logged') }}">Logged</a></td>
			<td class="text-right">{{ $invoicesLogged->count() }}</td>
		</tr>
		<tr>
			<td><a href="{{ route('invoices.invoiced') }}">Invoiced</a></td>
			<td class="text-right">{{ $invoicesInvoiced->count() }}</td>
		</tr>
		<tr>
			<td><a href="{{ route('invoices.paid') }}">Paid</a></td>
			<td class="text-right">{{ $invoicesPaid->count() }}</td>
		</tr>
	</table>

</div>