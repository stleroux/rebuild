{{-- @if(checkPerm('article_edit', $article)) --}}
   <a href="{{ route('admin.articles.audits', $article->id) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
      title="Article Revisions">
      <i class="{{ Config::get('buttons.audits') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
{{-- @endif --}}