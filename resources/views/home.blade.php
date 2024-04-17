@extends('layouts.app')

@section('content')
@if(auth()->user()->is_active == 'Yes')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Dashboard</h3></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">  
                            <h4>All About Food.......</h4><br/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">                   
                            <a href="{{ route('createRecipe') }}" class="btn btn-primary">Create New Recipe</a>
                        </div>
                        <div class="col-md-4">  
                            <a href="{{ route('viewMyRecipe') }}" class="btn btn-primary">View My Recipes</a> 
                        </div> 
                        <div class="col-md-4">  
                            <a href="{{ route('viewAllRecipe') }}" class="btn btn-primary">All Recipes</a>
                        </div> 
                    </div>
                </div>
                <div><hr/></div>
                <div class="card-body">
                    @if(auth()->user()->is_admin == 'Yes')
                    <div class="row bg-gray text-black">
                        <div class="col-md-12">  
                            <h3 class="text-dark">Admin Panel</h3><br/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">  
                            <h4>Create Course, Cuisine and Dietary Restriction</h4><br/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{ route('listCourseToCreate') }}" class="btn btn-primary">Course Creation</a>
                        </div>
                        <div class="col-md-4"> 
                            <a href="{{ route('listCuisineToCreate') }}" class="btn btn-primary">Cuisine Creation</a> 
                        </div>
                        <div class="col-md-4"> 
                            <a href="{{ route('listDietRestrictToCreate') }}" class="btn btn-primary">Create Dietary Restriction</a>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    @if(auth()->user()->is_admin == 'Yes')
                    <div class="row">
                        <div class="col-md-12">  
                            <h4>User Recipe Information</h4><br/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{ route('listActiveUsers') }}" class="btn btn-primary">List Active Users</a>
                        </div>
                        <div class="col-md-4"> 
                            <a href="{{ route('listUsersByRecipeCreation') }}" class="btn btn-primary">Users Created Recipes</a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('listAllUsers') }}" class="btn btn-primary">User Info</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
