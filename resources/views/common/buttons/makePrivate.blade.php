<button
   class="btn btn-sm btn-outline-secondary"
   type="submit"
   formaction="{{ route($model.'s'.'.makePrivate', $id) }}"
   formmethod="GET"
   title="Make Private">
   <i class="far fa-eye-slash"></i>
   @if($type == 'menu')
      Make Private
   @endif
</button>