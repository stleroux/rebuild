<a href="{{ route($model.'s'.'.trash', $id) }}"
   class="btn btn-sm btn-outline-danger"
   title="Trash">
   <i class="far fa-trash-alt"></i>
   @if($type == 'menu')
      Trash
   @endif
</a>