<body>
    <header>
        <nav class="navbar">
            <div class="center">
                <a href="/">Home</a>
                <a href="/search">Ricerca</a>
            </div>
            <div class="right">
                <!-- TODO {{}}  -->
                @if (isset($customer))
                <a href="./reservations">Lista prenotazioni</a>
                <a href="./logout">Logout</a>
                @else
                <a href="./login">Accedi</a>
                <a href="./signup">Registrati</a>
                @endif
            </div>
        </nav>
        <div class="texts">
            <div class="stars">
                <img src="images/star.png" alt="">
                <img src="images/star.png" alt="">
                <img src="images/star.png" alt="">
                <img src="images/star.png" alt="">
                <img src="images/star.png" alt="">
            </div>
            <h1>HotelNUMBERS</h1>
            <h3>La prima e unica catena d'hotel alla portata di click!</h3>
        </div>
    </header>

    <section>
        @section("main")
        @show
    </section>

    <footer>
        <h4>
            HW2 - Desantis Damiano O46002183 WEB PROGRAMMING A - L
        </h4>
    </footer>
</body>