@if(checkPerm('article_read', $article))
   <a href="{{ route('admin.articles.show', $article->id) }}"
      class="btn btn-{{ $size }} btn-primary text-light"
      title="Show Article">
      <i class="{{ Config::get('buttons.show') }}"></i>
   </a>
@endif
