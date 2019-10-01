@extends('layouts.invoicer.app')

@section('content')

	<div class="row">
		<div class="col-sm-9">
				<div class="card">
					<div class="card-header">
						<span class="h3">Clients</span>
						@if(strpos($_SERVER['REQUEST_URI'], 'search?') !== false)
							[Filtered]
						@endif
{{-- 						@if(checkPerm('invoicer_client_create'))
							<span class="float-right">
								<a href="{{ route('invoicer.clients.create') }}" class="btn btn-sm btn-secondary">
									<i class="far fa-plus-square"></i>
									Add New Client
								</a>
							</span>
						@endif --}}
					</div>
					{{-- <div class="card-body"> --}}
						@if($clients->count() > 0)
							<table class="table table-hover table-sm">
								<thead>
									<tr>
										<th>@sortablelink('id','Client ID')</th>
										<th>@sortablelink('company_name','Company Name')</th>
										<th>@sortablelink('last_name','Contact Name')</th>
										<th>@sortablelink('email','Contact Email')</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@foreach($clients as $client)
									<tr>
										<td>{{ $client->id }}</td>
										<td>{{ $client->company_name }}</td>
										<td>{{ $client->first_name }} {{ $client->last_name }}</td>
										<td>{{ $client->email }}</td>
										<td>
											<form action="{{ route('invoicer.clients.destroy',[$client->id]) }}" method="POST" 
												onsubmit="return confirm('Do you really want to delete this client?');"
												class="float-right">
												<input type="hidden" name="_method" value="DELETE" />
												{{ csrf_field() }}
												
												@if(checkPerm('invoicer_client_show'))
													<a href="{{ route('invoicer.invoices.create', $client->id) }}" class="btn btn-sm btn-outline-primary">
														<i class="far fa-plus-square"></i>
														New Invoice
													</a>
												@endif

												{{-- @if(checkPerm('invoicer_client_show'))
													<a href="{{ route('invoicer.clients.show', $client->id) }}" class="btn btn-sm btn-outline-primary">
														<i class="fa fa-eye" aria-hidden="true"></i>
														View
													</a>
												@endif --}}
												
												{{-- @if(checkPerm('invoicer_client_edit'))
													<a href="{{ route('invoicer.clients.edit', $client->id) }}" class="btn btn-sm btn-primary">
														<i class="fa fa-edit"></i>
														Edit
													</a>
												@endif --}}

												{{-- @if(checkPerm('invoicer_client_delete'))
													<button type="submit" class="btn btn-sm btn-danger">
														<i class="fa fa-trash-alt"></i>
														Delete
													</button>
												@endif --}}
											</form>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						@else
							<div class="card-body">
								No clients found in the system.
							</div>
						@endif
					{{-- </div> --}}

					@if($clients->count() > 0)
						<div class="card-footer">
							<div class="row">
								<div class="col-xs-6 text-left">
									Showing records {{ $clients->firstItem() }} to {{ $clients->lastItem() }} of {{ $clients->total() }}
								</div>
								<div class="col-xs-6 text-right">
									{!! $clients->appends(request()->except('page'))->render() !!}
								</div>
							</div>
						</div>
					@endif
				</div>
		</div>
		<div class="col-sm-3">
			<div class="card">
				<div class="card-header">
					Filter
				</div>
				<div class="card-body pb-0">
					<form action="{{ route('invoicer.clients.search') }}" class="">
						<div class="form-group">
							<select class="form-control" name="selection">
								<option value="company">Company Name</option>
								<option value="contact">Contact Name</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="searchWord">
						</div>
						<div class="form-group text-center">
							<button type="submit" value="Search" class="btn btn-sm btn-primary">
								<i class="fa fa-binoculars" aria-hidden="true"></i>
								Filter
							</button>
							<a href="{{ route('invoicer.clients') }}" class="btn btn-sm btn-outline-secondary">
								<i class="far fa-square"></i>
								Reset
							</a>
						</div>
					</form>
				</div>
				<div class="card-footer">
					Click the Reset button to clear search parameters and display all clients
				</div>
			</div>
		</div>
	</div>

@endsection
