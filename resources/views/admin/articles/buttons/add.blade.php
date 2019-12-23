@if(checkPerm('article_create'))
   <a href="{{ route('admin.articles.create') }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-success text-light"
      title="Add Article">
      <i class="{{ Config::get('buttons.add') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
