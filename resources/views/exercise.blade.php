<?php

if ($data != null) {
    $exerciseTitleWithID = $data->id_exercise.'. '. $data->title;
}

?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $exerciseTitleWithID; ?></title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    {{-- Initial data check --}}
    @if ($data == null && $authorized == null)
        <div class="container-fluid">
            <div class="alert alert-danger" role="alert">
                <h1 class="text-center">
                    Sorry no data was found, something went wrong.
                </h1>
            </div>
        </div>
        <?php die(); ?>
    @endif

    {{-- Initial authorization --}}
    @if ($authorized == null || $authorized == false)
        <div class="container">
            <form method="post" action="authorization">
                @csrf
                <label for="user_id" style="color:white"><h1>Enter your discord user id:</h1></label><br>
                <input type="text" id="user_id" class="form-control" name="user_id" placeholder="e.g. 524229083014365194"><br>
                <input type="hidden" name="userIdForm" value="{{ serialize($data) }}">
                <input class="btn btn-warning" type="submit" value="Submit">
            </form>
        </div>
        <?php die(); ?>
    @endif

    @if ($authorized === false)
        <div class="container-fluid">
            <div class="alert alert-danger" role="alert">
                <h3 class="text-center">
                    Sorry that was wrong, please try again.
                </h3>
            </div>
        </div>
    @endif


    {{-- Main page --}}
    @if ($authorized === true)
        <div class="container-fluid container-settings">
            <div class="row" style="padding-top: 0;">
                <div class="col">
                    <h1>
                        <?php echo $exerciseTitleWithID; ?>
                    </h1>
                </div>
            </div>
            <?php dump($data); ?>
        </div>
    @endif
</body>
</html>
