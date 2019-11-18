<div class="card mb-2">
   <div class="card-header block_header p-2">
      <i class="far fa-"></i>
      Most Assigned Permissions
   </div>
   <div class="card-body p-2">
      <div class="text text-center">
         {{ DB::table('permission_user')->groupBy('user_id')->count() }}
      </div>
   </div>
</div>