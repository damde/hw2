<head>
    <title>Hotel NUMBERS</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="/js/reservationList.js" defer></script>
</head>

@extends("layouts.app")
@section('main')
<div class="column">
    <table>
        <thead>
            <tr>
                <th>Hotel</th>
                <th>Stanze</th>
                <th>Data prenotazione</th>
                <th>Data inizio</th>
                <th>Data fine</th>
                <th>Prezzo</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody id="res">
        </tbody>
    </table>
</div>
@endsection