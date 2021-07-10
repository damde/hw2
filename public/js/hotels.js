function onResponseToJSON(response) {
    return response.json()
}

let hotel = window.location.href.split('/')
hotel = hotel[hotel.length - 1]

function seeDates() {
    const reserveBtn = document.getElementById("reserve")

    reserveBtn.hidden = true

    const datesDiv = document.querySelector("#dates")
    const startDateInput = document.createElement("input")
    startDateInput.type = "date"
    const endDateInput = document.createElement("input")
    endDateInput.type = "date"
    const buttonSearch = document.createElement("button")
    buttonSearch.textContent = "Verifica disponibilitá"
    datesDiv.appendChild(startDateInput)
    datesDiv.appendChild(endDateInput)
    datesDiv.appendChild(buttonSearch)
    buttonSearch.addEventListener("click", () => {
        if (new Date(startDateInput.value).getTime() > new Date(endDateInput.value).getTime()) {
            return alert("Data inizio successiva data fine")
        }
        if (startDateInput.value && endDateInput.value) {
            fetch(`/checkAvailability?startDate=${startDateInput.value}&endDate=${endDateInput.value}&hotel=${hotel}`)
                .then(onResponseToJSON)
                .then((response) => {
                    if (response["notLogged"]) {
                        return window.location.replace("/login");
                    }
                    const resultDiv = document.querySelector("#result");
                    resultDiv.innerHTML = ""
                    const table = document.createElement("table")
                    const thead = document.createElement("thead");
                    const tbody = document.createElement("tbody")
                    let tr = document.createElement("tr")
                    let thID = document.createElement("th")
                    let thO = document.createElement("th")
                    let thT = document.createElement("th")
                    let thTh = document.createElement("th")

                    thID.textContent = "Numero Stanza"
                    thO.textContent = "Tipo";
                    thT.textContent = "Prezzo"
                    thTh.textContent = "Azione"

                    tr.appendChild(thID)
                    tr.appendChild(thO)
                    tr.appendChild(thT)
                    tr.appendChild(thTh)
                    thead.appendChild(tr)

                    for (let room of response) {
                        const thR = document.createElement("tr")
                        const tdID = document.createElement("td")
                        const tdO = document.createElement("td")
                        const tdT = document.createElement("td")
                        const tdH = document.createElement("td")
                        const button = document.createElement("button")

                        button.textContent = "Prenota"
                        button.addEventListener("click", () => {
                            fetch(`/makeReservation?startDate=${startDateInput.value}&endDate=${endDateInput.value}&room=${room.IDRoom}`)
                                .then(onResponseToJSON)
                                .then((response) => {
                                    if (response["ok"]) {
                                        alert("Prenotazione aggiunta");
                                        window.location.replace("home")
                                    } else {
                                        alert(`Impossibile completare la prenotazione: ${response["error"]}`)
                                    }
                                })
                        })
                        tdID.textContent = `${room.IDRoom}`
                        tdO.textContent = `${room.type}`
                        tdT.textContent = `${room.price} euro`

                        tdH.appendChild(button)
                        thR.appendChild(tdID)
                        thR.appendChild(tdO)
                        thR.appendChild(tdT)
                        thR.appendChild(tdH)
                        tbody.appendChild(thR)
                    }
                    table.appendChild(thead)
                    table.appendChild(tbody)
                    resultDiv.appendChild(table)
                })
        }
    })
}


function sendReview() {
    const text = document.getElementById("ta").value
    if(text.length) {
        fetch('/reviews/' + hotel, {
            method: 'POST', body: JSON.stringify({
                text: text
            })
        })
            .then(onResponseToJSON)
            .then((response) => {
    
            })
    } else {
        alert("Inserire il testo per inviare un feedback")
    }
}


fetch('/reviews/' + hotel)
    .then(onResponseToJSON)
    .then((response) => {
        const x = document.getElementsByClassName("list")[0]
        for (let review of response) {
            const p = document.createElement("p")
            p.textContent = `${review.customer}: ${review.text}`
            x.appendChild(p)
        }
    })