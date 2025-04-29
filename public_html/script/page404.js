const gifs = ["100.gif",
	"123.gif","8600060fcd0aa514e645bd5d06a401a3.gif",
	"arch-linux.png",
	"bonjour-princesse-ça-va.gif",
	"duo.jpg","321.gif",
	"giphy.gif",
	"ha-smirk.gif",
	"icegif-162.gif",
	"Rick1.gif",
	"Rick2.gif"
	];


// ============================
// 1. FONCTIONS PRINCIPALES 
// ============================

function visualiseRandomBackground(){
    var randomGifPosition = getRandomInt(gifs.length);
    
    updateBackground(gifs[randomGifPosition]);
}

// ============================
// 2. SOUS FONCTIONS
// ============================

function updateBackground(gif){
    var div = document.querySelector("#container");
    var url = "url('../images/" + gif + "')";

    div.style.backgroundImage = url;
    console.log(url);
}

// ============================ 
// 3. FONCTIONS UTILITAIRES
// ============================

function getRandomInt(max) {
    return Math.floor(Math.random() * max);
}