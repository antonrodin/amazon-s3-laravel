@extends('layouts.master')

@section('content')
        <div class="jumbotron">
        <h1>Test Project. Amazon S3</h1>
        <p>Upload, resize, delete images into Amazon S3 Custom Bucket.</p>
        <p><a class="btn btn-primary btn-lg" href="{{ route('photo.index') }}" role="button">Form</a></p>
        </div>
@endsection
