@extends('layouts.invoicer.app')

@section('content')

	<div class="row">
		<div class="col-sm-9">
				<div class="card">
					<div class="card-header">
						Products
						@if(strpos($_SERVER['REQUEST_URI'], 'search?') !== false)
							[Filtered]
						@endif
						@if(checkPerm('invoicer_product_create'))
							<span class="float-right">
								<a href="{{ route('invoicer.products.create') }}" class="btn btn-sm btn-secondary">
									<i class="far fa-plus-square"></i>
									Add New Product
								</a>
							</span>
						@endif
					</div>
					{{-- <div class="panel-body"> --}}
						@if($products->count() > 0)
							<table class="table table-hover table-sm">
								<thead>
									<tr>
										{{-- <th>@sortablelink('id','ID')</th> --}}
										<th>@sortablelink('code','Code')</th>
										<th>@sortablelink('details','Details')</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@foreach($products as $product)
									<tr>
										{{-- <td>{{ $product->id }}</td> --}}
										<td>{{ $product->code }}</td>
										<td>{{ $product->details }}</td>
										<td>
											<form action="{{ route('invoicer.products.destroy', [$product->id]) }}" method="POST" onsubmit="return confirm('Do you really want to delete this product?');" class="float-right">
												{{ csrf_field() }}

												@if(checkPerm('invoicer_product_show'))
													<a href="{{ route('invoicer.products.show', $product->id) }}" class="btn btn-sm btn-outline-primary">
														<i class="fa fa-eye"></i>
														View
													</a>
												@endif

												@if(checkPerm('invoicer_product_edit'))
													<a href="{{ route('invoicer.products.edit', $product->id) }}" class="btn btn-sm btn-primary">
														<i class="fa fa-edit"></i>
														Edit
													</a>
												@endif

												<input type="hidden" name="_method" value="DELETE" />

												@if(checkPerm('invoicer_product_delete'))
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
								No products found in the system.
							</div>
						@endif
					{{-- </div> --}}

					@if($products->count() > 0)
						<div class="card-footer">
							<div class="row">
								<div class="col-sm-6 text-left">
									Showing records {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }}
								</div>
								<div class="col-sm-6 text-right">
									{!! $products->appends(request()->except('page'))->render() !!}
								</div>
							</div>
						</div>
					@endif
				</div>
		</div>

		<div class="col-sm-3">
			<div class="card">
				<div class="card-header">
					Search
				</div>
				<div class="card-body pb-0">
					<form action="{{ route('invoicer.products.search') }}" class="">
						<div class="form-group">
							<select class="form-control" name="selection">
								<option value="code">Code</option>
								<option value="details">Details</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="searchWord">
						</div>
						<div class="form-group text-center">
							<button type="submit" value="Search" class="btn btn-sm btn-primary">
								<i class="fa fa-binoculars"></i>
								Search
							</button>
							<a href="{{ route('invoicer.products') }}" class="btn btn-sm btn-outline-secondary">
								<i class="far fa-square"></i>
								Reset
							</a>
						</div>
					</form>
				</div>
				<div class="card-footer">
					Click the Reset button to clear search parameters and display all products
				</div>
			</div>
		</div>

	</div>

@endsection
