const firstForm = document.getElementById("playerFormEna");
const secondForm = document.getElementById("playerFormDva");
const thirdForm = document.getElementById("playerFormTri");

const players = [
    document.getElementById("playerFormEna"),
    document.getElementById("playerFormDva"),
    document.getElementById("playerFormTri")
];
secondForm.style.display = "none";
thirdForm.style.display = "none";

let playersAdd = 1;
document.getElementById("add").addEventListener("click", function () {
    if (playersAdd < players.length) {
        players[playersAdd].style.display = "block";
        playersAdd += 1;
    }
    if (playersAdd == players.length)
        playersSub = players.length - 1;
});

let playersSub = 2;
document.getElementById("sub").addEventListener("click", function () {
    if (playersSub > 0) {
        players[playersSub].style.display = "none";
        playersSub--;
    }
    if (playersSub == 1)
        playersAdd = 1;
});
document.getElementById("titletext").addEventListener("click", () => {
    Swal.fire({
        icon: 'info',
        title: 'O strani',
        html: 'Razvijalec: Žan Markuža<br>Razred: 4. RB<br>Mentor: dr. Boštjan Vouk'
    });
});

document.getElementById("gumb").addEventListener("click", () => {

    const numberInputValue = document.querySelector('input[type="number"]').value
    const textInputValue = document.querySelector('input[type="text"]').value;
    if(textInputValue == "" || numberInputValue == ""){
        Swal.fire({
            icon: 'error',
            title: 'Napaka',
            html: 'Vnos podatkov je obvezen!'
        });
        return;
    }
});
const numberInput = document.querySelector('input[type="number"]');

numberInput.addEventListener("input", () => {
    if (parseFloat(numberInput.value) < 0) {
    numberInput.value = 0;  // Reset negative input to 0 immediately
  }
});