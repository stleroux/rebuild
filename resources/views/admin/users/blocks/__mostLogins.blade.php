<div class="card mb-2">
   <div class="card-header block_header p-2">
      <i class="far fa-"></i>
      Most Logins
   </div>
   <div class="card-body p-2">
      <div class="text text-center">
         {{-- <span class="badge badge-secondary border float-right">{{ App\Models\Recipes\Recipe::unpublished()->count() }}</span> --}}
         {{ \App\Models\User::orderBy('login_count','desc')->pluck('username')->first() }} &nbsp;
         [{{ \App\Models\User::orderBy('login_count','desc')->pluck('login_count')->first() }}]
         {{-- No Data Available --}}
         
      </div>
   </div>
</div>