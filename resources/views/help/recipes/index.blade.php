<div class="card mb-3" id="recipes">
   <h3 class="card-header bg-grape-dark text-lime">Recipes</h3>
   <div class="card-body">
      <p class="card-text">Only accessible from the dashboard and to certain users that have been granteds the proper permissions.</p>
      <p><h5>Navigation menu</h5></p>
      
      <table class="table table-bordered table-sm table-hover">
         <thead class="thead-dark">
            <tr>
               <th style="width: 20%">Menu Iten</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td>Frontend View</td>
               <td>Clicking this menu will bring you back to the main homepage of the site</td>
            </tr>
            <tr>
               <td>Dashboard</td>
               <td>Clicking this menu will bring you back to the Dashboard</td>
            </tr>
         </tbody>
      </table>
      
      <h5>Recipes menu</h5>
      <table class="table table-bordered table-sm table-hover">
         <thead class="thead-dark">
            <tr>
               <th style="width: 20%">Menu Iten</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody>
            <tr>
               <td><a href="/help#recipes_published">Published Recipes</a></td>
               <td>Clicking this menu will bring you back to the Published Recipes page</td>
            </tr>
            <tr>
               <td><a href="/help#recipes_my">My Recipes</a></td>
               <td>Clicking this menu will bring you back to the My Recipes page</td>
            </tr>
            <tr>
               <td><a href="/help#recipes_my_private">My Private Recipes</a></td>
               <td>Clicking this menu will bring you back to the My Private Recipes page</td>
            </tr>
            <tr>
               <td><a href="/help#recipes_new">New Recipes</a></td>
               <td>Clicking this menu will bring you back to the New Recipes page</td>
            </tr>
            <tr>
               <td><a href="/help#recipes_unpublished">Unpublished Recipes</a></td>
               <td>Clicking this menu will bring you back to the Unpublished Recipes page</td>
            </tr>
            <tr>
               <td><a href="/help#recipes_future">Future Recipes</a></td>
               <td>Clicking this menu will bring you back to the Future Recipes page</td>
            </tr>
            <tr>
               <td><a href="/help#recipes_trashed">Trashed Recipes</a></td>
               <td>Clicking this menu will bring you back to the Trashed Recipes page</td>
            </tr>
         </tbody>
      </table>

      @include('help.recipes.published')
      @include('help.recipes.myRecipes')
      @include('help.recipes.myPrivate')
      @include('help.recipes.new')
      @include('help.recipes.unpublished')
      @include('help.recipes.future')
      @include('help.recipes.trashed')
   </div>
</div>
