{{-- @if(checkACL('user')) --}}
	<div class="col-md-12">
		<div class="card mb-2">
			<div class="card-header card_header p-2">Methodology</div>
			<div class="card-body card_body p-1 text-light">
				{!! $recipe->methodology !!}
			</div>
		</div>
	</div>
{{-- @endif --}}