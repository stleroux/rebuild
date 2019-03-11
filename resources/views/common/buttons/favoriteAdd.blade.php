{{-- <button
   class="btn btn-sm btn-outline-secondary"
   type="submit"
   formaction="{{ route($model.'s'.'.favoriteAdd', $id) }}"
   formmethod="GET"
   title="Add Favorite">
   <i class="far fa-thumbs-up"></i>
   @if($type == 'menu')
      Add Favorite
   @endif
</button> --}}

<a href="{{ route(str_plural($model).'.favoriteAdd', $id) }}"
   class="btn btn-sm btn-outline-secondary"
   title="Add Favorite">
   <i class="fas fa-heart"></i>
   @if($type == 'menu')
      Add Favorite
   @endif
</a>