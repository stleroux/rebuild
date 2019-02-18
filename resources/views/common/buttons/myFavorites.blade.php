<button
   class="btn btn-sm btn-outline-secondary"
   type="button"
   title="My Favorites"
   onclick="window.location='{{ route($model.'s'.'.myFavorites') }}'">
   <i class="fab fa-gratipay"></i>
   @if($type == 'menu')
      My Favorites
   @endif
</button>