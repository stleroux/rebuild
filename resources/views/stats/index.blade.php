@extends('layouts.backend')

@section('left_column')
   @include('blocks.adminNav')
   @include('stats.sidebar')
@endsection

@section('right_column')
@endsection

@section('content')

   <div class="row">
      <div class="col">
         <div class="card mb-2">
            <div class="card-header card_header">
               <i class="fas fa-chart-pie"></i>
               Site Statistics
            </div>
            <div class="card-body card_body">

               <div class="row">
                  <div class="col">
                     <div class="card mb-2">
                        <div class="card-header card_header_2">
                           {{-- <i class="fas fa-chart-pie"></i> --}}
                           Number of items in each model
                        </div>
                        <div class="card-body card_body px-1 py-0 m-0">

                           <div class="card-deck text-center px-2 py-0">
                              
                              <div class="card bg-bprimary col-sm-1 p-0 m-2">
                                 <div class="card-header p-0 m-0">Categories</div>
                                 <div class="card-body p-0 m-1">
                                    <i class="fas fa-4x fa-sitemap"></i>
                                 </div>
                                 <div class="card-footer m-0 p-0">
                                    <h1 class="p-0 m-0">{{ $categoryCount }}</h1>
                                 </div>
                              </div>

                              <div class="card bg-bprimary col-sm-1 p-0 m-2">
                                 <div class="card-header p-0 m-0">Comments</div>
                                 <div class="card-body p-0 m-1">
                                    <i class="fas fa-4x fa-comments"></i>
                                 </div>
                                 <div class="card-footer m-0 p-0">
                                    <h1 class="p-0 m-0">{{ $commentCount }}</h1>
                                 </div>
                              </div>

                              <div class="card bg-bprimary col-sm-1 p-0 m-2">
                                 <div class="card-header p-0 m-0">Components</div>
                                 <div class="card-body p-0 m-1">
                                    <i class="fas fa-4x fa-boxes"></i>
                                 </div>
                                 <div class="card-footer m-0 p-0">
                                    <h1 class="p-0 m-0">{{ $componentCount }}</h1>
                                 </div>
                              </div>

                              <div class="card bg-bprimary col-sm-1 p-0 m-2">
                                 <div class="card-header p-0 m-0">Members</div>
                                 <div class="card-body p-0 m-1">
                                    <i class="fas fa-4x fa-users"></i>
                                 </div>
                                 <div class="card-footer m-0 p-0">
                                    <h1 class="p-0 m-0">{{ $userCount }}</h1>
                                 </div>
                              </div>

                              <div class="card bg-bprimary col-sm-1 p-0 m-2">
                                 <div class="card-header p-0 m-0">Modules</div>
                                 <div class="card-body p-0 m-1">
                                    <i class="fas fa-4x fa-users"></i>
                                 </div>
                                 <div class="card-footer m-0 p-0">
                                    <h1 class="p-0 m-0">{{ $moduleCount }}</h1>
                                 </div>
                              </div>

                              <div class="card bg-bprimary col-sm-1 p-0 m-2">
                                 <div class="card-header p-0 m-0">Permissions</div>
                                 <div class="card-body p-0 m-1">
                                    <i class="fas fa-4x fa-shield-alt"></i>
                                 </div>
                                 <div class="card-footer m-0 p-0">
                                    <h1 class="p-0 m-0">{{ $permissionCount }}</h1>
                                 </div>
                              </div>

                              <div class="card bg-bprimary col-sm-1 p-0 m-2">
                                 <div class="card-header p-0 m-0">Posts</div>
                                 <div class="card-body p-0 m-1">
                                    <i class="fas fa-4x fa-newspaper"></i>
                                 </div>
                                 <div class="card-footer m-0 p-0">
                                    <h1 class="p-0 m-0">{{ $postCount }}
                                    </h1>
                                 </div>
                              </div>

                              <div class="card bg-bprimary col-sm-1 p-0 m-2">
                                 <div class="card-header p-0 m-0">Projects</div>
                                 <div class="card-body p-0 m-1">
                                    <i class="fab fa-4x fa-pagelines"></i>
                                 </div>
                                 <div class="card-footer m-0 p-0">
                                    <h1 class="p-0 m-0">{{-- {{ App\Project::count() }} --}}</h1>
                                 </div>
                              </div>

                              <div class="card bg-bprimary col-sm-1 p-0 m-2">
                                 <div class="card-header p-0 m-0">Recipes</div>
                                 <div class="card-body p-0 m-1">
                                    <i class="fab fa-4x fa-apple"></i>
                                 </div>
                                 <div class="card-footer m-0 p-0">
                                    <h1 class="p-0 m-0">
                                       {{ $recipeCount }}
                                    </h1>
                                 </div>
                              </div>

                           </div>
                        </div>
                     </div>
                  </div>
               </div>

                  <div class="row">
                     <div class="col">
                        <div class="card mb-2">
                           <div class="card-header card_header_2">
                              <i class="fas fa-chart-pie"></i>
                              Site Statistics
                           </div>
                           <div class="card-body card_body">
                              <div class="row px-2">
                              <table class="table table-mini table-hover col-sm-3 mx-1">
                                 <thead>
                                    <tr>
                                       <th colspan="2">Categories</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($modules as $module)
                                       <tr>
                                          <td>{{ ucwords($module->name) }}</td>
                                          <td align="center">{!! App\Category::where('module_id', '=', $module->id)->count() !!}</td>
                                       </tr>
                                    @endforeach
                                 </tbody>
                              </table>

                              <table class="table table-mini table-hover col-sm-3 mx-1">
                                 <thead>
                                    <tr>
                                       <th colspan="2">Comments</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($comments as $comment)
                                       <tr>
                                          <td>{{ ucwords($comment->commentable_type) }}</td>
                                          <td align="center">{!! App\Comment::where('commentable_type', '=', $comment->commentable_type)->count() !!}</td>
                                       </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                              </div>

                           </div>
                        </div>
                     </div>
                  </div>

            </div>

            <div class="card-footer px-1 py-0">
               
            </div>

         </div>
      </div>
   </div>



@endsection