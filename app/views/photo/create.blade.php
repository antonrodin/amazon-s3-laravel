@extends('layouts.master')

@section('content')
    <h1>Create:</h1>
    {{ Form::open(['route' => 'photo.store', 'files' => 'true']) }}
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Shiny morning">
        </div>
        <div class="form-group">
          <label for="foto">File</label>
          <input type="file" class="form-control" id="foto" name="foto">
        </div>
        <button type="submit" class="btn btn-default">Create</button>
    {{ Form::close() }}
@endsection