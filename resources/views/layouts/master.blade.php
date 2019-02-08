<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'TheWoodBarn.ca') }}</title>

	<!-- Scripts -->
	{{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
	{{-- Removed above because it interferes with DataTable --}}
	{{-- <script src='https:https://cloud.tinymce.com/stable/tinymce.min.js'></script> --}}

	
	<!-- Font Awesome -->
	{{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous"> --}}
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

	<!-- Styles -->
	{{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.18/datatables.min.css"/>
	{{-- <link rel="stylesheet" href="{{ asset('css/bootstrap_4/slate.css') }}"> --}}
	<link rel="stylesheet" href="{{ asset('css/bootstrap-colors.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
	@yield('stylesheets')
</head>
<body>
	
	@include('layouts.master.navbar')
	@include('layouts.master.messages')

	<main class="container-fluid">
		<div id="app" class="py-0 px-0">
			<div class="row pt-0 pr-2 pl-2 pb-0">
				<div class="col-sm-3 col-md-2 pt-0 pr-0 pl-0 pb-0">
					@include('blocks.main_menu')
					@yield('left_column')
				</div>
				<div class="col-sm-6 col-md-8 py-0 px-2">
					@yield('content')
				</div>
				<div class="col-sm-3 col-md-2 py-0 px-0">
					@guest
						@include('blocks.login')
					@else
						@include('blocks.member')
					@endguest
					@yield('right_column')
				</div>
			</div>
		</div>
	</main>
		
	<footer class="footer fixed-bottom">
		@include('layouts.master.footer')
	</footer>

	<!-- Optional JavaScript -->
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.18/datatables.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	
	@yield('scripts')
	<script>
		$(document).ready( function () {
			$('#datatable').DataTable(
				{
					"order": [],
					"stateSave": true,
					"pagingType": "full_numbers",
					"columnDefs": [ {
						"targets"  : 'no-sort',
						"orderable": false,
					}],
					"drawCallback": function () {
						$('.dataTables_paginate > .pagination').addClass('pagination-sm');
					}
				}
			);
		});
	</script>
	{{-- <script>
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		});
	</script> --}}
	<script>
		$('#success-empty').hide();
		setTimeout(function() {
			$('#success-alert').remove();
			$('#success-empty').show();
		}, 5000); // <-- time in milliseconds
	</script>

	<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=aye0kmmyja4hfhckelt1xd1srcm6j38ptyvy67g8rkfodfd8"></script>
	<script>
		tinymce.init({
			selector: '.wysiwyg',
			height: 300,
			branding: false,
			theme: 'modern',
			plugins: 'print preview powerpaste searchreplace autolink directionality advcode visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount tinymcespellchecker a11ychecker imagetools mediaembed  linkchecker contextmenu colorpicker textpattern emoticons',
			// help-> displays help menu; fullpage->save whole html codes in page
			toolbar1: 'formatselect | undo redo | insert | styleselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | removeformat | source',
			image_advtab: true,
			templates: [
				{ title: 'Test template 1', content: 'Test 1' },
				{ title: 'Test template 2', content: 'Test 2' }
			],
			content_css: [
				'fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
				'www.tinymce.com/css/codepen.min.css'
			]
		});
	</script>

	<script>
		tinymce.init({
			selector: '.simple',
			branding: false,
			menubar: false,
			plugins: [
				'advlist autolink lists link charmap print preview anchor',
				'searchreplace visualblocks code fullscreen',
				'insertdatetime media table contextmenu paste code'
			],
			toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link',
			content_css: '//www.tinymce.com/css/codepen.min.css'
		});
	</script>
	<script>
		tinymce.init({
			selector: '.plain',
			// content_style: "div {margin: 1px; border: 5px solid red; padding: 3px}",
			branding: false,
			menubar: false,
			toolbar: false,
			statusbar: false,
			// content_css: '//www.tinymce.com/css/codepen.min.css'
		});
	</script>
</body>
</html>