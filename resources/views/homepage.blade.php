@extends('layouts.master')

@section ('stylesheets')
   {{-- {{ Html::style('css/woodbarn.css') }} --}}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
   {{-- @include('blocks.login') --}}
   @include('blocks.popularItems')
	{{-- @include('blocks.recipesArchive') --}}
   {{-- @include('blocks.postsArchive') --}}
   @include('blocks.projectsImageSlider')
@endsection

@section('content')

	{{-- @include('homepage.greeting') --}}
   {{-- GREETING --}}
   <div class="card mb-2">
      <div class="card-header card_header">Welcome to TheWoodBarn.ca</div>
      <div class="card-body card_body">
         <p>Welcome to the newly redesigned TheWoodBarn.ca site.</p>
         <p>Note that the site now features a left hand side menu that will update based on your access privileges to the different sections of the site that you are currently visiting.</p>
      </div>
   </div>
{{--    <div class="card mb-2">
      <div class="card-header card_header">{{ $introPost->title }}</div>
      <div class="card-body card_body">
         {!! $introPost->body !!}
      </div>
   </div> --}}

	{{-- @include('homepage.newUser') --}}
   {{-- NEW USER --}}
   @auth
      @if(auth::user()->login_count <= setting('login_count_warning'))
         <div class="card mb-2">
            <div class="card-header card_header">First Time User</div>
            <div class="card-body card_body">
               <p>Welcome to the site, first time user.</p>
               <p>We hope you will enjoy your stay with us.</p>
               <p>Feel free to browse around.</p>
            </div>
         </div>
      @endif
   @endauth

	{{-- @include('homepage.warning') --}}
   {{-- WARNING --}}
   @auth
      @if(
         (Auth::user()->profile->first_name == '') OR
         (Auth::user()->profile->last_name == '') OR
         (Auth::user()->profile->telephone == ''))
            <div class="card mb-2">
               <div class="card-header text-white bg-danger p-2">
                  <i class="fa fa-exclamation" aria-hidden="true"></i>
                  Your user profile is incomplete!
               </div>
               <div class="card-body p-2">
                  Please rectify this oversight by clicking <a href="{{ route('profile.edit', Auth::user()->id) }}">here</a>
               </div>
            </div>
      @endif
   @endauth

	{{-- @include('homepage.interests') --}}
   {{-- INTERESTS --}}
   <div class="card mb-2">
      <div class="card-header card_header">
            <i class="fa fa-smile-o" aria-hidden="true"></i>
            Sections of interest on the site
      </div>
      <div class="card-body card_body">
         
         <div class="card bg-transparent mb-2">
            <div class="card-header card_header_2">
                  <i class="fab fa-pagelines"></i>
                  Wood Projects
            </div>
            <div class="card-body card_body">
               <p>Check out this area to feast your eyes on the woodworking projects we have worked on in our shop.</p>
               <p>There will be before and after pictures of the materials being used to create the different items as well as some info on the materials used in the finishing process and other relevant details.</p>
            </div>
         </div>
         
         <div class="card bg-transparent mb-2">
            <div class="card-header card_header_2">
                  <i class="far fa-address-card"></i>
                  Recipes
            </div>
            <div class="card-body card_body">
               <p>The title says it all. Access this section to see recipes contributed by some of our members.</p>
            </div>
         </div>

         <div class="card bg-transparent mb-2">
            <div class="card-header card_header_2">
                  <i class="far fa-newspaper"></i>
                  The Blog
            </div>
            <div class="card-body card_body">
               <p>Here you will find the latest news of the site. Keep an eye on this section to find out what is happening with the site.</p>
            </div>
         </div>

      </div>
   </div>

	{{-- @include('homepage.blog') --}}
   {{-- BLOG --}}
   @if($posts->count() > 0)
      <div class="card mb-3">
         <div class="card-header card_header">
            <i class="far fa-newspaper" aria-hidden="true"></i>
            Latest Posts
         </div>
         <div class="card-body card_body">
            @if(count($posts) > 0)
               @foreach ($posts as $post)
                  <div class="card mb-2 bg-transparent">
                     <div class="card-header card_header_2">{{ $post->title }}</div>
                     <div class="card-body card_body">
                        <div class="row">
                        <div class="col-sm-10">
                           <p>{{ substr(strip_tags($post->body), 0, 250) }} {{ strlen(strip_tags($post->body)) > 250 ? " [More]..." : "" }}</p>
                        </div>
                        <div class="col-sm-2">
                           {{-- <a href="{{ url('posts::blog/'.$post->slug) }}" class="btn btn-sm btn-primary"> --}}
                              <a href="{{ route('blog.single', $post->slug) }}" class="btn btn-sm btn-primary float-right">
                              <div class="text text-left">
                                 <i class="fa fa-chevron-right" aria-hidden="true"></i> Read More
                              </div>
                           </a>
                        </div>
                        </div>
                     </div>
                     <div class="card-footer bg-transparent px-1 py-1">
                        Created by {{ $post->user->username }}
                        {{-- @include('common.authorFormat', ['model'=>$post, 'field'=>'user']) --}}
                        on {{-- @include('common.dateFormat', ['model'=>$post, 'field'=>'created_at']) --}}
                        {{ $post->created_at->format('M d, Y') }}
                     </div>
                  </div>
               @endforeach
            @else
               {{-- @include('common.noRecordsFound', ['name'=>'Latest Posts', 'icon'=>'newspaper-o', 'color'=>'primary']) --}}
               No Records Found
            @endif
         </div>
      </div>
   @endif
   

@endsection
