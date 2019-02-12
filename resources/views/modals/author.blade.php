{{--
   AUTHOR MODAL
      - model
      - fn
--}}
{{-- {{ $field }} --}}
<div class="modal fade" id="view{{ $field }}Modal{{ $model->id}}" tabindex="-1" role="dialog" aria-labelledby="view{{ $field }}ModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
            
         <div class="modal-header">
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

         <div class="modal-body">
            <div class="row mb-3">
               <div class="col text-center">
                  @if($field == 'user')
                     @if($model->user->profile->image)
                        <img src="/_profiles/{{ $model->user->profile->image }}" height="100" width="100">
                     @else
                        <img src="/_profiles/no_photo.jpg" height="100" width="100">
                     @endif
                  @elseif($field == 'modifiedBy')
                     @if($model->modifiedBy->profile->image)
                        <img src="/_profiles/{{ $model->modifiedBy->profile->image }}" height="100" width="100">
                     @else
                        <img src="/_profiles/no_photo.jpg" height="100" width="100">
                     @endif
                  @elseif($field == 'lastViewedBy')
                     @if($model->lastViewedBy->profile->image)
                        <img src="/_profiles/{{ $model->lastViewedBy->profile->image }}" height="100" width="100">
                     @else
                        <img src="/_profiles/no_photo.jpg" height="100" width="100">
                     @endif
                  @else
                     <img src="/_profiles/no_photo.jpg" height="100" width="100">
                  @endif
               </div>
            </div>

            <div class="row">
               <div class="col">
                  <table class="table table-sm table-hover mb-0">
                     <tr>
                        <th class="text-right">Username</th>
                        <td>
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
                        <th class="text-right">First Name</th>
                        <td>
                           @if($field == 'user')
                              {{ $model->user->profile->first_name }}
                           @elseif($field == 'modifiedBy')
                              {{ $model->modifiedBy->profile->first_name }}
                           @elseif($field == 'lastViewedBy')
                              {{ $model->lastViewedBy->profile->first_name }}
                           @endif

                        </td>
                     </tr>
                     <tr>
                        <th class="text-right">Last Name</th>
                        <td>
                           @if($field == 'user')
                              {{ $model->user->profile->last_name }}
                           @elseif($field == 'modifiedBy')
                              {{ $model->modifiedBy->profile->last_name }}
                           @elseif($field == 'lastViewedBy')
                              {{ $model->lastViewedBy->profile->last_name }}
                           @endif
                        </td>
                     </tr>
                     <tr>
                        <th class="text-right">Email Address</th>
                           @if($field == 'user')
                              @if($model->user->public_email === 1)
                                 <td>{{ $model->user->email }}</td>
                              @else
                                 <td>*************************</td>
                              @endif
                           @elseif($field == 'modifiedBy')
                              @if($model->modifiedBy->public_email === 1)
                                 <td>{{ $model->modifiedBy->email }}</td>
                              @else
                                 <td>*************************</td>
                              @endif
                           @elseif($field == 'lastViewedBy')
                              @if($model->lastViewedBy->public_email === 1)
                                 <td>{{ $model->lastViewedBy->email }}</td>
                              @else
                                 <td>*************************</td>
                              @endif
                           @endif
                     </tr>
                     <tr>
                        <th class="text-right">Member Since</th>
                        <td>
                            @if($field == 'user')
                              @if($model->user->created_at)
                                 {{ $model->user->created_at->format(setting('dateFormat')) }}
                              @else
                                 Unknown
                              @endif
                           @elseif($field == 'modifiedBy')
                              @if($model->modifiedBy->created_at)
                                 {{ $model->modifiedBy->created_at->format(setting('dateFormat')) }}
                              @else
                                 Unknown
                              @endif
                           @elseif($field == 'lastViewedBy')
                              @if($model->lastViewedBy->created_at)
                                 {{ $model->lastViewedBy->created_at->format(setting('dateFormat')) }}
                              @else
                                 Unknown
                              @endif
                           @endif
                        </td>
                     </tr>
                  </table>
               </div>
            </div>
         </div>

         <div class="modal-footer p-1">
            <button type="button" class="btn btn-sm btn-outline-secondary px-1 py-0" data-dismiss="modal">Close</button>
         </div>
         
      </div>
   </div>
</div>