@if(checkPerm('article_edit'))
   <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
      type="submit"
      formaction="{{ route('admin.articles.unpublishAll') }}"
      formmethod="POST"
      id="bulk-publish"
      style="display:none;"
      title="Unpublish Selected"
      onclick="return confirm('Are you sure you want to unpublish these articles?')">
      <i class="{{ Config::get('buttons.unpublish') }} text-danger"></i>
   </button>
@endif
