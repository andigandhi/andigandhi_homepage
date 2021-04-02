// Links to the different sub-sites of the page
// ['Name of the Link', 'link adress']
var siteLinks = [
	['Menü',''],
	['Start / News', 'content/index.html'],
	['Livestream', 'content/stream.html', 820, 490],
	['April 2021', 'content/april21/index.php', 920, 700],
	
	['Altes',''],
	['Frohes Neues Jahr!','content/silvester.html'],
	['1. April: Design my Tattoo', 'content/tattoo.html'],
	['DJ Gion Porno', 'content/gigs.html'],
	['Creepy Stuff', 'content/image.html'],
	//['Archiv (noch nicht 100% kompatibel!)',''],
	//['Corona-Projekte', 'corona/index.html'], 
	//['Programmieren', ''],
	//['Konsole', 'content/CTF/ctf1.html', 580, 300],
	['Sonstiges', ''],
	//['Lebenslauf', 'content/business/lebenslauf.html'],
	['Impressum', 'content/impressum.html'],
	['Datenschutz', 'content/datenschutz.html'],
	//['Einstellungen', 'content/settings.html'],
];

// The Icons on the desktop, images have to be deposited in /img/ico/
// ['Name / Name.png','link']
var icons = [
	['Chat', 'content/chat/chat.html'],
	['Paint', 'content/paint/paint.html'],
	['April 2021', 'content/april21/index.php', 920, 700],
	
	//['Hühner Cam', 'content/huhn.html', 800, 600],
	['', ''],
	['Livestream', 'content/stream.html'],
	//['cooler Priester', 'https://andigandhi.ddns.net/cooler_priester/'],
	['Coole Websites', 'content/links.html'],
	['', ''],
	['WLAN-Router', 'content/wlan.html'],
	['Musik', 'https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/927233515&color=%23db699b&auto_play=true&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true'],
	['Solitaire', 'http://frvr.com/play/solitaire/'],
	['Minesweeper', 'http://www.freeminesweeper.org/minecore.html'],
	//['CTF', 'content/CTF/ctf1.html', 580, 300],
];


// ------ Methods for the window divs ------

// Adds a new window with a innerHtml to the document
function addWindow(title, innerHtml, w, h, left, top) {
	var id = Math.floor((Math.random() * 1000000) + 1000);
	
	var win = document.createElement('div');
	win.setAttribute('class', 'window');
	win.setAttribute('id', id);
	win.style = "position: absolute; width: "+w+"px; height: "+h+"px; left: "+left+"%; top: "+top+"%";
	
	var titleBar = document.createElement('div');
	titleBar.setAttribute('class', 'title-bar');
	
	var titleBarText = document.createElement('div');
	titleBarText.setAttribute('class', 'title-bar-text');
	titleBarText.innerHTML = title;
	titleBar.appendChild(titleBarText);
	
	var titleBarIcon = document.createElement('div');
	titleBarIcon.setAttribute('class', 'title-bar-controls');
	titleBarIcon.innerHTML = "<button aria-label=\"Minimize\" onClick=\"toggleWindow("+id+")\"></button>";
	//titleBarIcon.innerHTML += "<button aria-label=\"Maximize\" onClick=\"maximizeWindow("+id+")\"></button>";
	titleBarIcon.innerHTML += "<button aria-label=\"Close\" onClick=\"removeWindow("+id+")\"></button>";
	titleBar.appendChild(titleBarIcon);
	
	win.appendChild(titleBar);
	
	var winInnen = document.createElement('div');
	winInnen.setAttribute('class', 'window-body');
	winInnen.style = "position: relative; height: "+h+"px; overflow: hidden;";
	winInnen.innerHTML = innerHtml;
	
	win.appendChild(winInnen);
	
	addMoveListeners(win, titleBar);
	
	document.body.appendChild(win);
	
	
	var task = document.createElement('button');
	task.setAttribute('id', id+'t');
	task.setAttribute('class', 'taskElement active');
	task.setAttribute('onClick', 'toggleWindow('+id+')');
	task.innerHTML = "<b>"+title+"</b>";
	document.getElementById("taskbar").appendChild(task);
}

function maximizeWindow(id) {
	var win = document.getElementById(id);
	
	w = "100%";
	h = "100%";
	
	if (win.style.width == "100%") {
		w = "816px";
		h = "480px"
	} else {
		win.style.top = "0";
		win.style.left = "0";
	}
	
	win.style.width = w;
	win.style.height = h;
}

// Creates the inner html for a Window and calls addWindow()
function fillWindow(no, w, h) {
	let title = "";
	let link = "";
	let innerHTML = "";
	if (typeof(no) === 'object') {
		title = no[0];
		link = no[1];
	} else {
		title = siteLinks[no][0];
		link = siteLinks[no][1];
		
		w = siteLinks[no][2];
		h = siteLinks[no][3];
	}
	
	var left = Math.floor(Math.random() * 20);
	var top = Math.floor((Math.random() * 15) + 1);
	
	if (typeof(w) === 'undefined') {
		w = 816;
		h = 480;
	}
	
	if (link.startsWith("http")) {
		innerHTML='<iframe width="'+(w-16)+'px" height="'+(h-30)+'px" type="text/html" src="'+link+'" frameborder="0" allowfullscreen onmouseover = "mouseMove(\'event\')"></iframe>';
	} else {
		innerHTML='<object type="text/html" data="'+link+'" width="'+(w-16)+'px" height="'+(h-30)+'px" style="overflow-right: hidden;" onmouseover = "mouseMove(\'event\')"></object>';
		//innerHTML='<iframe width="800" height="450" type="text/html" src="'+link+'" frameborder="0" allowfullscreen onmouseover = "mouseMove(\'event\')"></iframe>';
	}
	
	addWindow(title, innerHTML, w, h, left, top);
}

// Creates the inner html for a popup window (smaller than a regular one) and calls addWindow()
function addPopup() {
	var left = Math.floor((Math.random() * 80) + 0);
	var top = Math.floor((Math.random() * 20) + 0);
	addWindow("Werbung", "<img alt='' src='img/corona-sticker-werbung.jpg' width=100% onclick='alert(\"Schreib mir einfach auf Instagram :)\")' style='cursor: pointer'>", 400, 300, left, top);
}

// Removes a window with a specific ID
function removeWindow(id) {
	document.body.removeChild(document.getElementById(id));
	document.getElementById("taskbar").removeChild(document.getElementById(id+'t'));
}

// Removes a window with a specific ID
function toggleWindow(id) {
	var win = document.getElementById(id);
	var btn = document.getElementById(id+'t');
	
	if (win.style.visibility == "hidden") {
		win.style.visibility = "";
		btn.classList.add("active");
		inForground(win);
	} else {
		win.style.visibility = "hidden";
		btn.classList.remove("active");
	}
	//document.getElementById("taskbar").removeChild(document.getElementById(id+'t'));
}


// ------ Functions for the bulding of the menu ------

// Builds the menu
function build_menu() {
	addMoveListeners(document.getElementById("menuWind"), document.getElementById("menuTit"));
	
	var ulRoot = document.getElementById('menuUL');
	ul = ulRoot;

	for (var i = 0;i < siteLinks.length; i++) {
		let li = document.createElement('li');
		li.innerHTML += siteLinks[i][0];
		
		if (siteLinks[i][1] === '') {
			ulRoot.appendChild(li);
			ul = document.createElement('ul');
			li.appendChild(ul);
		} else {
			ul.appendChild(li);
			li.setAttribute('onClick', 'fillWindow('+i+');');
		}
	}
}

// Toggles the visibility of the menu
function toggleMenu() {
	var men = document.getElementById("menuWind");
	var btn = document.getElementById("taskMenBtn");
	
	if (men.style.visibility == "hidden") {
		men.style.visibility = "";
		btn.classList.add("active");
	} else {
		men.style.visibility = "hidden";
		btn.classList.remove("active");
	}
}

// Creates a desktop icon
function createIcon(name, link, w, h) {
	var ico = document.createElement('div');
	ico.setAttribute('class', 'icon');
	ico.innerHTML = '<img alt="" src="img/ico/'+name+'.png" width="100%" style="cursor: pointer;" onClick="fillWindow([\''+name+'\', \''+link+'\'], '+w+', '+h+');">';
	ico.innerHTML += name;
	
	addMoveListeners(ico, ico);
	
	document.body.appendChild(ico);
}

// Creates all the icons of the array icon[] by calling createIcon()
function createIcons() {
	for (var i = 0; i < icons.length; i++) {
		createIcon(icons[i][0], icons[i][1], icons[i][2], icons[i][3]);
	}
}





// Menu Actions

function einstellungen() {
	let eDiv = document.getElementById("einstellungen");
	if (eDiv.style.display == "inline") {
		eDiv.style.display = "none";
		document.getElementById("einstellungBtn").innerHTML = "Einstellungen öffnen";
	} else {
		eDiv.style.display = "inline";
		document.getElementById("einstellungBtn").innerHTML = "Einstellungen schließen";
	}
}

function randomBackgroundColor() {
	var letters = '0123456789ABCDEF';
	var color = '#';
	for (var i = 0; i < 6; i++) {
		color += letters[Math.floor(Math.random() * 16)];
	}
	document.body.style.backgroundColor = color;
	if (document.body.style.backgroundImage !== "") {
		addAesthetics();	
	}
}

function addAesthetics() {
	if (document.body.style.backgroundImage === "") {
		document.body.style.backgroundImage = "url('https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/c21ede05-b425-49a6-a33b-0c9d9c537f40/d38z382-31ca4b64-fd08-43ea-8ca1-a6bc3491a07b.png/v1/fill/w_800,h_500,q_80,strp/windows_9x_clouds_remake_by_brianmatte_d38z382-fullview.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOiIsImlzcyI6InVybjphcHA6Iiwib2JqIjpbW3siaGVpZ2h0IjoiPD01MDAiLCJwYXRoIjoiXC9mXC9jMjFlZGUwNS1iNDI1LTQ5YTYtYTMzYi0wYzlkOWM1MzdmNDBcL2QzOHozODItMzFjYTRiNjQtZmQwOC00M2VhLThjYTEtYTZiYzM0OTFhMDdiLnBuZyIsIndpZHRoIjoiPD04MDAifV1dLCJhdWQiOlsidXJuOnNlcnZpY2U6aW1hZ2Uub3BlcmF0aW9ucyJdfQ.50ItsgCN-FkR17Ou3qg0C6O1aWTli7JyaacXqJTIHUk')";
		document.getElementById("aestheticBtn").innerHTML = "wieder der einfarbige Hintergrund";
		var audio = new Audio('https://www.winhistory.de/more/winstart/mp3/win95.mp3');
		audio.play();
	} else {
		document.body.style.backgroundImage = "";
		document.getElementById("aestheticBtn").innerHTML = "wieder den Wolkenhintergrund";
	}
}



// Ermöglicht Links zu Unterseiten
function openLinkedWindow() {
	let no = window.location.search.substr(1);
	if (no === "") {return;}
	no = parseInt(no);
	if (no>siteLinks.length) {
		fillWindow(icons[no-siteLinks.length])
	} else {
		fillWindow(no);
	}
}

// Creates all the Desctop Icons
createIcons();
// Builds the menu
build_menu();
// Opens first Window
fillWindow(3);

openLinkedWindow();

if(Math.random() > 0.7 && false) {
	var interval = setInterval(function(){ 
		if(Math.random() > 0.9) {
			addPopup();
			clearInterval(interval);
		}
	}, 5000);
}
