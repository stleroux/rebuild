<div class="card mb-2">
   <div class="card-header block_header">
      <i class="fa fa-sitemap"></i>
      Users
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

      <a href="{{ route('users.index') }}" class="list-group-item list-group-item-action p-1 {{ Route::is('users.index') ? 'active' : '' }}">
         <i class="fa fa-sitemap pl-2"></i>
         Users
         <div class="badge badge-primary float-right">
            {{-- {{ App\Category::count() }} --}}
         </div>
      </a>

      @if(checkPerm('user_create'))
         <a href="{{ route('users.create') }}" class="list-group-item list-group-item-action p-1 {{ Route::is('users.create') ? 'active' : '' }}">
            <i class="fas fa-plus-square pl-2"></i>
            New User
         </a>
      @endif

   </div>

</div>