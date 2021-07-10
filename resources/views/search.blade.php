<head>
    <title>Hotel NUMBERS</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/app.css') }}">
    <script defer src="js/search.js"></script>
</head>

@extends("layouts.app")
@section("main")
<div class="column">
    <div id="search">
        <h2>Ricerca</h2>
        <form action="#" id="search">
            <label for="text">Inserisci una parola chiave:</label>
            <input type="text" name="text" id="text">
        </form>
    </div>
</div>

<div class="column">
    <section class="showroom">
        <h2>Risultati ricerca</h2>
        <div class="verticalCards" id="products">
        </div>
    </section>
</div>
@endsection