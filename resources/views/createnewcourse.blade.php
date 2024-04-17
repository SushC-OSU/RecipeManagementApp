@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Course</div>
                <div id="error-message">
                @if (isset($error))
                    <div class="alert alert-danger">{{ $error }}<span class="close" onclick="closeErrorMessage()">&times;</span></div>
                    
                @endif
                </div>


                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <h1>Create New Course</h1>
                            <div>
                                <h3>Add New Course</h3>
                                <label>Enter Course name:</label>
                                <input type="text" name="course_name" id="course_name">
                                <br>
                                <label for="is_active">Is Active:</label>
                                <input type="checkbox" name="is_active" id="is_active" value="1">
                                <button type="button" id="addCourse">Add Course</button>
                            </div>
                            <br>
                            <div>
                                <h2>Available Courses</h2>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Course Name</th>
                                            <th>Status</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($courses as $course)
                                            <tr>
                                                <td>{{ $course->course_name }}</td>
                                                <td>{{ $course->is_active == 'Yes' ? 'Active' : 'Inactive' }}</td>
                                                <td>
                                                    <form method="GET" action="{{ route('showEditCourse', $course->id) }}">
                                                        <button class="showEditCourse" data-course-id="{{ $course->id }}">Edit</button>

                                                    </form>
                                                </td>
                                                <td>
                                                    <form method="POST" action="{{ route('deleteCourse', ['id' => $course->id]) }}">
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
           // Add new course
           $('#addCourse').click(function(){
               var courseName = $('#course_name').val();
               var isActive = $('#is_active').is(':checked');
               $.ajax({
                   type:'POST',
                   url:'/createNewCourse',
                   data:{
                       course_name: courseName,
                       is_active: isActive,
                       _token: '{{ csrf_token() }}'
                   },
                   success:function(data){
                        location.reload()
                       $('#courseList').append('<li>'+data.course_name+' '+(data.is_active ? '(Active)' : '(Inactive)')+'</li>');
                       $('#course_name').val('');
                       $('#is_active').prop('checked', false);
                       location.reload()
                   },
                   error:function(xhr,status,error){
                       console.log(xhr.responseText);
                   }
               });
           });
         });
         function closeErrorMessage() {
            var errorMessage = document.getElementById("error-message");
            errorMessage.style.display = "none";
            
            }
      </script>
     

@endsection

<!-- <script src="{{ url('listcourses') }}"></script> -->

