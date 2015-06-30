<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test Amazon S3 File</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <style>
        .color-red { color: red; }
    </style>
</head>
<body>
    <p class="clear_fix"></p>
    <div class='container'>
        <p>
            <a class="btn btn-default" href="{{ route('photo.index') }}">List All</a>
            <a class="btn btn-default" href="{{ route('photo.create') }}">Upload New</a>
        </p>
    </div>
    <div class='container'>
    <?php if (Session::has('exito')) { ?>
        <div class="alert alert-success">
            {{ Session::get('exito') }}
        </div>
    <?php } ?>
    <?php if (Session::has('error')) { ?>
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    <?php } ?>
    </div>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>