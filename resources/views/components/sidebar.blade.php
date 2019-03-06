<div class="card mb-2">
   <div class="card-header block_header">
      <i class="fas fa-boxes"></i>
      Components
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

      <a href="{{ route('components.index') }}" class="list-group-item list-group-item-action p-1 {{ Route::is('components.*') ? 'active' : '' }}">
         <i class="fas fa-boxes pl-2"></i>
         Components
         {{-- <div class="badge badge-primary float-right">
            {{ App\Comments::count() }}
         </div> --}}
      </a>

   </div>

</div>