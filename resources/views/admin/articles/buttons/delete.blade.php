@if(checkPerm('article_delete'))
   <a href="{{ route('admin.articles.delete', $article->id) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-danger text-light"
      title="Delete Article">
      <i class="{{ Config::get('buttons.delete') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
