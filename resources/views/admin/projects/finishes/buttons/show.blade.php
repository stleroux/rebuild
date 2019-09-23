<a href="{{ route('admin.projects.finishes.show', $finish->id) }}"
   class="btn btn-{{ $size }} btn-primary text-light"
   title="Show Finish">
   <i class="{{ Config::get('buttons.show') }}"></i>
</a>