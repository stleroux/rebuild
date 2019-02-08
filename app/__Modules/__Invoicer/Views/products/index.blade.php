@extends('Invoicer::layouts.app')

@section('content')

	<div class="row">
		<div class="col-sm-9">
				<div class="card">
					<div class="card-header">
						Products
						<span class="float-right">
							<a href="{{ route('invoicer.products.create') }}" class="btn btn-xs btn-secondary">
								<i class="far fa-plus-square"></i>
								Add New Product
							</a>
						</span>
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
												<a href="{{ route('invoicer.products.show', $product->id) }}" class="btn btn-xs btn-outline-primary">
													<i class="fa fa-eye"></i>
													View
												</a>
												<a href="{{ route('invoicer.products.edit', $product->id) }}" class="btn btn-xs btn-primary">
													<i class="fa fa-edit"></i>
													Edit
												</a>
												<input type="hidden" name="_method" value="DELETE" />
												<button type="submit" class="btn btn-xs btn-danger">
													<i class="fa fa-trash-alt"></i>
													Delete
												</button>
											</form>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						@else
							<div class="card">
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
							<button type="submit" value="Search" class="btn btn-xs btn-primary">
								<i class="fa fa-binoculars"></i>
								Search
							</button>
							<a href="{{ route('invoicer.products') }}" class="btn btn-xs btn-outline-secondary">
								<i class="far fa-square"></i>
								Reset
							</a>
						</div>
					</form>
				</div>
			</div>
		</div>

	</div>

@endsection
