@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">View Recipe</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{$recipe[0]->dietary_restriction_name}}

                    <div>
                        <label for="recipe_name">Recipe Name:</label>
                        <span>{{ $recipe[0]->recipe_name }}</span>
                    </div>
                    <div>
                        <label for="recipe_name">Ingredients:</label>
                        <span>{{ $recipe[0]->ingredients }}</span>
                    </div>
                    <div>
                        <label for="recipe_name">Cooking Time:</label>
                        <span>{{ $recipe[0]->cooking_time }}</span>
                    </div>
                    <div>
                        <label for="recipe_name">Serving Size:</label>
                        <span>{{ $recipe[0]->serving_size }}</span>
                    </div>
                    <div>
                        <label for="recipe_name">Description:</label>
                        <span>{{ $recipe[0]->description }}</span>
                    </div>
                    <div>
                        <label for="courseid">Course:</label>
                        <span>{{ $recipe[0]->course_name }}</span>
                    </div>
                    <div>
                        <label for="cuisineid">Cuisine:</label>
                        <span>{{ $recipe[0]->cuisine_name }}</span>
                    </div>
                    <div>
                        <label for="dietary_restriction">Dietary Restriction:</label>                        
                        @foreach ($recipe as $dietary_restriction)
                        <li>{{$dietary_restriction->dietary_restriction_name}}</li>
                        @endforeach
                    </div>
                    <div align="right">
                            <a href="{{ route('viewAllRecipe') }}">Back</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

</script>


@endsection

<!-- <script src="{{ url('listcourses') }}"></script> -->

