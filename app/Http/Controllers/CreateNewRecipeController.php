<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
USE App\User;
use App\Course;
use App\cuisine;
use App\dietaryrestriction;
use App\recipe;
use App\recipe_dietary_restriction;
use Illuminate\Support\Facades\Auth;
use \DB;



class CreateNewRecipeController extends Controller
{
    public function submitForm(Request $request) {

        $user_id = Auth::id();

        $recipe = new Recipe;

        $recipe->recipe_name = $request->recipename;
        $recipe->ingredients = $request->ingredients;
        $recipe->cooking_time = $request->cooktime;
        $recipe->serving_size = $request->servesize;
        $recipe->course_id = $request->courseid;
        $recipe->cuisine_id = $request->cuisineid;
        $recipe->description = $request->description;
        $recipe->user_id = $user_id;

        $recipe->save();

        $recipeId = $recipe->id;

        if(isset($request->dietrestrictid)){
            foreach ($request->dietrestrictid as $restriction) {

                $newRecipeRestriction = new recipe_dietary_restriction;
                $newRecipeRestriction->recipe_id = $recipeId;
                $newRecipeRestriction->dietary_restriction_id = $restriction;
                $newRecipeRestriction->save();
            }
        }
        
        return redirect('/home');
        // Do something with the form input
    }

    public function listCourses()
    {
        $courses = Course::all();
        return response()->json($courses);
        
    }

    public function listCuisines()
    {
        $cuisines = Cuisine::all();
        return response()->json($cuisines);
        
    }
    
    public function listRecipesByCourses($course_id)
    {
        // Retrieve the course by its ID
        $course = Course::findOrFail($course_id);
        
        // Retrieve the recipes associated with the course
        // $recipes = $course->recipes()->get();
        $recipes = $course->recipes()
                ->where('is_active', 'Yes')
                ->get();

        
        // Pass the data to the view
        // return view('recipes_by_course', [
        //     'course' => $course,
        //     'recipes' => $recipes
        // ]);
        return view('listallrecipebycourse', ['recipes' => $recipes]);
        
    }

    public function listRecipesByCuisines($cuisine_id)
    {
        // Retrieve the course by its ID
        $cuisine = Cuisine::findOrFail($cuisine_id);
        
        // Retrieve the recipes associated with the course
        $recipes = $cuisine->recipes()
        ->where('is_active', 'Yes')->get();
        
        // Pass the data to the view
        return view('listallrecipebycourse', ['recipes' => $recipes]);
        
    }

    public function listRecipieElements()
    {
        
        $courses = Course::where('is_active', 'Yes')->get(); // Use the Course model to retrieve all courses from the database
        $cuisines = cuisine::where('is_active', 'Yes')->get();
        $dietrestrictions = dietaryrestriction::where('is_active', 'Yes')->get();
        // dd($courses);exit;
        return view('createnewrecipe', ['courses' => $courses, 'cuisines' => $cuisines, 'dietrestrictions' => $dietrestrictions]);
        // return view('createnewrecipe', compact('courses')); // Pass the courses to the view
    }

    public function listMyRecipies()
    {
        $user_id= Auth::id();
        $recipes = Recipe::with('cuisine', 'course')
                            ->where('user_id', $user_id)
                            ->get();

        return view('viewmyrecipe', ['recipes' => $recipes]);
        // return view('createnewrecipe', compact('courses')); // Pass the courses to the view
    }

    public function editMyRecipe($recipe_id)
    {
        $recipe = Recipe::with('cuisine', 'course', 'recipe_dietary_restriction')->find($recipe_id);

        $cuisines = Cuisine::pluck('cuisine_name', 'id')->toArray();
        $courses = Course::pluck('course_name', 'id')->toArray();

        // Get all the dietary restriction names from the dietary_restrictions table
        $allDietaryRestrictions = dietaryrestriction::pluck('dietary_restriction_name', 'id')->toArray();

        $dietaryRestrictions = $recipe->recipe_dietary_restriction->pluck('dietary_restriction_id')->toArray();

        return view('editrecipe', ['recipe' => $recipe, 
                                    'allDietaryRestrictions' => $allDietaryRestrictions,
                                    'selectedDietaryRestrictions' => $dietaryRestrictions,
                                    'cuisines' => $cuisines, 
                                    'courses' => $courses]);
    }

    public function updateMyRecipe($recipe_id, Request $request) {

            $selectedDietaryRestrictions = explode(',', $request->input('selectedDietaryRestrictions'));
        
        // Find the recipe by ID
        $recipe = Recipe::find($recipe_id);

        $user_id = Auth::id();
        // Update the recipe fields
        $recipe->recipe_name  = $request->recipe_name;
        $recipe->ingredients = $request->ingredients;
        $recipe->cooking_time = $request->cooktime;
        $recipe->serving_size = $request->servesize;
        $recipe->course_id = $request->courseid;
        $recipe->cuisine_id = $request->cuisineid;
        $recipe->description = $request->description;
        $recipe->user_id = $user_id;

        $recipe->save();

        // fetch the recipe with its current dietary restrictions
        $recipe_diet = Recipe::with('recipe_dietary_restriction')->find($recipe_id);
        
        // get the IDs of the current dietary restrictions
        $currentRestrictionIds = $recipe_diet->recipe_dietary_restriction->pluck('dietary_restriction_id')->toArray();
        
        

        // find the IDs that are removed and delete the corresponding records
        $removedIds = array_diff($currentRestrictionIds, $selectedDietaryRestrictions);
        if (!empty($removedIds)) {
            recipe_dietary_restriction::where('recipe_id', $recipe_id)->whereIn('dietary_restriction_id', $removedIds)->delete();
        }
        
        // find the IDs that are added and insert new records
        $addedIds = array_diff($selectedDietaryRestrictions, $currentRestrictionIds);
        if (!empty($addedIds)) {
            $records = [];
            foreach ($addedIds as $id) {
                $records[] = [
                    'recipe_id' => $recipe_id,
                    'dietary_restriction_id' => $id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            recipe_dietary_restriction::insert($records);
        }
        
        $user_id= Auth::id();
        $all_recipes = Recipe::with('cuisine', 'course')
                            ->where('user_id', $user_id)
                            ->get();

        return view('viewmyrecipe', ['recipes' => $all_recipes]);

        // Save the changes
        // $recipe->save();

        // Redirect to the recipe details page
        // return redirect()->route('recipes.show', $recipe_id);
        
    }

    public function deleteMyRecipe($recipe_id)
    {
        $recipe = Recipe::find($recipe_id);
    
        if ($recipe) {
            $recipe->recipe_dietary_restriction()->delete(); // Delete related records from recipe_dietary_restrictions table
            $recipe->delete(); // Delete the recipe record
        }
        
        // Redirect to some other page
        return redirect()->route('home');

        // return view('createnewrecipe', compact('courses')); // Pass the courses to the view
    }

    public function listAllRecipies()
    {
        $recipes = Recipe::with('cuisine', 'course')->get();

        return view('recipelisting', ['recipes' => $recipes]);
    }

    public function viewRecipe($recipe_id)
    {
            
            $recipe = Recipe::select('recipes.*', 'courses.course_name', 'cuisines.cuisine_name', 'dietaryrestrictions.dietary_restriction_name')
            ->join('courses', 'courses.id', '=', 'recipes.course_id')
            ->join('cuisines', 'cuisines.id', '=', 'recipes.cuisine_id')
            ->join('recipe_dietary_restrictions', 'recipe_dietary_restrictions.recipe_id', '=', 'recipes.id')
            ->join('dietaryrestrictions', 'dietaryrestrictions.id', '=', 'recipe_dietary_restrictions.dietary_restriction_id')
            ->where('recipes.id', '=', $recipe_id)
            ->get();


        return view('viewrecipe', ['recipe' => $recipe]);

    //         print "<pre>";
    // print_r($recipe);
    // print "</pre>";
    
    exit;
        // print_r($recipes);exit;
        $courses = Course::all();
    
        // return view('viewRecipe', compact('recipe', 'courses'));
        
        return view('viewrecipe', ['recipe' => $recipes, 'courses' => $courses]);

        // return view('viewRecipe', ['recipe' => $recipe, 
        //                             'allDietaryRestrictions' => $allDietaryRestrictions,
        //                             'selectedDietaryRestrictions' => $dietaryRestrictions,
        //                             'cuisines' => $cuisines, 
        //                             'courses' => $courses]);
    }

    public function getRecipesByCourses()
    {
        $recipes = Recipe::select('recipes.*', 'courses.course_name as course_name')
                ->join('courses', 'recipes.course_id', '=', 'courses.id')
                ->get();

        return response()->json($recipes);
        
    }

    public function searchIng(Request $request)
    {
        $ingredients = $request->input('ingredients');

        // Convert comma-separated list of ingredients into an array
        $ingredientArray = explode(',', $ingredients);

        // Query for recipes that include any of the specified ingredients
        $recipes = Recipe::where('is_active',"Yes")
        ->where(function($query) use ($ingredientArray) {
            foreach ($ingredientArray as $ingredient) {
                $query->orWhere('Ingredients', 'LIKE', '%' . trim($ingredient) . '%');
            }
        })->get();
        return view('recipelisting', ['recipes' => $recipes, 'search' => "true"]);
    }

    public function listSearchedRecipies($id)
    {
        
        $recipe = Recipe::select('recipes.*', 'courses.course_name', 'cuisines.cuisine_name', 'dietaryrestrictions.dietary_restriction_name')
            ->join('courses', 'courses.id', '=', 'recipes.course_id')
            ->join('cuisines', 'cuisines.id', '=', 'recipes.cuisine_id')
            ->join('recipe_dietary_restrictions', 'recipe_dietary_restrictions.recipe_id', '=', 'recipes.id')
            ->join('dietaryrestrictions', 'dietaryrestrictions.id', '=', 'recipe_dietary_restrictions.dietary_restriction_id')
            ->where('recipes.id', '=', $id)
            ->get();


        // return view('viewrecipe', ['recipe' => $recipe]);
                    
    return view('searchedrecipelisting', ['recipe' => $recipe]);
    }

    public function viewUserRecipe($recipe_id)
    {
            
            // $recipe = Recipe::select('recipes.*', 'courses.course_name', 'cuisines.cuisine_name', 'dietaryrestrictions.dietary_restriction_name')
            // ->join('courses', 'courses.id', '=', 'recipes.course_id')
            // ->join('cuisines', 'cuisines.id', '=', 'recipes.cuisine_id')
            // ->join('recipe_dietary_restrictions', 'recipe_dietary_restrictions.recipe_id', '=', 'recipes.id')
            // ->join('dietaryrestrictions', 'dietaryrestrictions.id', '=', 'recipe_dietary_restrictions.dietary_restriction_id')
            // ->where('recipes.id', '=', $recipe_id)
            // ->get();
            //INNER JOIN To display User created Recipes
            $recipe = DB::select('SELECT recipes.*, courses.course_name, cuisines.cuisine_name, dietaryrestrictions.dietary_restriction_name
                       FROM recipes
                       JOIN courses ON courses.id = recipes.course_id
                       JOIN cuisines ON cuisines.id = recipes.cuisine_id
                       JOIN recipe_dietary_restrictions ON recipe_dietary_restrictions.recipe_id = recipes.id
                       JOIN dietaryrestrictions ON dietaryrestrictions.id = recipe_dietary_restrictions.dietary_restriction_id
                       WHERE recipes.id = ?', [$recipe_id]);

        return view('viewuserrecipe', ['recipe' => $recipe]);
    }

    public function listLatestRecipies()
    {
        // $recipes = User::with(['recipes' => function ($query) {
        //     $query->latest()->take(2);
        // }])->get();

    //     DB::statement("
    //     CREATE VIEW last_created_recipes AS
    //     SELECT recipe_name, cooking_time, serving_size, Ingredients, course.name as course_name, cuisine.name as cuisine_name, dietary_restriction.name as dietary_restriction_name, description, users.first_name, users.last_name, recipes.created_at
    //     FROM recipes
    //     INNER JOIN users ON users.id = recipes.user_id
    //     INNER JOIN course ON course.id = recipes.course_id
    //     INNER JOIN cuisine ON cuisine.id = recipes.cuisine_id
    //     INNER JOIN dietary_restriction ON dietary_restriction.id = recipes.dietary_restriction_id
    //     ORDER BY recipes.created_at DESC
    //     LIMIT 10;
    // ");

        $latest_recipes = [];
        foreach ($recipes as $value) {
            // $latest_recipes[$value->id][''] =
            foreach ($value['recipes'] as $recipe_info) {
                $latest_recipes[$recipe_info->id]['recipe_id'] = $recipe_info->id;
                $latest_recipes[$recipe_info->id]['recipe_name'] = $recipe_info->recipe_name;
                $latest_recipes[$recipe_info->id]['cooking_time'] = $recipe_info->cooking_time;
                $latest_recipes[$recipe_info->id]['serving_size'] = $recipe_info->serving_size;
                
            } 
            // print('<pre>');print_r($latest_recipes);print('</pre>');exit;
            // print('<pre>');print_r($value['recipes']);print('</pre>');exit;
        }


        return view('home', ['latest_recipes' => $latest_recipes]);

        
    }

    public function listdietaryrestriction()
    {
        $dietRes = dietaryrestriction::all();
        return response()->json($dietRes);
        
    }
    public function listRecipesByDietaryRestrictions($diet_res_id)
    {
        //ANY Query
        $recipesAll = DB::select("
                        SELECT * FROM recipes 
                        WHERE is_active= 'Yes' and
                        id = ANY(
                            SELECT recipe_id FROM recipe_dietary_restrictions 
                            WHERE dietary_restriction_id = $diet_res_id
                        )
                    ");

        return view('listallrecipebydietaryrestriction', ['recipes' => $recipesAll]);
        
    }

}
