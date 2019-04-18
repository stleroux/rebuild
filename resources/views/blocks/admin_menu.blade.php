{{-- @if(checkPerm('admin_menu')) --}}
	<div class="card mb-2">
		<div class="card-header block_header">ADMIN MENU</div>
		
		<div class="list-group pt-0 pb-0">

{{-- 		<a href="/"
			class="list-group-item list-group-item-action p-1 {{ Request::is('/') ? 'active' : '' }}">
			<i class="fas fa-home pl-2"></i>
			Home
		</a> --}}

			@if(checkPerm('category_index'))
				<a href="{{ route('categories.index') }}"
					class="list-group-item list-group-item-action p-1 {{ Request::is('categories*') ? 'active' : '' }}">
					<i class="fa fa-sitemap pl-2"></i>
					Categories
				</a>
			@endif

			{{-- @if(checkPerm('component_index')) --}}
				<a href="{{ route('comments.index') }}"
					class="list-group-item list-group-item-action p-1 {{ Request::is('comments*') ? 'active' : '' }}">
					<i class="fas fa-comments pl-2"></i>
					Comments
				</a>
			{{-- @endif --}}

{{-- 			@if(checkPerm('component_index'))
				<a href="{{ route('components.index') }}"
					class="list-group-item list-group-item-action p-1 {{ Request::is('components*') ? 'active' : '' }}">
					<i class="fas fa-boxes pl-2"></i>
					Components
				</a>
			@endif --}}

			@if(checkPerm('module_index'))
				<a href="{{ route('modules.index') }}"
					class="list-group-item list-group-item-action p-1 {{ Request::is('modules*') ? 'active' : '' }}">
					<i class="fa fa-cubes pl-2"></i>
					Modules
				</a>
			@endif

			@if(checkPerm('permission_index'))
				<a href="{{ route('permissions.index') }}"
					class="list-group-item list-group-item-action p-1 {{ Route::is('permissions.*') ? 'active' : '' }}">
					<i class="fas fa-shield-alt pl-2"></i>
					Permissions
				</a>
			@endif

			<a href="{{ route('posts.index') }}"
				class="list-group-item list-group-item-action p-1 {{ Request::is('posts*') ? 'active' : '' }}">
				<i class="far fa-newspaper pl-2"></i>
				Posts
			</a>
{{-- 			@if(\Module::enabled('Posts'))
				<a class="list-group-item list-group-item-action p-1 {{ Request::is('posts*') ? 'active' : '' }}"
					data-remote="true" href="#posts" id="categoria_4" data-toggle="collapse" data-parent="#sub_posts">
					<i class="far fa-newspaper pl-2"></i>
					Posts
					<span class="menu-ico-collapse float-right pr-2">
						<i class="fa fa-chevron-down"></i>
					</span>
				</a>

				<div class="collapse list-group-submenu" id="posts">
					@if(checkPerm('post_index'))
						<a href="{{ route('posts.newPosts') }}"
							class="list-group-item list-group-item-action pl-4 py-1 {{ Request::is('posts/newPosts') ? 'active' : '' }}"
							data-parent="#sub_posts">
							<i class="fas fa-dot-circle"></i>
							New Posts
							<span class="badge badge-secondary border float-right">{{ Modules\Posts\Entities\Post::newPostsCount()->count() }}</span>
						</a>
						<a href="{{ route('posts.index') }}"
							class="list-group-item list-group-item-action pl-4 py-1 {{ Request::is('posts') ? 'active' : '' }}"
							data-parent="#sub_posts">
							<i class="fas fa-upload"></i>
							Published Posts
							<span class="badge badge-secondary border float-right">{{ Modules\Posts\Entities\Post::published()->count() }}</span>
						</a>
						<a href="{{ route('posts.trashed') }}"
							class="list-group-item list-group-item-action pl-4 py-1 {{ Request::is('posts/trashed') ? 'active' : '' }}"
							data-parent="#sub_posts">
							<i class="far fa-trash-alt"></i>
							Trashed Posts
							<span class="badge badge-secondary border float-right">{{ Modules\Posts\Entities\Post::trashedCount()->count() }}</span>
						</a>
						<a href="{{ route('posts.unpublished') }}"
							class="list-group-item list-group-item-action pl-4 py-1 {{ Request::is('posts/unpublished') ? 'active' : '' }}"
							data-parent="#sub_posts">
							<i class="fas fa-download"></i>
							Unpublished Posts
							<span class="badge badge-secondary border float-right">{{ Modules\Posts\Entities\Post::unpublished()->count() }}</span>
						</a>
					@endif
				</div>
			@endif --}}


			<a href="{{ route('recipes.published') }}"
				class="list-group-item list-group-item-action p-1 {{ Route::is('recipes.*') ? 'active' : '' }}">
				<i class="fab fa-apple pl-2"></i>
				Recipes
			</a>
{{-- 			@if(\Module::enabled('Recipes'))
				<a class="list-group-item list-group-item-action p-1 {{ Route::is('recipes.*') ? 'active' : '' }}"
					data-remote="true" href="#recipes_admin" id="categoria_5" data-toggle="collapse" data-parent="#sub_recipes_admin">
					<i class="fab fa-apple pl-2"></i>
					Recipes
					<span class="menu-ico-collapse float-right pr-2">
						<i class="fa fa-chevron-down"></i>
					</span>
				</a>

				<div class="collapse list-group-submenu" id="recipes_admin">
					<a href="{{ route('recipes.published') }}" class="list-group-item list-group-item-action pl-4 py-1 {{ Route::is('recipes.published') ? 'active' : '' }}">
			         <i class="fab fa-apple pl-2"></i>
			         Published Recipes
			      </a>

			      <a href="{{ route('recipes.newRecipes') }}" class="list-group-item list-group-item-action pl-4 py-1 {{ Route::is('recipes.newRecipes') ? 'active' : '' }}">
			      	<i class="fas fa-clipboard-list pl-2"></i>
			         New Recipes
			      </a>

			      <a href="{{ route('recipes.unpublished') }}" class="list-group-item list-group-item-action pl-4 py-1 {{ Route::is('recipes.unpublished') ? 'active' : '' }}">
			      	<i class="fas fa-clipboard-list pl-2"></i>
			         Unpublished Recipes
			      </a>

			      <a href="{{ route('recipes.future') }}" class="list-group-item list-group-item-action pl-4 py-1 {{ Route::is('recipes.future') ? 'active' : '' }}">
			      	<i class="fas fa-clipboard-list pl-2"></i>
			         Future Recipes
			      </a>

			      <a href="{{ route('recipes.trashed') }}" class="list-group-item list-group-item-action pl-4 py-1 {{ Route::is('recipes.trashed') ? 'active' : '' }}">
			      	<i class="fas fa-clipboard-list pl-2"></i>
			         Trashed Recipes
			      </a>

					<a href="{{ route('recipes.import') }}" class="list-group-item list-group-item-action pl-4 py-1 {{ Route::is('/') ? 'active' : '' }}">
						<i class="fa fa-upload pl-2"></i>
						Import
					</a>

					<a href="{{ URL::to('recipes/downloadExcel/xls') }}" class="list-group-item list-group-item-action pl-4 py-1 {{ Route::is('/') ? 'active' : '' }}">
						<i class="fas fa-file-excel pl-2"></i>
						Download All as XLS
					</a>

					<a href="{{ URL::to('recipes/downloadExcel/xlsx') }}" class="list-group-item list-group-item-action pl-4 py-1 {{ Route::is('/') ? 'active' : '' }}">
						<i class="far fa-file-excel pl-2"></i>
						Download All as XLSX
					</a>

					<a href="{{ URL::to('recipes/downloadExcel/csv') }}" class="list-group-item list-group-item-action pl-4 py-1 {{ Route::is('/') ? 'active' : '' }}">
						<i class="fas fa-file-csv pl-2"></i>
						Download All as CSV
					</a>

					<a href="{{ route('recipes.pdfview') }}" class="list-group-item list-group-item-action pl-4 py-1 {{ Route::is('/') ? 'active' : '' }}">
						<i class="fas fa-file-pdf pl-2"></i>
						Preview All as PDF
					</a>

					<a href="{{ route('recipes.pdfview',['download'=>'pdf']) }}" class="list-group-item list-group-item-action pl-4 py-1 {{ Route::is('/') ? 'active' : '' }}">
						<i class="far fa-file-pdf pl-2"></i>
						Download All to PDF
					</a>
				</div>
			@endif --}}


			<a href="{{ route('settings.index') }}"
				class="list-group-item list-group-item-action p-1 {{ Route::is('settings.*') ? 'active' : '' }}">
				<i class="fas fa-cog pl-2"></i>
				Site Settings
			</a>

			<a href="{{ route('stats') }}"
				class="list-group-item list-group-item-action p-1 {{ Route::is('stats*') ? 'active' : '' }}">
				<i class="fas fa-chart-pie pl-2"></i>
				Site Statistics
			</a>

			@if(checkPerm('user_index'))
				<a href="{{ route('users.index') }}"
					class="list-group-item list-group-item-action p-1 {{ Route::is('users.*') ? 'active' : '' }}">
					<i class="fas fa-users pl-2"></i>
					Users
				</a>
			@endif

		</div>
	</div>
{{-- @endif --}}
