@extends('layouts.master')

@section ('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
   @include('blog.blocks.search')
   @include('blog.blocks.popularPosts')
   @include('blog.blocks.archives')
   @include('blog.blocks.leaveComment')
@endsection

@section('content')

   <div class="card mb-3">
      <div class="card-header section_header p-2">
         {{ ucwords($post->title) }}
         <span class="float-right">
            @auth
               <a href="" type="button" class="btn btn-sm btn-secondary px-1 py-0" data-toggle="modal" data-target="#printModal" data-link="{{ $post->slug }}">
                  <i class="fa fa-print"></i> Print
               </a>
            @endauth

            <!-- Only show if coming from the homepage -->
            @if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'home')
               <a href="{{ route('home') }}" class="btn btn-sm btn-primary px-1 py-0">
                  <i class="fas fa-home"></i> Home
               </a>
            @endif

            <!-- Only show if coming from the blog page -->
            @if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'blog.index')
               <a href="{{ route('blog.index') }}" class="btn btn-sm btn-primary px-1 py-0">
                  <i class="fas fa-blog"></i> Blog
               </a>
            @endif

            <!-- Show this button after posting a comment -->
            @if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'blog.single')
               <a href="{{ route('blog.index') }}" class="btn btn-sm btn-primary px-1 py-0">
                  <i class="fas fa-blog"></i> Blog
               </a>
            @endif

            <!-- Only show if coming from the blog print page -->
            @if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'blog.print')
               <a href="{{ route('blog.index') }}" class="btn btn-sm btn-primary px-1 py-0">
                  <i class="fas fa-blog"></i> Blog
               </a>
            @endif

            <!-- Only show if coming from the blog search page -->
            @if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'blog.search')
               <a href="{{ route('blog.index') }}" class="btn btn-sm btn-primary px-1 py-0">
                  <i class="fas fa-blog"></i> Blog
               </a>
               <a href="{{ URL::previous() }}" class="btn btn-sm btn-primary px-1 py-0">
                  <i class="fas fa-blog"></i> Search
               </a>
            @endif              

            <!-- Only show if coming from the blog archive page -->
            @if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'blog.archive')
               <a href="{{ route('blog.index') }}" class="btn btn-sm btn-primary px-1 py-0">
                  <i class="fas fa-blog"></i> Blog
               </a>
               <a href="{{ URL::previous() }}" class="btn btn-sm btn-primary px-1 py-0">
                  <i class="fas fa-blog"></i> Archive
               </a>
            @endif
         </span>
      </div>

      <div class="card-body section_body p-2">
         <div class="row">
            <div class="col-8 pr-1">
               <div class="row text-center">
                  <div class="col-3 pr-1">
                     <div class="card mb-2 bg-transparent">
                        <div class="card-header card_header p-1">Category</div>
                        <div class="card-body p-1">
                           {{ ucfirst($post->category->name) }}
                        </div>
                     </div>
                  </div>
                  <div class="col-3 px-1">
                     <div class="card mb-2 bg-transparent">
                        <div class="card-header card_header p-1">Published On</div>
                        <div class="card-body p-1">
                           {{ $post->published_at->format('M d, Y') }}
                        </div>
                     </div>
                  </div>
                  <div class="col-3 pl-1">
                     <div class="card mb-2 bg-transparent">
                        <div class="card-header card_header p-1">Views</div>
                        <div class="card-body p-1">
                           {{ $post->views }}
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col">
                     <div class="card mb-2 bg-transparent">
                        <div class="card-header card_header p-1">Content</div>
                        <div class="card-body p-1">
                           {{-- @if(checkPerm('post_show')) --}}
                              {!! $post->body !!}
                           {{-- @else
                              {!! substr(strip_tags($post->body), 0, 25) !!} {{ strlen(strip_tags($post->body)) > 25 ? ' [More]...' : '' }}
                           @endif --}}
                        </div>
                        {{-- @if(!checkPerm('post_show'))
                           <div class="card-footer bg-danger px-1 py-0">
                              Register or login to see more!
                           </div>
                        @endif --}}
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-4 pl-1">
               <div class="row">
                  <div class="col-12">
                     <div class="card mb-2 bg-transparent">
                        <div class="card-header card_header p-1">Image</div>
                        <div class="card-body p-1">
                           @if ($post->image)
                              {{-- @if(checkPerm('post_show')) --}}
                              @auth
                                 <a href="" data-toggle="modal" data-target="#imageModal">
                                    {{ Html::image("_posts/" . $post->image, "", array('height'=>'100%','width'=>'100%')) }}
                                 </a>
                              @else
                                 {{ Html::image("_posts/" . $post->image, "", array('height'=>'100%','width'=>'100%')) }}
                              @endauth
                           @endif
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <div class="row text-center">
            <div class="col-4 pr-1">
               <div class="card bg-transparent mb-2">
                  <div class="card-header card_header p-1">Created</div>
                  <div class="card-body p-0">
                     <div class="col">
                        <div class="row">
                           <div class="col-6 px-0">
                              <div class="card bg-transparent">
                                 <div class="card-header card_header p-1">By</div>
                                 <div class="card-body p-1">
                                    {{ ucfirst($post->user->username) }}
                                 </div>
                              </div>
                           </div>
                           <div class="col-6 px-0">
                              <div class="card bg-transparent">
                                 <div class="card-header card_header p-1">Date</div>
                                 <div class="card-body p-1">
                                    {{ $post->created_at->format('M d, Y') }}
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <div class="col-4 px-1">
               <div class="card bg-transparent mb-2">
                  <div class="card-header card_header p-1">Last Updated</div>
                  <div class="card-body p-0">
                     <div class="col">
                        <div class="row">
                           <div class="col-6 px-0">
                              <div class="card bg-transparent">
                                 <div class="card-header card_header p-1">By</div>
                                 <div class="card-body p-1">
                                    @if($post->updated_by_id)
                                       {{ ucfirst($post->updated_by->username) }}
                                    @else
                                       N/A
                                    @endif
                                 </div>
                              </div>
                           </div>
                           <div class="col-6 px-0">
                              <div class="card bg-transparent">
                                 <div class="card-header card_header p-1">Date</div>
                                 <div class="card-body p-1">
                                    @if($post->updated_by_id)
                                       {{ $post->updated_at->format('M d, Y') }}
                                    @else
                                       N/A
                                    @endif
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <div class="col-4 pl-1">
               <div class="card bg-transparent mb-2">
                  <div class="card-header card_header p-1">Last Viewed</div>
                  <div class="card-body p-0">
                     <div class="col">
                        <div class="row">
                           <div class="col-6 px-0">
                              <div class="card bg-transparent">
                                 <div class="card-header card_header p-1">By</div>
                                 <div class="card-body p-1">
                                    Not Tracked
                                 </div>
                              </div>
                           </div>
                           <div class="col-6 px-0">
                              <div class="card bg-transparent">
                                 <div class="card-header card_header p-1">Date</div>
                                 <div class="card-body p-1">
                                    Not Tracked
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <div class="row m-0 p-0">
            <div class="col m-0 p-0">
               @include('common.comments', ['model'=>$post])
            </div>
         </div>
      </div>
   </div>

   <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            {{-- <h4 class="modal-title" id="printPostModalLabel">Post Image</h4> --}}
            <h4 class="modal-title" id="imageModalLabel">
               {{-- {{ $title }} --}}
               Image Name
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span>&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>
               {{-- {{ Html::image($img_path . "/". $model->$img_name, "", array('height'=>'100%','width'=>'100%')) }} --}}
               {{ Html::image('_posts/'. $post->image, "", array('height'=>'100%','width'=>'100%')) }}
               {{-- 1498587512.jpg --}}
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
   </div>

   <div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="printModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="printModalLabel">
               {{-- {{ $title }} {{ ucfirst(str_singular($name)) }} --}}
               Print blog
            </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span>&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>To print this post, please use your browser's print functionality.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
            <a href="{{ route('blog.print', $post->id) }}" class="btn btn-sm btn-primary">
               <div class="text text-left">
                 <i class="fa fa-print"></i> Proceed
               </div>
            </a>
          </div>
        </div>
      </div>
   </div>
@endsection

@section ('scripts')
@endsection