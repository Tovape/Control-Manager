// Sidebar

function sidebaraction() {
	
	var sidebar = document.getElementById("sidebar");
	var contentwrapper = document.getElementById("content-wrapper");
	
	if (sidebar.className === "sidebar sidebar-open") {
		sidebar.className += " sidebar-close";
		contentwrapper.className += " content-open";
		
		localStorage.setItem('sidebar-page', 'closed');
		
	} else {
		sidebar.className = "sidebar sidebar-open";
		contentwrapper.className = "content-wrapper content-close";
		
		localStorage.setItem('sidebar-page', 'open');
		
	}

}

// Autoresize

function sidebarauto(sidebarmedia) {
	
	var sidebar = document.getElementById("sidebar");
	var contentwrapper = document.getElementById("content-wrapper");
	var sidebarbutton = document.getElementById("sidebarbutton");
	
	if (sidebarmedia.matches) {
		localStorage.setItem('sidebar-page', 'closed');
		sidebarbutton.disabled = true;
	} else {
		localStorage.setItem('sidebar-page', 'open');
	}
}

var sidebarmedia = window.matchMedia("(max-width: 900px)")
sidebarauto(sidebarmedia)
sidebarmedia.addListener(sidebarauto)


// Getting Dates

function showDateTime() {
  var getDay = document.getElementById("getDay");
  var getDate = document.getElementById("getDate");
  var getTime = document.getElementById("getTime");

  var date = new Date();
  var dayList = ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"];
  var monthNames = [
	"Enero",
    "Febrero",
    "Marzo",
    "Abril",
    "Mayo",
    "Junio",
    "Julio",
    "Agosto",
    "Septiembre",
    "Octubre",
    "Noviembre",
    "Diciembre"
  ];
  var dayName = dayList[date.getDay()];
  var monthName = monthNames[date.getMonth()];
  var today = `${date.getDate()} de ${monthName}, ${date.getFullYear()}`;

  var hour = date.getHours();
  var min = date.getMinutes();

  var time = hour + ":" + min;
  
  getDay.innerText = `${dayName}`;
  getTime.innerText = `${time}`;
  getDate.innerText = `${today}`;
}

setInterval(showDateTime, 1000);

// Get Browser

function getBrowser() {
	
	var getBrowser = document.getElementById("getBrowser");
	var brName="Unknown Browser";
	
	if (navigator.userAgent.match(/chrome|chromium|crios/i)) {
		brName = "Chrome";
	} else if (navigator.userAgent.match(/firefox|fxios/i)) {
		brName = "Firefox";
	} else if (navigator.userAgent.match(/safari/i)) {
		brName = "Safari";
	} else if (navigator.userAgent.match(/opr\//i)) {
		brName = "Opera";
	} else if (navigator.userAgent.match(/edg/i)) {
		brName = "Edge";
	}
	
	getBrowser.innerText = brName;

}

// Get Screen Information

function browserScreen(){
	var innerWidth = document.getElementById('innerWidth');
	var innerHeight = document.getElementById('innerHeight');
	var screenwidth = document.getElementById('screenwidth');
	var screenheight = document.getElementById('screenheight');
	var screencolorDepth = document.getElementById('screencolorDepth');

	innerWidth.innerText = window.innerWidth;
	innerHeight.innerText = window.innerHeight;
	screenwidth.innerText = screen.width;
	screenheight.innerText = screen.height;
	screencolorDepth.innerText = screen.colorDepth;
}


