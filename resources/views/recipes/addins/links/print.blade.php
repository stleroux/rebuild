<a href="{{ route('recipes.print', $recipe->id) }}"
   class="btn btn-sm btn-primary"
   title="Print Recipe">
   <i class="{{ Config::get('buttons.print') }}"></i>
</a>
