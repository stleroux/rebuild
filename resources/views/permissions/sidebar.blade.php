<div class="card mb-2">
   <div class="card-header block_header">
      <i class="fas fa-shield-alt"></i>
      Permissions
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

      <a href="{{ route('permissions.index') }}" class="list-group-item list-group-item-action p-1 {{ Route::is('permissions.*') ? 'active' : '' }}">
         <i class="fas fa-shield-alt pl-2"></i>
         Permissions
      </a>

   </div>

</div>