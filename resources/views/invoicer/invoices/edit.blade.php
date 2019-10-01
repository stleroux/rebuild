@extends('layouts.invoicer.app')

@section('content')
	{!! Form::model($invoice, ['route'=>['invoicer.invoices.update', $invoice->id], 'method' => 'PUT']) !!}
	{{ Form::token() }}

		<div class="card">
			
			<div class="card-header">
				<span class="h3">Edit Invoice</span>
				<span class="float-right">
					<a href="{{ route('invoicer.invoices') }}" class="btn btn-sm btn-outline-secondary">
						<i class="fa fa-backward"></i>
						Cancel
					</a>
					{{ Form::button('<i class="far fa-save"></i> Update Invoice', ['class' => 'btn btn-sm btn-primary', 'type' => 'submit']) }}
				</span>
			</div>
			
			<div class="card-body">
				<div class="row">
					<div class="col-sm-9">
						<div class="form-group {{ $errors->has('client_id') ? 'has-error' : '' }}">
							{{ Form::label('client_id', 'Client', ['class'=>'required']) }}
							{{ Form::select('client_id', $clients, $invoice->client_id, ['class'=>'form-control', 'placeholder'=>'Select']) }}
							<span class="text-danger">{{ $errors->first('client_id') }}</span>
						</div>
						<div class="form-group {{ $errors->has('notes') ? 'has-error' : '' }}">
							{{ Form::label ('notes', 'Notes:') }}
							{{ Form::textarea ('notes', null, ['class'=>'form-control', 'rows'=>'4']) }}
							<span class="text-danger">{{ $errors->first('notes') }}</span>
							<small id="passwordHelpBlock" class="form-text text-muted">
								These notes will not be shown on invoice
							</small>
						</div>
					
						<div class="row">
							{{-- Logged Date --}}
							<div class="col-sm-3">
								<div class="form-group">
									{{ Form::label ('created_at', 'Logged Date') }}
									<div class="input-group">
										{{ Form::text ('created_at', $invoice->created_at, ['class'=>'form-control', 'readonly'=>'readonly']) }}
										<div class="input-group-append">
											<span class="input-group-text">
												<i class="far fa-calendar-alt"></i>
											</span>
										</div>
									</div>
								</div>
							</div>
							{{-- Invoiced Date --}}
							<div class="col-sm-3">
								<div class="form-group {{ $errors->has('invoiced_at') ? 'has-error' : '' }}">
									{{ Form::label ('invoiced_at', 'Invoiced Date') }}
									<div class="input-group">
										@if($invoice->invoiced_at)
											{{ Form::text ('created_at', $invoice->invoiced_at, ['class'=>'form-control', 'readonly'=>'readonly']) }}
										@else
											{{ Form::date ('invoiced_at', $invoice->invoiced_at, ['class'=>'form-control']) }}
										@endif
										<div class="input-group-append">
											<span class="input-group-text">
												<i class="far fa-calendar-alt"></i>
											</span>
										</div>
										<span class="text-danger">{{ $errors->first('invoiced_at') }}</span>
									</div>
<span><small class="form-text">Ensure you select Invoiced from the Status dropdown</small></span>
								</div>
							</div>
							{{-- Paid Date --}}
							<div class="col-sm-3">
								<div class="form-group {{ $errors->has('paid_at') ? 'has-error' : '' }}">
									{{ Form::label ('paid_at', 'Paid Date') }}
									<div class="input-group">
										@if($invoice->paid_at)
											{{ Form::text ('created_at', $invoice->paid_at, ['class'=>'form-control', 'readonly'=>'readonly']) }}
										@else
											{{ Form::date ('paid_at', $invoice->paid_at, ['class'=>'form-control']) }}
										@endif
										<div class="input-group-append">
											<span class="input-group-text">
												<i class="far fa-calendar-alt"></i>
											</span>
										</div>
										<span class="text-danger">{{ $errors->first('paid_at') }}</span>
									</div>
<span><small class="form-text">Ensure you select Paid from the Status dropdown</small></span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
							{{ Form::label ('status', 'Status', ['class'=>'required']) }}
							{{ Form::select('status', ['invoiced'=>'Invoiced', 'logged'=>'Logged', 'paid'=>'Paid'], $invoice->status, ['class'=>'form-control']) }}
							<span class="text-danger">{{ $errors->first('status') }}</span>
						</div>
						{{-- Sub Total --}}
						<div class="form-group">
							{{ Form::label ('amount_charged', 'SubTotal:') }}
							<div class="input-group">
								{{ Form::text ('amount_charged', number_format($invoice->amount_charged, 2, '.', ' '), ['class'=>'form-control text-right', 'readonly'=>'readonly']) }}
								<div class="input-group-append">
									<span class="input-group-text">$</span>
								</div>
							</div>
						</div>
						{{-- HST --}}
						<div class="form-group">
							{{ Form::label ('hst', 'HST:') }}
							<div class="input-group">
								{{ Form::text ('hst', number_format($invoice->hst, 2, '.', ' '), ['class'=>'form-control text-right', 'readonly'=>'readonly']) }}
								<div class="input-group-append">
									<span class="input-group-text">$</span>
								</div>
							</div>
						</div>
						{{-- Total --}}
						<div class="form-group">
							{{ Form::label ('total', 'Total Charged:') }}
							<div class="input-group">
								{{ Form::text ('hst', number_format($invoice->sub_total, 2, '.', ' '), ['class'=>'form-control text-right', 'readonly'=>'readonly']) }}
								<div class="input-group-append">
									<span class="input-group-text">$</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="card-footer">
				Fields marked with an<span class="required"></span> are required.
			</div>
		</div>
	{!! Form::close() !!}

		<br />
		<div class="card">

			<div class="card-header">
				<span class="h3">Billable Items</span>
				@if(checkPerm('invoicer_invoice_edit'))
					@if($invoice->status != 'paid')
						<span class="float-right">
							<a href="{{ route('invoicer.invoiceItems.create', $invoice->id) }}" class="btn btn-sm btn-primary">
								<i class="far fa-plus-square"></i>
								Add Billable
							</a>
						</span>
					@endif
				@endif
			</div>

			{{-- <div class="card-body"> --}}
				@if($invoice->invoiceItems->count() > 0)
					<table class="table table-sm table-striped">
						<thead>
							<tr>
								<th>Product</th>
								<th>Work Date</th>
								<th>Notes</th>
								<th class="text-center">Quantity</th>
								<th class="text-right">Price</th>
								<th class="text-right">Total</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($invoice->invoiceItems->sortByDesc('work_date') as $item)
								<tr>
									<td>{{ $item->product->details }}</td>
									<td nowrap="nowrap">{{ $item->work_date }}</td>
									<td>{!! nl2br(e($item->notes)) !!}</td>
									<td class="text-center">{{ $item->quantity }}</td>
									<td class="text-right" nowrap="nowrap">{{ number_format($item->price, 2, '.', ' ') }}$</td>
									<td class="text-right" nowrap="nowrap">{{ number_format($item->total, 2, '.', ' ') }}$</td>
									<td class="text-right" nowrap="nowrap">
										<form action="{{ route('invoiceItems.destroy',[$item->id]) }}" method="POST" onsubmit="return confirm('Do you really want to delete this billable item?');"
											class="pull-right">
											{{ csrf_field() }}
											<input type="hidden" name="_method" value="DELETE" />

											@if(checkPerm('invoicer_invoice_edit'))
												<a href="{{ route('invoiceItems.edit', $item->id) }}" class="btn btn-sm btn-primary">
													<i class="fa fa-edit"></i>
													Edit
												</a>
											@endif
											
											@if(checkPerm('invoicer_invoice_edit'))
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
						No billable items found for this invoice.
					</div>
				@endif
			{{-- </div> --}}
		</div>

@endsection
