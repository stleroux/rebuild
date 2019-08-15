<div class="col">
	<div class="card">
		<div class="card-header card_header p-2">
			<i class="fa fa-comments-o"></i>
			Comments <small>({{ $recipe->comments()->count() }} total)</small>
		</div>
		<div class="card-body card_body p-1 text-light">
			<table class="table table-hover table-sm mb-0">
				@if($recipe->comments->count())
					<thead>
						<tr class="d-flex">
							<th class="col-2">Posted By</th>
							<th class="col-8">Comment</th>
							<th class="col-2">Posted On</th>
						</tr>
					</thead>
					<tbody>
						@foreach($recipe->comments as $comment)
							<tr class="d-flex">
								<td class="col-2">
									@auth
										@include('common.authorFormat', ['model'=>$comment, 'field'=>'user'])
									@else
										{{ $comment->user->username }}
									@endif
								</td>
								<td class="col-8">{{ $comment->comment }}</td>
								<td class="col-2">
									@include('common.dateFormat', ['model'=>$comment, 'field'=>'created_at'])
								</td>
							</tr>
						@endforeach
					</tbody>
				@else
					<div class="card-body card_body p-1">
						No comments found
					</div>
				@endif
			</table>
		</div>
	</div>
</div>