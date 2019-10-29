{{-- @if(checkACL('user')) --}}
		<div class="card mb-3 p-0 m-0">
		
			<div class="card-header block_header p-2 m-0">
				
					Articles Menu
				
			</div>

			<div class="list-group">

				{{-- @if(checkACL('user')) --}}
					<a href="{{ route('admin.articles.index') }}" class="list-group-item list-group-item-action p-1
						{{ Route::is('admin.articles.index') ? 'active' : '' }}">
						<i class="fa fa-file-text-o" aria-hidden="true"></i>
						Articles
						<div class="badge badge-secondary float-right">
							{{ App\Models\Articles\Article::published()->count() }}
						</div>
					</a>
				{{-- @endif --}}

				{{-- @if(checkACL('author')) --}}
					<a href="{{ route('admin.articles.newArticles') }}" class="list-group-item list-group-item-action p-1 
						{{ Route::is('admin.articles.newArticles') ? 'active' : '' }}">
						<i class="fa fa-file-text-o" aria-hidden="true"></i>
						New Articles
						<div class="badge badge-secondary float-right">
							{{ App\Models\Articles\Article::newArticles()->count() }}
						</div>
					</a>
				{{-- @endif --}}

				{{-- @if(checkACL('author')) --}}
					<a href="{{ route('admin.articles.myArticles') }}" class="list-group-item list-group-item-action p-1
						{{ Route::is('admin.articles.myArticles') ? 'active' : '' }}">
						<i class="fa fa-file-text-o" aria-hidden="true"></i>
						Created By Me
						<div class="badge badge-secondary float-right">
							{{ App\Models\Articles\Article::myArticles()->count() }}
						</div>
					</a>
				{{-- @endif --}}

				{{-- @if(checkACL('user')) --}}
{{-- 					<a href="{{ route('articles.myFavorites') }}" class="list-group-item list-group-item-action p-1  {{ Nav::isRoute('admin.articles.myFavorites') }} ">
						<i class="fa fa-file-text-o" aria-hidden="true"></i>
						My Favorites
						<div class="badge badge-secondary float-right">
							{{ DB::table('article_user')->where('user_id','=',Auth::user()->id)->count() }}
						</div>
					</a> --}}
				{{-- @endif --}}

				{{-- @if(checkACL('publisher')) --}}
					<a href="{{ route('admin.articles.unpublished') }}" class="list-group-item list-group-item-action p-1
						{{ Route::is('admin.articles.unpublished') ? 'active' : '' }}">
						<i class="fa fa-file-text-o" aria-hidden="true"></i>
						Unpublished
						<div class="badge badge-secondary float-right">
							{{ App\Models\Articles\Article::unpublished()->count() }}
						</div>
					</a>
				{{-- @endif --}}
				
				{{-- @if(checkACL('publisher')) --}}
					<a href="{{ route('admin.articles.future') }}" class="list-group-item list-group-item-action p-1
						{{ Route::is('admin.articles.future') ? 'active' : '' }}">
						<i class="fa fa-file-text-o" aria-hidden="true"></i>
						Future
						<div class="badge badge-secondary float-right">
							{{ App\Models\Articles\Article::future()->count() }}
						</div>
					</a>
				{{-- @endif --}}

				{{-- @if(checkACL('manager')) --}}
					<a href="{{ route('admin.articles.trashed') }}" class="list-group-item list-group-item-action p-1
						{{ Route::is('admin.articles.trashed') ? 'active' : '' }}">
						<i class="fa fa-trash-o" aria-hidden="true"></i>
						Trashed
						<div class="badge badge-secondary float-right">
							{{ App\Models\Articles\Article::trashedCount()->count() }}
						</div>
					</a>
				{{-- @endif --}}

			</div>
		</div>


		{{-- @if(checkACL('manager')) --}}
			{{-- Only show this menu if you are on the following pages --}}
{{-- 			@if(
				(Route::currentRouteName() == 'articles.newArticles' && App\Article::newArticles()->count() > 0) || 
				(Route::currentRouteName() == 'articles.index' && App\Article::published()->count() > 0) || 
				(Route::currentRouteName() == 'articles.myArticles' && App\Article::myArticles()->count() > 0) || 
				(Route::currentRouteName() == 'articles.myFavorites' && DB::table('article_user')->where('user_id','=',Auth::user()->id)->count() > 0)|| 
				(Route::currentRouteName() == 'articles.unpublished' && App\Article::unpublished()->count() > 0) || 
				(Route::currentRouteName() == 'articles.future' && App\Article::future()->count() > 0) || 
				(Route::currentRouteName() == 'articles.trashed' && App\Article::trashedCount()->count() > 0)
			)
			<br />
				<div class="panel panel-primary">
				   <div class="panel-heading">
				      <h4 class="panel-title">
				         <a data-toggle="collapse" data-parent="#accordion" href="#collapseOptions" style="display: block; text-decoration: none;">
				            <i class="fa fa-file-text" aria-hidden="true"></i>
				            Options
				            <span class="badge badge-secondary float-right">
				               <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
				               <i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
				            </span>
				         </a>
				      </h4>
				   </div>

				   <div id="collapseOptions" class="panel-collapse collapse"> --}}
					   {{-- <a href="{{ URL::to('backend/articles/downloadExcel/xls') }}" class="list-group-item list-group-item-action p-1">
							<i class="fa fa-file-excel-o" aria-hidden="true"></i>
							Download All as XLS
						</a>

						<a href="{{ URL::to('backend/articles/downloadExcel/xlsx') }}" class="list-group-item list-group-item-action p-1">
							<i class="fa fa-file-excel-o" aria-hidden="true"></i>
							Download All as XLSX
						</a>

						<a href="{{ URL::to('backend/articles/downloadExcel/csv') }}" class="list-group-item list-group-item-action p-1">
							<i class="fa fa-file-text-o" aria-hidden="true"></i>
							Download All as CSV
						</a>

						<a href="{{ route('admin.articles.pdfview') }}" class="list-group-item list-group-item-action p-1 {{ Nav::isRoute('admin.articles.pdfview') }}">
							<i class="fa fa-file-pdf-o" aria-hidden="true"></i>
							Preview All as PDF
						</a>

						<a href="{{ route('admin.articles.pdfview',['download'=>'pdf']) }}" class="list-group-item list-group-item-action p-1">
							<i class="fa fa-file-pdf-o" aria-hidden="true"></i>
							Download All to PDF
						</a> --}}
				   {{-- </div> --}} {{-- End of CollapseReports --}}
				{{-- </div>
			@endif
			<br /><br />
		@endif --}}

{{-- @endif --}}
