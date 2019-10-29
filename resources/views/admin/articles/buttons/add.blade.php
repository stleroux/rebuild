@if(checkPerm('article_add'))
   <a href="{{ route('admin.articles.create') }}"
      data-toggle="modal"
      data-target="#add"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-success text-light"
      title="Add Article">
      <i class="{{ Config::get('buttons.add') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif

@include('admin.articles.modals.add')