@extends('layouts.backend')

@section('stylesheets')
   {{ Html::style('css/switch.css') }}
@endsection

@section('left_column')
   @include('blocks.adminNav')
   @include('users.sidebar')
@endsection

@section('right_column')
@endsection

@section('content')

   {!! Form::model($user) !!}

      <div class="card">
         <!--CARD HEADER-->
         <div class="card-header card_header">
            <i class="fas fa-user"></i>
            View User
            <span class="float-sm-right">
               @include('common.buttons.cancel', ['model'=>'user', 'type'=>''])
            </span>
         </div>
         <!--CARD BODY-->
         <div class="card-body card_body">
            <div class="row">
               <div class="col-sm-12 col-md-2">
                  <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                     {{ Form::label('username', 'Username', ['class'=>'required']) }}
                     {!! Form::text('username', null, array('placeholder'=>'Username', 'class'=>'form-control form-control-sm','disabled', 'autofocus'=>'autofocus' )) !!}
                     <span class="text-danger">{{ $errors->first('username') }}</span>
                  </div>
               </div>

               <div class="col-sm-12 col-md-4">
                  <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                     {{ Form::label('email', 'Email', ['class'=>'required']) }}
                     {!! Form::text('email', null, array('placeholder'=>'Email', 'class'=>'form-control form-control-sm', 'disabled' => 'disabled')) !!}
                     <span class="text-danger">{{ $errors->first('email') }}</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
         
      <div class="card my-2">
         <div class="card-header card_header">
            Display the permissions assigned to this user
            <span class="float-right">
               <span class="badge badge-primary">{{ $user->permissions->count() }}</span>
            </span>
         </div>
         <div id="accordion">
            <div class="card">
               <div class="card-header px-2 py-2" id="core" data-toggle="collapse" data-target="#corePermissions" aria-expanded="true" aria-controls="corePermissions">Core Permissions</div>
               <div id="corePermissions" class="collapse show" aria-labelledby="core" data-parent="#accordion">
                  <div class="card-body px-1 py-1">
                     <div class="card-columns">
                        @foreach ($coreGroups as $group => $permissions)
                           <div class="card mb-2">
                              <div class="card-header card_header_2">{{ ucfirst($group) }}</div>
                              <div class="card-body card_body pt-2 pb-1 px-1">
                                 @foreach($permissions as $permission)
                                    <div class="form-group mb-0">
                                       <span class="switch switch-xs">
                                          {{ Form::checkbox('permission[]', $permission->id, in_array($permission->id, $userPermissions) ? true : false, ['id'=>$permission->id, 'disabled'=>'disabled']) }}
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

            <div class="card">
               <div class="card-header px-2 py-2" id="nonCore" data-toggle="collapse" data-target="#nonCorePermissions" aria-expanded="false" aria-controls="nonCorePermissions">Non Core Permissions</div>
               <div id="nonCorePermissions" class="collapse" aria-labelledby="nonCore" data-parent="#accordion">
                  <div class="card-body px-1 py-1">
                     <div class="card-columns">
                        @foreach ($nonCoreGroups as $group => $permissions)
                           <div class="card mb-2">
                              <div class="card-header card_header_2">{{ ucfirst($group) }}</div>
                              <div class="card-body card_body pt-2 pb-1 px-1">
                                 @foreach($permissions as $permission)
                                    <div class="form-group mb-0">
                                       <span class="switch switch-xs">
                                          {{ Form::checkbox('permission[]', $permission->id, in_array($permission->id, $userPermissions) ? true : false, ['id'=>$permission->id, 'disabled'=>'disabled']) }}
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

            <div class="card">
               <div class="card-header px-2 py-2" id="modules" data-toggle="collapse" data-target="#modulesPermissions" aria-expanded="false" aria-controls="modulesPermissions">Modules Permissions</div>
               <div id="modulesPermissions" class="collapse" aria-labelledby="modules" data-parent="#accordion">
                  <div class="card-body px-1 py-1">
                     <div class="card-columns">
                        @foreach ($moduleGroups as $group => $permissions)
                           <div class="card mb-2">
                              <div class="card-header card_header_2">{{ ucfirst($group) }}</div>
                              <div class="card-body card_body pt-2 pb-1 px-1">
                                 @foreach($permissions as $permission)
                                    <div class="form-group mb-0">
                                       <span class="switch switch-xs">
                                          {{ Form::checkbox('permission[]', $permission->id, in_array($permission->id, $userPermissions) ? true : false, ['id'=>$permission->id, 'disabled'=>'disabled']) }}
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
      
{{ Form::close() }}

@endsection
