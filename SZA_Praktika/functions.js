// FUNCTIONS //

// SLOT MACHINE FUNCTIONS //
var play = null;
var play2 = null;
var play3 = null;

var start1 = 0;
var start2 = 1;
var start3 = 2;

var times = 0;
var pushed = false;
var playing = false;

function spin(){
	start1++;
	if(start1 === 6)
		start1 = 0;
	document.getElementById("slots").rows[0].cells[0].innerHTML = '<img align="center" src="images/POKE'+start1+'.png" height=100 width=100>';
	changeColor("left");

}

function spin2(){
	start2++;
	if(start2 === 6)
		start2 = 0;
	document.getElementById("slots").rows[0].cells[1].innerHTML = '<img align="center" src="images/POKE'+start2+'.png" height=100 width=100>';
	changeColor("center");

}

function spin3(){
	start3++;
	if(start3 === 6)
		start3 = 0;
	document.getElementById("slots").rows[0].cells[2].innerHTML = '<img align="center" src="images/POKE'+start3+'.png" height=100 width=100>';
	changeColor("right");

}

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

var xhttp1 = new XMLHttpRequest();
xhttp1.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		var erantzuna = xhttp1.responseText;
		var split = erantzuna.split(" ");
		if(split[0] =="OK"){
			document.getElementById("coins").innerHTML=split[1];
			if(split[1]==0){
				document.getElementById("play").disabled = true;
				document.getElementById("play").style.backgroundColor = "#cccccc";
			}
		}
		
		if(split[0] == "BOUGHT"){
			document.getElementById("cash").innerHTML=split[1];
			document.getElementById("coins").innerHTML=split[2];
			var dollar = Math.abs(document.getElementById("coinsToBuy").value);
			alert("Bought: "+dollar*4+" coins for "+dollar);
			document.getElementById("coinsToBuy").value = "";
			if(split[2]==0){
				document.getElementById("play").disabled = true;
				document.getElementById("play").style.backgroundColor = "#cccccc";
			} else {
				document.getElementById("play").disabled = false;
				document.getElementById("play").style.backgroundColor = "yellow";
			}
		}

		if(split[0] == "EXCHANGED"){
			document.getElementById("cash").innerHTML=split[1];
			document.getElementById("coins").innerHTML=split[2];
			var dollar = Math.abs(document.getElementById("coinsToExchange").value);
			alert("Exchanged: "+dollar+" coins for "+dollar/4);
			document.getElementById("coinsToExchange").value = "";
			if(split[2]==0){
				document.getElementById("play").disabled = true;
				document.getElementById("play").style.backgroundColor = "#cccccc";
			}
		}
	}
};

function gordeKredituak(){
	xhttp1.open("POST", "updateXML.php");
	xhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp1.send("user=" + document.getElementById("user").innerHTML+"&coins=" + document.getElementById("payout").innerHTML);

}

function kenduKredituak(){
	if(document.getElementById("coins").innerHTML > 0){
		document.getElementById("play").disabled = false;
		xhttp1.open("POST", "updateXML.php");
		xhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp1.send("user=" + document.getElementById("user").innerHTML+"&coins=-1");
	} else {
		alert("You have no coins!");
		document.getElementById("play").disabled = true;
		document.getElementById("play").style.backgroundColor = "#cccccc";
	}

}

function konprobatu(){
	if(document.getElementById("coins").innerHTML > 0){
		document.getElementById("play").disabled = false;
	} else {
		document.getElementById("play").disabled = true;
		document.getElementById("play").style.backgroundColor = "#cccccc";
	}
}

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

function getRandomColor() {
	var letters = '0123456789ABCDEF';
	var color = '#';
	for (var i = 0; i < 6; i++ ) {
		color += letters[Math.floor(Math.random() * 16)];
	}
	return color;
}

function changeColor(id){
	var text = 	document.getElementById(id);
	text.style.border = "3px solid " + getRandomColor();
}


// SIGN UP FUNCTIONS //

function validateCredit(card){
	var regex=/\d{4}-\d{4}-\d{4}/;
	return regex.test(card);
}

var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		getMail(this);
	}
};

function validateMail(){
	xhttp.open("GET", "jokalariak.xml", true);
	xhttp.send();
}

var dago = false;

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

function balioztatu(){
	var emaitza = false;
	var bool=false;
	var f=document.getElementById("erregistro");
	var msg="";
	for(i=0;i<7;i++){
		if(f.elements[i].value == ""){
			msg +=f.elements[i].id + " is empty!" + "\n";
			bool=true;
		}
	}

	if(bool)
		alert(msg);
	else{
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

//LOG IN FUNCTIONS //
