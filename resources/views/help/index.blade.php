@extends('layouts.help')

@section('left_column')

@endsection

@section('content')

	<h1>Main system help</h1>
	@include('help.categories.index')
	@include('help.recipes.index')


{{-- @php
	// $remote_site_data = file_get_contents('');
	// $remote_site_data = File::get(storage_path('index.blade.php'));
	$remote_site_data = \Illuminate\Support\Facades\File::get(base_path() . '/resources/views/help/index.blade.php');
	// dd($remote_site_data);
	$dom_document = new DOMDocument();
	@$dom_document->loadHTML($remote_site_data);
	$headers = $dom_document->getElementsByTagName('h3');
	foreach ($headers as $header) {
	   $table_of_contents[] = trim($header->nodeValue);
	}
	var_dump($table_of_contents);
@endphp --}}

@endsection

