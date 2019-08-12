<div class="card mb-2">
   <div class="card-header card_header p-2">Profile Image</div>
   <div class="card-body section_body p-2">
      <div class="form-row">
         <label>Total permissions</label>
         <input type="text" class="form-control form-control-sm" value="{{ $user->permissions->count() }}" disabled>
         <span class="badge badge-primary"></span>
      </div>
   </div>
</div>