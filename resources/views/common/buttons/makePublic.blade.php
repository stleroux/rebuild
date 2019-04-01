<button
   class="btn btn-sm btn-outline-secondary"
   type="submit"
   formaction="{{ route($model.'s'.'.makePublic', $id) }}"
   formmethod="GET"
   title="Make Public">
   <i class="far fa-eye"></i>
</button>