@extends('layouts.master')

@section('content')
	{!! Form::model($user, ['route'=>['profile.preferencesPost', $user->profile->id], 'method' => 'POST']) !!}
	<div class="row">
		<div class="col">
			<div class="card mb-2">
				<div class="card-header card_header">
					User Preferences 
					<span class="text-muted">(Features marked with	<i class="far fa-check-square"></i> have been implemented in code)</span>
					<span class="float-right">
						<a href="{{ route('profile.resetPreferences', $user->profile->id) }}" class="btn btn-sm btn-outline-secondary px-1 py-0">Reset All Defaults</a>
						{{ Form::button('<i class="fa fa-save"></i> Update Preferences', array('type' => 'submit', 'class' => 'btn btn-sm btn-outline-secondary px-1 py-0')) }}
					</span>
				</div>

				<div class="card-body card_body">
					<table class="table table-sm table-hover">
						<thead>
							<tr>
								<td><i class="far fa-check-square"></i></td>
								<th>Title</th>
								<th>Option</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							{{-- ACTION BUTTONS --}}
							<tr>
								<td></td>
								<td>Action Buttons</td>
								<td>
									{{ Form::select('action_buttons', array(
										'1' => 'Icons and Text (Default)',
										'2' => 'Icons only',
										'3' => 'Text Only',
										), $user->profile->action_buttons, array('class'=>'form-control form-control-sm'))
									}}
								</td>
								<td>Changes the appearance of some buttons (Edit & Delete only at the moment).</td>
							</tr>
							{{-- ALERT FADE TIME --}}
							<tr>
								<td><i class="far fa-check-square"></i></td>
								<td>Alert Fade Time</td>
								<td>
									{{ Form::select('alert_fade_time', array(
										'2000' => '2 seconds',
										'3000' => '3 seconds',
										'4000' => '4 seconds',
										'5000' => '5 seconds (Default)',
										'6000' => '6 seconds',
										'7000' => '7 seconds',
										'8000' => '8 seconds',
										'9000' => '9 seconds',
										'10000' => '10 seconds',
										'15000' => '15 seconds',
										'20000' => '20 seconds',
										'1000000000' => 'Forever',
										), $user->profile->alert_fade_time, array('class'=>'form-control form-control-sm'))
									}}
								</td>
								<td>Changes the length of time the alerts will be displayed.</td>
							</tr>
							{{-- AUTHOR FORMAT --}}
							<tr>
								<td></td>
								<td>Author Format</td>
								<td>
									{{ Form::select('author_format', array(
										'1' => 'Username (Default)' ,
										'2' => 'Last Name, First Name',
										'3' => 'First Name Last Name'
										), $user->profile->author_format, array('class'=>'form-control form-control-sm'))
									}}
								</td>
								<td>Changes the way the author's name will be displayed.</td>
							</tr>
							{{-- DATE FORMAT --}}
							<tr>
								<td></td>
								<td>Date Format</td>
								<td>
									{{ Form::select('date_format', array(
										'1' => 'Jan 01, 2017 (Default)',
										'2' => 'Jan 1, 2017',
										'3' => '01/01/2017 (M-D-Y)',
										'4' => '1/01/2017 (M-D-Y)',
										'5' => '01 Jan 2017',
										'6' => '1 Jan 2017',
										'7' => '01/01/2017 (D-M-Y)',
										'8' => '1/01/2017 (D-M-Y)',
										), $user->profile->date_format, array('class'=>'form-control form-control-sm'))
									}}
								</td>
								<td>Changes the way the dates are displayed.</td>
							</tr>
							{{-- LANDING PAGE --}}
							<tr>
								<td></td>
								<td>Landing Page</td>
								<td>
									{{ Form::select('landing_page_id', $landingPages, $user->profile->landing_page_id , ['class' => 'form-control form-control-sm']) }}
								</td>
								<td>The page you will be redirected to when you log in to the site.</td>
							</tr>
							{{-- ROWS PER PAGE --}}
							<tr>
								<td></td>
								<td>Rows Per Page</td>
								<td>
									{{ Form::select('rows_per_page', array(
										'5' => '5',
										'10' => '10',
										'15' => '15 (Default)',
										'20' => '20',
										'25' => '25',
										'50' => '50',
										'100' => '100'
										), $user->profile->rows_per_page, array('class'=>'form-control form-control-sm'))
									}}
								</td>
								<td>Changes the number of entries displayed in grids.</td>
							</tr>
							{{-- FRONTEND STYLE --}}
							<tr>
								<td></td>
								<td>Frontend Style</td>
								<td>
									{{ Form::select('frontendStyle', array(
										'bootstrap' => 'Bootstrap',
										'cerulean' => 'Cerulean',
										'cosmo' => 'Cosmo',
										'cyborg'=>'Cyborg',
										'darkly'=>'Darkly',
										'flatly'=>'Flatly',
										'journal'=>'Journal',
										'lumen'=>'Lumen',
										'paper'=>'Paper',
										'readable'=>'Readable',
										'sandstone'=>'Sandstone',
										'simplex'=>'Simplex',
										'slate'=>'Slate (Default)',
										'spacelab'=>'SpaceLab',
										'superhero'=>'SuperHero',
										'united'=>'United',
										'yeti'=>'Yeti',
										), $user->profile->frontendStyle, array('class'=>'form-control form-control-sm'))
									}}
								</td>
								<td>Choosing a different style will change the apperance of the whole site.</td>
							</tr>
							{{-- BACKEND STYLE --}}
							<tr>
								<td></td>
								<td>Backend Style</td>
								<td>
									{{ Form::select('backendStyle', array(
										'bootstrap' => 'Bootstrap (Default)',
										'cerulean' => 'Cerulean',
										'cosmo' => 'Cosmo',
										'cyborg'=>'Cyborg',
										'darkly'=>'Darkly',
										'flatly'=>'Flatly',
										'journal'=>'Journal',
										'lumen'=>'Lumen',
										'paper'=>'Paper',
										'readable'=>'Readable',
										'sandstone'=>'Sandstone',
										'simplex'=>'Simplex',
										'slate'=>'Slate',
										'spacelab'=>'SpaceLab',
										'superhero'=>'SuperHero',
										'united'=>'United',
										'yeti'=>'Yeti',
										), $user->profile->backendStyle, array('class'=>'form-control form-control-sm'))
									}}
								</td>
								<td>Choosing a different style will change the apperance of the whole site.</td>
							</tr>
						</tbody>
					</table>




					{{-- <div class="row">
						<!-- SITE LAYOUT -->
						<div class="col">
							<div class="card mb-2">
								<div class="card-header">
									<i class="fa fa-check-square-o" aria-hidden="true"></i>
									Site Layout
									<div class="float-right">
										<a href="#" id="popover" data-toggle="popover" data-trigger="hover"
											data-placement="top"
											data-title="Layouts"
											data-content="Choosing a different layout will change the layout of the whole site.">
											<i class="fa fa-question-circle" aria-hidden="true"></i>
										</a>
									</div>
									
								</div>
								<div class="card-body">
									<div class="btn-group" data-toggle="buttons">
										<label class="btn btn-default form-check-label {{ $user->profile->layout == 1 ? 'active' : '' }}">
											<input class="form-check-input" name="layout" id="layout1" value="1" type="radio" {{ $user->profile->layout == 1 ? 'checked' : '' }} autocomplete="off">
											<pre>@include('profiles.layout1_preview')</pre>
											Layout 1 (Default)
										</label>
										<label class="btn btn-default form-check-label {{ $user->profile->layout == 2 ? 'active' : '' }}">
											<input class="form-check-input" name="layout" id="layout2" value="2" type="radio" {{ $user->profile->layout == 2 ? 'checked' : '' }} autocomplete="off">
											<pre>@include('profiles.layout2_preview')</pre>
											Layout 2
										</label>
										<label class="btn btn-default form-check-label {{ $user->profile->layout == 3 ? 'active' : '' }}">
											<input class="form-check-input" name="layout" id="layout3" value="3" type="radio" {{ $user->profile->layout == 3 ? 'checked' : '' }} autocomplete="off">
											<pre>@include('profiles.layout3_preview')</pre>
											Layout 3
										</label>
										<label class="btn btn-default form-check-label {{ $user->profile->layout == 4 ? 'active' : '' }}">
											<input class="form-check-input" name="layout" id="layout4" value="4" type="radio" {{ $user->profile->layout == 4 ? 'checked' : '' }} autocomplete="off">
											<pre>@include('profiles.layout4_preview')</pre>
											Layout 4
										</label>
									</div>
								</div>
							</div>
						</div>
					</div> --}}
				</div>
				{{-- BACKEND STYLE --}}
				<input type="hidden" name="backendStyle" value="{{ $user->profile->backendStyle }}">

				<div class="card-footer">
					{{ Form::button('<i class="fa fa-save"></i> Update Preferences', array('type' => 'submit', 'class' => 'btn btn-xs btn-primary')) }}
					<a href="{{ route('profile.resetPreferences', $user->profile->id) }}" class="btn btn-xs btn-default">Reset All Defaults</a>
				</div>
				
			</div>
		</div>
	</div>
	{{ Form::close() }}
@endsection

@section('scripts')
	<script>
		$(function () {
		    $('[data-toggle="popover"]').popover()
		})
	</script>
@endsection