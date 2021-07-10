const text = document.querySelector("#text")
const showroom = document.querySelector(".showroom")

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
    
    
    element.appendChild(idA)
    
    element.addEventListener("click", cardButton)

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
    if (json.length) {
        showroom.querySelector("h2").textContent = "Risultati ricerca"
        for (let hotel of json) {
            const payload = {
                id: hotel.id,
                denomination: hotel.denomination,
                description: hotel.description,
                image: hotel.image,
                address: hotel.address
            }
            addHotel(payload)
        }
    } else if (text.value.length > 0) {
        showroom.querySelector("h2").textContent = "Nessun risultato trovato"
    } else {
        showroom.querySelector("h2").textContent = "Cerca un hotel usando il campo di ricerca"
    }

}

function fetchData(q) {
    fetch(`api/search`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            q: q
        })
    })
        .then(onResponseToJSON)
        .then(addHotels)
}

text.addEventListener("keyup", (event) => {
    fetchData(text.value)
})

showroom.querySelector("h2").textContent = "Cerca un hotel usando il campo di ricerca"