@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All Users</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <!-- <div>
                        <h3 for="recipe_name">Active Users</h3>
                    </div> -->
                    <div>
                        <table>
                            <thead>
                                <tr>
                                    <td width="25%"><p><b>User Name</b></p></td>
                                    <td width="40%"><p><b>Email</b></p></td>
                                    <td width="10%"><p><b>Is Admin</b></p></td>
                                    <td width="10%"><p><b>Is Active</b></p></td>
                                    <td width="15%"><p><b>Edit</b></p></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($active_users as $active_user)
                                <tr>
                                    <td width="25%">{{$active_user->first_name}} {{$active_user->last_name}}</td>
                                    <td width="40%">{{$active_user->email}} </td>
                                    <td width="10%">{{$active_user->is_admin}} </td>
                                    <td width="10%">{{$active_user->is_active}} </td>
                                    <td width="15%">
                                        <form method="GET" action="{{ route('showEditUser', $active_user->id) }}">
                                            <button class="showEditCourse" data-user-id="{{ $active_user->id }}">Edit</button>

                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>                        
                    </div>
                    <div>
                        <hr/>
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

