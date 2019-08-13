@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('/css/woodbarn.css') }}
   {{ Html::style('css/switch.css') }}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
   @include('users.blocks.mostPermissions')
   @include('users.blocks.mostLogins')
   @include('users.blocks.mostAssignedPermissions')
@endsection

@section('content')

   {{-- {!! Form::model($user, ['method' => 'PATCH', 'files'=>true, 'route' => ['users.update', $user->id]]) !!} --}}
   {!! Form::model($user, ['route'=>['users.update', $user->id], 'method'=>'PUT', 'files'=>true]) !!}
      {{ Form::token() }}
      
      <div class="card mb-3">
         <!--CARD HEADER-->
         <div class="card-header section_header p-2">
            <i class="fas fa-user"></i>
            Edit User :: {{ $user->username }}
            <span class="float-sm-right">
               @include('users.buttons.addAllPermissions', ['size'=>'xs'])
               @include('users.buttons.removeAllPermissions', ['size'=>'xs'])

               @include('users.buttons.back', ['size'=>'xs'])

               @if(checkPerm('user_edit'))
                  <button type="submit" class="btn btn-xs btn-info" name="submit" value="continue" title="Update & Continue">
                     <i class="far fa-hdd"></i>
                     {{-- Update & Continue --}}
                  </button>
                  <button type="submit" class="btn btn-xs btn-success" name="submit" value="close" title="Update & Close">
                     <i class="far fa-save"></i>
                     {{-- Update & Close --}}
                  </button>
               @endif
            </span>
         </div>

         <!--CARD BODY-->
         <div class="card-body section_body p-2">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
               <li class="nav-item">
                  <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                     User Profile
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="core-tab" data-toggle="tab" href="#core" role="tab" aria-controls="core" aria-selected="false">
                     Core Permissions
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="nonCore-tab" data-toggle="tab" href="#nonCore" role="tab" aria-controls="nonCore" aria-selected="false">
                     Non-Core Permissions
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="modules-tab" data-toggle="tab" href="#modules" role="tab" aria-controls="modules" aria-selected="false">
                     Modules Permissions
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="instructions-tab" data-toggle="tab" href="#instructions" role="tab" aria-controls="instructions" aria-selected="false">
                     Instructions
                  </a>
               </li>
            </ul>

            <div class="tab-content pb-0 mb-0" id="myTabContent">
               <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  @include('users.inc.edit.profile')
               </div>
               <div class="tab-pane fade" id="core" role="tabpanel" aria-labelledby="core-tab">
                  @include('users.inc.edit.core')
               </div>
               <div class="tab-pane fade" id="nonCore" role="tabpanel" aria-labelledby="nonCore-tab">
                  @include('users.inc.edit.nonCore')
               </div>
               <div class="tab-pane fade" id="modules" role="tabpanel" aria-labelledby="modules-tab">
                  @include('users.inc.edit.modules')
               </div>
               <div class="tab-pane fade" id="instructions" role="tabpanel" aria-labelledby="instructions-tab">
                  @include('users.inc.edit.instructions')
               </div>
            </div>
         </div>

         <!-- CARD FOOTER -->
         <div class="card-footer pt-1 pb-1 pl-2">
            Fields marked with an <span class="required"></span> are required
         </div>
      </div>

{{--       <div class="card mb-3">
         <div class="card-header card_header">
            Select the permissions to assign to this user
            <span class="float-right">
               <span class="badge badge-primary">{{ $user->permissions->count() }}</span>
            </span>
         </div>
         <div class="card-body p-2">
            <div id="accordion">
               <div class="card mb-2">
                  <div class="card-header" id="core" data-toggle="collapse" data-target="#corePermissions" aria-expanded="true" aria-controls="corePermissions">Core Permissions</div>
                  <div id="corePermissions" class="collapse show" aria-labelledby="core" data-parent="#accordion">
                     <div class="card-body p-2">
                        <div class="card-columns">
                           @foreach ($coreGroups as $group => $permissions)
                              <div class="card mb-1">
                                 <div class="card-header card_header_2">{{ ucfirst($group) }}</div>
                                 <div class="card-body card_body pt-2 pb-1 px-1">
                                    @foreach($permissions as $permission)
                                       <div class="form-group mb-0">
                                          <span class="switch switch-xs">
                                             {{ Form::checkbox('permission[]', $permission->id, in_array($permission->id, $userPermissions) ? true : false, ['id'=>$permission->id]) }}
                                             <label for="{{$permission->id}}">{{ ucfirst($permission->display_name) }}</label>
                                          </span>
                                          <span class="float-right">
                                             <a data-toggle="tooltip" title="Allow member to {{ strtolower($permission->description) }}">
                                                <i class="fas fa-info-circle"></i>
                                             </a>
                                          </span>
                                       </div>
                                    @endforeach
                                 </div>
                              </div>
                           @endforeach
                        </div>
                     </div>
                  </div>
               </div>

               <div class="card mb-2">
                  <div class="card-header" id="nonCore" data-toggle="collapse" data-target="#nonCorePermissions" aria-expanded="false" aria-controls="nonCorePermissions">Non Core Permissions</div>
                  <div id="nonCorePermissions" class="collapse" aria-labelledby="nonCore" data-parent="#accordion">
                     <div class="card-body p-2">
                        <div class="card-columns">
                           @foreach ($nonCoreGroups as $group => $permissions)
                              <div class="card mb-2">
                                 <div class="card-header card_header_2">{{ ucfirst($group) }}</div>
                                 <div class="card-body card_body pt-2 pb-1 px-1">
                                    @foreach($permissions as $permission)
                                       <div class="form-group mb-0">
                                          <span class="switch switch-xs">
                                             {{ Form::checkbox('permission[]', $permission->id, in_array($permission->id, $userPermissions) ? true : false, ['id'=>$permission->id]) }}
                                             <label for="{{$permission->id}}">{{ ucfirst($permission->display_name) }}</label>
                                          </span>
                                          <span class="float-right">
                                             <a data-toggle="tooltip" title="Allow member to {{ strtolower($permission->description) }}">
                                                <i class="fas fa-info-circle"></i>
                                             </a>
                                          </span>
                                       </div>
                                    @endforeach
                                 </div>
                              </div>
                           @endforeach
                        </div>
                     </div>
                  </div>
               </div>

               <div class="card mb-2">
                  <div class="card-header" id="modules" data-toggle="collapse" data-target="#modulesPermissions" aria-expanded="false" aria-controls="modulesPermissions">Modules Permissions</div>
                  <div id="modulesPermissions" class="collapse" aria-labelledby="modules" data-parent="#accordion">
                     <div class="card-body p-2">
                        <div class="card-columns">
                           @foreach ($moduleGroups as $group => $permissions)
                              <div class="card mb-2">
                                 <div class="card-header card_header_2">{{ ucfirst($group) }}</div>
                                 <div class="card-body card_body pt-2 pb-1 px-1">
                                    @foreach($permissions as $permission)
                                       <div class="form-group mb-0">
                                          <span class="switch switch-xs">
                                             {{ Form::checkbox('permission[]', $permission->id, in_array($permission->id, $userPermissions) ? true : false, ['id'=>$permission->id]) }}
                                             <label for="{{$permission->id}}">{{ ucfirst($permission->display_name) }}</label>
                                          </span>
                                          <span class="float-right">
                                             <a data-toggle="tooltip" title="Allow member to {{ strtolower($permission->description) }}">
                                                <i class="fas fa-info-circle"></i>
                                             </a>
                                          </span>
                                       </div>
                                    @endforeach
                                 </div>
                              </div>
                           @endforeach
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div> --}}

   {!! Form::close() !!}

@endsection
