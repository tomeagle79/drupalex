	function vet_step_1() {	
		document.getElementById('Error_Messages1').innerHTML = "";
		document.getElementById("Error_Messages1").className = "";		
		document.getElementById("Code_1").className = "";	
		document.getElementById("Code_2").className = "";
		document.getElementById("Code_3").className = "";
		document.getElementById("Code_4").className = "";
		Errors = "";
		True_False = "True";
		Code = trim(document.Entrants_Form.Code_1.value) + 	trim(document.Entrants_Form.Code_2.value) + trim(document.Entrants_Form.Code_3.value) + trim(document.Entrants_Form.Code_4.value);		
		
		if (trim(Code).length !== 4) {
			if (Errors !== "") {
				Errors += "<br>";
			}
			
			Errors += "Please complete a valid code";
			document.getElementById("Code").className = "validation-error";
			True_False = "False";
		}
		else {	
			if (!is_a_number(trim(document.Entrants_Form.Code_1.value))) {
				if (Errors !== "") {
					Errors += "<br>";
				}
						
				Errors += "Please complete a valid code";
				document.getElementById("Code_1").className = "validation-error";
				True_False = "False";
			}
			if (!is_a_number(trim(document.Entrants_Form.Code_2.value))) {
				if (Errors !== "") {
					Errors += "<br>";
				}
						
				Errors += "Please complete a valid code";
				document.getElementById("Code_2").className = "validation-error";
				True_False = "False";
			}
			if (!is_a_number(trim(document.Entrants_Form.Code_3.value))) {
				if (Errors !== "") {
					Errors += "<br>";
				}
						
				Errors += "Please complete a valid code";
				document.getElementById("Code_3").className = "validation-error";
				True_False = "False";
			}
			if (!is_a_number(trim(document.Entrants_Form.Code_4.value))) {
				if (Errors !== "") {
					Errors += "<br>";
				}
						
				Errors += "Please complete a valid code";
				document.getElementById("Code_4").className = "validation-error";
				True_False = "False";
			}
		}
				
		if (True_False == "False") { 
			document.getElementById('Error_Messages1').innerHTML = Errors;			
			document.getElementById("Error_Messages1").className = "error";
			document.getElementById('Error_Messages1_Outer').focus();			
			return false;
		}
		else {
			return true;	
		}
	}
			
	function is_a_number(inputbox) {
		var teststring
		teststring = trim(inputbox.toString())
		if (teststring == "") {return false}
		for (var i = 0; i <  teststring.length; i++) {
			var c = teststring.charAt(i)
			if (c != "0" & c != "1" & c != "2" & c != "3" & c != "4" & c != "5" & c != "6" & c != "7" & c != "8" & c != "9"){return false;}
		}
		return true
	}	
	
	function trim(str) {
   		if (str == "") {
			return str;
		}
		else {
			return str.replace(/^\s*|\s*$/g,"");
		}
	}
