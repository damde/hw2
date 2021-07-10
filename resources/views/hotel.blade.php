<head>
    <title>Hotel NUMBERS</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/app.css') }}">
    <script defer src="/js/hotels.js"></script>
</head>
@extends("layouts.app")
@section("main")
<div class="column">
    <div class="card">
        <h2>{{$hotel["denomination"]}}</h3>
        <div class="image">
            <img src={{$hotel["image"]}} alt="" class="fullImage">
        </div>
        <div class="text">
            <p>{{$hotel["description"]}}</p>
        </div>
        <div >
            <button style="width: 40%;" id="reserve" onclick="seeDates()">Prenota</button>
        </div>
        <div id="dates"></div>
        <div id="result"></div>
        <div id="reviews">
            <h3>Recensioni</h3>
            @if(isset($error))
                <p>Non é mai stata effettuata una prenotazione in questo hotel. Prenota una stanza per lasciare una recensione</p>
            @endif
            <form class="new" action="/review" method="POST">
                @csrf
                <textarea name="text" rows="4" cols="50"></textarea>
                <input type="hidden" name="hotel" value="{{ $hotel["id"] }}"></input>
                <input style="flex: 1" type="submit" value="Invia">
            </form>
            
            <div class="list">
            </div>
        </div>
    </div>
</div>
@endsection