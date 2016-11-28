/********************************
 ************FUNCTIONS***********
 ********************************/

 function checkName(){

 	if(document.getElementById("izena").value == "")
 		document.getElementById("izena").style.border = "2px solid red";
 	else
 		document.getElementById("izena").style.border = "1px solid #cccccc";

 	if(document.getElementById("izena").value == "Pokémon"){
 		var audio = new Audio('Pokemon.mp3');
 		audio.play();
 		loop();
 		
 	} else if(document.getElementById("izena").value == "Digimon"){
 		var audio = new Audio('Digimon.mp3');
 		//audio.play();
 		loop();
 		document.getElementById("frame").style.display = "block";
 		document.getElementById("frame").innerHTML = '<iframe width="1280" height="720" src="https://www.youtube.com/embed/UXwunDD5Lm8?autoplay=1" frameborder="0"></iframe>';		
 	}
 }
 

 function balioztatu(){

 	var bool = false;
 	var msg = "";
 	var konpr = "";
 	var f=document.getElementById("iruzkina");

 	if(f.elements[0].value === ""){
 		msg+= "Izena hutsik dago. \n";
 		bool=true;
 	}

 	if(f.elements[3].value === ""){
 		msg+= "Iruzkina hutsik dago. \n";
 		bool=true;
 	}

 	if(bool){
 		msg+="Mesedez, bete.";
 		alert(msg);
 		return false;
 	}

 	if(f.elements[1].value !== ""){

 		var str = f.elements[1].value;
 		var times =(str.split('@').length-1);

 		if(times==1){
 			konpr+="@ behin bakarrik agertzen da.\n";
 		} else{
 			alert("@ ez da behin bakarrik agertzen.");
 			document.getElementById("email").style.border = "2px solid red";
 			return false;
 		}

 		var splitted = str.split("@");

 		if(splitted[0]===""){
 			konpr+="@ karaketerea baino lehen ez dago ezer.\n";
 			document.getElementById("email").style.border = "2px solid red";
 			return false;
 		}

 		if(splitted[1]===""){
 			alert("@ karaketerearen ondoren ez dago ezer.");
 			document.getElementById("email").style.border = "2px solid red";
 			return false;
 		} else if((splitted[1].split('.').length-1)==1){
 			konpr+="@ karaketerearen ondoren puntu bat dago.\n";
 		} else {
 			alert("@ karaketerearen ondoren ez dago punturik.");
 			document.getElementById("email").style.border = "2px solid red";
 			return false;
 		}

 		var splitted2 = splitted[1].split(".");
 		var len = splitted2[1].length;

 		if(len < 2){
 			alert("Puntu karaketerearen atzetik ez daude bi karaktere.");
 			document.getElementById("email").style.border = "2px solid red";
 			return false;
 		} else {
 			konpr+="Puntu karaketerearen atzetik bi karakere daude gutxienez.";
 			document.getElementById("email").style.border = "1px solid #cccccc";
 			alert(konpr);
 		}
 	}
 }

 function desgaitu(){

 	if(document.getElementById("email").value==""){
 		document.getElementById("public").disabled = true;
 		document.getElementById("testua").style.color = "gray";
 		document.getElementById("public").checked = false;

 	} else {
 		document.getElementById("public").disabled = false;
 		document.getElementById("testua").style.color = "black";
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

 function changeColor(){
 	var text = 	document.getElementById("text");
 	text.style.border = "2px solid " + getRandomColor();
 }

 function randomPic(){

 	var gen = document.getElementById("generation").value;
 	var min = 0;
 	var max = 0;

 	if(gen == 1){
 		min = 0;
 		max = 151;
 	} else if(gen == 2){
 		min = 151;
 		max = 279;
 	} else if(gen == 3){
 		min = 279;
 		max = 421;
 	} else if(gen == 4){
 		min = 421;
 		max = 567;
 	} else if(gen == 5){
 		min = 567;
 		max = 750;
 	} else if(gen == 6){
 		min = 0;
 		max = 750;
 	}


 	var	num = Math.floor(Math.random() * (max - min)) + min;

 	var str = "POKE00000.png POKE00001.png POKE00002.png POKE00003.png POKE00004.png POKE00005.png POKE00006.png POKE00007.png POKE00008.png POKE00009.png POKE00010.png POKE00011.png POKE00012.png POKE00013.png POKE00014.png POKE00015.png POKE00016.png POKE00017.png POKE00018.png POKE00019.png POKE00020.png POKE00021.png POKE00022.png POKE00023.png POKE00024.png POKE00025.png POKE00026.png POKE00027.png POKE00028.png POKE00029.png POKE00030.png POKE00031.png POKE00032.png POKE00033.png POKE00034.png POKE00035.png POKE00036.png POKE00037.png POKE00038.png POKE00039.png POKE00040.png POKE00041.png POKE00042.png POKE00043.png POKE00044.png POKE00045.png POKE00046.png POKE00047.png POKE00048.png POKE00049.png POKE00050.png POKE00051.png POKE00052.png POKE00053.png POKE00054.png POKE00055.png POKE00056.png POKE00057.png POKE00058.png POKE00059.png POKE00060.png POKE00061.png POKE00062.png POKE00063.png POKE00064.png POKE00065.png POKE00066.png POKE00067.png POKE00068.png POKE00069.png POKE00070.png POKE00071.png POKE00072.png POKE00073.png POKE00074.png POKE00075.png POKE00076.png POKE00077.png POKE00078.png POKE00079.png POKE00080.png POKE00081.png POKE00082.png POKE00083.png POKE00084.png POKE00085.png POKE00086.png POKE00087.png POKE00088.png POKE00089.png POKE00090.png POKE00091.png POKE00092.png POKE00093.png POKE00094.png POKE00095.png POKE00096.png POKE00097.png POKE00098.png POKE00099.png POKE00100.png POKE00101.png POKE00102.png POKE00103.png POKE00104.png POKE00105.png POKE00106.png POKE00107.png POKE00108.png POKE00109.png POKE00110.png POKE00111.png POKE00112.png POKE00113.png POKE00114.png POKE00115.png POKE00116.png POKE00117.png POKE00118.png POKE00119.png POKE00120.png POKE00121.png POKE00122.png POKE00123.png POKE00124.png POKE00125.png POKE00126.png POKE00127.png POKE00128.png POKE00129.png POKE00130.png POKE00131.png POKE00132.png POKE00133.png POKE00134.png POKE00135.png POKE00136.png POKE00137.png POKE00138.png POKE00139.png POKE00140.png POKE00141.png POKE00142.png POKE00143.png POKE00144.png POKE00145.png POKE00146.png POKE00147.png POKE00148.png POKE00149.png POKE00150.png POKE00151.png POKE00152.png POKE00153.png POKE00154.png POKE00155.png POKE00156.png POKE00157.png POKE00158.png POKE00159.png POKE00160.png POKE00161.png POKE00162.png POKE00163.png POKE00164.png POKE00165.png POKE00166.png POKE00167.png POKE00168.png POKE00169.png POKE00170.png POKE00171.png POKE00172.png POKE00173.png POKE00174.png POKE00175.png POKE00176.png POKE00177.png POKE00178.png POKE00179.png POKE00180.png POKE00181.png POKE00182.png POKE00183.png POKE00184.png POKE00185.png POKE00186.png POKE00187.png POKE00188.png POKE00189.png POKE00190.png POKE00191.png POKE00192.png POKE00193.png POKE00194.png POKE00195.png POKE00196.png POKE00197.png POKE00198.png POKE00199.png POKE00200.png POKE00201.png POKE00202.png POKE00203.png POKE00204.png POKE00205.png POKE00206.png POKE00207.png POKE00208.png POKE00209.png POKE00210.png POKE00211.png POKE00212.png POKE00213.png POKE00214.png POKE00215.png POKE00216.png POKE00217.png POKE00218.png POKE00219.png POKE00220.png POKE00221.png POKE00222.png POKE00223.png POKE00224.png POKE00225.png POKE00226.png POKE00227.png POKE00228.png POKE00229.png POKE00230.png POKE00231.png POKE00232.png POKE00233.png POKE00234.png POKE00235.png POKE00236.png POKE00237.png POKE00238.png POKE00239.png POKE00240.png POKE00241.png POKE00242.png POKE00243.png POKE00244.png POKE00245.png POKE00246.png POKE00247.png POKE00248.png POKE00249.png POKE00250.png POKE00251.png POKE00252.png POKE00253.png POKE00254.png POKE00255.png POKE00256.png POKE00257.png POKE00258.png POKE00259.png POKE00260.png POKE00261.png POKE00262.png POKE00263.png POKE00264.png POKE00265.png POKE00266.png POKE00267.png POKE00268.png POKE00269.png POKE00270.png POKE00271.png POKE00272.png POKE00273.png POKE00274.png POKE00275.png POKE00276.png POKE00277.png POKE00278.png POKE00279.png POKE00280.png POKE00281.png POKE00282.png POKE00283.png POKE00284.png POKE00285.png POKE00286.png POKE00287.png POKE00288.png POKE00289.png POKE00290.png POKE00291.png POKE00292.png POKE00293.png POKE00294.png POKE00295.png POKE00296.png POKE00297.png POKE00298.png POKE00299.png POKE00300.png POKE00301.png POKE00302.png POKE00303.png POKE00304.png POKE00305.png POKE00306.png POKE00307.png POKE00308.png POKE00309.png POKE00310.png POKE00311.png POKE00312.png POKE00313.png POKE00314.png POKE00315.png POKE00316.png POKE00317.png POKE00318.png POKE00319.png POKE00320.png POKE00321.png POKE00322.png POKE00323.png POKE00324.png POKE00325.png POKE00326.png POKE00327.png POKE00328.png POKE00329.png POKE00330.png POKE00331.png POKE00332.png POKE00333.png POKE00334.png POKE00335.png POKE00336.png POKE00337.png POKE00338.png POKE00339.png POKE00340.png POKE00341.png POKE00342.png POKE00343.png POKE00344.png POKE00345.png POKE00346.png POKE00347.png POKE00348.png POKE00349.png POKE00350.png POKE00351.png POKE00352.png POKE00353.png POKE00354.png POKE00355.png POKE00356.png POKE00357.png POKE00358.png POKE00359.png POKE00360.png POKE00361.png POKE00362.png POKE00363.png POKE00364.png POKE00365.png POKE00366.png POKE00367.png POKE00368.png POKE00369.png POKE00370.png POKE00371.png POKE00372.png POKE00373.png POKE00374.png POKE00375.png POKE00376.png POKE00377.png POKE00378.png POKE00379.png POKE00380.png POKE00381.png POKE00382.png POKE00383.png POKE00384.png POKE00385.png POKE00386.png POKE00387.png POKE00388.png POKE00389.png POKE00390.png POKE00391.png POKE00392.png POKE00393.png POKE00394.png POKE00395.png POKE00396.png POKE00397.png POKE00398.png POKE00399.png POKE00400.png POKE00401.png POKE00402.png POKE00403.png POKE00404.png POKE00405.png POKE00406.png POKE00407.png POKE00408.png POKE00409.png POKE00410.png POKE00411.png POKE00412.png POKE00413.png POKE00414.png POKE00415.png POKE00416.png POKE00417.png POKE00418.png POKE00419.png POKE00420.png POKE00421.png POKE00422.png POKE00423.png POKE00424.png POKE00425.png POKE00426.png POKE00427.png POKE00428.png POKE00429.png POKE00430.png POKE00431.png POKE00432.png POKE00433.png POKE00434.png POKE00435.png POKE00436.png POKE00437.png POKE00438.png POKE00439.png POKE00440.png POKE00441.png POKE00442.png POKE00443.png POKE00444.png POKE00445.png POKE00446.png POKE00447.png POKE00448.png POKE00449.png POKE00450.png POKE00451.png POKE00452.png POKE00453.png POKE00454.png POKE00455.png POKE00456.png POKE00457.png POKE00458.png POKE00459.png POKE00460.png POKE00461.png POKE00462.png POKE00463.png POKE00464.png POKE00465.png POKE00466.png POKE00467.png POKE00468.png POKE00469.png POKE00470.png POKE00471.png POKE00472.png POKE00473.png POKE00474.png POKE00475.png POKE00476.png POKE00477.png POKE00478.png POKE00479.png POKE00480.png POKE00481.png POKE00482.png POKE00483.png POKE00484.png POKE00485.png POKE00486.png POKE00487.png POKE00488.png POKE00489.png POKE00490.png POKE00491.png POKE00492.png POKE00493.png POKE00494.png POKE00495.png POKE00496.png POKE00497.png POKE00498.png POKE00499.png POKE00500.png POKE00501.png POKE00502.png POKE00503.png POKE00504.png POKE00505.png POKE00506.png POKE00507.png POKE00508.png POKE00509.png POKE00510.png POKE00511.png POKE00512.png POKE00513.png POKE00514.png POKE00515.png POKE00516.png POKE00517.png POKE00518.png POKE00519.png POKE00520.png POKE00521.png POKE00522.png POKE00523.png POKE00524.png POKE00525.png POKE00526.png POKE00527.png POKE00528.png POKE00529.png POKE00530.png POKE00531.png POKE00532.png POKE00533.png POKE00534.png POKE00535.png POKE00536.png POKE00537.png POKE00538.png POKE00539.png POKE00540.png POKE00541.png POKE00542.png POKE00543.png POKE00544.png POKE00545.png POKE00546.png POKE00547.png POKE00548.png POKE00549.png POKE00550.png POKE00551.png POKE00552.png POKE00553.png POKE00554.png POKE00555.png POKE00556.png POKE00557.png POKE00558.png POKE00559.png POKE00560.png POKE00561.png POKE00562.png POKE00563.png POKE00564.png POKE00565.png POKE00566.png POKE00567.png POKE00568.png POKE00569.png POKE00570.png POKE00571.png POKE00572.png POKE00573.png POKE00574.png POKE00575.png POKE00576.png POKE00577.png POKE00578.png POKE00579.png POKE00580.png POKE00581.png POKE00582.png POKE00583.png POKE00584.png POKE00585.png POKE00586.png POKE00587.png POKE00588.png POKE00589.png POKE00590.png POKE00591.png POKE00592.png POKE00593.png POKE00594.png POKE00595.png POKE00596.png POKE00597.png POKE00598.png POKE00599.png POKE00600.png POKE00601.png POKE00602.png POKE00603.png POKE00604.png POKE00605.png POKE00606.png POKE00607.png POKE00608.png POKE00609.png POKE00610.png POKE00611.png POKE00612.png POKE00613.png POKE00614.png POKE00615.png POKE00616.png POKE00617.png POKE00618.png POKE00619.png POKE00620.png POKE00621.png POKE00622.png POKE00623.png POKE00624.png POKE00625.png POKE00626.png POKE00627.png POKE00628.png POKE00629.png POKE00630.png POKE00631.png POKE00632.png POKE00633.png POKE00634.png POKE00635.png POKE00636.png POKE00637.png POKE00638.png POKE00639.png POKE00640.png POKE00641.png POKE00642.png POKE00643.png POKE00644.png POKE00645.png POKE00646.png POKE00647.png POKE00648.png POKE00649.png POKE00650.png POKE00651.png POKE00652.png POKE00653.png POKE00654.png POKE00655.png POKE00656.png POKE00657.png POKE00658.png POKE00659.png POKE00660.png POKE00661.png POKE00662.png POKE00663.png POKE00664.png POKE00665.png POKE00666.png POKE00667.png POKE00668.png POKE00669.png POKE00670.png POKE00671.png POKE00672.png POKE00673.png POKE00674.png POKE00675.png POKE00676.png POKE00677.png POKE00678.png POKE00679.png POKE00680.png POKE00681.png POKE00682.png POKE00683.png POKE00684.png POKE00685.png POKE00686.png POKE00687.png POKE00688.png POKE00689.png POKE00690.png POKE00691.png POKE00692.png POKE00693.png POKE00694.png POKE00695.png POKE00696.png POKE00697.png POKE00698.png POKE00699.png POKE00700.png POKE00701.png POKE00702.png POKE00703.png POKE00704.png POKE00705.png POKE00706.png POKE00707.png POKE00708.png POKE00709.png POKE00710.png POKE00711.png POKE00712.png POKE00713.png POKE00714.png POKE00715.png POKE00716.png POKE00717.png POKE00718.png POKE00719.png POKE00720.png POKE00721.png POKE00722.png POKE00723.png POKE00724.png POKE00725.png POKE00726.png POKE00727.png POKE00728.png POKE00729.png POKE00730.png POKE00731.png POKE00732.png POKE00733.png POKE00734.png POKE00735.png POKE00736.png POKE00737.png POKE00738.png POKE00739.png POKE00740.png POKE00741.png POKE00742.png POKE00743.png POKE00744.png POKE00745.png POKE00746.png POKE00747.png POKE00748.png POKE00749.png";

 	var res = str.split(" ");

 	document.getElementById("pic").src = "POKEMON/" + res[num];
 }

 function refresh(){
 	randomPic();
 	setInterval(randomPic,3000);
 }

 var colors = new Array(
 	[62,35,255],
 	[60,255,60],
 	[255,35,98],
 	[45,175,230],
 	[255,0,255],
 	[255,128,0]);

 var step = 0;
//color table indices for: 
// current color left
// next color left
// current color right
// next color right
var colorIndices = [0,1,2,3];

//transition speed
var gradientSpeed = 0.01;

function updateGradient()
{

	if ( $===undefined ) return;

	var c0_0 = colors[colorIndices[0]];
	var c0_1 = colors[colorIndices[1]];
	var c1_0 = colors[colorIndices[2]];
	var c1_1 = colors[colorIndices[3]];

	var istep = 1 - step;
	var r1 = Math.round(istep * c0_0[0] + step * c0_1[0]);
	var g1 = Math.round(istep * c0_0[1] + step * c0_1[1]);
	var b1 = Math.round(istep * c0_0[2] + step * c0_1[2]);
	var color1 = "rgb("+r1+","+g1+","+b1+")";

	var r2 = Math.round(istep * c1_0[0] + step * c1_1[0]);
	var g2 = Math.round(istep * c1_0[1] + step * c1_1[1]);
	var b2 = Math.round(istep * c1_0[2] + step * c1_1[2]);
	var color2 = "rgb("+r2+","+g2+","+b2+")";

	$('#gradient').css({
		background: "-webkit-gradient(linear, left top, right top, from("+color1+"), to("+color2+"))"}).css({
			background: "-moz-linear-gradient(left, "+color1+" 0%, "+color2+" 100%)"});

		step += gradientSpeed;
		if ( step >= 1 )
		{
			step %= 1;
			colorIndices[0] = colorIndices[1];
			colorIndices[2] = colorIndices[3];

    //pick two new target color indices
    //do not pick the same as the current one
    colorIndices[1] = ( colorIndices[1] + Math.floor( 1 + Math.random() * (colors.length - 1))) % colors.length;
    colorIndices[3] = ( colorIndices[3] + Math.floor( 1 + Math.random() * (colors.length - 1))) % colors.length;
    
}
}

function loop(){
	updateGradient();
	setInterval(updateGradient,10);
}
