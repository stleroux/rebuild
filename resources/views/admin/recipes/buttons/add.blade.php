@if(checkPerm('recipe_add'))
   <a href="{{ route('admin.recipes.create') }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-success"
      title="Add Recipe"
      type="button">
      <i class="{{ Config::get('buttons.add') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
