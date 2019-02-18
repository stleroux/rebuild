<div class="card mb-2">
   <div class="card-header block_header">
      <i class="fa fa-cubes"></i>
      Modules
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

      <a href="{{ route('modules.index') }}" class="list-group-item list-group-item-action p-1 {{ Route::is('modules.index') ? 'active' : '' }}">
         <i class="fa fa-cubes pl-2"></i>
         Modules
         <div class="badge badge-primary float-right">
            {{-- {{ App\Category::count() }} --}}
         </div>
      </a>

      {{-- @if(checkPerm('user_create'))
         <a href="{{ route('modules.create') }}" class="list-group-item list-group-item-action p-1 {{ Route::is('modules.create') ? 'active' : '' }}">
            <i class="fas fa-plus-square pl-2"></i>
            New Module
         </a>
      @endif --}}

   </div>

</div>