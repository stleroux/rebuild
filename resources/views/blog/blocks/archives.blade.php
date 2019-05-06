<div class="card mb-2">
	<div class="card-header block_header">
		<i class="fab fa-newspaper-alt"></i>
		Blog Archives
	</div>
	<div class="card-body px-0 py-0">
		@if(count($postlinks) > 0)
			<ul class="list-group px-0 py-0">
				@foreach($postlinks as $plink)
					<a href="{{ route('blog.archive', ['year'=>$plink->year, 'month'=>$plink->month]) }}"
						style="text-decoration: none"
						class="list-group-item list-group-item-action px-1 py-2"
					>
						{{ $plink->month_name }} - {{ $plink->year }}
						<span class="badge badge-secondary badge-pill float-right">{{ $plink->post_count }}</span>
					</a>
				@endforeach
			</ul>
		@else
			<div class="text text-center">No Data Available</div>
		@endif
	</div>
</div>
