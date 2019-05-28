<div class="col">
	<div class="card">
		<div class="card-header card_header_2">
			<i class="fa fa-comments-o" aria-hidden="true"></i>
			Comments <small>({{ $recipe->comments()->count() }} total)</small>
		</div>
		<div class="card-body p-0">
			<table class="table table-hover table-sm mb-0">
				@if($recipe->comments->count())
					<thead>
						<tr class="d-flex">
							<th class="col-8">Comment</th>
							<th class="col-2">Posted By</th>
							<th class="col-2">Posted On</th>
						</tr>
					</thead>
					<tbody>
						@foreach($recipe->comments as $comment)
							<tr class="d-flex">
								<td class="col-8">{{ $comment->comment }}</td>
								<td class="col-2">
									@include('common.authorFormat', ['model'=>$comment, 'field'=>'user'])
								</td>
								<td class="col-2">
									@include('common.dateFormat', ['model'=>$comment, 'field'=>'created_at'])
									{{-- {{ $comment->created_at->format('M d, Y') }} --}}
								</td>
							</tr>
						@endforeach
					</tbody>
				@else
					<div class="card-body card_body">
						No comments found
					</div>
				@endif
			</table>
		</div>
	</div>
</div>