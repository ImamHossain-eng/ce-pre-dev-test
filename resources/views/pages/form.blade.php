@extends('layouts.form')

@section('content')
    <head>
        <script src="https://unpkg.com/dropzone@4/dist/min/dropzone.min.js"></script>

        <link
        rel="stylesheet"
        href="https://unpkg.com/dropzone@4/dist/min/dropzone.min.css"
        type="text/css"
        />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            
            .dropzone i, .dropzone img {
                display: block;
                margin: 0 auto;
                width: 60px;
                font-size: 2em;
            }

            .dropzone .dz-remove {
                background: #ff0000;
                color: #EFEFEF;
                text-decoration: none;
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
                <button type="button" class="btn btn-primary w-25">Browse File</button>
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
     

    



        Dropzone.options.myDropzone = {
            //Main Options
            // url: '/upload',
            paramName: 'file',
            parallelUploads: 100, // Allow up to 10 files to be uploaded at once
            dictDefaultMessage: 'Drag your photos here to start uploading',
            addRemoveLinks: true,
            acceptedFiles: 'image/*,.pdf,.doc,.docx,.txt',
            maxFiles: 100,
            // maxFilesize: 256,

            //other option
            init: function() {
                //States
                var myDropzone = this 
                var uploadedFiles = []

                //function added files -- check if the file already exists 
                this.on("addedfile", function(file) {

                    //check if the file with the same name has already been uploaded 
                    var existingFile = uploadedFiles.find(function(existing) {
                        return existing.name === file.name && existing.size === file.size;
                    });                    

                    if (existingFile) {
                        //show a confirmation dialog to replace the existing file or cancel 
                        if (confirm("File with the same name already exists. Do you want to replace it?")) {
                            //remove existing file from dropzone 
                            myDropzone.removeFile(existingFile)
                            //add the new file to the uploadedFiles array 
                            uploadedFiles.push(file)

                        } 
                        else {
                            //remove existing file from dropzone element   
                            file.previewElement.remove();     
                        }
                    } else {
                        //add the new file to the uploadedFiles array
                        uploadedFiles.push(file)
                    }
                });

                //function remove file -- delete files from database
                this.on("removedfile", function (file) {
                    // Send an Ajax request to your server-side controller to delete the file
                    axios.post('/remove_file', {
                        filename: file.name,
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then((response) => {
                        console.log(response)
                    })
                    .catch((error) => {
                        console.log("Error: ", error)
                    })
                });  
            }
        }
    </script>
@endsection