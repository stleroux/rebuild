@extends('layouts.master')

@section ('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@stop    

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
   @include('blocks.member')
   @include('profiles.block_contributions')
@endsection

@section('content')

   <div class="row">
      <div class="col">
         <div class="card mb-3">
            <div class="card-header section_header p-2">
               <i class="far fa-eye"></i>
               Show Profile
               <span class="float-right">
                  @if($user->id === Auth::user()->id)
                     <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-xs btn-primary">
                        <i class="fa fa-edit"></i>
                        Edit Profile
                     </a>
                  @endif
               </span>
            </div>

            <div class="card-body section_body p-2">
               
               <div class="form-row">
                  <div class="col-9">
                     {{-- Account Info --}}
                     <div class="card mb-2">
                        <div class="card-header card_header p-2">Account Info</div>
                        <div class="card-body section_body p-2">
                           <div class="form-row">
                              {{-- <div class="col-md-3"> --}}
                                 <div class="col-md-2">
                                    <div class="form-group">
                                       <label for="username">Username</label>
                                       <input type="text" class="form-control form-control-sm" readonly="readonly" value="{{ $user->username }}">
                                    </div>
                                 </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                       <label for="created_at">Member Since</label>
                                       @if($user->created_at)
                                          <input type="text" class="form-control form-control-sm" readonly="readonly" value="{{ $user->created_at->format('M d, Y') }}">
                                       @else
                                          <input type="text" class="form-control form-control-sm" readonly="readonly" value="Unknown">
                                       @endif
                                    </div>
                                 </div>
                                 <div class="col-md-4 col-lg-3">
                                    <div class="form-group">
                                       <label for="last_login_date">Last Login Date</label>
                                       <input type="text" class="form-control form-control-sm" readonly="readonly" value="{{ $user->last_login_date->format('M d, Y') }}">
                                    </div>
                                 </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                       <label for="login_count">Login Count</label>
                                       <input type="text" class="form-control form-control-sm" readonly="readonly" value="{{ $user->login_count }}">
                                    </div>
                                 </div>
                              {{-- </div> --}}
                           </div>
                        </div>
                     </div>
                     {{-- Profile Info --}}
                     <div class="card mb-2">
                        <div class="card-header card_header p-2">Profile Info</div>
                        <div class="card-body section_body p-2">
                           <div class="form-row">
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="input-text" class="form-control form-control-sm" value="{{ $user->first_name }}" readonly="readonly">
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control form-control-sm" value="{{ $user->last_name }}" readonly="readonly">
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label for="telephone">Telephone</label>
                                    <input type="text" class="form-control form-control-sm" value="{{ $user->telephone }}" readonly="readonly">
                                 </div>
                              </div>
                           </div>
                           <div class="form-row">
                              <div class="col-md-5">
                                 <div class="form-group">
                                    {{ Form::label('email', 'Email Address') }}
                                    @if($user->public_email == 'no')
                                       {{ Form::text('email', 'xxxxxxxxxxxxxxxxxxx', ['class'=>'form-control form-control-sm', 'readonly']) }}
                                    @else
                                       {{ Form::text('email', $user->email, ['class'=>'form-control form-control-sm', 'readonly']) }}
                                    @endif
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-3">
                     @include('profiles.block_image')
                  </div>

               </div>

               {{-- Address Info --}}
               <div class="form-row">
                  <div class="col">
                     <div class="card mb-2">
                        <div class="card-header card_header p-2">Address Info</div>
                        <div class="card-body section_body p-2">
                           <div class="form-row">
                              <div class="col-md-2">
                                 <div class="form-group">
                                    <label for="civic_number" class="control-label">Civic/Unit N<sup>o</sup></label>
                                    <input type="text" class="form-control form-control-sm" value="{{ $user->civic_number }}" readonly="readonly">
                                 </div>
                              </div>
                              <div class="col-md-5">
                                 <div class="form-group">
                                    <label for="address1" class="control-label">Address 1</label>
                                    <input type="text" class="form-control form-control-sm" value="{{ $user->address1 }}" readonly="readonly">
                                 </div>
                              </div>
                              <div class="col-md-5">
                                 <div class="form-group">
                                    <label for="address2" class="control-label">Address 2</label>
                                    <input type="text" class="form-control form-control-sm" value="{{ $user->address2 }}" readonly="readonly">
                                 </div>
                              </div>
                           </div>

                           <div class="form-row">
                              <div class="col-md-2">
                                 <div class="form-group">
                                    <label for="city" class="control-label">City</label>
                                    <input type="text" class="form-control form-control-sm" value="{{ $user->city }}" readonly="readonly">
                                 </div>
                              </div>
                              <div class="col-md-2">
                                 <div class="form-group">
                                    <label for="province" class="control-label">Province/State</label>
                                    <input type="text" class="form-control form-control-sm" value="{{ $user->province }}" readonly="readonly">
                                 </div>                                    
                              </div>
                              <div class="col-md-2">
                                 <div class="form-group">
                                    <label for="postal_code" class="control-label">Postal/Zip Code</label>
                                    <input type="text" class="form-control form-control-sm" value="{{ $user->postal_code }}" readonly="readonly">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

@endsection