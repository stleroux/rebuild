{{-- @auth --}}
   @if(checkPerm('recipe_delete', $recipe))
      <a href="{{ route('admin.recipes.trash', $recipe->id) }}"
         class="btn btn-{{ $size }} btn-danger text-light"
         title="Trash Recipe"><i class="{{ Config::get('buttons.trash') }}"></i></a>
   {{-- @else
      <a href="#"
         class="btn btn-{{ $size }} btn-primary disabled"
         title="Trash Recipe"><i class="{{ Config::get('buttons.trash') }} text-dark"></i></i></a> --}}
   @endif
{{-- @endauth --}}