@if(checkPerm('article_delete', $article))
   <a href="{{ route('admin.articles.trash', $article->id) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-danger text-light"
      title="Trash Article">
      <i class="{{ Config::get('buttons.trash') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
