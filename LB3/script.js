const pics = [
    "./assets/1.jpg",
    "./assets/2.jpg",
    "./assets/3.jpg",
    "./assets/4.jpg",
    "./assets/5.jpg"
];

let lastSelectedPic = "";

function getRandomInt(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min)) + min;
}

function setDayNightStyle() {
    const now = new Date();
    const currentHour = now.getHours();
    const body = document.body;

    if (currentHour > 18 || currentHour < 7) {
        body.style.backgroundColor = "grey";
        body.classList.remove("day-mode");
        body.classList.add("night-mode");
    } else {
        body.style.backgroundColor = "white";
        body.classList.remove("night-mode");
        body.classList.add("day-mode");
    }
}

function changePicture() {
    let pic = document.querySelector("img");
    let rand;

    do {
        rand = pics[getRandomInt(0, pics.length)];
    } while (rand === lastSelectedPic);

    lastSelectedPic = rand;

    pic.src = rand;
}

let time = prompt("Інтервал зміни картинок", 1);

setInterval(function () {
    changePicture();
    setDayNightStyle();
}, time * 1000);

function createTable() {
    let min = parseInt(document.getElementById("min").value);
    let max = parseInt(document.getElementById("max").value);

    if (!document.getElementsByTagName("table").length == 0) {
        document.querySelector("table").remove();
    }

    createTableNode(min, max);
}

function createTableNode(min, max) {
    let table = document.createElement("table");
    table.style.borderCollapse = "collapse";

    for (let i = 0; i < 10; i++) {
        let row = table.insertRow();
        for (let j = 0; j < 10; j++) {
            let cell = row.insertCell();
            let randomNumber =
                Math.floor(Math.random() * (max - min + 1)) + min;
            cell.textContent = randomNumber;

            if ((i + j) % 2 === 1) {
                cell.style.backgroundColor = "#f0f0f0";
            } else {
                cell.style.backgroundColor = "#ffffff";
            }

            cell.style.border = "1px solid #ccc";
            cell.style.padding = "8px";
        }
    }

    document.body.appendChild(table);
}

setDayNightStyle();
