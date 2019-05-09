{{-- Do not hide this panel as the information is shown in the index page list anyways --}}
<div class="col-md-3">
	<div class="card mb-2">
		<div class="card-header card_header_2">Category</div>
		<div class="card-body text-center">
         @if($recipe->category)
            {{ ucwords($recipe->category->name) }}
         @else
            Not Specified
         @endif
      </div>
	</div>
</div>
