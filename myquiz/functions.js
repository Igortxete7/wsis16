///////////////////////////////////////////
///////////////Functions.js///////////////
//////////////////////////////////////////

        function ikusBalioak(){
          var sAux="";
          var frm=document.getElementById("erregistro"); 
          for(i=0;i<frm.elements.length-2;i++){
            sAux +="IZENA: " + frm.elements[i].name+" ";
            sAux +="BALIOA: " + frm.elements[i].value+"\n"; 
          }
          alert(sAux);
        }

        function validateEmail(emilio){
          var regex=/[a-z]*[0-9][0-9][0-9]@ikasle.ehu.e(u?)s/;
          return regex.test(emilio);
        }

        function balioztatu(){
          var bool=false;
          var f=document.getElementById("erregistro");
          var msg="";
          for(i=0;i<5;i++){
            if(f.elements[i].value == ""){
              msg +=f.elements[i].name + " is empty!" + "\n";
              bool=true;
            }
          }
          if(bool)
            alert(msg);
          else{
            if(document.getElementById("Password").value.length <6)
              alert("Password is too short!");
            else if(!validateEmail(document.getElementById("e-mail").value))
              alert("The e-mail is not valid!");
            else if(document.getElementById("Telephone number").value.length <9)
              alert("The telephone number is not valid!");
            else
              ikusBalioak();
          }
        }