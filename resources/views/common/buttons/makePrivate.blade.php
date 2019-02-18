<a href="{{ route($model.'s'.'.makePrivate', $id) }}"
   class="btn btn-sm btn-outline-secondary"
   title="Make Private">
   <i class="far fa-eye-slash"></i>
   @if($type == 'menu')
      Make Private
   @endif
</a>