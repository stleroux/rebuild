<div class="card mb-2">
	<div class="card-header block_header">My Contributions</div>
	<table class="table table-sm table-hover mb-0">
		<tr>
			<td>
				Articles
				<span class="badge badge-secondary badge-pill float-right">
					{{ App\Models\Articles\Article::where('user_id','=', Auth::user()->id)->count() }}
				</span>
			</td>
		</tr>
		<tr>
			<td>
				Comments
				<span class="badge badge-secondary badge-pill float-right">
					{{ App\Models\Comment::where('user_id','=', Auth::user()->id)->count() }}
				</span>
			</td>
		</tr>
		<tr>
			<td>
				Posts
				<span class="badge badge-secondary badge-pill float-right">
					{{ App\Models\Post::where('user_id','=', Auth::user()->id)->count() }}
				</span>
			</td>
		</tr>
		<tr>
			<td>
				Recipes
				<span class="badge badge-secondary badge-pill float-right">
					{{ App\Models\Recipes\Recipe::where('user_id','=', Auth::user()->id)->count() }}
				</span>
			</td>
		</tr>
	</table>
</div>
