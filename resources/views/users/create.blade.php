@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/switch.css') }}
@endsection

@section('left_column')
   {{-- @include('blocks.admin_menu') --}}
   @include('users.sidebar')
@endsection

@section('right_column')
@endsection

@section('content')

   {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}

      <div class="card">
         <!--CARD HEADER-->
         <div class="card-header card_header">
            <i class="fas fa-user"></i>
            New User
            <span class="float-sm-right">
               <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-secondary px-1 py-0">
                  <i class="fas fa-angle-double-left"></i>
                  Cancel
               </a>
               @if(checkPerm('user_create'))
                  <button type="submit" class="btn btn-sm btn-outline-bprimary px-1 py-0">
                     <i class="far fa-save"></i>
                     Save
                  </button>
               @endif
            </span>
         </div>
         <!--CARD BODY-->
         <div class="card-body card_body">
            @include('users.form', ['disabled'=>''])
         </div>
         <div class="card-footer pt-1 pb-1 pl-2">
            Fields marked with an <span class="required"></span> are required
         </div>
      </div>

      <div class="card mt-2">
         <div class="card-header card_header">Select the permissions to assign to this user</div>
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
                                          {{ Form::checkbox('permission[]', $permission->id, false, ['id'=>$permission->id]) }}
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
                                          {{ Form::checkbox('permission[]', $permission->id, false, ['id'=>$permission->id]) }}
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
                                          {{ Form::checkbox('permission[]', $permission->id, false, ['id'=>$permission->id]) }}
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
      
   {!! Form::close() !!}

@endsection

{{--       <div class="row">
         <div class="col-sm-3">
            <div class="card">
               <div class="card-header bg-primary pt-2 pb-2 pl-2">Core Permissions</div>
               @foreach ($coreGroups as $group => $permissions)
                  <div class="card mb-2">
                     <div class="card-header card_header_2">{{ ucfirst($group) }}</div>
                     <div class="card-body card_body pt-2 pb-1 px-1">
                        @foreach($permissions as $permission)
                           <div class="form-group mb-0">
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
                        @endforeach
                     </div>
                  </div>
               @endforeach
            </div>
         </div>

         <div class="col-sm-9">
            <div class="card mb-2">
               <div class="card-header bg-primary pt-2 pb-2 pl-2">Module Permissions</div>
               <div class="card-columns">
                  @foreach ($moduleGroups as $group => $permissions)
                     <div class="card mb-2">
                        <div class="card-header card_header_2">{{ ucfirst($group) }}</div>
                        <div class="card-body card_body pt-2 pb-1 px-1">
                           @foreach($permissions as $permission)
                              <div class="form-group mb-0">
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
                           @endforeach
                        </div>
                     </div>
                  @endforeach
               </div>
               
            </div>
         </div>
      </div> --}}