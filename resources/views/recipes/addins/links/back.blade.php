@if(Session::get('fromPage')==='recipes.index')
   <a href="{{ route('recipes.index','all') }}" class="btn btn-sm btn-primary">
      <i class="{{ Config::get('buttons.recipes') }}"></i>
   </a>
@elseif(Session::get('fromPage'))
   <a href="{{ route(Session::get('fromPage')) }}" class="btn btn-sm btn-primary">
      <i class="{{ Config::get('buttons.back') }}"></i>
   </a>
@endif

@foreach ($categories as $category)
   @if (false !== stripos($_SERVER['HTTP_REFERER'], "recipes/" . $category->name))
      <a href="{{ url('recipes/'.$category->name) }}" class="btn btn-sm btn-primary">
         <i class="{{ Config::get('buttons.back') }}"></i>
      </a>
   @endif
   @foreach ($category->children as $children)
      @if (false !== stripos($_SERVER['HTTP_REFERER'], "recipes/" . $children->name))
         <a href="{{ url('recipes/'.$children->name) }}" class="btn btn-sm btn-primary">
            <i class="{{ Config::get('buttons.back') }}"></i>
         </a>
      @endif
   @endforeach
@endforeach


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
--}}

{{--
@elseif (false !== stripos($_SERVER['HTTP_REFERER'], "recipes/archives"))
   <a href="{{ URL::previous() }}" class="btn btn-sm btn-outline-secondary">
      <i class="fa fa-arrow-left"></i>
   </a>
@else
   blah
@endif --}}

