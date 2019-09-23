@auth
   <div class="card mb-2">
      <div class="card-header block_header p-2">
         <i class="fab fa-apple"></i>
         Recipes
      </div>
      
      <div class="list-group pt-0 pb-0">

         {{-- @if(checkPerm('recipe_browse'))
            <a href="{{ route('admin.recipes.index') }}" class="list-group-item list-group-item-action p-1 {{ Route::is('admin.recipes.index') ? 'menu_active' : '' }}">
               <i class="fab fa-apple fa-fw"></i>
               Published Recipes
            </a>
         @endif

         @if(checkPerm('recipe_edit'))
            <a href="{{ route('admin.recipes.unpublished') }}" class="list-group-item list-group-item-action p-1 {{ Route::is('admin.recipes.unpublished') ? 'menu_active' : '' }}">
               <i class="fas fa-clipboard-list fa-fw"></i>
               Unpublished Recipes
            </a>

            <a href="{{ route('admin.recipes.newRecipes') }}" class="list-group-item list-group-item-action p-1 {{ Route::is('admin.recipes.newRecipes') ? 'menu_active' : '' }}">
               <i class="fas fa-clipboard-list fa-fw"></i>
               New Recipes
            </a>

            <a href="{{ route('admin.recipes.future') }}" class="list-group-item list-group-item-action p-1 {{ Route::is('admin.recipes.future') ? 'menu_active' : '' }}">
               <i class="fas fa-clipboard-list fa-fw"></i>
               Future Recipes
            </a>

            <a href="{{ route('admin.recipes.trashed') }}" class="list-group-item list-group-item-action p-1 {{ Route::is('admin.recipes.trashed') ? 'menu_active' : '' }}">
               <i class="fas fa-clipboard-list fa-fw"></i>
               Trashed Recipes
            </a>
         @endif --}}

         @auth
            <a href="{{ route('recipes.myRecipes') }}" class="list-group-item list-group-item-action p-1 {{ Route::is('recipes.myRecipes') ? 'menu_active' : '' }}">
               <i class="fas fa-dot-circle fa-fw"></i>
               My Recipes
            </a>

            <a href="{{ route('recipes.myPrivateRecipes') }}" class="list-group-item list-group-item-action p-1 {{ Route::is('recipes.myPrivateRecipes') ? 'menu_active' : '' }}">
               <i class="fas fa-lock fa-fw"></i>
               My Private Recipes
            </a>

            <a href="{{ route('recipes.myFavoriteRecipes') }}" class="list-group-item list-group-item-action p-1 {{ Route::is('recipes.myFavoriteRecipes') ? 'menu_active' : '' }}">
               <i class="fas fa-heart fa-fw"></i>
               My Favorite Recipes
            </a>
         @endauth

         {{-- <hr /> --}}

         {{-- @if(checkPerm('recipe_edit'))
            <a href="<!-- {{ route('recipes.import') }} -->" class="list-group-item list-group-item-action p-1 {{ Route::is('/') ? 'menu_active' : '' }}">
               <span class="text-danger">
                  <i class="fa fa-upload fa-fw"></i>
                  Import
               </span>
            </a>

            <a href="<!-- {{ URL::to('recipes/downloadExcel/xls') }} -->" class="list-group-item list-group-item-action p-1 {{ Route::is('/') ? 'menu_active' : '' }}">
               <span class="text-danger">
                  <i class="fas fa-file-excel fa-fw"></i>
                  Download All as XLS
               </span>
            </a>

            <a href="<!-- {{ URL::to('recipes/downloadExcel/xlsx') }} -->" class="list-group-item list-group-item-action p-1 {{ Route::is('/') ? 'menu_active' : '' }}">
               <span class="text-danger">
                  <i class="far fa-file-excel fa-fw"></i>
                  Download All as XLSX
               </span>
            </a>

            <a href="<!-- {{ URL::to('recipes/downloadExcel/csv') }} -->" class="list-group-item list-group-item-action p-1 {{ Route::is('/') ? 'menu_active' : '' }}">
               <span class="text-danger">
                  <i class="fas fa-file-csv fa-fw"></i>
                  Download All as CSV
               </span>
            </a>

            <a href="<!-- {{ route('recipes.pdfview') }} -->" class="list-group-item list-group-item-action p-1 {{ Route::is('/') ? 'menu_active' : '' }}">
               <span class="text-danger">
                  <i class="fas fa-file-pdf fa-fw"></i>
                  Preview All as PDF
               </span>
            </a>

            <a href="<!-- {{ route('recipes.pdfview',['download'=>'pdf']) }} -->" class="list-group-item list-group-item-action p-1 {{ Route::is('/') ? 'menu_active' : '' }}">
               <span class="text-danger">
                  <i class="far fa-file-pdf fa-fw"></i>
                  Download All to PDF
               </span>
            </a>
         @endif --}}

      </div>
   </div>
@endauth