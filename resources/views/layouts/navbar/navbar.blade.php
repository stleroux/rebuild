{{-- <nav class="navbar navbar-expand-sm sticky-top my-0 mx-0 py-0 pl-2 pr-0 navbar-dark navbar_background"> --}}
<nav class="navbar navbar-expand-sm sticky-top my-0 mx-0 py-0 pl-2 pr-0 navbar-dark bg-dark">
	
	<a class="navbar-brand" href="/">
		<h2 class="my-0 mx-0 py-0 px-0">{{ setting('app_name') }}</h2>
	</a>
	
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		{{-- Left side --}}
         @include('layouts.navbar.navbarLeft')
		{{-- Right Side --}}
         @include('layouts.navbar.navbarRight')
	</div>

</nav>