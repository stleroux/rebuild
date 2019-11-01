<a href="{{ route('projects.index') }}"
   class="list-group-item list-group-item-action p-1 {{ (Route::is('projects.index') || Route::is('projects.show')) ? 'menu_active' : '' }}">
   <i class="fab fa-pagelines fa-fw"></i>
   Projects
</a>
