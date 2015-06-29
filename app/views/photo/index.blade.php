@extends('layouts.master')

@section('content')

    <p><a class="btn btn-lg btn-info" href="{{ route('photo.create') }}">Create New</a></p>
    <h1>List of photos:</h1>
    
    <table class="table striped">
    <?php foreach($photos as $photo) { ?>
        <tr>
            <td><img src="{{ $photo->get_photo() }}" width="300" height="200"></td>
            <td>{{ $photo->title }}</td>
            <td>
                {{ Form::open(['route' => array('photo.destroy', "{$photo->id}"), 'method' => 'delete']) }}
                    <button type="submit" class="btn btn-sm btn-danger">Delete photo</button></form></td>
                {{ Form::close() }}
        </tr>
    <?php } ?>
    </table>
        
@endsection