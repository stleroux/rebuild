<a href="{{ route($model.'s.'. Session::get('pageName')) }}" class="btn btn-sm btn-outline-secondary px-1 py-0">
   <i class="fas fa-angle-double-left"></i>
   Back
</a>


<button
   class="btn btn-sm btn-outline-secondary"
   type="submit"
   formaction="{{ route($model.'s'.'.publish', $id) }}"
   formmethod="GET"
   title="Publish">
   <i class="fas fa-upload"></i>
   @if($type == 'menu')
      Publish
   @endif
</button>