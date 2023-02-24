@extends('layouts.form')

@section('content')
    <head>
        <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

        <link
        rel="stylesheet"
        href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css"
        type="text/css"
        />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            .my-dropzone {
                height: 30em;
                width: 30em;
                border: 2px solid #212121;
            }

            .dropzone i, .dropzone img {
                display: block;
                margin: 0 auto;
                width: 60px;
                font-size: 2em;
            }
        </style>
    </head>
    
    <div class="conteiner p-4">
        {{-- <form action="/upload" method="POST" enctype="multipart/form-data">
            @csrf 
            <div class="dropzone" id="myDrop"></div>

            <input type="submit" class="btn btn-primary" value="Save">

        </form> --}}

        <form action="/upload" class="dropzone" id="my-dropzone" style="background-color: #f8f8f8; font-size: 24px; color: #333;">
            @csrf
            <div class="dz-message">
                <i class="fas fa-cloud-upload-alt"></i> 
                Drag your photos here to start uploading
                <hr>
                <button class="btn btn-primary w-25">Browse File</button>
            </div>
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
        // Dropzone.autoDiscover = false;
        // const dropzone = new Dropzone('#myDrop', {
        //      url: "/upload",
        //      parallelUploads: 10,
        //      method: 'post',
        //      enctype: 'multipart/form-data',
        //      headers: {
        //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //      }
        //     });

        Dropzone.options.myDropzone = {
            url: '/upload',
            paramName: 'file',
            parallelUploads: 100, // Allow up to 10 files to be uploaded at once
            dictDefaultMessage: 'Drag your photos here to start uploading',
            addRemoveLinks: true,
            acceptedFiles: 'image/*',
            //other option
            init: function() {
                this.on("removedfile", function(file) {
                    // Send an Ajax request to your server-side controller to delete the file
                    $.ajax({
                        type: "POST",
                        url: "{{ route('remove_file') }}",
                        data: {filename: file.name, _token: "{{ csrf_token() }}" },
                        success: function (data) {
                            console.log("File has been successfully removed from server!");
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                });
            }
            
        };

    </script>
@endsection












@extends('layouts.form')

@section('content')
    <head>
        <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

        <link
        rel="stylesheet"
        href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css"
        type="text/css"
        />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            .my-dropzone {
                height: 30em;
                width: 30em;
                border: 2px solid #212121;
            }

            .dropzone i, .dropzone img {
                display: block;
                margin: 0 auto;
                width: 60px;
                font-size: 2em;
            }
        </style>
    </head>
    
    <div class="conteiner p-4">
        {{-- <form action="/upload" method="POST" enctype="multipart/form-data">
            @csrf 
            <div class="dropzone" id="myDrop"></div>

            <input type="submit" class="btn btn-primary" value="Save">

        </form> --}}

        <form action="/upload" class="dropzone" id="my-dropzone" style="background-color: #f8f8f8; font-size: 24px; color: #333;">
            @csrf
            <div class="dz-message">
                <i class="fas fa-cloud-upload-alt"></i> 
                Drag your photos here to start uploading
                <hr>
                <button class="btn btn-primary w-25">Browse File</button>
            </div>
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
        // Dropzone.autoDiscover = false;
        // const dropzone = new Dropzone('#myDrop', {
        //      url: "/upload",
        //      parallelUploads: 10,
        //      method: 'post',
        //      enctype: 'multipart/form-data',
        //      headers: {
        //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //      }
        //     });

        Dropzone.options.myDropzone = {
            url: '/upload',
            paramName: 'file',
            parallelUploads: 100, // Allow up to 10 files to be uploaded at once
            dictDefaultMessage: 'Drag your photos here to start uploading',
            addRemoveLinks: true,
            acceptedFiles: 'image/*',
            //other option
            init: function() {
                this.on("removedfile", function(file) {
                    // Send an Ajax request to your server-side controller to delete the file
                    $.ajax({
                        type: "POST",
                        url: "{{ route('remove_file') }}",
                        data: {filename: file.name, _token: "{{ csrf_token() }}" },
                        success: function (data) {
                            console.log("File has been successfully removed from server!");
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                });
            }
            
        };

    </script>
@endsection