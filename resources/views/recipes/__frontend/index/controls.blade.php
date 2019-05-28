<div class="card mb-2">
   <div class="card-header block_header">
      RECIPES
   </div>
   <div class="list-group py-0 px-0">
		
{{-- 		<a href="/" class="list-group-item list-group-item-action py-1 px-1 {{ Request::is('/recipes/') ? 'active' : '' }}">
			<i class="fa fa-home pl-2 pl-2"></i> Home
		</a> --}}

	{{-- @if(checkACL('user')) --}}
	
	{{-- @auth
		<a href="{{ route('recipes.myFavorites') }}" class="list-group-item list-group-item-action py-1 px-1 {{ Request::is('/') ? 'active' : '' }}">
			<i class="fab fa-gratipay pl-2"></i>
			My Favorites
		</a> --}}
	{{-- @endif --}}
	
	{{-- @if(checkACL('author')) --}}
		{{-- <a href="{{ route('recipes.myRecipes') }}" class="list-group-item list-group-item-action py-1 px-1 {{ Request::is('/') ? 'active' : '' }}"> --}}
			{{-- <i class="fa fa-list pl-2"></i> --}}
{{-- 			<i class="fas fa-clipboard-list pl-2"></i>
			My Recipes
		</a>
	@endauth --}}
	{{-- @endif --}}

	{{-- @include('recipes::common.bulkActions', ['buttons'=>['unpublishAll','trashAll']]) --}}

      <a href="{{ route('recipes.published') }}" class="list-group-item list-group-item-action py-1 px-1 {{ Request::is('recipes/published') ? 'active' : '' }}">
         <i class="fab fa-apple pl-2"></i>
         Published Recipes
      </a>

      <a href="{{ route('recipes.newRecipes') }}" class="list-group-item list-group-item-action py-1 px-1 {{ Route::is('recipes.newRecipes') ? 'active' : '' }}">
      	<i class="fas fa-clipboard-list pl-2"></i>
         New Recipes
      </a>

      <a href="{{ route('recipes.unpublished') }}" class="list-group-item list-group-item-action py-1 px-1 {{ Route::is('recipes.unpublished') ? 'active' : '' }}">
      	<i class="fas fa-clipboard-list pl-2"></i>
         Unpublished Recipes
      </a>

      <a href="{{ route('recipes.future') }}" class="list-group-item list-group-item-action py-1 px-1 {{ Route::is('recipes.future') ? 'active' : '' }}">
      	<i class="fas fa-clipboard-list pl-2"></i>
         Future Recipes
      </a>

      <a href="{{ route('recipes.trashed') }}" class="list-group-item list-group-item-action py-1 px-1 {{ Route::is('recipes.trashed') ? 'active' : '' }}">
      	<i class="fas fa-clipboard-list pl-2"></i>
         Trashed Recipes
      </a>

		<a href="{{ route('recipes.import') }}" class="list-group-item list-group-item-action py-1 px-1 {{ Request::is('/') ? 'active' : '' }}">
			<i class="fa fa-upload pl-2"></i>
			Import
		</a>

		<a href="{{ URL::to('recipes/downloadExcel/xls') }}" class="list-group-item list-group-item-action py-1 px-1 {{ Request::is('/') ? 'active' : '' }}">
			<i class="fas fa-file-excel pl-2"></i>
			Download All as XLS
		</a>

		<a href="{{ URL::to('recipes/downloadExcel/xlsx') }}" class="list-group-item list-group-item-action py-1 px-1 {{ Request::is('/') ? 'active' : '' }}">
			<i class="far fa-file-excel pl-2"></i>
			Download All as XLSX
		</a>

		<a href="{{ URL::to('recipes/downloadExcel/csv') }}" class="list-group-item list-group-item-action py-1 px-1 {{ Request::is('/') ? 'active' : '' }}">
			<i class="fas fa-file-csv pl-2"></i>
			Download All as CSV
		</a>

		<a href="{{ route('recipes.pdfview') }}" class="list-group-item list-group-item-action py-1 px-1 {{ Request::is('/') ? 'active' : '' }}">
			<i class="fas fa-file-pdf pl-2"></i>
			Preview All as PDF
		</a>

		<a href="{{ route('recipes.pdfview',['download'=>'pdf']) }}" class="list-group-item list-group-item-action py-1 px-1 {{ Request::is('/') ? 'active' : '' }}">
			<i class="far fa-file-pdf pl-2"></i>
			Download All to PDF
		</a>
	</div>
</div>
