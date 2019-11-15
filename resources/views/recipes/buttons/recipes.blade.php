<a href="{{ route('recipes.index', 'all') }}"
   class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary"
   title="Recipes">
   <i class="{{ Config::get('buttons.recipes') }}"></i>
   {{ $btn_label ?? '' }}
</a>