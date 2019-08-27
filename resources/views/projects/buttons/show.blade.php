<a href="{{ route('projects.show', $project->id) }}"
   class="btn btn-{{ $size }} btn-primary text-light"
   title="Show Project">
   <i class="{{ Config::get('buttons.show') }}"></i>
</a>
