function validate(formObj) {
    /*generate variables to be sent to the insert.php upon validation*/
    var f_name_ = document.getElementById("first_name").value;
    var l_name_ = document.getElementById("last_name").value;
    var email_ = document.getElementById('email').value;
    var password_ = document.getElementById('password').value;
    var type_ = document.getElementById('userType').value;
  // put your validation code here
  // it will be a series of if statements
  var false_count = 0;
    var focusText= "";
    var focusSet = 0;
  if (formObj.f_name.value == "" || formObj.f_name.value == "Enter first name") {
    focusText += "You must enter a first name \n";
    if(focusSet ===0){
    formObj.f_name.focus();
    /*return false;*/
      focusSet =1;
      document.getElementById("first_name").style.borderColor = "red";
    }
  if(invalidCheck(formObj.f_name.value) == false){
      formObj.f_name.focus();
    }
  }
  if (formObj.l_name.value == "" || formObj.l_name.value == "Enter last name") {
    focusText += "You must enter a Last Name name \n";
    if(focusSet ===0){
    formObj.l_name.focus();
    /*return false;*/
      focusSet = 1;
      document.getElementById("l_name").style.borderColor = "red";
    }
  }
  if (formObj.email.value == "" || formObj.l_name.value == "Enter Email") {
    focusText += "You must enter an email \n";
    if(focusSet ===0){
    formObj.email.focus();
    /*return false;*/
      focusSet = 1;
      document.getElementById("email").style.borderColor = "red";
    }
  }
  if (formObj.password.value == "" || formObj.l_name.value == "Enter Password") {
    focusText += "You must enter an 8-digit password \n";
    if(focusSet ===0){
    formObj.password.focus();
    /*return false;*/
      focusSet = 1;
      document.getElementById("password").style.borderColor = "red";
    }
  }
  if (formObj.psw_repeat.value == "" || formObj.psw_repeat.value == "Repeat Password" || formObj.psw_repeat.value != formObj.password.value) {
    focusText += "Passwords do not match \n";
    if(focusSet ===0){
    formObj.psw_repeat.focus();
    /*return false;*/
      focusSet = 1;
      document.getElementById("psw_repeat").style.borderColor = "red";
    }
  }
    if(focusSet === 1){
        alert(focusText);
        return false;
        
    }
    else{
        return true;
    }
} 