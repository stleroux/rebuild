<div class="card">

	<div class="card-header">
		Products
		<span class="float-right"><small><b>Total :</b> {{ $products->count() }}</small></span>
	</div>
	
	<table class="table table-hover table-sm">
		@foreach($products as $product)
			<tr>
				<td>{{ $product->code }}</td>
			</tr>
		@endforeach
	</table>

</div>