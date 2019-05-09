<div class="card mb-2">
   <div class="card-header block_header">
      <i class="fab fa-apple"></i>
      Recipes
   </div>
   
   <div class="list-group pt-0 pb-0">
{{--       @if(App\Category::newCategories()->count() > 0)
      <a href="{{ route('categories.newCategories') }}" class="list-group-item {{ Nav::isRoute('categories.newCategories') }}">
         <i class="fa fa-sitemap"></i>
         New Categories
         <div class="badge pull-right">
            {{ App\Category::newCategories()->count() }}
         </div>
      </a>
      @endif --}}

      <a href="{{ route('recipes.published') }}" class="list-group-item list-group-item-action p-1 {{ Route::is('recipes.published') ? 'active' : '' }}">
         <i class="fab fa-apple pl-2"></i>
         Published Recipes
      </a>

      <a href="{{ route('recipes.myRecipes') }}" class="list-group-item list-group-item-action p-1 {{ Route::is('recipes.myRecipes') ? 'active' : '' }}">
         <i class="fas fa-dot-circle pl-2"></i>
         My Recipes
      </a>

      <a href="{{ route('recipes.myPrivateRecipes') }}" class="list-group-item list-group-item-action p-1 {{ Route::is('recipes.myPrivateRecipes') ? 'active' : '' }}">
         <i class="far fa-eye-slash pl-2"></i>
         My Private Recipes
      </a>

      <a href="{{ route('recipes.newRecipes') }}" class="list-group-item list-group-item-action p-1 {{ Route::is('recipes.newRecipes') ? 'active' : '' }}">
         <i class="fas fa-clipboard-list pl-2"></i>
         New Recipes
      </a>

      <a href="{{ route('recipes.unpublished') }}" class="list-group-item list-group-item-action p-1 {{ Route::is('recipes.unpublished') ? 'active' : '' }}">
         <i class="fas fa-clipboard-list pl-2"></i>
         Unpublished Recipes
      </a>

      <a href="{{ route('recipes.future') }}" class="list-group-item list-group-item-action p-1 {{ Route::is('recipes.future') ? 'active' : '' }}">
         <i class="fas fa-clipboard-list pl-2"></i>
         Future Recipes
      </a>

      <a href="{{ route('recipes.trashed') }}" class="list-group-item list-group-item-action p-1 {{ Route::is('recipes.trashed') ? 'active' : '' }}">
         <i class="fas fa-clipboard-list pl-2"></i>
         Trashed Recipes
      </a>

      <hr />

      <a href="{{-- {{ route('recipes.import') }} --}}" class="list-group-item list-group-item-action p-1 {{ Route::is('/') ? 'active' : '' }}">
         <span class="text-danger">
            <i class="fa fa-upload pl-2"></i>
            Import
         </span>
      </a>

      <a href="{{-- {{ URL::to('recipes/downloadExcel/xls') }} --}}" class="list-group-item list-group-item-action p-1 {{ Route::is('/') ? 'active' : '' }}">
         <span class="text-danger">
            <i class="fas fa-file-excel pl-2"></i>
            Download All as XLS
         </span>
      </a>

      <a href="{{-- {{ URL::to('recipes/downloadExcel/xlsx') }} --}}" class="list-group-item list-group-item-action p-1 {{ Route::is('/') ? 'active' : '' }}">
         <span class="text-danger">
            <i class="far fa-file-excel pl-2"></i>
            Download All as XLSX
         </span>
      </a>

      <a href="{{-- {{ URL::to('recipes/downloadExcel/csv') }} --}}" class="list-group-item list-group-item-action p-1 {{ Route::is('/') ? 'active' : '' }}">
         <span class="text-danger">
            <i class="fas fa-file-csv pl-2"></i>
            Download All as CSV
         </span>
      </a>

      <a href="{{-- {{ route('recipes.pdfview') }} --}}" class="list-group-item list-group-item-action p-1 {{ Route::is('/') ? 'active' : '' }}">
         <span class="text-danger">
            <i class="fas fa-file-pdf pl-2"></i>
            Preview All as PDF
         </span>
      </a>

      <a href="{{-- {{ route('recipes.pdfview',['download'=>'pdf']) }} --}}" class="list-group-item list-group-item-action p-1 {{ Route::is('/') ? 'active' : '' }}">
         <span class="text-danger">
            <i class="far fa-file-pdf pl-2"></i>
            Download All to PDF
         </span>
      </a>

   </div>

</div>