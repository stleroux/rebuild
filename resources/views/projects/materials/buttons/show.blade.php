<a href="{{ route('materials.show', $material->id) }}"
   class="btn btn-{{ $size }} btn-primary text-light"
   title="Show Material">
   <i class="{{ Config::get('buttons.show') }}"></i>
</a>