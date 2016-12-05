// Funtzioak //

////////// Slot Machine Funtzioak //////////

// Makinaren funtzionamendua kontrolatzen dituzten aldagaiak.
//Denbora tarteak adierazten dituzten aldagaiak, makina biraka hasteko.
var play = null;
var play2 = null;
var play3 = null;

//Ruleta bakoitzaren balioa eramaten dituzten aldagaiak.
var start1 = 0;
var start2 = 1;
var start3 = 2;

//Stop botoiari zenbat alditan ematen zaion. Ruleta bakoitza aldi batean gelditzeko.
var times = 0;

//Play botoia pultsatuta dagoela adierazteko.
var pushed = false;

//Jokua martxan dabilela adierazteko.
var playing = false;

//Lehenengo ruleta giraka hasteko funtzioa. Irudiak sartuz doa eta karratuaren kolorea aldatzen.
function spin(){
	start1++;
	if(start1 === 6)
		start1 = 0;
	document.getElementById("slots").rows[0].cells[0].innerHTML = '<img align="center" src="images/POKE'+start1+'.png" height=100 width=100>';
	changeColor("left");

}

//Bigarren ruleta giraka hasteko funtzioa. Irudiak sartuz doa eta karratuaren kolorea aldatzen.
function spin2(){
	start2++;
	if(start2 === 6)
		start2 = 0;
	document.getElementById("slots").rows[0].cells[1].innerHTML = '<img align="center" src="images/POKE'+start2+'.png" height=100 width=100>';
	changeColor("center");

}

//Hirugarren ruleta giraka hasteko funtzioa. Irudiak sartuz doa eta karratuaren kolorea aldatzen.
function spin3(){
	start3++;
	if(start3 === 6)
		start3 = 0;
	document.getElementById("slots").rows[0].cells[2].innerHTML = '<img align="center" src="images/POKE'+start3+'.png" height=100 width=100>';
	changeColor("right");

}

//Play botoiari ematean funtzionatzen hasten da makina, hiru ruletak biraraziz zehaztutako denboran.
//Interval horiek play aldagaietan gordetzen dira kontrola eramateko.
function refresh(){
	if(!pushed){
		spin();
		spin2();
		spin3();
		play = setInterval(spin,100);
		play2 = setInterval(spin2,100);
		play3 = setInterval(spin3,100);
		playing = true;
		document.getElementById("payout").innerHTML="0000";
	}
	pushed = true;
}

//AJAX. Eskaera bidaltzean egiten duen funtzioa. Funtzio bakoitzak erantzun mezu ezberdina bueltatuko du.
//Horren arabera gauza bat edo beste egingo du.
var xhttp1 = new XMLHttpRequest();
xhttp1.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		//Erantzuna lortu
		var erantzuna = xhttp1.responseText;

		//Erantzunaren balioak zatutu hutsuneen arabera.
		var split = erantzuna.split(" ");

		//Erantzuna OK bada kredituak gorde edo kendu dira.
		if(split[0] =="OK"){
			document.getElementById("coins").innerHTML=split[1];
			if(split[1]==0){
				document.getElementById("play").disabled = true;
			}
		}

		//Erantzuna BOUGHT bada kredituak erosi dira.
		if(split[0] == "BOUGHT"){
			document.getElementById("cash").innerHTML=split[1];
			document.getElementById("coins").innerHTML=split[2];
			var dollar = Math.abs(document.getElementById("coinsToBuy").value);
			alert("Bought: "+dollar*4+" coins for "+dollar);
			document.getElementById("coinsToBuy").value = "";
			if(split[2]==0){
				document.getElementById("play").disabled = true;
			} else {
				document.getElementById("play").disabled = false;
			}
		}

		//Erantzuna EXCHANGED bada kredituak diruaren truke aldatu dira.
		if(split[0] == "EXCHANGED"){
			document.getElementById("cash").innerHTML=split[1];
			document.getElementById("coins").innerHTML=split[2];
			var dollar = Math.abs(document.getElementById("coinsToExchange").value);
			alert("Exchanged: "+dollar+" coins for "+dollar/4);
			document.getElementById("coinsToExchange").value = "";
			if(split[2]==0){
				document.getElementById("play").disabled = true;º
			}
		}
	}
};

//AJAX Funtzioa. Kredituak XML fixategian gordetzeko. updateXML.php dei eginez eta beheko balioak pasaz.
function gordeKredituak(){
	xhttp1.open("POST", "updateXML.php");
	xhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp1.send("user=" + document.getElementById("user").innerHTML+"&coins=" + document.getElementById("payout").innerHTML);

}

//AJAX Funtzioa. Kredituak XML fixategian gordetzeko. updateXML.php dei eginez. Kasu honetan partida bakoitzaren ondoren kreditu bat kentzen zaio erabiltzaileari.
function kenduKredituak(){
	if(document.getElementById("coins").innerHTML > 0){
		document.getElementById("play").disabled = false;
		xhttp1.open("POST", "updateXML.php");
		xhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp1.send("user=" + document.getElementById("user").innerHTML+"&coins=-1");
	} else {
		alert("You have no coins!");
		document.getElementById("play").disabled = true;
	}

}

//AJAX Funtzioa. Kredituak XML fixategian gordetzeko. updateXML.php dei eginez. Kredituak erosterakoan erabiltzen da.
function buyCoins(){
	var quantity = Math.abs(new Number(document.getElementById("coinsToBuy").value));
	var cash = Math.abs(new Number(document.getElementById("cash").innerHTML));
	if(quantity>cash){
		alert("ERROR: You do not have enough money!");
	}else{
		xhttp1.open("POST", "updateXML.php");
		xhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp1.send("user=" + document.getElementById("user").innerHTML+"&coinsToBuy="+quantity);
	}
}

//AJAX Funtzioa. Kredituak XML fixategian gordetzeko. updateXML.php dei eginez. Kredituak diruaren truke aldatzeko erabiltzen da.
function exchangeCoins(){
	var quantity = Math.abs(new Number(document.getElementById("coinsToExchange").value));
	var coins = Math.abs(new Number(document.getElementById("coins").innerHTML));
	if(quantity>coins){
		alert("ERROR: You do not have enough coins!");
	}else{
		xhttp1.open("POST", "updateXML.php");
		xhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp1.send("user=" + document.getElementById("user").innerHTML+"&coinsToExchange="+quantity);
	}
}

//Kredituak daudela konporbatzeko, bestela ezin da jokatu.
function konprobatu(){
	if(document.getElementById("coins").innerHTML > 0){
		document.getElementById("play").disabled = false;
	} else {
		document.getElementById("play").disabled = true;
	}
}

//STOP botoiari ematean egiten dituen eragiketak.
//Hasierako bi alditan bakarrik ruletak gelditzen ditu.
//Azkeneko ruleta gelditzean, haien balioak konprobatzen ditu saria dagoen ala ez begiratzeko.
//Kredituak gordetzen dira azkenik eta ruleten balioak randomizatzen dira hurrengo partida hasteko prest.
function stop(){
	if(playing){
		if(times === 0){
			clearInterval(play);
			times++;
		} else if(times ===1){
			clearInterval(play2);
			times++;
		} else if(times ===2){
			clearInterval(play3);
			times = 0;
			pushed = false;
			playing = false;
			if(start1 == start2 && start2 == start3){
				alert("BIG PRIZE!");
				document.getElementById("right").style.border = "3px solid LawnGreen";
				document.getElementById("center").style.border = "3px solid LawnGreen";
				document.getElementById("left").style.border = "3px solid LawnGreen";
				if(start1==0){
					document.getElementById("payout").innerHTML="0002";
				}else if(start1==1){
					document.getElementById("payout").innerHTML="0005";
				}else if(start1==2){
					document.getElementById("payout").innerHTML="0010";
				}else if(start1==3){
					document.getElementById("payout").innerHTML="0020";		
				}else if(start1==4){
					document.getElementById("payout").innerHTML="0050";		
				}else if(start1==5){
					document.getElementById("payout").innerHTML="0100";
				}
				gordeKredituak();
			}else if(start1 == start2){
				alert("YOU WON!!");
				document.getElementById("left").style.border = "3px solid LawnGreen";
				document.getElementById("center").style.border = "3px solid LawnGreen";
				document.getElementById("right").style.border = "3px solid red";
				document.getElementById("payout").innerHTML="0001";				
				gordeKredituak();
			}else if(start1 == start3){
				alert("YOU WON!!");
				document.getElementById("left").style.border = "3px solid LawnGreen";
				document.getElementById("right").style.border = "3px solid LawnGreen";
				document.getElementById("center").style.border = "3px solid red";
				document.getElementById("payout").innerHTML="0001";
				gordeKredituak();
			}else if(start2 == start3){
				alert("YOU WON!!");
				document.getElementById("center").style.border = "3px solid LawnGreen";
				document.getElementById("right").style.border = "3px solid LawnGreen";
				document.getElementById("left").style.border = "3px solid red";
				document.getElementById("payout").innerHTML="0001";
				gordeKredituak();
			}else{
				kenduKredituak();
			}

			start1 = Math.floor((Math.random() * 6) + 0);
			start2 = Math.floor((Math.random() * 6) + 0);
			start3 = Math.floor((Math.random() * 6) + 0);
			
		}
	}
}

//Hamaseitarrean kolore aleatorio bat bueltatzen du.
function getRandomColor() {
	var letters = '0123456789ABCDEF';
	var color = '#';
	for (var i = 0; i < 6; i++ ) {
		color += letters[Math.floor(Math.random() * 16)];
	}
	return color;
}

//Elementu bati ertzetako kolorea aldatzeko.
function changeColor(id){
	var text = 	document.getElementById(id);
	text.style.border = "3px solid " + getRandomColor();
}




////////// Sign Up Funtzioak //////////


//Kreditu txartela sartzeko balidazioa.
function validateCredit(card){
	var regex=/\d{4}-\d{4}-\d{4}/;
	return regex.test(card);
}

//AJAX Funtzioa. Email errepikatua ez sartzeko kontrola.
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		getMail(this);
	}
};

//AJAX Funtzioa. XML fitxategia hartzen du.
function validateMail(){
	xhttp.open("GET", "jokalariak.xml", true);
	xhttp.send();
}

var dago = false;

//XML fitxategiarekin begiratu ea korreoa dagoen. Dago aldagaia true-ra aldatzen bada korreo hori jadanik existitzen da.
function getMail(xml) {
	dago=false;
	var xmlDoc = xml.responseXML;
	var emails = xmlDoc.getElementsByTagName("mail");
	var mail = document.getElementById("e-mail").value;

	for (var i = 0; i < emails.length; i++) {
		if(mail == emails[i].childNodes[0].nodeValue){
			dago = true;
			break;
		}
	}
}

//Erregistro orriko balidazioa.
function balioztatu(){
	var emaitza = false;
	var bool=false;
	var f=document.getElementById("erregistro");
	var msg="";
	//Hutsik dauden balioen kotnrola
	for(i=0;i<7;i++){
		if(f.elements[i].value == ""){
			msg +=f.elements[i].id + " is empty!" + "\n";
			bool=true;
		}
	}

	//Hutsik badaude mezua agertu.
	if(bool)
		alert(msg);
	else{
		//Bestela balidatu datuak eta emaitza bidali.
		if(dago)
			alert("The e-mail already exists.");
		else if(document.getElementById("Password").value.length <6)
			alert("Password is too short!");
		else if(document.getElementById("Password").value != document.getElementById("Password Repeat").value)
			alert("Paswords are not equal!");
		else if(!validateCredit(document.getElementById("Credit Card number").value))
			alert("The Credit Card number is not valid!");
		else
			emaitza=true;
	}
	return emaitza;
}