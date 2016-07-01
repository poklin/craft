@extends('layouts.app')

@section('content')
    <script type="text/javascript" src="{{ asset('/vendor/laravel-filemanager/js/cropper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/laravel-filemanager/js/jquery.form.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript">

    var editor_config = {
            path_absolute : "{{ url('/') }}/",
            selector: "textarea",
            plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
            toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            relative_urls : false,
            file_browser_callback : function(field_name,url,type,win){
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                if(type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }
                console.log("CMSURL : " + cmsURL);
                tinyMCE.activeEditor.windowManager.open({
                    file : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no"
                });
            },
        };
    tinymce.init(editor_config);


    </script>
    <form role="form" method="POST" action="{{ url('/new-post') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <input required="required" value="{{ old('title') }}" placeholder="Enter title here" type="text" name = "title"class="form-control" />
        </div>
        <div class="form-group">
            <textarea name='body'class="form-control">{{ old('body') }}</textarea>
        </div>
        <input type="submit" name='publish' class="btn btn-success" value = "Publish"/>
        <input type="submit" name='save' class="btn btn-default" value = "Save Draft" />
    </form>

@endsection
