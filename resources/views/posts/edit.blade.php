@extends('layouts.app')

@section('content')
    <script type="text/javascript" src="{{ asset('/vendor/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript">
        tinymce.init({
            selector : "textarea",
            plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
            toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });
    </script>

    <form method="POST" action='{{ url("/update") }}'>
        {{ csrf_field() }}
        <input type="hidden" name="post_id" value="{{ $posts->id }}{{ old('post_id') }}">
        <div class="form-group">
            <input required="required" placeholder="Enter title here" type="text" name = "title" class="form-control" value="@if(!old('title')){{$posts->title}}@endif{{ old('title') }}"/>
        </div>
        <div class="form-group">
    <textarea name='body'class="form-control">
      @if(!old('body'))
            {!! $posts->body !!}
        @endif
        {!! old('body') !!}
    </textarea>
        </div>
        @if($posts->active == '1')
            <input type="submit" name='publish' class="btn btn-success" value = "Update"/>
        @else
            <input type="submit" name='publish' class="btn btn-success" value = "Publish"/>
        @endif
        <input type="submit" name='save' class="btn btn-default" value = "Save As Draft" />
        <a href="{{  url('delete/'.$posts->id.'?_token='.csrf_token()) }}" class="btn btn-danger">Delete</a>
    </form>

@endsection
