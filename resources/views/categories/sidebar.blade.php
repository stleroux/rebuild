<div class="card mb-2">
   <div class="card-header block_header">
      <i class="fa fa-sitemap"></i>
      Categories
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

      <a href="{{ route('categories.index') }}" class="list-group-item list-group-item-action p-1 {{ Route::is('categories.index') ? 'active' : '' }}">
         <i class="fa fa-sitemap pl-2"></i>
         Categories
         <div class="badge badge-primary float-right">
            {{ App\Category::count() }}
         </div>
      </a>

{{--       @if(checkPerm('user_create'))
         <a href="{{ route('categories.create') }}" class="list-group-item list-group-item-action p-1 {{ Route::is('categories.create') ? 'active' : '' }}">
            <i class="fas fa-plus-square pl-2"></i>
            New Category
         </a>
      @endif --}}

   </div>

</div>
