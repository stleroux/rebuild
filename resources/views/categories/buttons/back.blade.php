{{-- @if (false !== stripos($_SERVER['HTTP_REFERER'], "/"))
   <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary">
      <i class="fa fa-home"></i>
   </a>
@endif --}}
<a href="{{ route('categories.index') }}"
   class="btn btn-{{ $size }} btn-primary text-light">
   <i class="fas fa-angle-double-left"></i>
</a>

{{-- @if (false !== stripos($_SERVER['HTTP_REFERER'], "/recipes/all"))
   <a href="{{ route('recipes.index', 'all') }}" class="btn btn-sm btn-outline-secondary">
      <i class="fa fa-arrow-left"></i>
   </a>
@elseif (false !== stripos($_SERVER['HTTP_REFERER'], "/recipes/published"))
   <a href="{{ route('recipes.published') }}" class="btn btn-sm btn-outline-secondary">
      <i class="fa fa-arrow-left"></i>
   </a>
@elseif (false !== stripos($_SERVER['HTTP_REFERER'], "/recipes/unpublished"))
   <a href="{{ route('recipes.unpublished') }}" class="btn btn-sm btn-outline-secondary">
      <i class="fa fa-arrow-left"></i>
   </a>
@elseif (false !== stripos($_SERVER['HTTP_REFERER'], "/recipes/newRecipes"))
   <a href="{{ route('recipes.newRecipes') }}" class="btn btn-sm btn-outline-secondary">
      <i class="fa fa-arrow-left"></i>
   </a>
@elseif (false !== stripos($_SERVER['HTTP_REFERER'], "/recipes/future"))
   <a href="{{ route('recipes.future') }}" class="btn btn-sm btn-outline-secondary">
      <i class="fa fa-arrow-left"></i>
   </a>
@elseif (false !== stripos($_SERVER['HTTP_REFERER'], "/recipes/myRecipes"))
   <a href="{{ route('recipes.myRecipes') }}" class="btn btn-sm btn-outline-secondary">
      <i class="fa fa-arrow-left"></i>
   </a>
@elseif (false !== stripos($_SERVER['HTTP_REFERER'], "/recipes/myPrivateRecipes"))
   <a href="{{ route('recipes.myPrivateRecipes') }}" class="btn btn-sm btn-outline-secondary">
      <i class="fa fa-arrow-left"></i>
   </a>

@foreach ($categories as $category)
   @if (false !== stripos($_SERVER['HTTP_REFERER'], "recipes/" . $category->name))
      <a href="{{ url('recipes/'.$category->name) }}" class="btn btn-sm btn-outline-secondary">
         <i class="fa fa-arrow-left"></i>
      </a>
   @endif
   @foreach ($category->children as $children)
      @if (false !== stripos($_SERVER['HTTP_REFERER'], "recipes/" . $children->name))
         <a href="{{ url('recipes/'.$children->name) }}" class="btn btn-sm btn-outline-secondary">
            <i class="fa fa-arrow-left"></i>
         </a>
      @endif
   @endforeach
@endforeach

@elseif (false !== stripos($_SERVER['HTTP_REFERER'], "recipes/archives"))
   <a href="{{ URL::previous() }}" class="btn btn-sm btn-outline-secondary">
      <i class="fa fa-arrow-left"></i>
   </a>
@else
   blah
@endif --}}

