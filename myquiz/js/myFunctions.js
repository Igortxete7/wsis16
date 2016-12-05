///////////////////////////////////////////
///////////////Functions.js///////////////
//////////////////////////////////////////

//SIGN UP FUNCTIONS//

function removeGlyph(id){
  var myElem = document.getElementById(id);
  if(myElem !== null){
    myElem.parentNode.className = "form-group";
    myElem.remove();
  }
}

function validateEmail(emilio){
  var regex=/[a-zA-Z]+\d{3}@ikasle\.ehu\.e(u?)s/;
  return regex.test(emilio);
}

function validatePhone(tlf){
  var regex=/\d{9}/;
  return regex.test(tlf);
}

function validateName(name){
  var regex=/[A-ZÁÉÍÓÚÑ][A-Za-z\sáéíóúñ]+/;
  return regex.test(name);
}

function balioztatu(){
  var emaitza = false;
  var bool=false;
  var f=document.getElementById("erregistro");
  var msg="";
  if(f.elements[8].id == ""){
    for(i=9;i<16;i++){
      var uneko = f.elements[i];
      if(uneko.value == ""){
        msg +=uneko.id + " is empty!" + "\n";
        if(uneko.parentNode.className.localeCompare("form-group")==0){
          uneko.parentNode.className = "form-group has-error has-feedback";
          uneko.parentNode.innerHTML += '<span class="glyphicon glyphicon-remove form-control-feedback" id="glyphicon'+i+'"></span>';
        }
        bool=true;
      }
    }
  }else{
    for(i=8;i<15;i++){
      var uneko = f.elements[i];
      if(uneko.value == ""){
        msg +=uneko.id + " is empty!" + "\n";
        if(uneko.parentNode.className.localeCompare("form-group")==0){
          uneko.parentNode.className = "form-group has-error has-feedback";
          uneko.parentNode.innerHTML += '<span class="glyphicon glyphicon-remove form-control-feedback" id="glyphicon'+i+'"></span>';
        }
        bool=true;
      }
    }
  }
  
  if(bool)
    alert(msg);
  else{
    if(!validateName(document.getElementById("First name").value)){
      alert("First name error!");
      document.getElementById("First name").parentNode.className = "form-group has-error has-feedback";
      document.getElementById("First name").parentNode.innerHTML += '<span class="glyphicon glyphicon-remove form-control-feedback" id="glyphicon8"></span>';
    }else if(!validateName(document.getElementById("Last name").value)){
      alert("You need to introduce two surnames!");
      document.getElementById("Last name").parentNode.className = "form-group has-error has-feedback";
      document.getElementById("Last name").parentNode.innerHTML += '<span class="glyphicon glyphicon-remove form-control-feedback" id="glyphicon9"></span>';
    }else if(document.getElementById("Password").value.length <6){
      alert("Password is too short!");
      document.getElementById("Password").parentNode.className = "form-group has-error has-feedback";
      document.getElementById("Password").parentNode.innerHTML += '<span class="glyphicon glyphicon-remove form-control-feedback" id="glyphicon12"></span>';
    }else if(!validateEmail(document.getElementById("e-mail").value)){
      alert("The e-mail is not valid!");
      document.getElementById("e-mail").parentNode.className = "form-group has-error has-feedback";
      document.getElementById("e-mail").parentNode.innerHTML += '<span class="glyphicon glyphicon-remove form-control-feedback" id="glyphicon10"></span>';
    }else if(!validatePhone(document.getElementById("Telephone number").value)){
      alert("The telephone number is not valid!");
      document.getElementById("Telephone number").parentNode.className = "form-group has-error has-feedback";
      document.getElementById("Telephone number").parentNode.innerHTML += '<span class="glyphicon glyphicon-remove form-control-feedback" id="glyphicon14"></span>';
    }else{
      emaitza=true;
    }  
  }
  return emaitza;
}

function addValid(place, id){
  removeGlyph(id);
  var span = document.createElement("span");
  span.className = "glyphicon glyphicon-ok form-control-feedback";
  span.id = id;
  $('#'+place).append(span);
  document.getElementById(place).className = "form-group has-success has-feedback";
}

function addNoValid(place, id){
  removeGlyph(id);
  var span = document.createElement("span");
  span.className = "glyphicon glyphicon-remove form-control-feedback";
  span.id = id;
  $('#'+place).append(span);
  document.getElementById(place).className = "form-group has-error has-feedback";
}

xhttp = new XMLHttpRequest();
xhttp1 = new XMLHttpRequest();

function validate(){
  xhttp.onreadystatechange = function(){
    if((xhttp.readyState==4) && (xhttp.status==200)){
      var erantzuna = xhttp.responseText;
      if(erantzuna =="BAI"){
        addValid("mailGroup", "glyphicon10");
        document.getElementById("Submit").disabled = false;
        document.getElementById("container").innerHTML ="";
      }
      else{
        addNoValid("mailGroup", "glyphicon10");
        document.getElementById("Submit").disabled = true;
        document.getElementById("container").innerHTML ="Is NOT a valid email";
        document.getElementById("container").style.color ="red";
      }
    }
  }

  xhttp.open("POST","emailValidator.php");
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("email=" + document.getElementById("e-mail").value);

}

function validatePass(){
  xhttp1.onreadystatechange = function(){
    if((xhttp1.readyState==4) && (xhttp1.status==200)){
      var erantzuna = xhttp1.responseText;
      if(document.getElementById("Password").value== "" || document.getElementById("Code").value== ""){
        removeGlyph("glyphicon13");
        removeGlyph("glyphicon12");
        removeGlyph("glyphicon11");
        document.getElementById("container3").innerHTML = "";
        document.getElementById("container4").innerHTML = "";
        document.getElementById("Submit").disabled = false;
        return false;
      }else{
        if(erantzuna =="BALIOZKOA"){
          addValid("pass1Group", "glyphicon12");
          addValid("codeGroup", "glyphicon11");
          document.getElementById("Submit").disabled = false;
          document.getElementById("container3").innerHTML = "";
          document.getElementById("container2").innerHTML = "";
          equals();
        }
        else if (erantzuna == "BALIOGABEA"){
          addNoValid("pass1Group", "glyphicon12");
          addValid("codeGroup", "glyphicon11");
          document.getElementById("Submit").disabled = true;
          document.getElementById("container3").innerHTML = "Weak password";
          document.getElementById("container3").style.color ="red";
          document.getElementById("container2").innerHTML = "";
        }
        else {
          addNoValid("codeGroup", "glyphicon11");
          document.getElementById("Submit").disabled = true;
          document.getElementById("container2").innerHTML = "User with no permissions";
          document.getElementById("container2").style.color ="red";
          document.getElementById("container3").innerHTML = " ";
        }
      }
    }
  }

  xhttp1.open("POST","passValidator.php");
  xhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp1.send("pass=" + document.getElementById("Password").value+"&code=" + document.getElementById("Code").value);

}

function equals() {

  if(document.getElementById("Password2").value!=""){
    if (document.getElementById("Password").value == document.getElementById("Password2").value){
      addValid("pass2Group", "glyphicon13");
      document.getElementById("container4").innerHTML = "";
      document.getElementById("Submit").disabled = false;
    } else {
      addNoValid("pass2Group", "glyphicon13");
      document.getElementById("container4").innerHTML = "Passwords are NOT equal.";
      document.getElementById("container4").style.color="red";
      document.getElementById("Submit").disabled = true;
    }
  } else {
    removeGlyph("glyphicon13");
    document.getElementById("container4").innerHTML = "";

  }
}

//SEND A COMMENT FUNCTIONS//

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
  var text =  document.getElementById("text");
  text.style.border = "2px solid " + getRandomColor();
}


// CHANGE PASSWORD FUNCTIONS//

function passEquals() {
  if(document.getElementById("pass2").value!=""){
    if(document.getElementById("pass").value.length <6){
      alert("Password is too short!");
      document.getElementById("submit").disabled = true;
      return false;
    }
    if (document.getElementById("pass").value == document.getElementById("pass2").value){
      removeGlyph("glyphicon");
      document.getElementById("pass2Class").className = "form-group has-success has-feedback";
      var span = document.createElement("span");
      span.className = "glyphicon glyphicon-ok form-control-feedback";
      span.id = "glyphicon";
      $('#pass2Class').append(span);
      document.getElementById("container").innerHTML = "";
      document.getElementById("submit").disabled = false;
      return true;
    } else {
      removeGlyph("glyphicon");
      document.getElementById("pass2Class").className = "form-group has-error has-feedback";
      var span = document.createElement("span");
      span.className = "glyphicon glyphicon-remove form-control-feedback";
      span.id = "glyphicon";
      $('#pass2Class').append(span);
      document.getElementById("container").innerHTML = "Passwords are NOT equal.";
      document.getElementById("container").style.color="red";
      document.getElementById("submit").disabled = true;
      return false;
    }
  } else {
    removeGlyph("glyphicon");
    document.getElementById("container").innerHTML = "";
    return true;
  }
}

xhttp2 = new XMLHttpRequest();

function validateChangePass(){

  xhttp2.onreadystatechange = function(){
    if((xhttp2.readyState==4) && (xhttp2.status==200)){
      var erantzuna = xhttp2.responseText;
      if(document.getElementById("pass").value== ""){
        removeGlyph("glyphicon2");
        document.getElementById("passClass").className = "form-group";
        document.getElementById("container").innerHTML = "";
        document.getElementById("submit").disabled = false;
      }else{
        if(erantzuna =="BALIOZKOA"){
          removeGlyph("glyphicon2");
          document.getElementById("passClass").className = "form-group has-success has-feedback";
          var span = document.createElement("span");
          span.className = "glyphicon glyphicon-ok form-control-feedback";
          span.id = "glyphicon2";
          $('#passClass').append(span);
          document.getElementById("container").innerHTML = "";
          document.getElementById("submit").disabled = false;
        }
        else if (erantzuna == "BALIOGABEA"){
          removeGlyph("glyphicon2");
          document.getElementById("passClass").className = "form-group has-error has-feedback";
          var span = document.createElement("span");
          span.className = "glyphicon glyphicon-remove form-control-feedback";
          span.id = "glyphicon2";
          $('#passClass').append(span);
          document.getElementById("container").innerHTML = "Weak password.";
          document.getElementById("container").style.color="red";
          document.getElementById("submit").disabled = true;
        }
      }
    }
  }

  xhttp2.open("POST","passValidator.php");
  xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp2.send("pass=" + document.getElementById("pass").value+"&code=1111");

}

