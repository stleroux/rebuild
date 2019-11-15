@if(checkPerm('recipe', $recipe))
   @if($recipe->personal == 0)
      <a href="{{ route('admin.recipes.privatize', $recipe->id) }}"
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary"
         title="Make Private">
         <i class="{{ Config::get('buttons.public') }} text-success"></i>
         {{ $btn_label ?? '' }}
      </a>
   @else
      <a href="{{ route('admin.recipes.publicize', $recipe->id) }}"
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary"
         title="Make Public">
         <i class="{{ Config::get('buttons.private') }} text-danger"></i>
         {{ $btn_label ?? '' }}
      </a>
   @endif
@endif
