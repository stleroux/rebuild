@extends ('layouts.print')

@section ('stylesheets')
   {{ Html::style('css/print.css') }}
@stop

@section ('content')
   <div class="card mt-5">
      <div class="card-header p-2">
         {{ $post->title }}
         <span class="float-right">
            <a href="{{ route('blog.single', $post->slug) }}" class="btn btn-sm btn-outline-secondary d-print-none px-1 py-0">Return</a>
            <a href="" class="btn btn-sm btn-outline-primary d-print-none px-1 py-0" onClick="window.print()">Print</a>
         </span>
      </div>
      <div class="card-body card_body p-2">
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
                        <div class="card-header card_header_2 py-0 pl-1 pr-0">Published On</div>
                        <div class="card-body px-1 py-0">
                           {{ $post->published_at->format('M d, Y') }}
                        </div>
                     </div>
                  </div>
                  <div class="col-3 pl-1">
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
                           @endif
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row text-center">
            <div class="col-4 pr-1">
               <div class="card bg-transparent">
                  <div class="card-header card_header_2 py-0 pl-1 pr-0">Created</div>
                  <div class="card-body px-0 py-0">
                     <div class="col">
                        <div class="row">
                           <div class="col-6 px-0">
                              <div class="card bg-transparent">
                                 <div class="card-header card_header_2 py-0 pl-1 pr-0">By</div>
                                 <div class="card-body px-1 py-0">
                                    {{ ucfirst($post->user->username) }}
                                 </div>
                              </div>
                           </div>
                           <div class="col-6 px-0">
                              <div class="card bg-transparent">
                                 <div class="card-header card_header_2 py-0 pl-1 pr-0">Date</div>
                                 <div class="card-body px-1 py-0">
                                    {{ $post->created_at->format('M d, Y') }}
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <div class="col px-1">
               <div class="card bg-transparent">
                  <div class="card-header card_header_2 py-0 pl-1 pr-0">Last Updated</div>
                  <div class="card-body px-0 py-0">
                     <div class="col">
                        <div class="row">
                           <div class="col-6 px-0">
                              <div class="card bg-transparent">
                                 <div class="card-header card_header_2 py-0 pl-1 pr-0">By</div>
                                 <div class="card-body px-1 py-0">
                                    @if($post->updated_by_id)
                                       {{ ucfirst($post->updated_by->username) }}
                                    @endif
                                 </div>
                              </div>
                           </div>
                           <div class="col-6 px-0">
                              <div class="card bg-transparent">
                                 <div class="card-header card_header_2 py-0 pl-1 pr-0">Date</div>
                                 <div class="card-body px-1 py-0">
                                    @if($post->updated_by_id)
                                       {{ $post->updated_at->format('M d, Y') }}
                                    @endif
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <div class="col pl-1">
               <div class="card bg-transparent">
                  <div class="card-header card_header_2 py-0 pl-1 pr-0">Last Viewed</div>
                  <div class="card-body px-0 py-0">
                     <div class="col">
                        <div class="row">
                           <div class="col-6 px-0">
                              <div class="card bg-transparent">
                                 <div class="card-header card_header_2 py-0 pl-1 pr-0">By</div>
                                 <div class="card-body px-1 py-0">
                                    Not Tracked
                                 </div>
                              </div>
                           </div>
                           <div class="col-6 px-0">
                              <div class="card bg-transparent">
                                 <div class="card-header card_header_2 py-0 pl-1 pr-0">Date</div>
                                 <div class="card-body px-1 py-0">
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
      </div> 
      <div class="card-footer card_footer pl-2 p-1">
         From the Blog at TheWoodBarn.ca
      </div>
   </div>
     
@stop
