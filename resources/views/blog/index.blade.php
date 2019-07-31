@extends ('layouts.master')

@section ('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@stop

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
   @include('blog.blocks.search')
   @include('blog.blocks.popularPosts')
   @include('blog.blocks.archives')
@stop

@section('content')
   
   @if(count($posts) > 0)
      <div class="card mb-2">
         <div class="card-header section_header p-2">
            <i class="fas fa-blog"></i>
            Blog
         </div>
         <div class="card-body section_body p-2">
            @foreach ($posts as $post)
               <div class="card mb-2">
                  <div class="card-header card_header p-2">
                     <i class="far fa-newspaper"></i>
                     {{ $post->title }}
                  </div>
                  <div class="card-body section_body">
                     
                     <div class="row">
                     
                        <div class="col-1 px-3">
                           @if ($post->user->image)
                              {{ Html::image("images/profiles/" . $post->user->image, "",array('height'=>'60','width'=>'60')) }}
                           @else
                              <i class="fa fa-3x fa-user" aria-hidden="true"></i>
                           @endif                  
                        </div>
                        <div class="col-9 px-2">
                           <p>{!! substr(strip_tags($post->body), 0, 250) !!} {{ strlen(strip_tags($post->body)) > 250 ? ' [More]...' : '' }}</p>
                        </div>
                        <div class="col px-2 text text-right">
                           <a href="{{ route('blog.single', $post->slug) }}" class="btn btn-sm btn-primary">
                              <i class="fa fa-chevron-right"></i> Read More
                           </a>
                        </div>
                     </div>
                     
                  </div>
                  <div class="card-footer card_footer p-1">
                     Created by {{-- {{ ucfirst($post->user->username) }} --}}
                        @include('common.authorFormat', ['model'=>$post, 'field'=>'user'])
                     on {{-- {{ $post->created_at->format('M d, Y') }} --}}
                        @include('common.dateFormat', ['model'=>$post, 'field'=>'created_at'])
                  </div>
               </div>
            @endforeach

            <div class="pb-2">
               {{-- {{ $posts->links('vendor.pagination.simple-bootstrap-4') }} --}}
               {{ $posts->links() }}
            </div>
         </div>
      </div>

   @else
      {{-- @include('common.noRecordsFound', ['color'=>'primary', 'name'=>'Blog Entries', 'icon'=>'newspaper-o']) --}}
      <div class="card mb-2">
         <div class="card-header section_header">
            <i class="fa fa-newspaper-o"></i>
            Blog
         </div>
         <div class="card-body section_body">
            No Records Found
         </div>
      </div>
   @endif
@stop

@section ('scripts')
@stop
