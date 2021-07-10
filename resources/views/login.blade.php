<head>
    <title>Hotel NUMBERS</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/app.css') }}">
    <script defer src="js/loadHotels.js"></script>
</head>

@extends("layouts.app")
@section("main")
<form name='login' method='post' autocomplete="off" id="login">
    @csrf
    <div>
        <div>
            <label for='username'>Username</label>
        </div>
        <div>
            <input type='text' name='username' value="">
        </div>
    </div>

    <div>
        <div>
            <label for='password'>Password</label>
        </div>
        <div>
            <input type='password' name='password' value="">
        </div>
    </div>

    <div class="submit">
        <input type='submit' value="Login" id="submit">
    </div>
    @if(isset($error))
    <p class="error">{{$error}}</p>
    @endif
</form>
@endsection