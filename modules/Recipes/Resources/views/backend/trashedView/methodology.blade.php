{{-- @if(checkACL('user')) --}}
	<div class="col-md-12">
		<div class="card mb-2">
			<div class="card-header card_header_2">Methodology</div>
			<div class="card-body card_body">
				{!! $recipe->methodology !!}
			</div>
		</div>
	</div>
{{-- @endif --}}