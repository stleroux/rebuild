<div class="card mb-2">
   <div class="card-header block_header">
      Recipe Archives
   </div>
   <div class="list-group py-0 px-0">
		@if(count($recipelinks) > 0)
			<ul class="list-group">
				@foreach($recipelinks as $rlink)
					<a href="{{ route('recipes.archive', ['year'=>$rlink->year, 'month'=>$rlink->month]) }}"
						class="list-group-item list-group-item-action py-1 px-1 {{ Request::is('/') ? 'menu_active' : '' }}">
                  <i class="fas fa-archive pl-2"></i>
						{{ $rlink->month_name }} - {{ $rlink->year }}
						<span class="float-right badge badge-primary">{{ $rlink->recipe_count }}</span>
					</a>
				@endforeach
			</ul>
		@else
			<div class="text text-center">No Data Available</div>
		@endif
	</div>
</div>