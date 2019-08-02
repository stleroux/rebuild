<button
   class="btn btn-{{ $size }} btn-primary border border-light text-warning"
   type="submit"
   formaction="{{ route('recipes.unpublishAll') }}"
   formmethod="POST"
   id="bulk-unpublish"
   title="Unpublish Selected"
   style="display:none;"
   onclick="return confirm('Are you sure you want to unpublish these recipes?')">
   <i class="{{ Config::get('buttons.publish') }}"></i>
</button>
