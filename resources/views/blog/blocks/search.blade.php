<div class="card mb-2">
	<div class="card-header block_header p-2">
      <i class="fa fa-search" aria-hidden="true"></i>
      Search Blog Entries
	</div>
	<div class="card-body py-2">
		{!! Form::open(['route' => 'blog.search', 'method'=> 'GET']) !!}
         <div class="row">
            <div class="col px-0">
               <div class="form-group mb-2">
   			      {{ Form::text('search', null, ['class' => 'form-control form-control-sm']) }}
               </div>
               <div class="form-group mb-0">
   			      {{ Form::button('<i class="fa fa-search" aria-hidden="true"></i> Search', array('type' => 'submit', 'class' => 'btn btn-sm btn-primary btn-block')) }}
               </div>
            </div>
         </div>
		{!! Form::close() !!}
   </div>
</div>
