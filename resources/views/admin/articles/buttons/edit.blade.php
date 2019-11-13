@if(checkPerm('article_edit', $article))
   <a href="{{ route('admin.articles.edit', $article->id) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-info text-light"
      title="Edit Article">
      <i class="{{ Config::get('buttons.edit') }}"></i>
   </a>
@endif