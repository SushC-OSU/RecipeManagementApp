@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Recipes</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('updateMyRecipe', $recipe->id) }}">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="recipe_name">Recipe Name:</label>
                            <input type="text" class="form-control" id="recipe_name" name="recipe_name" value="{{ $recipe->recipe_name }}">
                        </div>
                        <div class="form-group">
                            <label for="ingredients">Ingredients:</label>
                            <textarea class="form-control" id="ingredients" name="ingredients">{{ $recipe->ingredients }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="cookingtime">Cooking Time:</label>
                            <input type="number" class="form-control" id="cookingtime" name="cooktime" value="{{ $recipe->cooking_time }}">
                        </div>
                        <div class="form-group">
                            <label for="servingsize">Serving Size:</label>
                            <input type="text" class="form-control" id="servingsize" name="servesize" value="{{ $recipe->serving_size }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" id="description" name="description">{{ $recipe->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="cuisineid">Cuisine:</label>  <br/>
                            <select name="cuisineid">
                                @foreach($cuisines as $id => $name)
                                    <option value="{{ $id }}" {{ $recipe->cuisine_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="courseid">Course:</label>  <br/>
                            <select name="courseid">
                                @foreach($courses as $id => $name)
                                    <option value="{{ $id }}" {{ $recipe->course_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="dietrestrictid">Dietary Restriction:</label>  <br/>
                            <select name="dietary_restrictions[]" multiple>
                            @foreach($allDietaryRestrictions as $id => $name)
                                <option value="{{ $id }}" {{ in_array($id, $selectedDietaryRestrictions) ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>                            
                        </div>
                        <input type="hidden" name="selectedDietaryRestrictions" value="{{ implode(',', $selectedDietaryRestrictions) }}">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <div align="right">
                            <a href="{{ route('viewMyRecipe') }}">Back</a>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
    
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    
    // Get the value of the hidden input field and store it in a variable
    var selectedDietaryRestrictions = $('input[name="selectedDietaryRestrictions"]').val();
    
    // Attach event listener to remove button for each dietary restriction option
    $('select[name="dietary_restrictions[]"]').on('change', function() {
        // Get array of currently selected dietary restriction ids
        var selectedIds = $(this).val();
        
        // Update value of hidden input field
        $('input[name="selectedDietaryRestrictions"]').val(selectedIds.join(','));
        
        // Update value of selectedDietaryRestrictions variable
        selectedDietaryRestrictions = selectedIds.join(',');
        
        // Log value of selectedDietaryRestrictions variable to console
        console.log(selectedDietaryRestrictions);
    });
});
</script>


@endsection

<!-- <script src="{{ url('listcourses') }}"></script> -->

