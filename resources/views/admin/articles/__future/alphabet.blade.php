<div class="well well-sm text text-center" style="padding-top:4px; padding-bottom:4px; margin-top:0px; margin-bottom:0px;">
	<a href="{{ route('admin.articles.future') }}" class="{{ Request::is('admin/articles/future') ? "btn-secondary": "btn-primary" }} btn btn-sm">All</a>
	@foreach($letters as $value)
		<a href="{{ route('admin.articles.future', $value) }}" class="{{ Request::is('admin/articles/future/'.$value) ? "btn-secondary": "btn-primary" }} btn btn-sm">{{ strtoupper($value) }}</a>
	@endforeach
</div>