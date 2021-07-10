<head>
    <title>Hotel NUMBERS</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/app.css') }}">
    <script defer src="js/signup.js"></script>
</head>

@extends("layouts.app")
@section('main')
<form name='signup' method='post' autocomplete="off" id="signup" onsubmit="return validateform(this)">
    @csrf
    <div class="sameline">
        <div class="name">
            <div>
                <label for='name'>Nome</label>
            </div>
            <div>
                <input type='text' name='name'>
            </div>
        </div>
        <div class="surname">
            <div>
                <label for='surname'>Cognome</label>
            </div>
            <div>
                <input type='text' name='surname'>
            </div>
        </div>
    </div>

    <div>
        <div>
            <label for='username'>Username</label>
        </div>
        <div>
            <input type='text' name='username'>
        </div>
    </div>

    <div>
        <div>
            <label for='email'>Email</label>
        </div>
        <div>
            <input type='text' name='email'>
        </div>
    </div>

    <div class="sameline">
        <div>
            <div>
                <label for='password'>Password</label>
            </div>
            <div>
                <input type='password' name='password'>
            </div>
        </div>
        <div>
            <div>
                <label for='ppassword'>Conferma Password</label>
            </div>
            <div>
                <input type='password' name='ppassword'>
            </div>
        </div>
    </div>

    <div class="submit">
        <input type='submit' value="Registrati" id="submit">
    </div>
    @if(isset($error))
    <p class="error">{{$error}}</p>
    @endif
</form>
@endsection