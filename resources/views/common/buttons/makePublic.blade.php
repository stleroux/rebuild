<a href="{{ route($model.'s'.'.makePublic', $id) }}"
   class="btn btn-sm btn-outline-secondary"
   title="Make Public">
   <i class="far fa-eye"></i>
   @if($type == 'menu')
      Make Public
   @endif
</a>
