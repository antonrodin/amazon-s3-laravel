@extends('layouts.master')

@section('content')
<h1>Update <em>{{ $photo->title }}</em>:</h1>
    {{ Form::open(['route' => array('photo.update', "{$photo->id}"), 'files' => 'true', 'method' => 'put']) }}
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" id="title" name="title" value="{{ $photo->title }}">
        </div>
        <div class="form-group">
          <label for="foto">File</label>
          <input type="file" class="form-control" id="foto" name="foto">
        </div>
        <button type="submit" class="btn btn-default">Edit</button>
    {{ Form::close() }}
@endsection