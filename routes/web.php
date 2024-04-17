<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/createRecipe', function () {    
//     return view('createnewrecipe');
// })->name('createRecipe');

Route::get('/createRecipe', 'CreateNewRecipeController@listRecipieElements')->name('createRecipe');
Route::get('/viewMyRecipe', 'CreateNewRecipeController@listMyRecipies')->name('viewMyRecipe');
Route::get('/editMyRecipe/{recipe_id}', 'CreateNewRecipeController@editMyRecipe')->name('editMyRecipe');
Route::get('/deleteMyRecipe/{recipe_id}', 'CreateNewRecipeController@deleteMyRecipe')->name('deleteMyRecipe');
Route::post('/updateMyRecipe/{recipe_id}', 'CreateNewRecipeController@updateMyRecipe')->name('updateMyRecipe');
Route::get('/viewAllRecipe', 'CreateNewRecipeController@listAllRecipies')->name('viewAllRecipe');

Route::get('/listCourseToCreate', 'CreateNewCCDRController@listCourseToCreate')->name('listCourseToCreate');
Route::post('/createNewCourse', 'CreateNewCCDRController@createNewCourse')->name('createNewCourse');
Route::get('/showEditCourse/{id}', 'CreateNewCCDRController@showEditCourse')->name('showEditCourse');
Route::delete('/deleteCourse/{id}', 'CreateNewCCDRController@deleteCourse')->name('deleteCourse');
Route::put('/editCourse/{id}', 'CreateNewCCDRController@editCourse')->name('editCourse');


Route::get('/listCuisineToCreate', 'CreateNewCCDRController@listCuisineToCreate')->name('listCuisineToCreate');
Route::post('/createNewCuisine', 'CreateNewCCDRController@createNewCuisine')->name('createNewCuisine');
Route::get('/showEditCuisine/{id}', 'CreateNewCCDRController@showEditCuisine')->name('showEditCuisine');
Route::delete('/deleteCuisine/{id}', 'CreateNewCCDRController@deleteCuisine')->name('deleteCuisine');
Route::put('/editCuisine/{id}', 'CreateNewCCDRController@editCuisine')->name('editCuisine');


Route::get('/listDietRestrictToCreate', 'CreateNewCCDRController@listDietRestrictToCreate')->name('listDietRestrictToCreate');
Route::get('/showEditDietRestriction/{id}', 'CreateNewCCDRController@showEditDietRestriction')->name('showEditDietRestriction');
Route::put('/editDietaryRestriction/{id}', 'CreateNewCCDRController@editDietaryRestriction')->name('editDietaryRestriction');
Route::delete('/deleteDietaryRestriction/{id}', 'CreateNewCCDRController@deleteDietaryRestriction')->name('deleteDietaryRestriction');
Route::post('/createNewDietaryRestriction', 'CreateNewCCDRController@createNewDietaryRestriction')->name('createNewDietaryRestriction');

Route::put('/editUser/{id}', 'CreateNewCCDRController@editUser')->name('editUser');

Route::get('getRecipesByCourses', 'CreateNewRecipeController@getRecipesByCourses')->name('getRecipesByCourses');

Route::get('/listSearchedRecipies/{id}', 'CreateNewRecipeController@listSearchedRecipies')->name('listSearchedRecipies');
Route::get('/showEditUser/{id}', 'CreateNewCCDRController@showEditUser')->name('showEditUser');


Route::post('someurl', 'CreateNewRecipeController@submitForm');
Route::get('listcourses', 'CreateNewRecipeController@listCourses')->name('listcourses');
Route::get('listcuisines', 'CreateNewRecipeController@listCuisines')->name('listcuisines');
Route::get('listdietaryrestriction', 'CreateNewRecipeController@listdietaryrestriction')->name('listdietaryrestriction');



Route::get('recipesByCourse/{course_id}', 'CreateNewRecipeController@listRecipesByCourses')->name('recipesByCourse');
Route::get('recipesByCuisine/{cuisine_id}', 'CreateNewRecipeController@listRecipesByCuisines')->name('recipesByCuisine');
Route::get('recipesByDietaryRestriction/{cuisine_id}', 'CreateNewRecipeController@listRecipesByDietaryRestrictions')->name('recipesByDietaryRestriction');

Route::get('/viewRecipe/{recipe_id}', 'CreateNewRecipeController@viewRecipe')->name('viewRecipe');
Route::get('/search', 'CreateNewRecipeController@searchIng')->name('search');

Route::get('/listActiveUsers', 'CreateNewCCDRController@listActiveUsers')->name('listActiveUsers');
Route::get('/listUsersByRecipeCreation', 'CreateNewCCDRController@listUsersByRecipeCreation')->name('listUsersByRecipeCreation');

Route::get('/viewUserRecipe/{recipe_id}', 'CreateNewRecipeController@viewUserRecipe')->name('viewUserRecipe'); 

Route::get('/latestRecipes', 'CreateNewRecipeController@listLatestRecipies')->name('latestRecipes');
Route::get('/listAllUsers', 'CreateNewCCDRController@listAllUsers')->name('listAllUsers');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
