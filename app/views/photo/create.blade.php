@extends('layouts.master')

@section('content')
    <h1>Create:</h1>
    {{ Form::open(['route' => 'photo.store', 'files' => 'true']) }}
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Photo Title">
           <span class="help-block color-red"><?php echo $errors->first('title'); ?></span>
        </div>
        <div class="form-group">
          <label for="file">File</label>
          <input type="file" class="form-control" id="file" name="file">
           <span class="help-block color-red"><?php echo $errors->first('file'); ?></span>
        </div>
        <button type="submit" class="btn btn-default">Create</button>
    {{ Form::close() }}
@endsection