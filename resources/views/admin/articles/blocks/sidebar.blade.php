<div class="card mb-3 p-0 m-0">

	<div class="card-header block_header p-2 m-0">Articles Menu</div>

	<div class="list-group">

		<a href="{{ route('admin.articles.index') }}" class="list-group-item list-group-item-action p-1
			{{ Route::is('admin.articles.index') ? 'active' : '' }}">
			<i class="fa fa-file-text-o" aria-hidden="true"></i>
			Articles
			<div class="badge badge-secondary float-right">
				{{ App\Models\Articles\Article::published()->count() }}
			</div>
		</a>

		<a href="{{ route('admin.articles.newArticles') }}" class="list-group-item list-group-item-action p-1 
			{{ Route::is('admin.articles.newArticles') ? 'active' : '' }}">
			<i class="fa fa-file-text-o" aria-hidden="true"></i>
			New Articles
			<div class="badge badge-secondary float-right">
				{{ App\Models\Articles\Article::newArticles()->count() }}
			</div>
		</a>

		<a href="{{ route('admin.articles.myArticles') }}" class="list-group-item list-group-item-action p-1
			{{ Route::is('admin.articles.myArticles') ? 'active' : '' }}">
			<i class="fa fa-file-text-o" aria-hidden="true"></i>
			Created By Me
			<div class="badge badge-secondary float-right">
				{{ App\Models\Articles\Article::myArticles()->count() }}
			</div>
		</a>

		<a href="{{ route('admin.articles.unpublished') }}" class="list-group-item list-group-item-action p-1
			{{ Route::is('admin.articles.unpublished') ? 'active' : '' }}">
			<i class="fa fa-file-text-o" aria-hidden="true"></i>
			Unpublished
			<div class="badge badge-secondary float-right">
				{{ App\Models\Articles\Article::unpublished()->count() }}
			</div>
		</a>

		<a href="{{ route('admin.articles.future') }}" class="list-group-item list-group-item-action p-1
			{{ Route::is('admin.articles.future') ? 'active' : '' }}">
			<i class="fa fa-file-text-o" aria-hidden="true"></i>
			Future
			<div class="badge badge-secondary float-right">
				{{ App\Models\Articles\Article::future()->count() }}
			</div>
		</a>

		<a href="{{ route('admin.articles.trashed') }}" class="list-group-item list-group-item-action p-1
			{{ Route::is('admin.articles.trashed') ? 'active' : '' }}">
			<i class="fa fa-trash-o" aria-hidden="true"></i>
			Trashed
			<div class="badge badge-secondary float-right">
				{{ App\Models\Articles\Article::trashedCount()->count() }}
			</div>
		</a>
	</div>
</div>
