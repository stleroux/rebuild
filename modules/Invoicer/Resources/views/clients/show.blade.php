@extends('invoicer::layouts.app')

@section('content')

	{{-- {{ $client->user->name }} --}}

	<div class="card">
		
		<div class="card-header">
			Client Information
			<span class="float-right">
				<a href="{{ route('invoicer.clients') }}" class="btn btn-sm btn-primary">
					<i class="fas fa-list"></i>
					Clients List
				</a>
			</span>
		</div>
		
		<div class="card-body">
			<div class="row">
				<div class="col-sm-12 col-md-8">
					<div class="form-group">
						{{ Form::label ('company_name', 'Company Name:')}}
						{{ Form::text ('company_name', $client->company_name, array('class'=>'form-control', 'readonly')) }}
					</div>
					<div class="form-group">
						{{ Form::label ('address', 'Address:')}}
						{{ Form::text ('address', $client->address, array('class'=>'form-control', 'readonly')) }}
					</div>

					<div class="row">
						<div class="col-sm-12 col-md-6">
							<div class="form-group">
								{{ Form::label ('city', 'City:')}}
								{{ Form::text ('city', $client->city, array('class'=>'form-control', 'readonly')) }}
							</div>
						</div>
						<div class="col-sm-12 col-md-3">
							<div class="form-group">
								{{ Form::label ('state', 'Province:')}}
								{{ Form::text ('state', $client->state, array('class'=>'form-control', 'readonly')) }}
							</div>
						</div>
						<div class="col-sm-12 col-md-3">
							<div class="form-group">
								{{ Form::label ('zip', 'Postal Code:')}}
								{{ Form::text ('zip', $client->zip, array('class'=>'form-control', 'readonly')) }}
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								{{ Form::label ('notes', 'Notes:')}}
								{{ Form::textarea ('notes', $client->notes, array('class'=>'form-control', 'readonly', 'rows'=>4)) }}
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm12 col-md-4">
					<div class="form-group">
						{{ Form::label ('owner_name', 'Contact Name:')}}
						{{ Form::text ('owner_name', $client->contact_name, array('class'=>'form-control', 'readonly')) }}
					</div>
					<div class="form-group">
						{{ Form::label ('telephone', 'Telephone:')}}
						{{ Form::text ('telephone', $client->telephone, array('class'=>'form-control', 'readonly')) }}
					</div>
					<div class="form-group">
						{{ Form::label ('cell', 'Cell:')}}
						{{ Form::text ('cell', $client->cell, array('class'=>'form-control', 'readonly')) }}
					</div>
					<div class="form-group">
						{{ Form::label ('fax', 'Fax:')}}
						{{ Form::text ('fax', $client->fax, array('class'=>'form-control', 'readonly')) }}
					</div>
					<div class="form-group">
						{{ Form::label ('email', 'Email Address:')}}
						{{ Form::text ('email', $client->email, array('class'=>'form-control', 'readonly')) }}
					</div>
					<div class="form-group">
						{{ Form::label ('website_address', 'Website Address:')}}
						{{ Form::text ('website_address', $client->website, array('class'=>'form-control', 'readonly')) }}
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="card mt-2">
		<div class="card-header">Related Invoices</div>
		
		@if($client->invoices->count() > 0)
			<table class="table table-sm table-striped">
				<thead>
					<tr>
						<th>Invoice N<sup>o</sup></th>
						<th>Create Date</th>
						<th>Amount</th>
						<th>Status</th>
						<th colspan="4"></th>
					</tr>
				</thead>
				<tbody>
					@foreach($client->invoices as $invoice)
						<tr>
							<td>{{ $invoice->id }}</td>
							<td>{{ $invoice->created_at->format('M d, Y') }}</td>
							<td>{{ number_format($invoice->sub_total, 2, '.', ', ') }}$</td>
							<td>{{ ucfirst($invoice->status) }}</td>
							
							<form action="{{ route('invoicer.invoices.destroy',[$invoice->id]) }}" method="POST" onsubmit="return confirm('Do you really want to delete this invoice?');">
								<input type="hidden" name="_method" value="DELETE" />
								<td width="10px">										
									<a href="{{ route('invoicer.invoices.show', $invoice->id) }}" class="btn btn-sm btn-outline-primary">
										<i class="fa fa-eye"></i>
										View
									</a>
								</td>
								<td width="10px">
									@if($invoice->status != "paid")
										<a href="{{ route('invoicer.invoices.edit', $invoice->id) }}" class="btn btn-sm btn-primary">
											<i class="fa fa-edit"></i>
											Edit
										</a>
									@endif
								</td>
								<td width="10px">											
									<button type="submit" class="btn btn-sm btn-danger">
										<i class="fa fa-trash-alt"></i>
										Delete
									</button>
								</td>
							</form>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<div class="card-body">
				No related invoices found for this client.
			</div>
		@endif
	</div>
	
@endsection