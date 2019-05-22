<a href="{{ route('dashboard') }}" class="btn btn-sm btn-block btn-primary">Dashboard</a>

<div id="accordion">
  <div class="card p-0 m-0">
    <div class="card-header m-0 p-0" id="headingOne">
      <div class="mb-0">
        <a class="btn btn-sm btn-block" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
          Recipes
        </a>
      </div>
    </div>

    <div id="collapseOne" class="collapse m-0 p-0" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body m-0 p-0">
        <a href="{{ route('recipes.published') }}" class="btn btn-sm btn-block btn-light m-0 text-left">Published Recipes</a>
        <a href="{{ route('recipes.newRecipes') }}" class="btn btn-sm btn-block btn-light m-0 text-left">Newly Added Recipes</a>
        <a href="{{ route('recipes.future') }}" class="btn btn-sm btn-block btn-light m-0 text-left">Future Recipes</a>
        <a href="{{ route('recipes.unpublished') }}" class="btn btn-sm btn-block btn-light m-0 text-left">Unpublished Recipes</a>
        <a href="{{ route('recipes.trashed') }}" class="btn btn-sm btn-block btn-light m-0 text-left text-danger">Trashed Recipes</a>
        <a href="{{ route('recipes.myRecipes') }}" class="btn btn-sm btn-block btn-light m-0 text-left">My Recipes</a>
        <a href="{{ route('recipes.myPrivateRecipes') }}" class="btn btn-sm btn-block btn-light m-0 text-left">My Private Recipes</a>
        <a href="{{ route('recipes.create') }}" class="btn btn-sm btn-block btn-light m-0 text-left text-success">Add Recipe</a>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header m-0 p-0" id="headingTwo">
      <div class="mb-0">
        <a class="btn btn-sm btn-block collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Collapsible Group Item #2
        </a>
      </div>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">

      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header m-0 p-0" id="headingThree">
      <div class="mb-0">
        <a class="btn btn-sm btn-block collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Site
        </a>
      </div>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">

      </div>
    </div>
  </div>
</div>