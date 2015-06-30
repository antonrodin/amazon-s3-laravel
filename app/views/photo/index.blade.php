@extends('layouts.master')

@section('content')
    <h1>List of photos:</h1>
    
    <table class="table striped">
    <?php foreach($photos as $photo) { ?>
        <tr>
            <td><img class="img-responsive img-thumbnail" src="{{ $photo->get_photo('low') }}" width="150" height="100"></td>
            <td>{{ $photo->title }}</td>
            <td>
                {{ Form::open(['route' => array('photo.destroy', "{$photo->id}"), 'method' => 'delete']) }}
                    <button type="submit" class="btn btn-sm btn-danger">Delete photo</button></form>
                {{ Form::close() }}
                
                <p class="clear_fix"></p>
                
                {{ Form::open(['route' => array('photo.edit', "{$photo->id}"), 'method' => 'get']) }}
                    <button type="submit" class="btn btn-sm btn-warning">Edit photo</button></form>
                {{ Form::close() }}
            </td>
                
        </tr>
    <?php } ?>
    </table>
        
@endsection