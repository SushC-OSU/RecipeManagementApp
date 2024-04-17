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
                      <p><label for="recipe_name"><b>Users who have created Recipies:</b></label></p> 
                    </div>
                    <div>
                        <table>
                            <tr>
                                <td width="25%">
                                    <span> <b>User Name</b></span>
                                </td>
                                <td width="50%">
                                    <span> <b>Email</b></span>
                                </td>
                                <td width="15%">
                                    <span> <b>Is Admin</b></span>
                                </td>
                                <td width="10%">
                                    <span> <b>Is Active</b></span>
                                </td>
                            </tr>
                            @if(count($user_recipe_created) > 0)
                                @for($i = 0; $i < count($user_recipe_created); $i++)
                                    <tr>
                                        <td width="25%">
                                        <p>{{ $user_recipe_created[$i]->first_name }} {{ $user_recipe_created[$i]->last_name }}</p>
                                        </td>
                                        <td width="50%">
                                        <p>{{ $user_recipe_created[$i]->email }}</p>
                                        </td>
                                        <td width="15%">
                                        <p>{{ $user_recipe_created[$i]->is_admin }}</p>
                                        </td>
                                        <td width="10%">
                                        <p>{{ $user_recipe_created[$i]->is_active }}</p>
                                        </td>
                                    </tr>
                                @endfor
                            @endif
                        </table>
                    </div>
                    <div>
                        <p><label for="recipe_name"><b>Users who have not created recipes:</b></label></p>
                    </div>
                    <div>
                        <table>
                            <thead>
                                <tr>
                                <td width="25%">
                                    <span> User Name</span>
                                </td>
                                <td width="50%">
                                    <span> Email</span>
                                </td>
                                <td width="15%">
                                    <span> Is Admin</span>
                                </td>
                                <td width="10%">
                                    <span> Is Active</span>
                                </td>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($user_recipe_not_created) > 0)
                            <tr>
                                @for($i = 0; $i < count($user_recipe_not_created); $i++)
                                <td width="25%">
                                <p>{{ $user_recipe_not_created[$i]->first_name }}</p>
                                </td>
                                <td width="50%">
                                <p>{{ $user_recipe_not_created[$i]->first_name }}</p>
                                </td>
                                <td width="15%">
                                <p>{{ $user_recipe_not_created[$i]->first_name }}</p>
                                </td>
                                <td width="10%">
                                <p>{{ $user_recipe_not_created[$i]->first_name }}</p>
                                </td>
                                @endfor
                            </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div align="right">
                        <a href="{{ route('home') }}">Back</a>
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

