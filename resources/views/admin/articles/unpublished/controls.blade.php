{{-- @include('common.controlCenterHeader') --}}

	{{-- @if(checkACL('author')) --}}
		<a href="{{ route('admin.articles.create') }}" class="btn btn-default btn-block">
			<i class="fa fa-plus-square" aria-hidden="true"></i>
			Add Article
		</a>
	{{-- @endif --}}

	{{-- @if(checkACL('manager')) --}}
	
{{-- 		<a href="{{ route('articles.import') }}" class="btn btn-warning btn-block">
			<i class="fa fa-upload" aria-hidden="true"></i>
			Import
		</a> --}}
	
		<br id="bulk-space" style="display:none;" />
		
		<button
			class="btn btn-default btn-block"
			type="submit"
			formaction="{{ route('admin.articles.publishAll') }}"
			formmethod="POST"
			id="bulk-publish"
			style="display:none; margin-left:2px"
			onclick="return confirm('Are you sure you want to publish these articles?')">
				Publish Selected
		</button>

		<button
			class="btn btn-danger btn-block"
			type="submit"
			formaction="{{ route('admin.articles.trashAll') }}"
			formmethod="POST"
			id="bulk-trash"
			style="display:none; margin-left:2px"
			onclick="return confirm('Are you sure you want to trash these articles?')">
				<i class="fa fa-" aria-hidden="true"></i>
				Trash Selected
		</button>

	{{-- @endif --}}

	<br />
{{-- 
	<a href="{{ URL::to('articles/downloadExcel/xls') }}" class="btn btn-default btn-block">
		<i class="fa fa-file-excel-o" aria-hidden="true"></i>
		Download All as XLS
	</a>

	<a href="{{ URL::to('articles/downloadExcel/xlsx') }}" class="btn btn-default btn-block">
		<i class="fa fa-file-excel-o" aria-hidden="true"></i>
		Download All as XLSX
	</a>

	<a href="{{ URL::to('articles/downloadExcel/csv') }}" class="btn btn-default btn-block">
		<i class="fa fa-file-text-o" aria-hidden="true"></i>
		Download All as CSV
	</a>

	<a href="{{ route('articles.pdfview') }}" class="btn btn-warning btn-block">
		<i class="fa fa-file-pdf-o" aria-hidden="true"></i>
		Preview All as PDF
	</a>

	<a href="{{ route('articles.pdfview',['download'=>'pdf']) }}" class="btn btn-warning btn-block">
		<i class="fa fa-file-pdf-o" aria-hidden="true"></i>
		Download All to PDF
	</a> --}}

{{-- @include('common.controlCenterFooter') --}}