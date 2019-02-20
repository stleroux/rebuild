<button
   class="btn btn-sm btn-outline-secondary"
   type="submit"
   formaction="{{ route($model.'s'.'.index') }}"
   formmethod="GET"
   title="{{ ucfirst($model) }}s">
   <i class="fab fa-apple"></i>
   @if($type == 'menu')
      Recipes
   @endif
</button>