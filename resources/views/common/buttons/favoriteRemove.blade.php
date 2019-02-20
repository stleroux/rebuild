<button
   class="btn btn-sm btn-outline-secondary"
   type="submit"
   formaction="{{ route($model.'s'.'.favoriteRemove', $id) }}"
   formmethod="GET"
   title="Remove Favorite">
   <i class="far fa-thumbs-down"></i>
   @if($type == 'menu')
      Remove Favorite
   @endif
</button>