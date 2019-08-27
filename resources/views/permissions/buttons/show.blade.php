<a href="{{ route('permissions.show', $permission->id) }}"
   class="btn btn-{{ $size }} btn-primary text-light"
   title="Show Permission">
   <i class="{{ Config::get('buttons.show') }}"></i>
</a>
