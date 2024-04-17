@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All Recipes</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card-body">  
                        <div class="row">
                            <div class="col-md-6">                      
                                <button onclick="showCourseDropdown()">Recipe By Course</button>
                                <div id="courseDropdown" style="display:none">
                                    <select name="course">
                                    </select>
                                    <button onclick="go()">Go</button>
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <button onclick="showCuisineDropdown()">Recipe By Cuisine</button>
                                <div id="cuisineDropdown" style="display:none">
                                    <select name="cuisine">
                                    </select>
                                    <button onclick="goCuisine()">Go</button>
                                </div>   
                            </div>  
                        </div>                                     
                    </div>
                    <div class="card-body">                    
                        <button onclick="showDietResDropdown()">Recipe By Dietary Restriction</button>
                        <div id="dietResDropdown" style="display:none">
                            <select name="dietRes">
                            </select>
                            <button onclick="goDietRes()">Go</button>
                        </div>                    
                    </div>
                    <div><hr/></div>

                    <div class= "card-body">
                        <div>
                            <h4>Search for Recipes by Ingredient</h4>

                            <form action="{{ route('search') }}" method="GET">
                                @csrf
                                <label for="ingredients">Ingredients:</label>
                                <input type="text" name="ingredients" id="ingredients" placeholder="Ex: Tomato">
                                <br>
                                <button type="submit" >Search</button>
                            </form>
                            <div>
                            @if (isset($search) && count($recipes) > 0)
                                <h4>Search Results:</h4>
                                <ul>
                                @foreach ($recipes as $recipe)
                                    <li><a href="{{ route('listSearchedRecipies', $recipe->id) }}">{{ $recipe->recipe_name }}</a></li>
                                @endforeach
                                </ul>
                            @else
                                <p>No recipes found.</p>
                            @endif

                            </div>
                            <div align="right">
                                <a href="{{ route('home') }}">Back</a>
                            </div>

                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function showCourseDropdown() {
        console.log("test123");
        $.ajax({
            url: '/listcourses', 
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response);
                var options = '';
                $.each(response, function(index, course) {
                    options += '<option value="' + course.id + '">' + course.course_name + '</option>';
                });
                $('#courseDropdown select').html(options);
                $('#courseDropdown').show();
            },
            error: function(xhr, textStatus, errorThrown) {
            console.log('Error: ' + errorThrown);
            }
        });
        
    }

    function go() {
        console.log("Go Button");
      var selectedCourse = $('select[name="course"]').val();
      if (selectedCourse != '') {
        window.location.href = '/recipesByCourse/' + selectedCourse;
      }
    }

    function showCuisineDropdown() {
        console.log("test123");
        $.ajax({
            url: '/listcuisines', 
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response);
                var options = '';
                $.each(response, function(index, cuisine) {
                    options += '<option value="' + cuisine.id + '">' + cuisine.cuisine_name + '</option>';
                });
                $('#cuisineDropdown select').html(options);
                $('#cuisineDropdown').show();
            },
            error: function(xhr, textStatus, errorThrown) {
            console.log('Error: ' + errorThrown);
            }
        });
        
    }
    function goCuisine() {
        console.log("Go Button");
      var selectedCuisine = $('select[name="cuisine"]').val();
      if (selectedCuisine != '') {
        window.location.href = '/recipesByCuisine/' + selectedCuisine;
      }
    }

    function showAllRecipeCourseDropdown() {
        
        $.ajax({
            url: '/getRecipesByCourses', 
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response);
                data = response;
                $('#RecipeByCourseDropdown').show();
            },
            error: function(xhr, textStatus, errorThrown) {
            console.log('Error: ' + errorThrown);
            }
        });
    }
        function showDietResDropdown() {
        console.log("test1243");
        $.ajax({
            url: '/listdietaryrestriction', 
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response);
                var options = '';
                $.each(response, function(index, dietRes) {
                    options += '<option value="' + dietRes.id + '">' + dietRes.dietary_restriction_name + '</option>';
                });
                $('#dietResDropdown select').html(options);
                $('#dietResDropdown').show();
            },
            error: function(xhr, textStatus, errorThrown) {
            console.log('Error: ' + errorThrown);
            }
        });
        
    }
    function goDietRes() {
        console.log("Go Button");
      var selectedDietRes = $('select[name="dietRes"]').val();
      if (selectedDietRes != '') {
        window.location.href = '/recipesByDietaryRestriction/' + selectedDietRes;
      }
        
    }
</script>

@endsection

<!-- <script src="{{ url('listcourses') }}"></script> -->

