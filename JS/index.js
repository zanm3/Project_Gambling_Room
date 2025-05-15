const firstForm = document.getElementById("playerFormEna");
const secondForm = document.getElementById("playerFormDva");
const thirdForm = document.getElementById("playerFormTri");

const players = [
    document.getElementById("playerFormEna"),
    document.getElementById("playerFormDva"),
    document.getElementById("playerFormTri")
];

firstForm.style.display = "none";
secondForm.style.display = "none";
thirdForm.style.display = "none";

let playersAdd = 0;
document.getElementById("add").addEventListener("click", function(){
    if(playersAdd < players.length){
        players[playersAdd].style.display = "block";
        playersAdd += 1;
    }
    if(playersAdd == players.length)
        playersSub = players.length - 1;
});

let playersSub = 2;
document.getElementById("sub").addEventListener("click", function(){
    if(playersSub >= 0){
        players[playersSub].style.display = "none";
        playersSub--;
    }
    if(playersSub == 0)
        playersAdd = 0;
});