let all = false

function addWeatherDiv(element, json) {
    const weatherDiv = document.createElement("div")
    const weatherImg = document.createElement("img")
    const weatherText = document.createElement("h5")
    weatherDiv.id = "weatherDiv"
    weatherImg.id = "weatherImg"
    weatherText.id = "weatherText"
    weatherImg.src = json["weather"]["weather_icons"][0]
    weatherText.textContent = json.address.split(",")[1] + ", "
        + json["weather"]["temperature"] + " °"
    weatherDiv.appendChild(weatherImg)
    weatherDiv.appendChild(weatherText)
    element.appendChild(weatherDiv)
}

function addHotel(hotel) {
    const element = document.createElement("div")
    element.classList.add(["card"]);
    const idA = document.createElement("span")
    idA.innerText = hotel.id
    idA.style.display = "none"
    const imageDiv = document.createElement("div")
    imageDiv.classList.add(["image"])
    const image = document.createElement("img")
    image.src = hotel.image
    imageDiv.appendChild(image)
    const text = document.createElement("h3")
    text.classList.add("text");
    text.textContent = hotel.denomination
    const description = document.createElement("h5")
    description.textContent = hotel.description.substring(0, 128) + "..."
    element.appendChild(imageDiv)
    element.appendChild(text)
    element.appendChild(description)
    addWeatherDiv(element, hotel)
    
    
    element.appendChild(idA)
    
    products.addEventListener("click", cardButton)

    products = document.getElementById("products")

    products.appendChild(element)
}

function cardButton(event) {
    window.location.replace(`hotel/${event.target.parentNode.querySelector("span").textContent}`)
}

function onResponseToJSON(response) {
    return response.json()
}



function addHotels(json) {
    document.getElementById("products").innerHTML = ""
    for (let hotel of json) {
        const payload = {
            id: hotel.id,
            denomination: hotel.denomination,
            description: hotel.description,
            image: hotel.image,
            address: hotel.address,
            weather: hotel.weather
        }
        addHotel(payload)
    }
}



function fetchData(i) {
    fetch(`api/hotels?limit=${i}`)
        .then(onResponseToJSON)
        .then(addHotels)
}

fetchData(3)

document.getElementById("all").addEventListener("click", (event) => {
    if (!all) {
        event.target.textContent = "Mostra meno"
        fetchData(-1)
    } else {
        event.target.textContent = "Mostra tutti"
        fetchData(3)
    }
    all = !all
})