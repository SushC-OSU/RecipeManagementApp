<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\cuisine;
use App\dietaryrestriction;
use App\recipe;
use App\recipe_dietary_restriction;
use Illuminate\Support\Facades\Auth;
use App\User;
use \DB;
use Illuminate\Database\QueryException;


class CreateNewCCDRController extends Controller
{
    public function listCourseToCreate()
    {
        $courses = Course::all(); 
        return view('createnewcourse', ['courses' => $courses]);
        
    }

    public function createNewCourse(Request $request)
    {
        
        $course = new Course();
        $course->course_name = $request->input('course_name');
        if($request->input('is_active') == "false"){
            $course->is_active = "No";            
        }else if($request->input('is_active') == "true"){
            $course->is_active = "Yes";
        }
        $course->save();
        
        $courses = Course::all(); 

        return view('createnewcourse', ['courses' => $courses]);
    }

    public function showEditCourse($course_id)
    {
        $course = Course::findOrFail($course_id);
        return view('editcourse', ['course' => $course]);
    }

    public function editCourse(Request $request, $id)
    {
        // print_r("edit");exit;
        $course = Course::findOrFail($id);
        $course->course_name = $request->input('course_name');
        $course->is_active = $request->input('is_active') ? 'Yes' : 'No';
        $course->save();
        $all_courses = Course::all(); 
        return view('createnewcourse', ['courses' => $all_courses]);
    }


    public function deleteCourse($course_id)
    {
        $courses = Course::all(); 
        try {
            //Stored Procedure and Trigger
            
            DB::statement("CALL deleteCourse($course_id)");
            return redirect()->route('listCourseToCreate');
        } catch (QueryException $e) {
            // Error message or roll back transaction
            if ($e->errorInfo[1] == 1644) {
                // handle trigger error
                $error_message = 'Cannot delete course because it is mapped with recipe(s)';
                
                // dd($courses);exit;
                // return view('createnewcourse', ['courses' => $courses]);
                return view('createnewcourse', ['courses' => $courses])->with('error', $error_message);
                // return redirect()->back()->withErrors($error_message);
            }
            // print_r($error_message);exit;
        }

        // delete the course with the given id from the database
        // $courses = Course::where('id',$course_id)->first(); 
        // if(isset($courses->id)){
        //     Course::findOrFail($course_id)->delete();
        // }else{
        //     return redirect()->route('home');    
        // }
        // return redirect()->route('home');
        
    }

    //Cuisine Functionality
    public function listCuisineToCreate()
    {
        $cuisines = cuisine::all(); 
        // dd($courses);exit;
        return view('createnewcuisine', ['cuisines' => $cuisines]);
    }

    public function showEditCuisine($id)
    {
        
        $cuisine = cuisine::findOrFail($id);
        return view('editcuisine', ['cuisine' => $cuisine]);
    }

    public function deleteCuisine($cuisine_id)
    {
        
        // $all_cuisines = cuisine::all(); 
        // delete the cuisine with the given id from the database
        // $cuisines = cuisine::where('id',$cuisine_id)->first(); 
        // if(isset($cuisines->id)){
            DB::delete('DELETE FROM cuisines WHERE id = ?', [$cuisine_id]);

            // cuisine::findOrFail($cuisine_id)->delete();
        // }else{
            return redirect()->route('listCuisineToCreate');
            // return redirect()->route('createnewcuisine')->with(['cuisines' => $all_cuisines]);  
            // return back()->with(['cuisines' => $all_cuisines]);

        // }
        
        // return redirect()->route('home');
        // return redirect()->route('createnewcuisine')->with(['cuisines' => $all_cuisines]);        
    }

    public function createNewCuisine(Request $request)
    {
        
        $cuisine = new cuisine();
        $cuisine->cuisine_name = $request->input('cuisine_name');
        if($request->input('is_active') == "false"){
            $cuisine->is_active = "No";            
        }else if($request->input('is_active') == "true"){
            $cuisine->is_active = "Yes";
        }
        $cuisine->save();
        
        $cuisines = cuisine::all(); 

        return view('createnewcuisine', ['cuisines' => $cuisines]);
        
    }
    
    public function editCuisine(Request $request, $id)
    {
        // print_r($id);exit;
        $cuisine = cuisine::findOrFail($id);
        $cuisine->cuisine_name = $request->input('cuisine_name');
        $cuisine->is_active = $request->input('is_active') ? 'Yes' : 'No';
        $cuisine->save();
        $all_cuisines = cuisine::all(); 
        return view('createnewcuisine', ['cuisines' => $all_cuisines]);
    }



    //Dietary Restriction Functionality
    public function listDietRestrictToCreate()
    {
        $dietrestrict = dietaryrestriction::all(); 
        // dd($courses);exit;
        return view('createnewdietrestrict', ['dietrestrict' => $dietrestrict]);
    }

    public function showEditDietRestriction($id)
    {
        $dietrestrict = dietaryrestriction::findOrFail($id);
        return view('editdietaryrestriction', ['dietrestrict' => $dietrestrict]);
    }

    public function editDietaryRestriction(Request $request, $id)
    {
        
        $save_dietrestrict = dietaryrestriction::findOrFail($id);
        $save_dietrestrict->dietary_restriction_name = $request->input('dietary_restriction_name');
        $save_dietrestrict->is_active = $request->input('is_active') ? 'Yes' : 'No';
        $save_dietrestrict->save();

        $dietrestrict = dietaryrestriction::all(); 
// print_r($dietrestrict[0]['dietary_restriction_name']);exit;
        // return view('editdietaryrestriction', ['dietrestrict' => $dietrestrict]);
        return view('createnewdietrestrict', ['dietrestrict' => $dietrestrict]);
    }

    public function deleteDietaryRestriction($id)
    {
        $dietrestrict = dietaryrestriction::where('id',$id)->first(); 
        if(isset($dietrestrict->id)){
            dietaryrestriction::findOrFail($id)->delete();
        }else{
            return redirect()->route('home');
            // return view('createnewcourse', ['courses' => $all_courses]);    
        }
        return redirect()->route('home');
        // return view('createnewcourse', ['courses' => $all_courses]);
        
    }

    public function createNewDietaryRestriction(Request $request)
    {
        // print_r($request->input(''));exit;
        $dietrestriction = new dietaryrestriction();
        $dietrestriction->dietary_restriction_name = $request->input('dietrestrict_name');
        if($request->input('is_active') == "false"){
            $dietrestriction->is_active = "No";            
        }else if($request->input('is_active') == "true"){
            $dietrestriction->is_active = "Yes";
        }
        $dietrestriction->save();
        
        $dietrestrict = dietaryrestriction::all(); 

        return view('createnewdietrestrict', ['dietrestrict' => $dietrestrict]);
    }

    public function listActiveUsers(){
        //View
        // $active_users = DB::table('active_users')->get();
        $active_users = DB::table('users')
                            ->where('is_active', "Yes")
                            ->get();

        // $results = DB::table('recipes')
        //      ->join('users', 'recipes.user_id', '=', 'users.id')
        //      ->select('users.first_name as user_name', 'recipes.recipe_name', 'recipes.id',DB::raw('count(*) as recipe_count'))
        //      ->groupBy('users.first_name', 'recipes.recipe_name', 'recipes.id')
        //      ->get();

        //Group By to display the recipes grouped by user.
        $results = DB::select('SELECT u.first_name AS user_name, r.recipe_name, r.id
                       FROM recipes r
                       JOIN users u ON r.user_id = u.id
                       GROUP BY u.first_name, r.recipe_name, r.id');
                       

             $formattedRecipes = [];
                foreach ($results as $recipe) {
                    $formattedRecipes[$recipe->user_name][] = [
                        'id' => $recipe->id,
                        'recipe_name' => $recipe->recipe_name,
                        'user_name' => $recipe->user_name,
                    ];
                }
            
// print_r($active_users);exit;
        return view('userListing', ['formattedRecipes' => $formattedRecipes, 'active_users' => $active_users]);
    }

    public function listUsersByRecipeCreation(){
        //Nested Query
        $user_recipe_created = DB::select(" SELECT *
                                FROM users
                                WHERE id IN (SELECT DISTINCT user_id
                                FROM recipes)");

        $user_recipe_not_created = DB::select(" SELECT *
                                FROM users
                                WHERE id NOT IN (SELECT DISTINCT user_id
                                FROM recipes)");

        return view('userRecipeCreationInfo', ['user_recipe_created' => $user_recipe_created, 'user_recipe_not_created' => $user_recipe_not_created]);
    }

    public function listAllUsers(){
        // $active_users = DB::table('active_users')->get();
        $active_users = DB::table('users')->get();

        return view('alluserListing', ['active_users' => $active_users]);
    }

    public function showEditUser($user_id)
    {
        $user = User::findOrFail($user_id);
        // echo "<pre>";print_r($user);echo "</pre>";exit;
        return view('edituser', ['user' => $user]);
    }

    public function editUser(Request $request, $id)
    {
        
        $user = User::findOrFail($id);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->is_active = $request->input('is_active') ? 'Yes' : 'No';
        $user->is_admin = $request->input('is_admin') ? 'Yes' : 'No';
        $user->save();
        

        // If the user is updated as inactive, set their recipes as inactive
        if ($user->is_active == "No") {
            $user->recipes()->update(['is_active' => 'No']);
        }elseif ($user->is_active == "Yes") {
            $user->recipes()->update(['is_active' => 'Yes']);
        }

        

        $active_users = DB::table('users')->get();

        return view('alluserListing', ['active_users' => $active_users]);
    }
    
}
