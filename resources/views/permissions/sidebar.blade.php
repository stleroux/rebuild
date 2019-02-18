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

      <a href="/"
         class="list-group-item list-group-item-action p-1">
         <i class="fas fa-home pl-2"></i>
         Frontend View
      </a>

      <a href="/dashboard"
         class="list-group-item list-group-item-action p-1">
         <i class="fas fa-cog pl-2"></i>
         Dashboard
      </a>

      <a href="{{ route('permissions.index') }}" class="list-group-item list-group-item-action p-1 {{ Route::is('permissions.index') ? 'active' : '' }}">
         <i class="fas fa-shield-alt pl-2"></i>
         Permissions
         <div class="badge badge-primary float-right">
            {{ App\Category::count() }}
         </div>
      </a>

      @if(checkPerm('user_create'))
         <a href="{{ route('permissions.create') }}" class="list-group-item list-group-item-action p-1 {{ Route::is('permissions.create') ? 'active' : '' }}">
            <i class="fas fa-plus-square pl-2"></i>
            New Permission
         </a>
      @endif

   </div>

</div>