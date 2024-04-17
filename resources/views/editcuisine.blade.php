@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Panel</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('editCuisine', ['id' => $cuisine->id]) }}">
                        @csrf
                        @method('PUT')
                        <label>Cuisine Name:</label>
                        <input type="text" name="cuisine_name" value="{{ $cuisine->cuisine_name }}">
                        <br>
                        <label>Is Active:</label>
                        <input type="checkbox" name="is_active" {{ $cuisine->is_active == "Yes" ? 'checked' : '' }}>
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


