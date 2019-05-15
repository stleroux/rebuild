<?php

namespace Modules\Recipes\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RecipesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('recipes')->delete();
        
        \DB::table('recipes')->insert(array (
            0 => 
            array (
                'category_id' => 1,
                'cook_time' => 20,
                'created_at' => '2016-10-05 14:06:04',
                'deleted_at' => NULL,
                'id' => 1,
                'image' => '1.jpg',
                'ingredients' => '<p>2 cups of sugar</p>
<p>dash of salt</p>
<p>3 tablespoons of cocoa</p>
<p>1 teaspoon of vanilla</p>
<p>1/2 cup of butter or margarine</p>
<p>1/2 cup of peanut butter</p>
<p>1/2 cup of milk</p>
<p>3 cups of oatmeal (quick cooking oats)</p>',
                'last_viewed_by_id' => 2,
                'last_viewed_on' => '2019-02-19 21:34:55',
                'methodology' => '<p>Place sugar, cocoa, butter, milk and salt in a pot. Bring to a full boil and boil for 1 minute.</p>
<p>Remove from heat and stir in vanilla, peanut butter and oatmeal. Mix well.</p>
<p>Drop from a teaspoon onto wax paper and let stand for about 30 minutes to dry.</p>',
                'modified_by_id' => 2,
                'personal' => 0,
                'prep_time' => 20,
                'private_notes' => NULL,
                'public_notes' => NULL,
                'published_at' => '2019-02-13 14:13:21',
                'servings' => 0,
                'source' => 'Recipe Box',
                'title' => 'Oatmeal Buds',
                'updated_at' => '2019-02-19 21:34:55',
                'user_id' => 2,
                'views' => 40,
            ),
            1 => 
            array (
                'category_id' => 1,
                'cook_time' => 0,
                'created_at' => '2019-02-21 07:03:32',
                'deleted_at' => NULL,
                'id' => 2,
                'image' => '2.jpg',
                'ingredients' => '<p>1/2 cup of brown sugar - well packed</p>
<p>1/2 cup of peanut butter</p>
<p>1/2 cup of corn syrup</p>
<p>1 cup of peanuts (non salted)</p>
<p>4 cups of Corn Flakes</p>
<p>2 cups semi sweet chocolate chips</p>',
                'last_viewed_by_id' => 2,
                'last_viewed_on' => '2018-02-13 15:23:28',
                'methodology' => '<p>Mix brown sugar, peanut butter and corn syrup in a pan</p>
<p>Cook on low heat until it starts to boil, mixing constantly</p>
<p>Remove form heat and add peanuts and Corn Flakes</p>
<p>Butter a 9 x 11 pan and spread mix evenly</p>
<p>Let cool and then melt chocolate chips and spread on top</p>',
                'modified_by_id' => 2,
                'personal' => 0,
                'prep_time' => 30,
                'private_notes' => NULL,
                'public_notes' => NULL,
                'published_at' => '2019-02-13 14:13:21',
                'servings' => 0,
                'source' => NULL,
                'title' => 'Bouchees Aux Cacahuettes',
                'updated_at' => '2019-02-19 21:35:34',
                'user_id' => 2,
                'views' => 189,
            ),
            2 => 
            array (
                'category_id' => 1,
                'cook_time' => 0,
                'created_at' => '2019-02-21 07:03:32',
                'deleted_at' => NULL,
                'id' => 4,
                'image' => '4.jpg',
                'ingredients' => '<p>1 1/2 cups of sugar</p>
<p>1/2 cup of butter</p>
<p>2 eggs</p>
<p>1 teaspoon of vanilla</p>
<p>4 tablespoons of milk</p>
<p>1 tablespoon of water</p>
<p>1 teaspoon of baking soda</p>
<p>1 teaspoon of baking powder</p>
<p>1 1/2 cups of flour</p>
<p>2-2 1/2 bananas</p>',
                'last_viewed_by_id' => 3,
                'last_viewed_on' => '2016-10-02 12:27:03',
            'methodology' => '<p>Mash bananas up completely and mix in all other ingredients. Pour into a loaf pan (greased) and bake at 350 degrees for 50 minutes.</p>',
                'modified_by_id' => NULL,
                'personal' => 0,
                'prep_time' => 20,
                'private_notes' => '',
                'public_notes' => '',
                'published_at' => '2019-02-13 14:13:21',
                'servings' => 0,
                'source' => 'Recipe Box',
                'title' => 'Banana Loaf',
                'updated_at' => '2019-02-28 22:53:57',
                'user_id' => 3,
                'views' => 15,
            ),
            3 => 
            array (
                'category_id' => 1,
                'cook_time' => 0,
                'created_at' => '2019-02-21 07:03:32',
                'deleted_at' => NULL,
                'id' => 5,
                'image' => '5.jpg',
                'ingredients' => '<p>1 1/2 cups of flour</p>
<p>3 teaspoons of baking powder</p>
<p>1/2 teaspoon of salt</p>
<p>2 eggs</p>
<p>1 cup of milk</p>
<p>4 tablespoons of melted butter</p>',
                'last_viewed_by_id' => 2,
                'last_viewed_on' => '2019-02-19 19:37:12',
                'methodology' => '<p>Mix flour, baking powder and salt together in large bowl. In a smaller bowl mix eggs and milk together and add to large bowl mixture. Beat well, cool and add melted butter.</p>',
                'modified_by_id' => 2,
                'personal' => 0,
                'prep_time' => 20,
                'private_notes' => NULL,
                'public_notes' => NULL,
                'published_at' => '2019-02-14 17:47:37',
                'servings' => 6,
                'source' => 'Recipe Box',
                'title' => 'Pancakes',
                'updated_at' => '2019-02-19 19:37:12',
                'user_id' => 3,
                'views' => 37,
            ),
            4 => 
            array (
                'category_id' => 9,
                'cook_time' => 0,
                'created_at' => '2016-10-02 14:17:37',
                'deleted_at' => NULL,
                'id' => 6,
                'image' => '6.jpg',
                'ingredients' => '<p>1 pound of butter</p>
<p>1 cup of fruit sugar</p>
<p>4 cups of flour</p>
<p>2 tablespoons of corn starch</p>
<p>1/2 teaspoon of vanilla</p>',
                'last_viewed_by_id' => 2,
                'last_viewed_on' => '2018-02-13 11:02:05',
                'methodology' => '<p>Mix butter, sugar, corn starch and vanilla together. Once well blended mix in all flour. Roll dough until it\'\'s about 1/4" thick and shape cookies as desired.</p>
<p>Preheat oven at 300 degrees and bake for approximately 16 minutes or until they are starting to brown.</p>',
                'modified_by_id' => 2,
                'personal' => 0,
                'prep_time' => 30,
                'private_notes' => NULL,
                'public_notes' => NULL,
                'published_at' => '2019-02-13 14:13:21',
                'servings' => 0,
                'source' => 'Recipe Box',
                'title' => 'Shortbread Cookies',
                'updated_at' => '2019-02-17 07:18:04',
                'user_id' => 3,
                'views' => 19,
            ),
            5 => 
            array (
                'category_id' => 2,
                'cook_time' => 0,
                'created_at' => '2016-10-02 14:19:13',
                'deleted_at' => NULL,
                'id' => 7,
                'image' => '7.jpg',
            'ingredients' => '<p>1 package of frozen spinach (cook as indicated and cool)</p>
<p>1 cup of sour cream</p>
<p>1 cup of mayonnaise</p>
<p>2 tablespoons of parmesan cheese</p>
<p>1 envelope (45g) of KNORR vegetable soup</p>',
                'last_viewed_by_id' => 2,
                'last_viewed_on' => '2016-10-02 11:19:13',
                'methodology' => '<p>Mix well and pour in a pumpernickel bread or use as a vegetable dip.</p>',
                'modified_by_id' => NULL,
                'personal' => 0,
                'prep_time' => 20,
                'private_notes' => '',
                'public_notes' => '',
                'published_at' => '2016-10-02 11:19:13',
                'servings' => 0,
                'source' => 'Recipe Box',
                'title' => 'Spinach Dip',
                'updated_at' => '2016-10-02 14:19:13',
                'user_id' => 2,
                'views' => 3,
            ),
            6 => 
            array (
                'category_id' => 1,
                'cook_time' => 0,
                'created_at' => '2016-10-02 14:20:36',
                'deleted_at' => NULL,
                'id' => 8,
                'image' => '8.jpg',
                'ingredients' => '<p>3 eggs</p>
<p>1/2 teaspoon of salt</p>
<p>2 tablespoons of sugar</p>
<p>1 cup of milk</p>
<p>6 slices of bread</p>',
                'last_viewed_by_id' => 2,
                'last_viewed_on' => '2016-10-02 11:20:37',
                'methodology' => '<p>Beat eggs well and add in all other ingredients. Mix well and soak bread until soft. Fry in a well greased frying pan.</p>',
                'modified_by_id' => NULL,
                'personal' => 0,
                'prep_time' => 10,
                'private_notes' => '',
                'public_notes' => '',
                'published_at' => '2019-02-28 22:53:42',
                'servings' => 6,
                'source' => 'Recipe Box',
                'title' => 'French Toast',
                'updated_at' => '2019-02-28 22:53:42',
                'user_id' => 3,
                'views' => 17,
            ),
            7 => 
            array (
                'category_id' => 9,
                'cook_time' => 0,
                'created_at' => '2016-10-02 14:22:46',
                'deleted_at' => NULL,
                'id' => 9,
                'image' => '9.jpeg',
                'ingredients' => '<p>1 1/4 cups of Kraft Smooth Peanut Butter</p>
<p>1/2 cup of margarine or butter</p>
<p>3/4 cup of white sugar</p>
<p>3/4 cup of brown sugar</p>
<p>2 eggs</p>
<p>2 teaspoons of vanilla</p>
<p>1 cup of flour</p>
<p>1/2 teaspoon of salt</p>
<p>1/2 teaspoon of baking soda</p>',
                'last_viewed_by_id' => 2,
                'last_viewed_on' => '2016-10-02 11:22:47',
                'methodology' => '<p>In a large bowl, mix together the first six ingredients.</p>
<p>In another bowl mix the remaining 3 ingredients.</p>
<p>Stir flour mixture into peanut butter mixture. mix well.</p>
<p>Drop onto a lightly greased sheet and then flatten slightly with a fork. Bake at 350 degrees for 10 to 12 minutes, or until the centers are still soft to the touch. Cool cookies on pan for 5 minutes.</p>',
                'modified_by_id' => NULL,
                'personal' => 0,
                'prep_time' => 30,
                'private_notes' => '',
                'public_notes' => '',
                'published_at' => '2019-02-19 20:06:13',
                'servings' => 36,
                'source' => 'Recipe Box',
                'title' => 'Peanut Butter Cookies',
                'updated_at' => '2019-02-19 20:06:13',
                'user_id' => 3,
                'views' => 53,
            ),
            8 => 
            array (
                'category_id' => 5,
                'cook_time' => 0,
                'created_at' => '2016-10-02 14:25:20',
                'deleted_at' => NULL,
                'id' => 10,
                'image' => '10.jpg',
                'ingredients' => '<p>2 teaspoons of cooking oil</p>
<p>1 pound of lean ground beef</p>
<p>2 cups of frozen mixed vegetables</p>
<p>1-10 ounce can of condensed cream of mushroom soup</p>
<p>1 teaspoon of beef bouillon powder</p>
<p>1/2 teaspoon of onion powder</p>
<p>1/4 teaspoon of black pepper</p>
<p>Pastry for 2 crust 9" pie</p>',
                'last_viewed_by_id' => 2,
                'last_viewed_on' => '2019-02-19 19:02:00',
                'methodology' => '<p>Heat cooking oil in a large frying pan on medium heat.</p>
<p>Add in ground beef.</p>
<p>Scramble-fry for about 10 minutes until no longer pink. Drain. Transfer to medium bowl. Cool. Add in rest of ingredients and stir.</p>
<p>Roll out one shell slightly larger then the other, about 1/8" thick and place in 9" pie plate.</p>
<p>Spoon beef mixture into shell.</p>
<p>Roll out other shell and place on top of pie mixture.</p>
<p>Dampen edge of shell with water.</p>
<p>Trim and crimp decorative edge to seal.</p>
<p>Cut 2 or 3 vents in top to allow steam to escape.</p>
<p>Bake on bottom rack at 400 degrees for 15 minutes.</p>
<p>Reduce heat to 350 degrees and bake for another 35 to 40 minutes until golden.</p>
<p>Let stand on wire rack for 10 minutes before serving.</p>',
                'modified_by_id' => 2,
                'personal' => 0,
                'prep_time' => 25,
                'private_notes' => NULL,
                'public_notes' => '<p>436 calories per wedge</p>',
                'published_at' => '2019-02-13 14:13:21',
                'servings' => 6,
                'source' => 'Company\'s Coming',
                'title' => 'Beef And Vegetable Pie',
                'updated_at' => '2019-02-21 22:08:12',
                'user_id' => 5,
                'views' => 46,
            ),
            9 => 
            array (
                'category_id' => 5,
                'cook_time' => 0,
                'created_at' => '2016-10-02 14:27:37',
                'deleted_at' => NULL,
                'id' => 11,
                'image' => '11.jpg',
                'ingredients' => '<p>1 egg</p>
<p>3/4 cup of quick-cooking rolled oats</p>
<p>3/4 cup of milk</p>
<p>1/4 cup on minced onion or 1 tablespoon of onion flakes</p>
<p>1 teaspoon of parsley flakes</p>
<p>1 teaspoon of Worcestershire sauce</p>
<p>1 1/2 teaspoons of salt</p>
<p>1/4 teaspoon of pepper</p>
<p>1 1/2 pounds of ground beef</p>
<p>1 cup of grated medium cheddar cheese</p>
<p>1/4 cup of ketchup</p>',
                'last_viewed_by_id' => 2,
                'last_viewed_on' => '2016-10-02 11:27:37',
                'methodology' => '<p>Combine first 8 ingredients in a large bowl.\\r\\nAdd ground beef. Mix well. Press 1/2 beef mixture into a 9x5x3 inch loaf pan. Sprinkle with cheese. Press in remaining beef mixture. Spread ketchup on top of beef mixture. Bake, uncovered at 350 degrees for 1 1/4 hours to 1 1/2 hours until fully cooked and internal temperature of beef reaches 160 degrees Fahrenheit. let stand for 10 minutes. Cuts into 12 slices.</p>',
                'modified_by_id' => NULL,
                'personal' => 0,
                'prep_time' => 35,
                'private_notes' => '',
                'public_notes' => '',
                'published_at' => '2016-02-13 14:13:21',
                'servings' => 6,
                'source' => 'Company\'s Coming',
                'title' => 'Classic Meatloaf',
                'updated_at' => '2016-10-02 14:27:37',
                'user_id' => 2,
                'views' => 124,
            ),
            10 => 
            array (
                'category_id' => 36,
                'cook_time' => 0,
                'created_at' => '2016-10-02 14:29:43',
                'deleted_at' => NULL,
                'id' => 12,
                'image' => '12.jpg',
            'ingredients' => '<p>4 oz. (125g) of light cream cheese, softened</p>
<p>2 tablespoons of packed brown sugar</p>
<p>1/2 teaspoon of vanilla</p>
<p>4-10" flour tortillas</p>
<p>1 cup of finely diced apple with peel</p>
<p>Ground cinnamon sprinkle</p>',
                'last_viewed_by_id' => 3,
                'last_viewed_on' => '2016-12-02 21:16:22',
                'methodology' => '<p>Preheat lightly sprayed electric griddle to medium-low. Combine cream cheese, brown sugar and vanilla in a small bowl until smooth.</p>
<p>Spread mixture onto 2 tortillas.</p>
<p>Divide apple between remaining 2 tortillas. Sprinkle with cinnamon. Cover with first 2 tortillas. Place apple side down on grill. Cook for 1 1/2 to 2 minutes. Carefully turn over and cook for 1 1/2 to 2 minutes until crispy and browned. Let stand for 1 minute. Cuts into 4 wedges each.</p>',
                'modified_by_id' => NULL,
                'personal' => 0,
                'prep_time' => 30,
                'private_notes' => '',
                'public_notes' => '<p>Variation: omit apples. Use 1 cup of mashed bananas.</p>',
                'published_at' => '2019-02-13 14:13:21',
                'servings' => 8,
                'source' => 'Company\'s Coming',
                'title' => 'Fresh Fruit Quesadillas',
                'updated_at' => '2019-02-16 19:42:03',
                'user_id' => 2,
                'views' => 37,
            ),
            11 => 
            array (
                'category_id' => 36,
                'cook_time' => 0,
                'created_at' => '2016-10-02 14:31:35',
                'deleted_at' => NULL,
                'id' => 13,
                'image' => '13.jpg',
                'ingredients' => '<p>2/3 cup of fresh raspberries</p>
<p>1/3 cup of fresh blueberries (or frozen, thawed)</p>
<p>1/3 cup of sliced strawberries</p>
<p>1/4 cup of low fat creamed cottage cheese</p>
<p>4 teaspoons of skim milk</p>
<p>3/4 teaspoon of lemon juice</p>
<p>1/2 teaspoon of liquid sweetener</p>
<p>8 flour tortillas (6 inch) warmed</p>',
                'last_viewed_by_id' => 2,
                'last_viewed_on' => '2019-02-19 19:14:40',
                'methodology' => '<p>Combine fruit in a shallow dish. Stir gently to mix.</p>
<p>Measure cottage cheese, milk, lemon juice and sweetener into a blender. Process until smooth.</p>
<p>Fold warm tortillas in half and then in half again.Lift 1 side to form a hollow.</p>
<p>Spoon about 2 1/2 tablespoons or about 1/8 of fruit into hollow.</p>
<p>Add about 1 teaspoon o f cottage cheese mixture.</p>
<p>Hold tortilla upright so mixture will run down through fruit. Repeat.</p>',
                'modified_by_id' => 2,
                'personal' => 0,
                'prep_time' => 25,
                'private_notes' => NULL,
                'public_notes' => NULL,
                'published_at' => '2019-02-13 14:13:21',
                'servings' => 8,
                'source' => 'Company\'s Coming',
                'title' => 'Fruity Burritos',
                'updated_at' => '2019-02-19 19:14:40',
                'user_id' => 2,
                'views' => 19,
            ),
            12 => 
            array (
                'category_id' => 5,
                'cook_time' => 0,
                'created_at' => '2016-10-02 14:33:30',
                'deleted_at' => NULL,
                'id' => 14,
                'image' => '14.jpg',
                'ingredients' => '<p>1 tablespoon vegetable oil</p>
<p>1 medium onion, chopped</p>
<p>2 pounds ground beef</p>
<p>1 garlic clove - finely chopped</p>
<p>2 cans pizza sauce - regular</p>
<p>1 can sliced mushrooms</p>
<p>1/2 cup water or mushroom juice</p>
<p>1 teaspoon oregano</p>
<p>1 cup cheddar cheese</p>
<p>1/3 cup Parmesan cheese</p>
<p>1 tablespoon salt</p>
<p>1 pack lasagna pasta</p>
<p>Mozzarella cheese - sliced</p>',
                'last_viewed_by_id' => 2,
                'last_viewed_on' => '2016-10-02 11:33:31',
                'methodology' => '<p>Cook pasta to liking</p>
<p>Mix all ingredients, except cheese and cook</p>
<p>Lay lasagna layer, meat layer, until none are left</p>
<p>Spread Mozzarella cheese on top and cook</p>',
                'modified_by_id' => NULL,
                'personal' => 0,
                'prep_time' => 35,
                'private_notes' => '',
                'public_notes' => '',
                'published_at' => '2019-02-13 14:13:21',
                'servings' => 8,
                'source' => '',
                'title' => 'Lasagna',
                'updated_at' => '2019-02-13 12:29:49',
                'user_id' => 2,
                'views' => 34,
            ),
            13 => 
            array (
                'category_id' => 1,
                'cook_time' => 0,
                'created_at' => '2016-10-02 14:35:01',
                'deleted_at' => NULL,
                'id' => 15,
                'image' => '15.jpg',
                'ingredients' => '<p>4 cups of white sugar</p>
<p>2 teaspoons of cinnamon</p>
<p>2 teaspoons of baking soda</p>
<p>2 teaspoons of baking powder</p>
<p>5 cups of flour</p>
<p>1 teaspoon of salt</p>
<p>2 1/2 cups of cooking oil</p>
<p>6 cups of grated carrots</p>
<p>8 eggs (whipped)</p>',
                'last_viewed_by_id' => 2,
                'last_viewed_on' => '2016-10-02 11:35:01',
                'methodology' => '<p>Mix sugar, cinnamon, baking soda, baking powder, flour and salt together. Then add oil, carrots and eggs. Place mixture into muffin cups. Bake at 325 degrees for about 20-25 minutes or until golden brown.</p>',
                'modified_by_id' => NULL,
                'personal' => 0,
                'prep_time' => 30,
                'private_notes' => '',
                'public_notes' => '',
                'published_at' => '2019-02-28 22:53:42',
                'servings' => 90,
                'source' => 'Recipe Box',
                'title' => 'Carrot Muffins',
                'updated_at' => '2019-02-28 22:53:42',
                'user_id' => 2,
                'views' => 15,
            ),
            14 => 
            array (
                'category_id' => 1,
                'cook_time' => 0,
                'created_at' => '2016-10-02 14:36:29',
                'deleted_at' => NULL,
                'id' => 16,
                'image' => '16.jpg',
                'ingredients' => '<p>1 cup of real mayonnaise</p>
<p>2 tablespoons of vinegar</p>
<p>1 tablespoon of prepared mustard</p>
<p>1 teaspoon of salt</p>
<p>1/4 teaspoon of pepper</p>
<p>8 ounces of macaroni</p>
<p>1 cup of sliced celery</p>
<p>1 cup of chopped green pepper</p>
<p>1/4 cup of onion</p>',
                'last_viewed_by_id' => 2,
                'last_viewed_on' => '2019-02-19 19:37:42',
                'methodology' => '<p>In a large bowl, stir together mayonnaise, vinegar, mustard, sugar, salt, and pepper until smooth.</p>
<p>Add remaining ingredients, toss to coat well.</p>
<p>Cover and chill</p>',
                'modified_by_id' => 2,
                'personal' => 0,
                'prep_time' => 20,
                'private_notes' => '<p>hghgfhgfhf</p>',
                'public_notes' => NULL,
                'published_at' => '2019-02-13 14:13:21',
                'servings' => 0,
                'source' => 'Recipe Box',
                'title' => 'Macaroni Salad',
                'updated_at' => '2019-02-19 19:37:42',
                'user_id' => 2,
                'views' => 20,
            ),
            15 => 
            array (
                'category_id' => 1,
                'cook_time' => 0,
                'created_at' => '2016-10-02 14:38:17',
                'deleted_at' => NULL,
                'id' => 17,
                'image' => '17.jpg',
                'ingredients' => '<p>2 cups of macaroni</p>
<p>2 tablespoons of butter</p>
<p>2 tablespoons of flour</p>
<p>salt and pepper to taste</p>
<p>2 cups of milk</p>
<p>2 cups of grated cheddar cheese (or cheddar &amp; colby - colby makes a smoother sauce)</p>',
                'last_viewed_by_id' => 2,
                'last_viewed_on' => '2016-10-02 11:38:18',
                'methodology' => '<p>Cook macaroni until tender. Make a roux of butter, flour, salt and pepper. Add milk and cook on stove top or microwave stirring regularily to make a smooth cream sauce. In a large buttered casserole dish combine: macaroni, sauce and cheese. Stir until mixed. Bake at 300 degrees for 20 minutes.</p>',
                'modified_by_id' => NULL,
                'personal' => 0,
                'prep_time' => 30,
                'private_notes' => '',
            'public_notes' => '<p>Variations: add onions and peppers (sauteed), add sliced hot dog pieces topped with buttered bread crumbs.</p>',
                'published_at' => '2019-02-13 14:13:21',
                'servings' => 0,
                'source' => 'Recipe Box',
                'title' => 'Macaroni And Cheese',
                'updated_at' => '2019-02-13 14:09:45',
                'user_id' => 2,
                'views' => 21,
            ),
            16 => 
            array (
                'category_id' => 6,
                'cook_time' => 0,
                'created_at' => '2016-10-02 14:40:15',
                'deleted_at' => NULL,
                'id' => 18,
                'image' => '18.jpg',
                'ingredients' => '<p>Salt</p>
<p>Pepper</p>
<p>Flour</p>
<p>Pork Chops</p>
<p>Sliced Onions</p>
<p>1/3 cup of water</p>
<p>1/3 cup of ketchup</p>
<p>3 tablespoons of brown sugar</p>',
                'last_viewed_by_id' => 2,
                'last_viewed_on' => '2016-10-02 11:40:16',
            'methodology' => '<p>Mix together salt, pepper and flour (the amounts are your own choice)</p>
<p>Coat pork chops with the flour mixture and brown chops on both sides in a frying pan. Place chops on the bottom of a roasting pan. Slice onions and place them on top of pork chops. Mix water, ketchup and brown sugar together and pour over top of chops. Bake at 300 degrees for approximately an hour.</p>',
                'modified_by_id' => NULL,
                'personal' => 0,
                'prep_time' => 20,
                'private_notes' => '',
                'public_notes' => '<p>You may increase the sauce depending on the number of chops. Each batch covers approximately 4 chops.</p>
<p>From my experience the best type of chops to use for this recipe is boneless.</p>',
                'published_at' => '2019-02-13 14:13:21',
                'servings' => 4,
                'source' => 'Recipe Box',
                'title' => 'Pork Chops A La Ruth',
                'updated_at' => '2019-02-13 14:09:45',
                'user_id' => 2,
                'views' => 18,
            ),
            17 => 
            array (
                'category_id' => 36,
                'cook_time' => 0,
                'created_at' => '2016-10-02 14:42:26',
                'deleted_at' => NULL,
                'id' => 19,
                'image' => '19.jpg',
                'ingredients' => '<p>2 cups of halved seedless grapes</p>
<p>2 cups of cubed honeydew</p>
<p>1 can of drained pineapple chunks (14 oz.)</p>
<p>1 can of sliced peaches in juice (drained but juice reserved) peaches chopped</p>
<p>Reserved peach juice</p>
<p>1 teaspoon of vanilla extract</p>
<p>1/2 teaspoon of ground ginger</p>
<p>1/4 teaspoon of ground allspice</p>',
                'last_viewed_by_id' => 2,
                'last_viewed_on' => '2019-03-03 17:14:58',
                'methodology' => '<p>Combine first four ingredients in large bowl.</p>
<p>Combine remaining 4 ingredients in small bowl.</p>
<p>Add to fruit. Stir until coated. Chill, covered, for at least 6 hours to blend flavours.</p>',
                'modified_by_id' => 2,
                'personal' => 0,
                'prep_time' => 20,
                'private_notes' => NULL,
                'public_notes' => '<p>97 calories per serving</p>',
                'published_at' => '2019-02-17 19:27:37',
                'servings' => 6,
                'source' => 'Company\'s Coming',
                'title' => 'Spiced Fruit Salad',
                'updated_at' => '2019-03-03 17:14:58',
                'user_id' => 2,
                'views' => 8,
            ),
            18 => 
            array (
                'category_id' => 36,
                'cook_time' => 0,
                'created_at' => '2016-10-02 14:44:42',
                'deleted_at' => NULL,
                'id' => 20,
                'image' => '20.jpeg',
                'ingredients' => '<p>4 cups of milk</p>
<p>2 boxes of instant white chocolate (or vanilla) pudding powder (4 serving size, each)</p>
<p>17 oz. angel food cake torn into 1 inch pieces</p>
<p>1-8 oz package of cream-filled chocolate mini cookies (12 reserved for garnish</p>
<p>3 cups of sliced strawberries</p>
<p>2 cups of frozen whipped topping, thawed</p>',
                    'last_viewed_by_id' => 3,
                    'last_viewed_on' => '2016-10-02 12:32:00',
                    'methodology' => '<p>Beat milk and pudding powder on low in a medium bowl for about 2 minutes until thickened.</p>
<p>Layer ingredients in a large glass serving bowl as follows:</p>
<p>1/2 of cake pieces</p>
<p>1/2 of cookies</p>
<p>1/2 of strawberry slices</p>
<p>2 cups of pudding, spread evenly</p>
<p>Remaining cake pieces</p>
<p>Remaining cookies</p>
<p>Remaining strawberry slices</p>
<p>Remaining pudding, spread evenly</p>
<p>Spread or pipe whipped topping in a decorative pattern on top of pudding. Garnish with reserved cookies. Chill for at least 4 hours to blend flavours.</p>',
                    'modified_by_id' => NULL,
                    'personal' => 0,
                    'prep_time' => 45,
                    'private_notes' => '',
                    'public_notes' => '',
                    'published_at' => '2019-02-13 14:13:21',
                    'servings' => 12,
                    'source' => 'Company\'s Coming',
                    'title' => 'Snow Angel Trifle',
                    'updated_at' => '2019-02-28 22:53:57',
                    'user_id' => 2,
                    'views' => 7,
                ),
                19 => 
                array (
                    'category_id' => 1,
                    'cook_time' => 0,
                    'created_at' => '2016-10-02 14:46:42',
                    'deleted_at' => NULL,
                    'id' => 21,
                    'image' => '21.jpg',
                    'ingredients' => '<p>2 cups of all purpose flour</p>
<p>1 1/3 chopped peeled fresh pear</p>
<p>3/4 of packed brown sugar</p>
<p>3 1/2 milk chocolate bar, chopped</p>
<p>2 teaspoons of baking powder</p>
<p>1/4 teaspoon of ground cinnamon</p>
<p>1/4 of salt</p>
<p>1 large egg</p>
<p>3/4 cup of buttermilk</p>
<p>1/2 cup of cooking oil</p>',
                    'last_viewed_by_id' => 2,
                    'last_viewed_on' => '2016-10-02 11:46:42',
                    'methodology' => '<p>Combine the first 7 ingredients in a large bowl. Make a well in centre.</p>
<p>Beat remaining 3 ingredients with whisk in small bowl. Add to well in large bowl. Stir until just moistened. Fill 12 greased muffins cups 3/4 full.</p>
<p>Bake in 375 degree oven for about 25 minutes until wooden pick inserted in centre of muffin comes out clean. Let stand in pan for 5 minutes before removing to wire rack to cool.</p>',
                    'modified_by_id' => NULL,
                    'personal' => 0,
                    'prep_time' => 30,
                    'private_notes' => '',
                    'public_notes' => '<p>Muffins may be stored in an airtight container for up to 3 months.</p>',
                    'published_at' => '2019-02-13 14:13:21',
                    'servings' => 12,
                    'source' => 'Company\'s Coming',
                    'title' => 'Chocolate And Pear Muffins',
                    'updated_at' => '2019-02-17 18:39:27',
                    'user_id' => 2,
                    'views' => 27,
                ),
                20 => 
                array (
                    'category_id' => 1,
                    'cook_time' => 30,
                    'created_at' => '2016-10-02 14:49:30',
                    'deleted_at' => NULL,
                    'id' => 22,
                    'image' => '22.jpg',
                    'ingredients' => '<p>2 cups of quick-cooking oats</p>
<p>1 3/4 cups of firmly packed light brown sugar</p>
<p>1 1/2 cups of all purpose flour</p>
<p>1 teaspoon of baking powder</p>
<p>1/2 teaspoon of baking soda</p>
<p>1 cup of butter</p>
<p>1/2 cup of chopped peanuts</p>
<p>1 cup (6 oz. pkg.) of semi-sweet chocolate chips</p>
<p>1 large egg, beaten</p>
<p>1 (14 oz.) can of sweetened condensed milk</p>
<p>1/2 cup of creamy peanut butter</p>',
                    'last_viewed_by_id' => 2,
                    'last_viewed_on' => '2016-10-02 11:49:30',
                    'methodology' => '<p>HEAT oven to 350Â°F.</p>
<p>Combine oats, brown sugar, flour, baking powder and baking soda in large bowl. Cut in butter with pastry blender or 2 knives until mixture resembles fine crumbs. Stir in peanuts.</p>
<p>RESERVE 1 1/2 cups crumb mixture. Stir egg into remaining crumb mixture.</p>
<p>Press onto bottom of 13 x 9-inch baking pan.</p>
<p>BAKE 15 minutes.</p>
<p>STIR together sweetened condensed milk and peanut butter in small bowl until well combined. Pour evenly over partially baked crust.</p>
<p>STIR together reserved crumb mixture and chocolate chips. Sprinkle evenly over peanut butter layer.</p>
<p>BAKE an additional 15 minutes. Cool. Cut into bars.</p>',
                    'modified_by_id' => NULL,
                    'personal' => 0,
                    'prep_time' => 30,
                    'private_notes' => '',
                    'public_notes' => '',
                    'published_at' => '2019-02-28 22:53:42',
                    'servings' => 12,
                    'source' => 'Recipe Box',
                    'title' => 'Chocolate Peanut Butter Bars',
                    'updated_at' => '2019-02-28 22:53:42',
                    'user_id' => 2,
                    'views' => 10,
                ),
                21 => 
                array (
                    'category_id' => 39,
                    'cook_time' => 180,
                    'created_at' => '2016-10-02 14:52:19',
                    'deleted_at' => NULL,
                    'id' => 23,
                    'image' => '23.jpeg',
                    'ingredients' => '<p>2 pounds of sausage</p>
<p>3 cups of chopped carrots</p>
<p>3 cups of chopped celery</p>
<p>Cabbage to taste (1 use about 1 cup and sometimes substitute leeks)</p>
<p>1 cup of chopped onions</p>
<p>2-28 ounce cans of tomatoes with herbs and spices</p>
<p>3 cloves of minced garlic</p>
<p>1 tablespoon of basil</p>
<p>8-10 cups of chicken or beef stock ( I use 1/2 and 1/2)</p>
<p>Parmesan cheese to grate on top at serving</p>',
                    'last_viewed_by_id' => 2,
                    'last_viewed_on' => '2018-02-01 14:07:56',
                    'methodology' => '<p>Brown sausage and chop into chunks. place in large roasting pan. Cook onion and garlic in the same pan as sausage until transparent and add to roasting pan. Add all other ingredients, cover and bake in oven at 350 degrees for 3-4 hours. About half hour before serving add 1 1/2 cups of el dente cooked pasta. I like fusilli. Top with cheese and enjoy!</p>',
                    'modified_by_id' => 3,
                    'personal' => 0,
                    'prep_time' => 30,
                    'private_notes' => '',
                    'public_notes' => '',
                    'published_at' => '2019-02-28 22:53:42',
                    'servings' => 10,
                    'source' => 'Recipe Box',
                    'title' => 'Baked Soup',
                    'updated_at' => '2019-02-28 22:53:42',
                    'user_id' => 4,
                    'views' => 46,
                ),
                22 => 
                array (
                    'category_id' => 1,
                    'cook_time' => 0,
                    'created_at' => '2016-10-02 14:55:51',
                    'deleted_at' => NULL,
                    'id' => 24,
                    'image' => '24.jpg',
                    'ingredients' => '<p>1 cup of all-purpose flour</p>
<p>3 tablespoon of unsweetened dutch cocoa powder</p>
<p>1 tablespoon of powdered sugar</p>
<p>1 1/2 cups of milk</p>
<p>2 large egg whites</p>
<p>1 whole egg</p>
<p>1 tsp. of oil</p>
<p>3 bananas, sliced</p>
<p>Whipped cream (homemade or store-bought)</p>
<p>Chocolate chips, for sprinkling (optional)</p>
<p>Chocolate syrup, for drizzling</p>',
                    'last_viewed_by_id' => 3,
                    'last_viewed_on' => '2016-10-02 12:32:22',
                'methodology' => '<p>In a large bowl, whisk together flour, milk, cocoa powder, powdered sugar, eggs and oil until smooth. (You can also do this with an electric mixer.)</p>
<p>Heat a large nonstick pan on medium-low heat, and grease with cooking spray. Pour 1/4 cup crepe mixture into pan, immediately the pan so that the batter spreads out thin into a large circle. Cook for 1 to 2 minutes or until bottom of crepe is light golden brown. Flip; cook 30 seconds to 1 minute or until light golden brown. Repeat with remaining cooking spray and crepe mixture.</p>
<p>To serve, spoon whipped cream into center of each crepe. Top with sliced bananas and fold each edge of crepe over filling. Drizzle with chocolate syrup and any additional toppings. Serve warm.</p>',
                    'modified_by_id' => NULL,
                    'personal' => 0,
                    'prep_time' => 30,
                    'private_notes' => '',
                    'public_notes' => '<p>This batter will also keep in the refrigerator for up to a day.</p>',
                    'published_at' => '2019-02-13 14:13:21',
                    'servings' => 12,
                    'source' => 'Recipe Box',
                    'title' => 'Chocolate Banana Crepes',
                    'updated_at' => '2019-02-17 08:08:22',
                    'user_id' => 4,
                    'views' => 13,
                ),
                23 => 
                array (
                    'category_id' => 1,
                    'cook_time' => 45,
                    'created_at' => '2016-10-02 14:58:10',
                    'deleted_at' => NULL,
                    'id' => 25,
                    'image' => '25.jpg',
                'ingredients' => '<p>1 stick (1/2 cup) of butter</p>
<p>1 egg, lightly beaten</p>
<p>1 cup of milk</p>
<p>1 cup of all-purpose flour</p>
<p>1 cup of sugar</p>
<p>2 teaspoons of baking powder</p>
<p>1/2 teaspoon of salt</p>
<p>2 quarts of whole strawberries, capped and washed</p>
<p>4 ounces of cream cheese, cut in small pieces</p>
<p>Vanilla ice cream for serving, optional</p>',
                    'last_viewed_by_id' => 2,
                    'last_viewed_on' => '2016-10-02 11:58:10',
                    'methodology' => '<p>Preheat oven to 350 F. Melt butter and pour into a 9x13-inch glass baking dish. In a small bowl, mix together the egg, milk, flour, sugar, baking powder and salt. Pour directly over the butter in the baking dish, but do not stir.</p>
<p>Add the strawberries, arranging in a single layer as much as possible. Sprinkle cream cheese pieces over strawberries. Place in preheated oven and bake for 45 minutes, or until top is golden brown and edges are bubbling. (Crust rises up and around the fruit, but fruit will still peek out of top.)</p>
<p>Serve hot out of the oven with choice of topping, if desired.</p>',
                    'modified_by_id' => NULL,
                    'personal' => 0,
                    'prep_time' => 30,
                    'private_notes' => '',
                    'public_notes' => '',
                    'published_at' => '2019-02-13 14:13:21',
                    'servings' => 10,
                    'source' => 'Company\'s Coming',
                    'title' => 'Strawberry Cream Cheese Cobbler',
                    'updated_at' => '2019-02-28 22:53:51',
                    'user_id' => 4,
                    'views' => 3,
                ),
                24 => 
                array (
                    'category_id' => 8,
                    'cook_time' => 40,
                    'created_at' => '2016-10-02 14:59:47',
                    'deleted_at' => NULL,
                    'id' => 26,
                    'image' => '26.jpg',
                    'ingredients' => '<p>2 cups of molasses</p>
<p>2 tbsp of lard or shortening</p>
<p>1/2 tsp of baking soda</p>
<p>1 tsp of baking powder</p>
<p>3 cups of all purpose flour</p>
<p>1 cup of boiling water</p>
<p>1/2 tsp of salt</p>',
                    'last_viewed_by_id' => 2,
                    'last_viewed_on' => '2016-10-02 11:59:47',
                    'methodology' => '<p>Mix baking soda and boiling water.</p>
<p>Add the rest of the ingredients.</p>
<p>Grease and flour pan.</p>
<p>Bake at 350\'\'F for 40 minutes.</p>',
                    'modified_by_id' => NULL,
                    'personal' => 0,
                    'prep_time' => 50,
                    'private_notes' => '',
                    'public_notes' => '',
                    'published_at' => '2019-02-13 14:13:21',
                    'servings' => 10,
                    'source' => 'Mom\'s recipe book',
                    'title' => 'Molasses Cake',
                    'updated_at' => '2016-10-02 14:59:47',
                    'user_id' => 4,
                    'views' => 29,
                ),
                25 => 
                array (
                    'category_id' => 9,
                    'cook_time' => 20,
                    'created_at' => '2019-03-05 12:31:22',
                    'deleted_at' => NULL,
                    'id' => 27,
                    'image' => '27.jpg',
                    'ingredients' => '<p>2 eggs</p>
<p>2 cups of brown sugar</p>
<p>2 teaspoons of vinegar</p>
<p>1 teaspoon of vanilla</p>
<p>1/2 cup of melted butter</p>
<p>2 cups of raisins</p>
<p>1 cup of chopped walnuts</p>',
                    'last_viewed_by_id' => 2,
                    'last_viewed_on' => '2019-03-05 12:31:22',
                    'methodology' => '<p>Beat eggs until yolks and whites are well blended not frothy.</p>
<p>Beat in brown sugar, vanilla and vinegar.</p>
<p>Stir in melted butter, raisins and walnuts.</p>
<p>Bake at 350 degrees about 15 minutes in unbaked pastry shells (about 1 tablespoon in each)</p>',
                    'modified_by_id' => 2,
                    'personal' => 0,
                    'prep_time' => 30,
                    'private_notes' => NULL,
                    'public_notes' => '<p>Old family recipe</p>',
                    'published_at' => '2019-03-01 12:29:00',
                    'servings' => 36,
                    'source' => 'Recipe Box',
                    'title' => 'Butter Tarts',
                    'updated_at' => '2019-03-05 12:31:22',
                    'user_id' => 2,
                    'views' => 0,
                ),
                26 => 
                array (
                    'category_id' => 8,
                    'cook_time' => 30,
                    'created_at' => '2019-03-05 12:33:14',
                    'deleted_at' => NULL,
                    'id' => 28,
                    'image' => '28.jpg',
                    'ingredients' => '<p>1 cup of white sugar</p>
<p>1 cup of milk</p>
<p>2 cups of flour</p>
<p>2 tsps of baking powder</p>
<p>2 1/2 cups of brown sugar</p>
<p>vanilla</p>',
                    'last_viewed_by_id' => 2,
                    'last_viewed_on' => '2019-03-05 12:33:14',
                    'methodology' => '<p>Mix white sugar, milk, flour and baking powder.</p>
<p>Pour mixture in ungreased 6 x 9 pan.</p>
<p>In sperate pot, boil brown sugar, water and vanilla.</p>
<p>Pour over dough and bake at 350 degrees F for about 30 minutes</p>',
                    'modified_by_id' => 2,
                    'personal' => 0,
                    'prep_time' => 20,
                    'private_notes' => NULL,
                    'public_notes' => NULL,
                    'published_at' => '2019-03-01 12:32:00',
                    'servings' => 10,
                    'source' => 'My mom\'s recipe book',
                    'title' => 'Pate Chomeur',
                    'updated_at' => '2019-03-05 12:33:14',
                    'user_id' => 2,
                    'views' => 0,
                ),
            ));
        
        
    }
}