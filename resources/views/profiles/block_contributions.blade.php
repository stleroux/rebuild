<div class="card mb-2">
	<div class="card-header">My Contributions</div>
	<table class="table table-hover mb-0">
		<tr>
			<td>
				Articles
				<span class="badge badge-primary badge-pill float-right">
					{{ Modules\Articles\Entities\Article::where('user_id','=', Auth::user()->id)->count() }}
				</span>
			</td>
		</tr>
		<tr>
			<td>
				Posts
				<span class="badge badge-primary badge-pill float-right">
					{{ Modules\Posts\Entities\Post::where('user_id','=', Auth::user()->id)->count() }}
				</span>
			</td>
		</tr>
		<tr>
			<td>
				Recipes
				<span class="badge badge-primary badge-pill float-right">
					{{ Modules\Recipes\Entities\Recipe::where('user_id','=', Auth::user()->id)->count() }}
				</span>
			</td>
		</tr>
	</table>
</div>
