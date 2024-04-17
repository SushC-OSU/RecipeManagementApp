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
                    
                    <div>
                        <h3 for="recipe_name">Active Users</h3>
                    </div>
                    <div>
                        <table>
                            <thead>
                                <tr>
                                    <td width="30%"><p><b>User Name</b></p></td>
                                    <td width="50%"><p><b>Email</b></p></td>
                                    <td width="20%"><p><b>Is Admin</b></p></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($active_users as $active_user)
                                <tr>
                                <td width="30%">{{$active_user->first_name}} {{$active_user->last_name}}</td>
                                <td width="50%">{{$active_user->email}} </td>
                                <td width="20%">{{$active_user->is_admin}} </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        
                    </div>
                    <div>
                        <hr/>
                    </div>
                    <div>
                        <h3 for="recipe_name">User's Recipe</h3>
                    </div>
                    <div>
                        @foreach ($formattedRecipes as $user => $recipes)
                            <h3>{{ $user }}</h3>
                            @foreach ($recipes as $recipe)
                                <li><a href="{{ route('viewUserRecipe', $recipe['id']) }}">{{ $recipe['recipe_name'] }}</a></li>
                            @endforeach
                        @endforeach

                        </span>
                    </div>
                    
                    <div align="right">
                            <a href="{{ route('home') }}">Back</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
    
</div>


@endsection