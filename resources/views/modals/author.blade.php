{{--
   AUTHOR MODAL
      - model
      - fn
--}}
{{-- {{ $field }} --}}
<div class="modal fade" id="view{{ $field }}Modal{{ $model->id}}" tabindex="-1" role="dialog" aria-labelledby="view{{ $field }}ModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
            
         <div class="modal-header text-light">
            <h5 class="modal-title" id="printModalLabel">
               @if($field == 'user')
                  Author Details
               @elseif($field == 'modifiedBy')
                  Updated By
               @elseif($field == 'lastViewedBy')
                  Last Viewed By
               @endif
            </h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span>&times;</span>
            </button>
         </div>

         <div class="modal-body text-light">
            <div class="row mb-3">
               <div class="col text-center text-light">
                  @if($field == 'user')
                     @if(!empty($model->user->image))
                        <img src="/_profiles/{{ $model->user->image }}" height="100" width="100">
                     @else
                        <img src="/_profiles/no_photo.jpg" height="100" width="100">
                     @endif
                  @elseif($field == 'modifiedBy')
                     @if(!empty($model->modifiedBy->image))
                        <img src="/_profiles/{{ $model->modifiedBy->image }}" height="100" width="100">
                     @else
                        <img src="/_profiles/no_photo.jpg" height="100" width="100">
                     @endif
                  @elseif($field == 'lastViewedBy')
                     @if($model->lastViewedBy->image)
                        <img src="/_profiles/{{ $model->lastViewedBy->image }}" height="100" width="100">
                     @else
                        <img src="/_profiles/no_photo.jpg" height="100" width="100">
                     @endif
                  @else
                     <img src="/_profiles/no_photo.jpg" height="100" width="100">
                  @endif
               </div>
            </div>

            {{-- <div class="row"> --}}
               {{-- <div class="col"> --}}
                  <table class="table table-sm table-hover mb-0 text-light">
                     <tr>
                        <th class="text-right text-light">Username</th>
                        <td class="text-left">
                           @if($field == 'user')
                              {{ $model->user->username }}
                           @elseif($field == 'modifiedBy')
                              {{ $model->modifiedBy->username }}
                           @elseif($field == 'lastViewedBy')
                              {{ $model->lastViewedBy->username }}
                           @endif
                        </td>
                     </tr>
                     <tr>
                        <th class="text-right text-light">First Name</th>
                        <td class="text-left">
                           @if($field == 'user')
                              @if(isset($model->user->first_name))
                                 {{ $model->user->first_name }}
                              @else
                                 N/A
                              @endif
                           @elseif($field == 'modifiedBy')
                              @if(isset($model->modifiedBy->first_name))
                                 {{ $model->modifiedBy->first_name }}
                              @else
                                 N/A
                              @endif
                           @elseif($field == 'lastViewedBy')
                              @if(isset($model->lastViewedBy->first_name))
                                 {{ $model->lastViewedBy->first_name }}
                              @else
                                 N/A
                              @endif
                           @endif
                        </td>
                     </tr>
                     <tr>
                        <th class="text-right text-light">Last Name</th>
                        <td class="text-left">
                           @if($field == 'user')
                              @if(isset($model->user->last_name))
                                 {{ $model->user->last_name }}
                              @else
                                 N/A
                              @endif
                           @elseif($field == 'modifiedBy')
                              @if(isset($model->modifiedBy->last_name))
                                 {{ $model->modifiedBy->last_name }}
                              @else
                                 N/A
                              @endif
                           @elseif($field == 'lastViewedBy')
                              @if(isset($model->lastViewedBy->last_name))
                                 {{ $model->lastViewedBy->last_name }}
                              @else
                                 N/A
                              @endif
                           @endif
                        </td>
                     </tr>
                     <tr>
                        <th class="text-right text-light">Email Address</th>
                           @if($field == 'user')
                              @if($model->user->public_email === 1)
                                 <td class="text-left">{{ $model->user->email }}</td>
                              @else
                                 <td class="text-left">*************************</td>
                              @endif
                           @elseif($field == 'modifiedBy')
                              @if($model->modifiedBy->public_email === 1)
                                 <td class="text-left">{{ $model->modifiedBy->email }}</td>
                              @else
                                 <td class="text-left">*************************</td>
                              @endif
                           @elseif($field == 'lastViewedBy')
                              @if($model->lastViewedBy->public_email === 1)
                                 <td class="text-left">{{ $model->lastViewedBy->email }}</td>
                              @else
                                 <td class="text-left">*************************</td>
                              @endif
                           @endif
                     </tr>
                     <tr>
                        <th class="text-right text-light">Member Since</th>
                        <td class="text-left">
                            @if($field == 'user')
                              @if($model->user->created_at)
                                 {{ $model->user->created_at }}
                              @else
                                 Unknown
                              @endif
                           @elseif($field == 'modifiedBy')
                              @if($model->modifiedBy->created_at)
                                 {{ $model->modifiedBy->created_at }}
                              @else
                                 Unknown
                              @endif
                           @elseif($field == 'lastViewedBy')
                              @if($model->lastViewedBy->created_at)
                                 {{ $model->lastViewedBy->created_at }}
                              @else
                                 Unknown
                              @endif
                           @endif
                        </td>
                     </tr>
                  </table>
               {{-- </div> --}}
            {{-- </div> --}}
         </div>

         <div class="modal-footer p-1">
            <button type="button" class="btn btn-sm btn-outline-secondary px-1 py-0" data-dismiss="modal">Close</button>
         </div>
         
      </div>
   </div>
</div>