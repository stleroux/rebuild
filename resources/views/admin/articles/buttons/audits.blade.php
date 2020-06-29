<a href="{{ route('admin.articles.audits', $article->id) }}"
   class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light d-print-none"
   title="Article Audits">
   <i class="{{ Config::get('buttons.articles') }}"></i>
</a>
