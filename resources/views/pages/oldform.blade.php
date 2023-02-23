@extends('layouts.form')

@section('content')
    <head>
        <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

        <link
        rel="stylesheet"
        href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css"
        type="text/css"
        />
        <style>
            .my-dropzone {
                height: 30em;
                width: 30em;
                border: 2px solid #212121;
            }
        </style>
    </head>
    
    <div class="conteiner p-4">
        <form action="/upload" method="POST" enctype="multipart/form-data">
            @csrf 
            <div class="dropzone" id="myDrop"></div>

            <input type="submit" class="btn btn-primary" value="Save">

        </form>
        {{-- <form action="/upload" class="dropzone" method="POST" enctype="multipart/form-data">
            @csrf
        </form> --}}
            {{-- <input class="my-dropzone" type="file" multiple /> --}}
            {{-- <div class="my-dropzone" name="file"></div> --}}


            {{-- <input type="submit" class="btn btn-primary w-100" value="Save"> --}}

    </div>

    <script>
        // Dropzone has been added as a global variable.
        Dropzone.autoDiscover = false;
        const dropzone = new Dropzone('#myDrop', {
             url: "/upload",
             parallelUploads: 10,
             method: 'post',
             enctype: 'multipart/form-data',
             headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
             }
            });
    </script>
@endsection