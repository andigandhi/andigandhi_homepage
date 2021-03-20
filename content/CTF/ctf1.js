// Moin und Willkommen im Code!

function pw() {
	return document.getElementById("passwordField").value;
}

function login1() {
	if(pw() === "jaOkee") {
		alert("Hallo Andy!");
	} else {
		alert("Falsches Passwort!");
	}
}