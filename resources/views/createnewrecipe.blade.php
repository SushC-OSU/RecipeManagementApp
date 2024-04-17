@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Recipe</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <form action="{{url('someurl')}}" method="POST">
                    @csrf <!-- Add a CSRF token field -->
                        <div class="form-group">
                            <label for="recipename">Recipe Name</label>
                            <input type="input" class="form-control" id="recipename" name="recipename" placeholder="Ex: Chicken Curry">
                        </div>
                        <div class="form-group">
                            <label for="ingredients">Ingredients</label>
                            <textarea class="form-control" name="ingredients"  id="ingredients" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="cookingtime">Cooking Time (In Minutes)</label>
                            <input type="number" name="cooktime" class="form-control" id="cookingtime" placeholder="Ex: 15">
                        </div>
                        <div class="form-group">
                            <label for="servingsize">Serving Size</label>
                            <input type="number" name="servesize" class="form-control" id="servingsize" placeholder="Ex: 4">
                        </div>
                        <div class="form-group">
                            <label for="courseid">Select a Course:</label>
                            <select class="form-control" id="courseid" name="courseid">
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cuisineid">Select a Cuisine:</label>
                            <select class="form-control" id="cuisineid" name="cuisineid">
                                @foreach($cuisines as $cuisine)
                                    <option value="{{ $cuisine->id }}">{{ $cuisine->cuisine_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="dietrestrictid">Select Dietary Restrictions:</label>
                            <select id="dietrestrictid" name="dietrestrictid[]" multiple class="form-control">
                                @foreach($dietrestrictions as $restriction)
                                    <option value="{{ $restriction->id }}">{{ $restriction->dietary_restriction_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name= "description" id="description" rows="10"></textarea>
                        </div>
                        

                        <button type="submit">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    
</div>

@endsection

<!-- <script src="{{ url('listcourses') }}"></script> -->

