<div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="printModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="printModalLabel">
           {{-- {{ $title }} {{ ucfirst(str_singular($name)) }} --}}
           Recipe
        </h4>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>To print this recipe, please use your browser's print functionality.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
        <a href="{{ route('recipes.print', $recipe->id) }}" class="btn btn-sm btn-primary">
           <div class="text text-left">
             <i class="fa fa-print"></i> Proceed
           </div>
        </a>
      </div>
    </div>
  </div>
</div>