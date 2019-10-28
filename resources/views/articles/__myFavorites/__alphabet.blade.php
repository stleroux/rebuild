<div class="well well-sm text text-center" style="padding-top:4px; padding-bottom:4px; margin-top:0px; margin-bottom:0px;">
   <a href="{{ route('articles.myFavorites') }}" class="{{ Request::is('articles/myFavorites') ? "btn-secondary": "btn-primary" }} btn btn-sm">All</a>
   @foreach($letters as $value)
      <a href="{{ route('articles.myFavorites', $value) }}" class="{{ Request::is('articles/myFavorites/'.$value) ? "btn-secondary": "btn-primary" }} btn btn-sm">{{ strtoupper($value) }}</a>
   @endforeach
</div>