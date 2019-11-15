@if(checkPerm('recipe_edit'))
   @if($recipe->published_at)
      <a href="{{ route('admin.recipes.unpublish', $recipe->id) }}"
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary"
         title="Unpublish Recipe">
         <i class="{{ Config::get('buttons.publish') }} text-danger"></i>
         {{ $btn_label ?? '' }}
      </a>
   @else
      <a href="{{ route('admin.recipes.publish', $recipe->id) }}"
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary"
         title="Publish Recipe">
         <i class="{{ Config::get('buttons.publish') }} text-success"></i>
         {{ $btn_label ?? '' }}
      </a>
   @endif
@endif
