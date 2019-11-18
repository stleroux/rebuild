<div class="card mb-2">
   <div class="card-header block_header p-2">Total Permissions</div>
   <div class="card-body p-2">
      <div class="text text-center">
         {{ App\Models\Permission::count() }}
      </div>
   </div>
</div>