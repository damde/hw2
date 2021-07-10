const tbody = document.querySelector("#res")

function onResponseToJSON(response) {
    return response.json()
}

const init = () => {
    fetch("/reservationsList").then(onResponseToJSON).then((response) => {
        tbody.innerHTML = ""
        if(!response.length) {
            tbody.parentElement.hidden = true
            const columnE = tbody.parentElement.parentElement
            const h3Info = document.createElement("h3");
            const btnSearch = document.createElement("button")
            btnSearch.textContent = "Effettua una ricerca"
            btnSearch.addEventListener("click", ()=>{
                window.location.replace("/search")
            })
            h3Info.textContent = "Nessuna prenotazione effettuata";
            columnE.appendChild(h3Info)
            columnE.appendChild(btnSearch)
            return
        } 
        for (let reservation of response) {
            let thR = document.createElement("tr")

            let thHotel = document.createElement("td")
            let thRooms = document.createElement("td")
            let tdO = document.createElement("td")
            let tdT = document.createElement("td")
            let tdH = document.createElement("td")
            let tdF = document.createElement("td")

            let tdActions = document.createElement("td")

            let iDelete = document.createElement("i")
            iDelete.classList.add("fas")
            iDelete.classList.add("fa-trash")

            iDelete.addEventListener("click", () => {
                fetch(`/deleteReservation/${reservation.IDReservation}`)
                    .then(onResponseToJSON)
                    .then((response) => {
                        if (response["ok"]) {
                            alert("Prenotazione cancellata");
                            init()
                        } else {
                            alert(`Impossibile completare la prenotazione: ${response["error"]}`)
                        }
                    })
            })

            /*
            let iAdd = document.createElement("i")
    
            iAdd.classList.add("fas")
            iAdd.classList.add("fa-plus")
    
            iAdd.addEventListener("click", () => {
    
            })
            */
            tdActions.appendChild(iDelete)
            //tdActions.appendChild(iAdd)

            thHotel.textContent = reservation.hotel
            for (let reserve of reservation.reserves) {
                thRooms.textContent = reserve.room + "\n"
            }
            tdO.textContent = reservation.dateReservation
            tdT.textContent = reservation.startDate
            tdH.textContent = reservation.endDate

            tdF.textContent = ((new Date(reservation.endDate) - new Date(reservation.startDate)) / 1000 / 60 / 60 / 24 + 1) * reservation.totalPrice

            thR.appendChild(thHotel)
            thR.appendChild(thRooms)
            thR.appendChild(tdO)
            thR.appendChild(tdT)
            thR.appendChild(tdH)
            thR.appendChild(tdF)
            thR.appendChild(tdActions)
            tbody.appendChild(thR)
        }
    })
}

init()