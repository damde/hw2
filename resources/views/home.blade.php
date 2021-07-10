<head>
    <title>Hotel NUMBERS</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/app.css') }}">
    <script defer src="js/loadHotels.js"></script>
</head>

@extends("layouts.app")
@section("main")
<div class="column">
    <section class="showroom">
        <h2>Vetrina</h2>
        <div class="verticalCards" id="products">
        </div>
        <a id="all" href="#/">Mostra tutti</a>
    </section>
</div>
@endsection