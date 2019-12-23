@if(checkPerm('article_delete', $article))
   <a href="{{ route('admin.articles.restore', $article->id) }}"
      class="btn btn-{{ $size }} btn-info text-light"
      title="Restore Article">
      <i class="{{ Config::get('buttons.restore') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
