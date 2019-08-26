@if(checkPerm('recipe_publish'))
   <button
      class="btn btn-{{ $size }} btn-primary border border-light text-warning"
      type="submit"
      formaction="{{ route('recipes.publishAll') }}"
      formmethod="POST"
      id="bulk-publish"
      title="Publish Selected"
      style="display:none;"
      onclick="return confirm('Are you sure you want to publish these recipes?')">
      <i class="{{ Config::get('buttons.publish') }} text-success"></i>
   </button>
@endif
