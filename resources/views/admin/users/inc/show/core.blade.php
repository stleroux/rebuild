<div class="card mb-2">
   <div class="card-body section_body p-2">
      <div class="card-columns">
         @foreach ($coreGroups as $group => $permissions)
            <div class="card mb-2">
               <div class="card-header card_header p-1">{{ ucfirst($group) }}</div>
               <div class="card-body section_body pt-0 pb-1 px-0">
                  @foreach($permissions as $permission)
                     <div class="form-group mb-0 pt-1 pb-0 px-1"
                        onMouseOver="this.style.background='#ABA', this.style.color='#000', this.style.fontWeight='bold'"
                        onMouseOut="this.style.background='', this.style.color='', this.style.fontWeight=''"
                        style="vertical-align: middle;"
                     >
                        <span class="switch switch-xs">
                           {{ Form::checkbox('permission[]', $permission->id, in_array($permission->id, $userPermissions) ? true : false, ['id'=>$permission->id, 'disabled'=>'disabled']) }}
                           <label for="{{$permission->id}}" title="Allow member to {{ strtolower($permission->description) }}">
                              {{ ucwords($permission->display_name) }}
                           </label>
                        </span>
                     </div>
                  @endforeach
               </div>
            </div>
         @endforeach
      </div>
   </div>
</div>