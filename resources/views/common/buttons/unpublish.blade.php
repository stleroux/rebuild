<button
   class="btn btn-sm btn-outline-secondary"
   type="submit"
   formaction="{{ route($model.'s'.'.unpublish', $id) }}"
   formmethod="GET"
   title="Unpublish">
   <i class="fas fa-download"></i>
   @if($type == 'menu')
      Unpublish
   @endif
</button>