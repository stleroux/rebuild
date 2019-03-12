@extends('layouts.help')

@section('left_column')
   dsdsd
@endsection

@section('content')

      <h1>Main system help</h1>
            
         <div id="recipes">
            <h2>Recipes Help</h2>
            <p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p>
            <p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p>
            <p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p>
            <p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p>
            <p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p>
            <p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p>
            <p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p>
            <p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p>
            <p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p>
            <p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p>
         </div>


         <div id="categories">
            <h2>Categories</h2>
            <p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p>
            <p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p>
         </div>

         <div id="categories_add_category">
            <h2>Add A Category</h2>
            <p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p>
            <p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p>
         </div>

         <div id="categories_add_subCategory">
            <h2>Add A SubCategory</h2>
            <p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p>
            <p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p><p><br /></p>
         </div>

         <div id="categories_add_mainCategory">
            <h2>Add A MainCategories</h2>
            <div class="row">
               <div class="col">
                  <p><h6>Required field(s)</h6></p>
                  <table class="table">
                     <thead>
                        <tr>
                           <th>Field</th>
                           <th>Description</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>Main Category</td>
                           <td>This will create a top level category in the system that will be used to sort the sub-categories</td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
            <div class="row">
               <div class="col">
                  <p><h6>Optional field(s)</h6></p>
                  <table class="table">
                     <thead>
                        <tr>
                           <th>Field</th>
                           <th>Description</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>Value</td>
                           <td>The Value field is only required if you want to create a new Landing Page entry. This is because the Landing Pages display a different value (which is more meaningful to the user) then the one stored in the system.</td>
                        </tr>
                        <tr>
                           <td>Description</td>
                           <td>Fill out a description of the field.</td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>

@endsection