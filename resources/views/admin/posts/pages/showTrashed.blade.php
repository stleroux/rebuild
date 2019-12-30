@extends('layouts.master')

@section('stylesheets')
@endsection

@section('left_column')
   @include('admin.posts.sidebar')
@endsection

@section('right_column')
@endsection

@section('content')
   
   <div class="card mb-2">
      <div class="card-header card_header">
         <i class="far fa-newspaper"></i>///
         {{ ucwords($post->title) }}
         <span class="float-right">
            <div class="btn-group">
               <a href="{{ route('posts.trashed') }}" class="btn btn-outline-secondary btn-sm px-1 py-0">
                  <i class="fas fa-angle-double-left"></i>
                  Back
               </a>
            </div>
         </span>
      </div>
      <div class="card-body card_body">
         <div class="row">
            <div class="col-8 pr-1">
               <div class="row text-center">
                  <div class="col-3 pr-1">
                     <div class="card mb-2 bg-transparent">
                        <div class="card-header card_header_2 py-0 pl-1 pr-0">Category</div>
                        <div class="card-body px-1 py-0">
                           {{ $post->category->name }}
                        </div>
                     </div>
                  </div>
                  <div class="col-3 px-1">
                     <div class="card mb-2 bg-transparent">
                        <div class="card-header card_header_2 py-0 pl-1 pr-0">Publish(ed) On</div>
                        <div class="card-body px-1 py-0">
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
                     <div class="card mb-2 bg-transparent">
                        <div class="card-header card_header_2 py-0 pl-1 pr-0">Views</div>
                        <div class="card-body px-1 py-0">
                           {{ $post->views }}
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col">
                     <div class="card mb-2 bg-transparent">
                        <div class="card-header card_header_2 py-0 pl-1 pr-0">Content</div>
                        <div class="card-body px-1 py-0">
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
                     <div class="card mb-2 bg-transparent">
                        <div class="card-header card_header_2 py-0 pl-1 pr-0">Tags</div>
                        <div class="card-body px-1 py-0">
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
                     <div class="card mb-2 bg-transparent">
                        <div class="card-header card_header_2 py-0 pl-1 pr-0">Image</div>
                        <div class="card-body px-0 py-0">
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
         <div class="row text-center">
            <div class="col-2 pr-1">
               <div class="card bg-transparent">
                  <div class="card-header card_header_2 py-0 pl-1 pr-0">Created By</div>
                  <div class="card-body px-1 py-0">
                     {{ ucfirst($post->user->username) }}
                  </div>
               </div>
            </div>
            <div class="col-2 px-1">
               <div class="card bg-transparent">
                  <div class="card-header card_header_2 py-0 pl-1 pr-0">Created On</div>
                  <div class="card-body px-1 py-0">
                     {{ $post->created_at->format('M d, Y') }}
                  </div>
               </div>
            </div>
            <div class="col-2 px-1">
               <div class="card bg-transparent">
                  <div class="card-header card_header_2 py-0 pl-1 pr-0">Updated By</div>
                  <div class="card-body px-1 py-0">
                     @if($post->updated_by_id)
                        {{ ucfirst($post->updated_by->username) }}
                     @else
                        {{ ucfirst($post->user->username) }}
                     @endif
                  </div>
               </div>
            </div>
            <div class="col-2 px-1">
               <div class="card bg-transparent">
                  <div class="card-header card_header_2 py-0 pl-1 pr-0">Updated On</div>
                  <div class="card-body px-1 py-0">
                     {{ $post->updated_at->format('M d, Y') }}
                  </div>
               </div>
            </div>
            <div class="col-2 px-1">
               <div class="card bg-transparent">
                  <div class="card-header card_header_2 py-0 pl-1 pr-0">Last Viewed By</div>
                  <div class="card-body px-1 py-0">
                     [LerouxH]
                  </div>
               </div>
            </div>
            <div class="col-2 pl-1">
               <div class="card bg-transparent">
                  <div class="card-header card_header_2 py-0 pl-1 pr-0">Last Viewed On</div>
                  <div class="card-body px-1 py-0">
                     [Dec 15, 2018]
                  </div>
               </div>
            </div>
         </div>

         <div class="row text-center">
            <div class="col-2 pr-1">
               <div class="card bg-transparent">
                  <div class="card-header card_header_2 py-0 pl-1 pr-0">Deleted On</div>
                  <div class="card-body px-1 py-0">
                     {{ $post->deleted_at->format('M d, Y') }}
                  </div>
               </div>
            </div>
         </div>

         <div class="row mt-2">
            <div class="col-12">
               <div class="card mb-2">
                  <div class="card-header card_header_2 py-0 pl-1 pr-0">
                     <i class="fa fa-comments-o" aria-hidden="true"></i>
                     Comments <small>({{ $post->comments()->count() }} total)</small>
                  </div>
                  <div class="card-body card_body">
                     @if($post->comments->count())
                        <table class="table table-hover table-sm">
                           <thead>
                              <tr>
                                 <th>Name</th>
                                 <th>Comment</th>
                                 <th>Posted On</th>
                                 <th></th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($post->comments as $comment)
                                 <tr>
                                    <td class="col-sm-1">
                                       {{-- @include('common.authorFormat', ['model'=>$comment, 'field'=>'user']) --}}
                                       {{ ucfirst($post->user->username) }}
                                    </td>
                                    <td>{{ $comment->comment }}</td>
                                    <td class="col-sm-1">
                                       {{-- @include('common.dateFormat', ['model'=>$comment, 'field'=>'created_at']) --}}
                                       {{ $post->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="text-right">
                                       {{-- @if(checkPerm('post_edit', $post)) --}}
                                       {{-- <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-sm btn-outline-bprimary" title="Edit Comment">
                                          <i class="far fa-edit"></i>
                                       </a> --}}
                                       {{-- @endif --}}
                                       {{-- @if(checkPerm('post_delete', $post)) --}}
                                       {{-- <a href="{{ route('comments.delete', $comment->id) }}" class="btn btn-sm btn-outline-danger" title="Delete Comment">
                                          <i class="far fa-trash-alt"></i>
                                       </a> --}}
                                       {{-- @endif --}}
                                    </td>
                                 </tr>
                              @endforeach
                           </tbody>
                        @else
                           No comments found
                        @endif
                     </table>
                  </div>
               </div>
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

@stop

@section('blocks')
   {{-- @include('blog.single.controls') --}}
   {{-- @include('blog.single.image') --}}
   {{-- @include('blog.single.information') --}}
   {{-- @include('common.information', ['model'=>$post, 'title'=>'Blog Post']) --}}
   {{-- @include('blog.blocks.archives') --}}
   {{-- @include('blog.single.leaveComment') --}}
@stop






@section ('scripts')
@stop