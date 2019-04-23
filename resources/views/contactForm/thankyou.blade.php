@extends ('layouts.master')

@section ('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@stop

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section ('content')
   <div class="card text-center mb-2">
      
      <div class="card-header bg-info text-dark">Thank you for your message</div>

      <div class="card-body card_body">
         <p>We will be in touch shortly if needed.</p>
      </div>

   </div>
@endsection