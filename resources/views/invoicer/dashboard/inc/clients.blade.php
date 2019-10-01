<div class="card">

	<div class="card-header">
		Clients
		<span class="float-right"><small><b>Total :</b> {{ $clients->count() }}</small></span>
	</div>
	
	<table class="table table-hover table-sm mb-0">
		<thead>
			<tr>
				<th></th>
				<th class="text-right">Logged</th>
				<th class="text-right">Invoiced</th>
				<th class="text-right">Paid</th>
				<th class="text-right">Gross</th>
				<th class="text-right">Net</th>
			</tr>
		</thead>
		@foreach($clients as $client)
			<tr>
				<td><a href="{{ route('invoicer.clients.show', $client->id) }}">{{ $client->company_name }}</a></td>
				<td>
					<div class="float-right">
						{{ number_format($amount = DB::table('invoicer__invoices')->where('user_id', '=', $client->id)->where('status','logged')->sum('sub_total'), 2, '.', ', ') }}$
					</div>
				</td>
				<td>
					<div class="float-right">
						{{ number_format($amount = DB::table('invoicer__invoices')->where('user_id', '=', $client->id)->where('status','invoiced')->sum('sub_total'), 2, '.', ', ') }}$
					</div>
				</td>
				<td>
					<div class="float-right">
						{{ number_format($amount = DB::table('invoicer__invoices')->where('user_id', '=', $client->id)->where('status','paid')->sum('sub_total'), 2, '.', ', ') }}$
					</div>
				</td>
				<td>
					<div class="float-right">
						{{ number_format($amount = DB::table('invoicer__invoices')->where('user_id', '=', $client->id)->sum('sub_total'), 2, '.', ', ') }}$
					</div>
				</td>
				<td>
					<div class="float-right">
						{{ number_format($amount = DB::table('invoicer__invoices')->where('user_id', '=', $client->id)->sum('total'), 2, '.', ', ') }}$
					</div>
				</td>
			</tr>
			@endforeach
	</table>

	<div class="card-footer text-center">
		<b>Gross :</b> Subtotal of all all client invoices
		<br />
		<b>Net :</b> Invoices Total - Total Deduction
	</div>
	
</div>