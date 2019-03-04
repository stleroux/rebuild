<div class="card mb-2">
   <div class="card-header block_header">
      <i class="fas fa-chart-pie"></i>
      Statistics
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

      <a href="{{ route('stats') }}" class="list-group-item list-group-item-action p-1 {{ Route::is('stats') ? 'active' : '' }}">
         <i class="fas fa-chart-pie pl-2"></i>
         Statistics
         <div class="badge badge-primary float-right">
            {{-- {{ App\Category::count() }} --}}
         </div>
      </a>

   </div>

</div>