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
                    
                    <form method="POST" action="{{ route('editCourse', ['id' => $course->id]) }}">
                        @csrf
                        @method('PUT')
                        <label>Course Name:</label>
                        <input type="text" name="course_name" value="{{ $course->course_name }}">
                        <br>
                        <label>Is Active:</label>
                        <input type="checkbox" name="is_active" {{ $course->is_active == "Yes" ? 'checked' : '' }}>
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


