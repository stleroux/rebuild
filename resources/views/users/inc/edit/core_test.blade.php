<div class="card p-1">
   <div class="card-body p-1">
         @foreach ($coreGroups as $group => $permissions)
            <div class="card mb-2">
               <div class="card-header card_header_2 p-1">{{ ucfirst($group) }}</div>
               <div class="card-body card_body pt-1 pb-1 px-0">
                  <table width="100%" border="1" cellspacing="1" cellpadding="1">
                     <tbody>
                        <tr>
                        @foreach($permissions as $permission)
                           <td class="col-2">
                              <span class="switch switch-xs">
                                 {{ Form::checkbox('permission[]', $permission->id, false, ['id'=>$permission->id]) }}
                                 <label for="{{$permission->id}}">{{ ucfirst($permission->display_name) }}</label>
                              </span>
                              <span class="float-right">
                                 <a data-toggle="tooltip" title="Allow member to {{ strtolower($permission->description) }}">
                                    <i class="fas fa-info-circle"></i>
                                 </a>
                              </span>
                           </td>
                        @endforeach
                     </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         @endforeach
   </div>
</div>



{{-- @foreach($permissions as $permission)
                     <div class="form-group mb-0 pt-1 pb-0 px-1"
                        onMouseOver="this.style.background='#ABA', this.style.color='#000', this.style.fontWeight='bold'"
                        onMouseOut="this.style.background='', this.style.color='', this.style.fontWeight=''"
                        style="vertical-align: middle;"
                     >
                        <span class="switch switch-xs">
                           {{ Form::checkbox('permission[]', $permission->id, false, ['id'=>$permission->id]) }}
                           <label for="{{$permission->id}}">{{ ucfirst($permission->display_name) }}</label>
                        </span>
                        <span class="float-right">
                           <a data-toggle="tooltip" title="Allow member to {{ strtolower($permission->description) }}">
                              <i class="fas fa-info-circle"></i>
                           </a>
                        </span>
                     </div>
                  @endforeach --}}