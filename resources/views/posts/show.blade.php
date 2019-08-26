@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
@endsection

@section('content')
   
   <div class="card mb-2">
      <div class="card-header card_header p-2">
         <i class="far fa-newspaper"></i>
         {{ ucwords($post->title) }}
         <span class="float-right">
            <div class="btn-group">
               @include('posts.buttons.back', ['size'=>'xs'])
            </div>
         </span>
      </div>
      <div class="card-body section_body p-2">
         <div class="row">
            <div class="col-8 pr-1">
               <div class="row text-center">
                  <div class="col-3 pr-1">
                     <div class="card mb-2">
                        <div class="card-header card_header p-1">Category</div>
                        <div class="card-body p-1">
                           {{ ucfirst($post->category->name) }}
                        </div>
                     </div>
                  </div>
                  <div class="col-3 px-1">
                     <div class="card mb-2">
                        <div class="card-header card_header p-1">Publish(ed) On</div>
                        <div class="card-body p-1">
                           @if($post->published_at)
                              @if($post->published_at > Carbon\Carbon::Now())
                                 <div class="text-danger"><b>{{ $post->published_at->format('M d, Y') }}</b></div>
                              @else
                                 {{ $post->published_at->format('M d, Y') }}
                              @endif
                           @else
                              N/A
                           @endif
                        </div>
                     </div>
                  </div>
                  <div class="col-3 px-1">
                     <div class="card mb-2">
                        <div class="card-header card_header p-1">Views</div>
                        <div class="card-body p-1">
                           {{ $post->views }}
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col">
                     <div class="card mb-2">
                        <div class="card-header card_header p-1">Content</div>
                        <div class="card-body p-1">
                           @if(checkPerm('post_show'))
                              {!! $post->body !!}
                           @else
                              {!! substr(strip_tags($post->body), 0, 250) !!} {{ strlen(strip_tags($post->body)) > 250 ? ' [More]...' : '' }}
                           @endif
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col">
                     <div class="card mb-2">
                        <div class="card-header card_header p-1">Tags</div>
                        <div class="card-body p-1">
                           @if($post->tags->count() > 0)
                              @foreach ($post->tags as $tag)
                                 <span class="badge badge-secondary">{{ $tag->name }}</span>
                              @endforeach
                           @else
                              No Tags Found
                           @endif
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-4 pl-1">
               <div class="row">
                  <div class="col-12">
                     <div class="card mb-2">
                        <div class="card-header card_header p-1">Image</div>
                        <div class="card-body p-1">
                           @if ($post->image)
                              @if(checkPerm('post_show'))
                                 <a href="" data-toggle="modal" data-target="#imageModal">
                                    {{ Html::image("_posts/" . $post->image, "", array('height'=>'100%','width'=>'100%')) }}
                                 </a>
                              @else
                                 {{ Html::image("_posts/" . $post->image, "", array('height'=>'100%','width'=>'100%')) }}
                              @endif
                           @else
                              No image associated to this post
                           @endif
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row text-center mb-2">
            <div class="col-2 pr-1">
               <div class="card">
                  <div class="card-header card_header p-1">Created By</div>
                  <div class="card-body p-1">
                     @include('common.authorFormat', ['model'=>$post, 'field'=>'user'])
                     {{-- {{ ucfirst($post->user->username) }} --}}
                  </div>
               </div>
            </div>
            <div class="col-2 px-1">
               <div class="card">
                  <div class="card-header card_header p-1">Created On</div>
                  <div class="card-body p-1">
                     @include('common.dateFormat', ['model'=>$post, 'field'=>'user'])
                     {{-- {{ $post->created_at->format('M d, Y') }} --}}
                  </div>
               </div>
            </div>
            <div class="col-2 px-1">
               <div class="card">
                  <div class="card-header card_header p-1">Updated By</div>
                  <div class="card-body p-1">
                     @include('common.authorFormat', ['model'=>$post, 'field'=>'modifiedBy'])
                     {{-- @if($post->updated_by_id)
                        {{ ucfirst($post->updated_by->username) }}
                     @else
                        {{ ucfirst($post->user->username) }}
                     @endif --}}
                  </div>
               </div>
            </div>
            <div class="col-2 px-1">
               <div class="card">
                  <div class="card-header card_header p-1">Updated On</div>
                  <div class="card-body p-1">
                     @include('common.dateFormat', ['model'=>$post, 'field'=>'updated_at'])
                     {{-- {{ $post->updated_at->format('M d, Y') }} --}}
                  </div>
               </div>
            </div>
            <div class="col-2 px-1">
               <div class="card">
                  <div class="card-header card_header p-1">Last Viewed By</div>
                  <div class="card-body p-1">
                     [LerouxH]
                  </div>
               </div>
            </div>
            <div class="col-2 pl-1">
               <div class="card">
                  <div class="card-header card_header p-1">Last Viewed On</div>
                  <div class="card-body p-1">
                     [Dec 15, 2018]
                  </div>
               </div>
            </div>
         </div>

         @include('common.comments', ['model'=>$post])

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
                  <span aria-hidden="true">&times;</span>
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

@endsection

@section('blocks')
   {{-- @include('blog.single.controls') --}}
   {{-- @include('blog.single.image') --}}
   {{-- @include('blog.single.information') --}}
   {{-- @include('common.information', ['model'=>$post, 'title'=>'Blog Post']) --}}
   {{-- @include('blog.blocks.archives') --}}
   {{-- @include('blog.single.leaveComment') --}}
@endsection






@section ('scripts')
@endsection