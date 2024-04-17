@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Cuisine</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <h1>Create New Cuisine</h1>
                            <div>
                                <h3>Add New Cuisine</h3>
                                <label>Enter Cuisine name:</label>
                                <input type="text" name="cuisine_name" id="cuisine_name">
                                <br>
                                <label for="is_active">Is Active:</label>
                                <input type="checkbox" name="is_active" id="is_active" value="1">
                                <button type="button" id="addCuisine">Add Cuisine</button>
                            </div>
                            <br>
                            <div>
                                <h2>Available Cuisines</h2>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Cuisine Name</th>
                                            <th>Status</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cuisines as $cuisine)
                                            <tr>
                                                <td>{{ $cuisine->cuisine_name }}</td>
                                                <td>{{ $cuisine->is_active == 'Yes' ? 'Active' : 'Inactive' }}</td>
                                                <td>
                                                    <form method="GET" action="{{ route('showEditCuisine', $cuisine->id) }}">
                                                        <button class="showEditCuisine" data-cuisine-id="{{ $cuisine->id }}">Edit</button>

                                                    </form>
                                                </td>
                                                <td>
                                                    <form method="POST" action="{{ route('deleteCuisine', ['id' => $cuisine->id]) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
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
    </div>
    
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script>
         $(document).ready(function(){
           // Add new cuisine
           $('#addCuisine').click(function(){
               var cuisineName = $('#cuisine_name').val();
               var isActive = $('#is_active').is(':checked');
               $.ajax({
                   type:'POST',
                   url:'/createNewCuisine',
                   data:{
                       cuisine_name: cuisineName,
                       is_active: isActive,
                       _token: '{{ csrf_token() }}'
                   },
                   success:function(data){
                        location.reload();
                       $('#cuisineList').append('<li>'+data.cuisine_name+' '+(data.is_active ? '(Active)' : '(Inactive)')+'</li>');
                       $('#cuisine_name').val('');
                       $('#is_active').prop('checked', false);
                       location.reload();
                   },
                   error:function(xhr,status,error){
                       console.log(xhr.responseText);
                   }
               });
           });
         });
      </script>
@endsection
