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
                    @if (isset($recipes) && count($recipes) > 0)
                    <div>
                    <table>
                        <thead>
                            <tr>
                            <th style="width: 20%">Recipe Name</th>
                            <th style="width: 20%">Ingredients</th>
                            <th style="width: 10%">Cook Time</th>
                            <th style="width: 10%">Serve Size</th>
                            <!-- <th style="width: 35%">Description</th> -->
                            <th style="width: 10%">Cuisine</th>
                            <th style="width: 10%">Course</th>
                            <th style="width: 10%">Edit</td>
                            <th style="width: 10%">Delete</td>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($recipes as $recipe)
                            <tr>
                                <td>{{ $recipe->recipe_name }}</td>
                                <td>{{ $recipe->ingredients }}</td>
                                <td>{{ $recipe->cooking_time }}</td>
                                <td>{{ $recipe->serving_size }}</td>
                                <!-- <td>{{ $recipe->description }}</td> -->
                                <td>{{ $recipe->cuisine->cuisine_name }}</td>
                                <td>{{ $recipe->course->course_name }}</td>
                                <td><a href="{{ route('editMyRecipe', $recipe->id) }}">Edit</a></td>
                                <td>
                                    <a href="{{ route('deleteMyRecipe', $recipe->id) }}">Delete</a>
                                    <!-- <form action="{{ route('deleteMyRecipe', $recipe->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Delete</button>
                                    </form> -->
                                </td>
                            </tr>
                            @endforeach  
                        </tbody>
                    </table>
                    </div>
                    @endif
                    <div>
                    <table>
                        <tbody>
                        <tr>
                            <td colspan="8"><p></p></td>
                            <td colspan="4">
                                <div align="right">
                                    <a href="{{ route('home') }}">Back</a>
                                </div>
                            </td>   
                        </tr> 
</tbody>
                    </table>
</div>
                </div>
            </div>
        </div>
    </div>
    
</div>

@endsection

<!-- <script src="{{ url('listcourses') }}"></script> -->

