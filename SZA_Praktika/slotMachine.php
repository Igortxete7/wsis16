<?php
//Sesioaren kontrola, norbait logeatuta ez badago ezin da sartu.
session_start();
if(!isset($_SESSION["user"])){
	header('Location: casino.html');
	exit();
}
?>
<html>
<head>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100, 400" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
	<link href="style.css" rel="stylesheet" type="text/css">
	<title>Slot Machine</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
	<script type="text/javascript" src="functions.js"></script>
</head>

<body onload="konprobatu()">
	<button style="position: absolute; top: 50px; left:10%;" onclick="location.href='Casino.html'"> Go back </button>
	<button style="position: absolute; top: 50px; right:10%;" onclick="location.href='LogOut.php'"> Logout </button>
	<br>
	<p id='name'>Slot Machine </p>
	<hr>
	<br>
	<br>
	<!-- Makinaren taula, php kodearekin dituzun eta irabazitako txanponak agertzen dira -->
	<div id="machine" align="center">
		<div id="data">
			<div id="leftData" class="data">
				<p> COINS </p>
				<?php
				echo '<p id="coins">'.$_SESSION["coins"].'</p>';
				?>
			</div>
			<div id="rightData" class="data">
				<p> PAYOUT </p>
				<p id="payout"> 0000 </p>
			</div>
		</div>
		<br>
		<table id="slots" class="table">
			<tr>
				<th id="left">LEFT</th>
				<th id="center">CENTER</th>
				<th id="right">RIGHT</th>
			</tr>
		</table>
		<!-- Jokatzeko botoiak -->
		<div align="center">
			<button id="play" onclick="refresh()" class="button button2"> PLAY </button>
			<button id="stop" onclick="stop()" class="button button2"> STOP </button>
		</div>
	</div>
	<br>
	<br>
	<br>
	<!-- Sarien taula -->
	<div class="prizeTable left" align="center">
		<p align="center"> PRIZES </p>
		<table  align="center">
			<tr>
				<td colspan="2">
					<p><img class="middle" src="images/POKE6.png" height="80" width="80"/><img class="middle" src="images/POKE6.png" height="80" width="80"/>Two alike: 1 Coin </p>
				</td>
			</tr>
			<tr>
				<td>
					<p><img class="middle" src="images/POKE0.png" height="80" width="80"/> 2 Coins </p>
				</td>
				<td>
					<p><img class="middle" src="images/POKE1.png" height="80" width="80"/> 5 Coins </p>
				</td>
			</tr>
			<tr>
				<td>
					<p><img class="middle" src="images/POKE2.png" height="80" width="80"/> 10 Coins </p>
				</td>
				<td>
					<p><img class="middle" src="images/POKE3.png" height="80" width="80"/> 20 Coins </p>
				</td>
			</tr>
			<tr>
				<td>
					<p><img class="middle" src="images/POKE4.png" height="80" width="80"/> 50 Coins </p>
				</td>
				<td>
					<p><img class="middle" src="images/POKE5.png" height="80" width="80"/> 100 Coins </p>
				</td>
			</tr>
		</table>
	</div>
	<!-- Erabiltzailearen interfazea, phprekin eguneratzen dira dirua eta txanponak -->
	<div class="right">
		<p align="center"> <u><b>USER INTERFACE </b></u></p>
		<?php
		echo '<p> <b>USER: </b><span id="user">'.$_SESSION["user"].'</span></p>';
		echo '<p> <b>CASH: </b><span id="cash">'.$_SESSION["cash"].'</span>$</p>';
		?>
		<p> <b>BUY COINS (1$ = 4 coins): </b><input type="text" id="coinsToBuy" style="width:25%; color:yellow; background-color:black">&nbsp;<input type="button" id="buy" style="width:25%;" value="Buy" onclick="buyCoins()"></p>
		<p> <b>EXCHANGE COINS: </b><input type="text" id="coinsToExchange" style="width:25%; color:yellow; background-color:black">&nbsp;<input type="button" id="exchange" style="width:25%;" value="Exchange" onclick="exchangeCoins()"></p>
	</div>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</body>
</html>