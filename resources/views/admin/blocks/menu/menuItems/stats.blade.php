@if(checkPerm('site_stats'))
   <a href="{{ route('admin.stats') }}"
      class="list-group-item list-group-item-action p-1 {{ Route::is('admin.stats*') ? 'menu_active' : '' }}">
      <i class="fas fa-chart-pie fa-fw"></i>
      Site Statistics
   </a>
@endif
