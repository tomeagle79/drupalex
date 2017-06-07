<!--	
	function validate() {
	  	var username = trim(document.Login_Form.Username.value)  
		if (username.length < 1 ) { 		
			alert("Please complete the Username");
			document.Login_Form.Username.focus();
	        return false;
		}
	
		if (trim(document.Login_Form.Password.value).length < 1) {
    		alert("Please complete the Password");
	  		document.Login_Form.Password.focus();
	  		return false;
    	}	
		
		return true;
	}
		
	function trim(str) {	
   		return str.replace(/^\s*|\s*$/g,"");
	}
	
//-->