@if(checkPerm('project_read'))
   <a href="{{ route('admin.projects.finishes.show', $finish->id) }}"
      class="btn btn-{{ $size }} btn-primary text-light"
      title="Show Finish">
      <i class="{{ Config::get('buttons.show') }}"></i>
   </a>
{{-- 
<button
   class="btn btn-{{ $size }} btn-primary text-light"
   type="submit"
   formaction="{{ route('admin.projects.finishes.show', $finish->id) }}"
   formmethod="GET"
   title="Show Finish">
   <i class="{{ Config::get('buttons.show') }}"></i>
</button> --}}
@endif
