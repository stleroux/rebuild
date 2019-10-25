@if(checkPerm('article_edit'))
   @if(!$article->published_at)
      <a href="{{ route('admin.articles.publish', $article->id) }}"
         class="btn btn-{{ $size }} btn-primary text-light"
         title="Publish Article">
         <i class="{{ Config::get('buttons.publish') }} text-success"></i>
      </a>
   @else
      <a href="{{ route('admin.articles.unpublish', $article->id) }}"
         class="btn btn-{{ $size }} btn-primary text-light"
         title="Unpublish Article">
         <i class="{{ Config::get('buttons.publish') }} text-danger"></i>
      </a>
   @endif
@endif
