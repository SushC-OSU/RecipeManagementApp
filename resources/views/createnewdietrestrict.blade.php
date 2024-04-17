@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Dietary Restriction</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <h1>Create New Dietary Restriction</h1>
                            <div>
                                <h3>Add New Dietary Restriction</h3>
                                <label>Enter Dietary Restriction name:</label>
                                <input type="text" name="dietrestrict_name" id="dietrestrict_name">
                                <br>
                                <label for="is_active">Is Active:</label>
                                <input type="checkbox" name="is_active" id="is_active" value="1">
                                <button type="button" id="addDietRestrict">Add Dietary Restriction</button>
                            </div>
                            <br>
                            <div>
                                <h2>Available Dietary Restrictions</h2>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Dietary Restriction Name</th>
                                            <th>Status</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dietrestrict as $dietres)
                                            <tr>
                                                <td>{{ $dietres->dietary_restriction_name }}</td>
                                                <td>{{ $dietres->is_active == 'Yes' ? 'Active' : 'Inactive' }}</td>
                                                <td>
                                                    <form method="GET" action="{{ route('showEditDietRestriction', $dietres->id) }}">
                                                        <button class="showEditDietRestriction" data-dietrestrict-id="{{ $dietres->id }}">Edit</button>

                                                    </form>
                                                </td>
                                                <td>
                                                    <form method="POST" action="{{ route('deleteDietaryRestriction', ['id' => $dietres->id]) }}">
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
           // Add new dietRestrict
           $('#addDietRestrict').click(function(){
               var dietRestrictName = $('#dietrestrict_name').val();
               var isActive = $('#is_active').is(':checked');
               $.ajax({
                   type:'POST',
                   url:'/createNewDietaryRestriction',
                   data:{
                       dietrestrict_name: dietRestrictName,
                       is_active: isActive,
                       _token: '{{ csrf_token() }}'
                   },
                   success:function(data){
                        location.reload()
                       $('#dietrestrictList').append('<li>'+data.dietrestrict_name+' '+(data.is_active ? '(Active)' : '(Inactive)')+'</li>');
                       $('#dietrestrict_name').val('');
                       $('#is_active').prop('checked', false);
                       location.reload()
                   },
                   error:function(xhr,status,error){
                       console.log(xhr.responseText);
                   }
               });
           });
         });
      </script>
@endsection

<!-- <script src="{{ url('listdietrestricts') }}"></script> -->

