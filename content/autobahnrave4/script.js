

function loadSite() {
	document.getElementById("form").style.marginTop = $(window).height() + "px";
	document.getElementById("form").style.height = $(window).height() + "px";
	document.getElementById("submitted").style.height = $(window).height() + "px";
	
	
	txtSpan = document.getElementById("wirdSpan");
	shuffler = setInterval(function(){ shuffleRndText() }, 200);
}

function loadRndBg() {
	var bgSrc = "img/"+Math.floor(Math.random() * 4) + ".jpg";
	document.body.style.backgroundImage = "url('"+bgSrc+"')";
}

function shuffleRndText() {
	txtSpan.innerHTML = texts[txtNo];
	txtNo--;
	if (txtNo < 0) clearInterval(shuffler);
}

function sendForm() {
	var name = document.getElementById("nameTxt").value;
	var fon = document.getElementById("fonTxt").value;
	var band = document.getElementById("bandChk").checked;
	
	if (name === "" || fon === "") {
		alert("Bitte alles ausfüllen :)")
		return false;
	}
	
	//Send Form Data
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
		  return true;
      }
    };
    xmlhttp.open("GET", "register.php?q="+name+"__"+fon+"__"+band, true);
    xmlhttp.send();

	window.location = "https://andigandhi.ga/content/autobahnrave4/#submitted";
	
	return true;
}

var shuffler = null;
var txtSpan = null;
var texts = ["Richtgeschwindigkeit130v4", "schnell", "hammermäßig", "dufte", "sakrisch lit", "flott", "not bad", "laut", "mega"];
var txtNo = texts.length - 1;