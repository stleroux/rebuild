@if(checkPerm('article_edit', $article))
   @if(!$article->published_at)
      <a href="{{ route('admin.articles.publish', $article->id) }}"
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
         title="Publish {$name}">
         <i class="{{ Config::get('buttons.publish') }} text-success"></i>
         {{ $btn_label ?? '' }}
      </a>
   @else
      <a href="{{ route('admin.articles.unpublish', $article->id) }}"
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
         title="Unpublish {$name}">
         <i class="{{ Config::get('buttons.publish') }} text-danger"></i>
         {{ $btn_label ?? '' }}
      </a>
   @endif
@endif
