<div class="text-center">
   <div class="btn-group" role="group">
      @if($page == 'index')
         <a href="{{ route($model.'s.'.$page) }}" class="{{ Request::is($model.'s') ? "btn-secondary": "btn-primary" }} btn btn-sm">All</a>
         @foreach($letters as $value)
            <a href="{{ route($model.'s.'.$page, $value) }}" class="{{ Request::is($model.'s/'.$value) ? "btn-secondary": "btn-primary" }} btn btn-sm">{{ strtoupper($value) }}</a>
         @endforeach
      @else
         <a href="{{ route($model.'s.'.$page) }}" class="{{ Request::is($model.'s/'.$page) ? "btn-secondary": "btn-primary" }} btn btn-sm">All</a>
         @foreach($letters as $value)
            <a href="{{ route($model.'s.'.$page, $value) }}" class="{{ Request::is($model.'s/'.$page.'/'.$value) ? "btn-secondary": "btn-primary" }} btn btn-sm">{{ strtoupper($value) }}</a>
         @endforeach
      @endif
   </div>
</div>