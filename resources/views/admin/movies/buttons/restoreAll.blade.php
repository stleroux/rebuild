@if(checkPerm('movie_delete'))
   <button
      class="btn btn-{{ $size }} btn-info text-light"
      type="submit"
      formaction="{{ route('admin.movies.restoreAll') }}"
      formmethod="POST"
      id="bulk-restore"
      style="display:none;"
      title="Restore Selected"
      onclick="return confirm('Are you sure you want to restore these movies?')">
      <i class="{{ Config::get('buttons.restore') }}"></i>
   </button>
@endif
