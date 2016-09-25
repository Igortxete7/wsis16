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
          var regex=/[a-zA-Z]+\d{3}@ikasle.ehu.e(u?)s/;
          return regex.test(emilio);
        }

        function validatePhone(tlf){
          var regex=/\d{9}/;
          return regex.test(tlf);
        }

        function validateName(name){
          var regex=/[A-Z][a-z]+/;
          return regex.test(name);
        }

        function validateSecondName(sName){
          var regex=/[A-Z][a-z]+\s[A-Z][a-z]+/;
          return regex.test(sName);
        }

        function balioztatu(){
          var bool=false;
          var f=document.getElementById("erregistro");
          var msg="";
          for(i=0;i<6;i++){
            if(f.elements[i].value == ""){
              msg +=f.elements[i].name + " is empty!" + "\n";
              bool=true;
            }
          }

          if(bool)
            alert(msg);
          else{
            if(!validateName(document.getElementById("First name").value))
              alert("First name error!");
            else if(!validateSecondName(document.getElementById("Last name").value))
              alert("You need to introduce two surnames!");
            else if(document.getElementById("Password").value.length <6)
              alert("Password is too short!");
            else if(!validateEmail(document.getElementById("e-mail").value))
              alert("The e-mail is not valid!");
            else if(!validatePhone(document.getElementById("Telephone number").value))
              alert("The telephone number is not valid!");
            else
              ikusBalioak();
          }
        }

        function addTextField(){
          if(document.getElementById("Department").value == "Others"){
          
          var container = document.getElementById("container");

          container.appendChild(document.createTextNode("Please specify your department:"));
          container.appendChild(document.createElement("br"));
          var textArea = document.createElement("textArea");
                textArea.rows = "1";
                textArea.cols = "20";
                textArea.name = "Other Department";
          container.appendChild(textArea);
          container.appendChild(document.createElement("br"));
          }
          else{
            var element = document.getElementById("container");
            while (element.firstChild) {
              element.removeChild(element.firstChild);
            }
          }
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $("#pic")
                        .attr("src", e.target.result)
                        //.width(150)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

