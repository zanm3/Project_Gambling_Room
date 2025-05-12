const playerFormDva = document.getElementById("playerFormDva");
playerFormDva.style.visibility = "hidden";

const playerFormTri = document.getElementById("playerFormTri");
playerFormTri.style.visibility = "hidden";

document.getElementById("addEna").addEventListener("click", function(){
    playerFormDva.style.visibility = "visible";
    
});
document.getElementById("addDva").addEventListener("click", function(){
    playerFormTri.style.visibility = "visible";
    
});