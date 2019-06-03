{{-- Do not forget to adjust the padding-bottom of the body tag css property to add more spacing if you add items to these columns --}}

<div class="card py-0 px-0">  {{-- style="background-image: url('../images/9.jpg')" --}}
	<div class="card-body py-0">
		<div class="row">
			<div class="col-sm-3">
				<p class="text-center mb-0">
					FOOTER 1<br />
					Line 1<br />
				</p>
			</div>
			<div class="col-sm-3">
				<p class="text-center mb-0">
					FOOTER 2<br />
					Line 2
				</p>
			</div>
			<div class="col-sm-3">
				<p class="text-center mb-0">
					FOOTER 3<br />
					Line 3
				</p>
			</div>
			<div class="col-sm-3">
				<p class="text-center mb-0">
					FOOTER 4<br />
					Line 4
				</p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 small">
				<p class="text-center mb-0">
					<a href="{{ route('terms') }}">Terms &amp; Conditions</a> | <a href="{{ route('privacy') }}">Privacy Policy</a>
					<br />
					Copyright &copy; TheWoodBarn.ca 2019
				</p>
			</div>
		</div>
	</div>
</div>
