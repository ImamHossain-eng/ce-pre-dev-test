@extends('layouts.form')

@section('content')
    <head>
        
        
    </head>
    
    <div class="conteiner p-4">
        <form action="/test_upload" method="POST" enctype="multipart/form-data">
            @csrf 
             
            <div class="form-group mb-4">
                <input type="file" name="image" class="form-control">
            </div>

            <input type="submit" value="Save" class="btn btn-primary w-100">
            
        </form> 

    </div>

   
@endsection