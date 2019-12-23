@if(checkPerm('article_delete'))
   <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-danger text-light"
      type="submit"
      formaction="{{ route('admin.articles.trashAll') }}"
      formmethod="POST"
      id="bulk-trash"
      style="display:none;"
      title="Trash Selected"
      onclick="return confirm('Are you sure you want to trash these articles?')">
      <i class="{{ Config::get('buttons.trash') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif
