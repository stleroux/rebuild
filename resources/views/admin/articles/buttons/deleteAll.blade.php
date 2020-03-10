@if(checkPerm('article_delete'))
   <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-danger"
      type="submit"
      formaction="{{ route('admin.articles.deleteAll') }}"
      formmethod="POST"
      id="bulk-delete"
      title="Delete Selected"
      style="display:none"
      onclick="return confirm('Are you sure you want to permanently delete these articles?')">
      <i class="{{ Config::get('buttons.delete') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif
