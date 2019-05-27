{{-- @if(checkPerm('recipe_makePrivate', $recipe))
   <button
      class="btn btn-sm btn-secondary"
      type="submit"
      formaction="{{ route('recipes.makePrivate', $recipe->id) }}"
      formmethod="GET"
      title="Make Private">
      <i class="far fa-eye-slash"></i>
   </button>
@endif --}}


@if(checkPerm('recipe_makePrivate', $recipe))
   <a href="{{ route('recipes.makePrivate', $recipe->id) }}"
      class="btn btn-{{ $size }} btn-secondary"
      title="Make Private"><i class="{{ Config::get('buttons.private') }}"></i>
   </a>
@endif