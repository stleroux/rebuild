@if(checkPerm('article_edit'))
   <button
      class="btn btn-{{ $size }} btn-primary text-light"
      type="submit"
      formaction="{{ route('admin.articles.publishAll') }}"
      formmethod="POST"
      id="bulk-publish"
      style="display:none;"
      title="Publish Selected"
      onclick="return confirm('Are you sure you want to publish these articles?')">
      <i class="{{ Config::get('buttons.publish') }} text-success"></i>
   </button>
@endif
