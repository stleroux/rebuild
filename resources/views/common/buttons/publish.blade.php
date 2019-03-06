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