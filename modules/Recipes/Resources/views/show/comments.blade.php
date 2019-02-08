<div class="col-md-12">
	<div class="card mb-2">
		<div class="card-header card_header_2">
			<i class="fa fa-comments-o" aria-hidden="true"></i>
			Comments <small>({{ $recipe->comments()->count() }} total)</small>
		</div>
		{{-- <div class="card-body"> --}}
			<table class="table table-hover table-sm">
				@if($recipe->comments->count())
					<thead>
						<tr>
							<th>Name</th>
							<th>Comment</th>
							<th>Posted On</th>
						</tr>
					</thead>
					<tbody>
						@foreach($recipe->comments as $comment)
							<tr>
								<td class="col-sm-2">
									{{-- @include('common.authorFormat', ['model'=>$comment, 'field'=>'user']) --}}
									{{ $comment->user->profile->first_name }} {{ $comment->user->profile->last_name }}
								</td>
								<td>{{ $comment->comment }}</td>
								<td class="col-sm-2">
									{{-- @include('common.dateFormat', ['model'=>$comment, 'field'=>'created_at']) --}}
									{{ $comment->created_at->format('M d, Y') }}
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
		{{-- </div> --}}
	</div>
</div>