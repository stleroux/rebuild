@if(checkPerm('test_delete'))
   <button
      class="btn btn-{{ $size }} btn-danger text-light"
      type="submit"
      formaction="{{ route('admin.tests.trashAll') }}"
      formmethod="POST"
      id="bulk-trash"
      style="display:none;"
      title="Trash Selected"
      onclick="return confirm('Are you sure you want to trash these tests?')">
      <i class="{{ Config::get('buttons.trash') }}"></i>
   </button>
@endif
