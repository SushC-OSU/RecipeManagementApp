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
                  <!-- {{$user}} -->
                    <form method="POST" action="{{ route('editUser', ['id' => $user->id]) }}">
                        @csrf
                        @method('PUT')
                        <label>First Name:</label>
                        <input type="text" name="first_name" value="{{ $user->first_name }}">
                        <br>
                        <label>Last Name:</label>
                        <input type="text" name="last_name" value="{{ $user->last_name }}">
                        <br>
                        <label>Email:</label>
                        <input type="text" name="email" value="{{ $user->email }}">
                        <br>
                        <label>Is Active:</label>
                        <input type="checkbox" name="is_active" {{ $user->is_active == "Yes" ? 'checked' : '' }}>
                        <br>
                        <label>Is Admin:</label>
                        <input type="checkbox" name="is_admin" {{ $user->is_admin == "Yes" ? 'checked' : '' }}>
                        <br>
                        <button type="submit">Save</button>
                    </form>
                    



                </div>
            </div>
        </div>
    </div>
    
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
</script>


@endsection


