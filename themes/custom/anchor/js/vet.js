	function vet_step() {	
		document.getElementById('Error_Messages2').innerHTML = "";
		document.getElementById("Error_Messages2").className = "";	
		document.getElementById("Title").className = "";	
		document.getElementById("First_Name").className = "";
		document.getElementById("Surname").className = "";		
		document.getElementById("The_Phone").className = "";
		document.getElementById("The_Email").className = "";
		document.getElementById("Over_18").className = "";	
		document.getElementById("Agree_To_Terms").className = "";
		document.getElementById("Code").className = "";		
		Errors = "";
		True_False = "True";

		if (!is_a_number(trim(document.Entrants_Form.Code.value))) {
				if (Errors !== "") {
					Errors += "<br>";
				}
						
				Errors += "Please complete a valid code";
				document.getElementById("Code").className = "validation-error";
				True_False = "False";
		}

		if (trim(document.Entrants_Form.Title.value).toLowerCase() !== "mr" & trim(document.Entrants_Form.Title.value).toLowerCase() !== "mrs" & trim(document.Entrants_Form.Title.value).toLowerCase() !== "miss" & trim(document.Entrants_Form.Title.value).toLowerCase() !== "ms" & trim(document.Entrants_Form.Title.value).toLowerCase() !== "dr" & trim(document.Entrants_Form.Title.value).toLowerCase() !== "lord" & trim(document.Entrants_Form.Title.value).toLowerCase() !== "lady"){
			if (Errors !== "") {
				Errors += "<br>";
			}
			document.getElementById("Title").className = "validation-error";
			Errors += "Please select a vaid title";
			True_False = "False";			
		}
		
		if (!is_a_letter_or_space(document.Entrants_Form.First_Name.value) | trim(document.Entrants_Form.First_Name.value).length < 2){
			if (Errors !== "") {
				Errors += "<br>";
			}
			document.getElementById("First_Name").className = "validation-error";
			Errors += "Please enter a valid First Name";
			True_False = "False";			
		}
		
		if (!check_valid_contents(document.Entrants_Form.Surname.value)){
			if (Errors !== "") {
				Errors += "<br>";
			}
			document.getElementById("Surname").className = "validation-error";
			Errors += "Please enter a valid Surname";
			True_False = "False";			
		}
		
		if (!check_valid_essential_telephone_contents(document.Entrants_Form.The_Phone.value)){
			if (Errors !== "") {
				Errors += "<br>";
			}
			document.getElementById("The_Phone").className = "validation-error";
			Errors += "Please enter a valid Telephone Number";	
			True_False = "False";			
		}
		
		if (!check_valid_essential_email_contents(document.Entrants_Form.The_Email.value)){
			if (Errors !== "") {
				Errors += "<br>";
			}
			document.getElementById("The_Email").className = "validation-error";
			Errors += "Please enter a valid Email Address";	
			True_False = "False";			
		}
		
		if (!document.Entrants_Form.Country[0].checked && !document.Entrants_Form.Country[1].checked){
			if (Errors !== "") {
				Errors += "<br>";
			}
			
			Errors += "Please select a Country";			
			document.getElementById("radio-01").className = "validation-error";
			document.getElementById("radio-02").className = "validation-error";
			True_False = "False";			
		}
				
		if (!document.Entrants_Form.Over_18.checked){
			if (Errors !== "") {
				Errors += "<br>";
			}
			document.getElementById("Over_18").className = "validation-error";
			Errors += "Please confirm that you are over 18";
			True_False = "False";			
		}
		
		if (!document.Entrants_Form.Agree_To_Terms.checked){
			if (Errors !== "") {
				Errors += "<br>";
			}
			document.getElementById("Agree_To_Terms").className = "validation-error";
			Errors += "Please confirm that you agree to the terms";
			True_False = "False";			
		}			
		if (True_False == "False") {
			document.getElementById('Error_Messages2').innerHTML = Errors;			
			document.getElementById("Error_Messages2").className = "error";
			document.getElementById('Error_Messages2_Outer').focus();
			return false;
		}
		else {
			return true;	
		}		
	}
	
	
	function check_valid_essential_telephone_contents(inputbox) {
		var teststring
		teststring  = trim(inputbox.toString())
		
		if (teststring == "") {
			return false
		}
				
		outputstring = removeblank(teststring)		
		for (var i = 0; i <  outputstring.length; i++) {			
			var c = outputstring.charAt(i)			
			if ((c != " ") & (c != "-") & (c != "+") & (c != "(") & (c != ")") & (c != ".") & !is_a_number(c)){				
				return false
			}
		}
		
		if (outputstring.length > 25) {
			return false
		}
				
		if (outputstring.length < 10) {
			return false
		}
							
		return true
	}
	
	function check_valid_essential_email_contents(inputbox) {
		if (trim(inputbox) == "") {							
			return false;
		}
		
		var outputstring; 

		outputstring = trim(inputbox.toString());
		
		if (isblank(outputstring)) {				
			return false;
		}		

		// Check for at least 7 chrs

		if (outputstring.length <= 6){						
			return false;
		}

		// Check for Illegal Characters

		var illegalchrs = new Array("*","£","$","!")

		var counter;

		for (counter=0; counter <= illegalchrs.length; counter++){
			if (outputstring.indexOf(illegalchrs[counter]) != -1){						
			return false;
			}				
		}

		// Check for the @ and the dots

		// First check that they both exist

		var atpositionback = outputstring.lastIndexOf("@");

		var dotpositionback = outputstring.lastIndexOf(".");

		var atpositionfront = outputstring.indexOf("@");


		if (atpositionback == -1){						
			return false;
		}

		if (dotpositionback == -1){						
			return false;
		}

		if (atpositionfront != atpositionback){						
			return false;
		}

		if (atpositionback > dotpositionback){						
			return false;
		}	
		
		if (dotpositionback == atpositionback + 1){						
			return false;
		}
		return true
	}
	
	function is_a_letter_or_space(inputbox) {		
		var teststring;
		teststring = trim(inputbox.toString());
		if (teststring == "") {return false}
		for (var i = 0; i <  teststring.length; i++) {
			var c = teststring.charAt(i).toLowerCase();
			if (c != "a" & c != "b" & c != "c" & c != "d" & c != "e" & c != "f" & c != "g" & c != "h" & c != "i" & c != "j" & c != "k" & c != "l" & c != "m" & c != "n" & c != "o" & c != "p" & c != "q" & c != "r" & c != "s" & c != "t" & c != "u" & c != "v" & c != "w" & c != "x" & c != "y" & c != "z" & c != " "){return false;}
		}
		return true;
	}	
	
	function check_valid_contents(inputbox) {
		
		var teststring;
		var outputstring;
		teststring = trim(inputbox.toString())
		if (teststring == "") {
			
			return false;
		}
		if (isblank(teststring)) {
			
			return false;
		}
		outputstring = removeblank(teststring)	
		if (is_a_number(outputstring)) {
			
			return false;
		}
		if (outputstring.length < 2) {
			return false;
		}	
		
		return true;
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
	
	function isblank(inbox) {
		for (var i = 0; i <  inbox.length; i++) {
			var c = inbox.charAt(i)
			if (c != " "){		
				return false;
			}
		}
		return true
	}
	
	function removeblank(inbox) {
		var output = "";
		for( var i = 0; i <  inbox.length; i++) {
			var c = inbox.charAt(i);
			if (c != " "){		
				output = output + c;			
			}
		}
		return output;
	}
	
	function trim(str) {
   		if (str == "") {
			return str;
		}
		else {
			return str.replace(/^\s*|\s*$/g,"");
		}
	}
	
		
