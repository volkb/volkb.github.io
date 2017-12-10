<?php

#HTML Code for the Login Button
$login = '  
  <div id="loginscreen">
  <span onclick="document.getElementById(\'loginscreen\').style.display=\'none\'" class="close" >&times;</span>
  <!-- Need to make a validation function for login -->
  <form class="modal-content-login animate" name="addForm" action="#">
        
      <label><b>Username</b></label>
      <input type="text" placeholder="Enter username" name="username">
        
      <label><b>Password</b></label>
      <input type="text" placeholder="Enter password" name="password">
      <button type="submit" class="loginto">Log In</button>
      <button type="button" class="signupto" onclick="document.getElementById(\'signupscreen\').style.display=\'block\'; document.getElementById(\'loginscreen\').style.display=\'none\';">Sign Up</button>
  </form>
  </div>   ';

#HTML Code for the Sign up Button
$signup =  '  
<div id="signupscreen" class="modal">
  <span onclick="document.getElementById(\'signupscreen\').style.display=\'none\'" class="close" title="Close Modal">&times;</span>
  <form class="modal-content-signup animate" name="addForm" action="/iit-project/resources/insert.php" method="post" onsubmit="validate(this);">
    <div class="container">

      <label><b>I Am A &nbsp;&nbsp; </b></label>
      <input type="radio" name="userType" value="entrepreneur" checked required> Entrepreneur&nbsp;&nbsp;&nbsp;
      <input type="radio" name="userType" value="investor"> Investor<br>


      <label><b>First Name</b></label>
      <input id="first_name" type="text" placeholder="Enter first name" name="f_name">

      <label><b>Last Name</b></label>
      <input id="last_name" type="text" placeholder="Enter last name" name="l_name">
        
      <label><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email">

      <label><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password">

      <label><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat Password" name="psw-repeat">
      <input type="checkbox" checked="checked"> Remember me
      <div class="g-recaptcha" data-sitekey="6LdvTjYUAAAAAGl-zzCuYleagZQD_hZueqcjvXyI"></div>
      <p class="terms" >By creating an account you agree to our <a href="Resources/TermsAndConditions.pdf">Terms & Privacy</a>.</p>

      <div class="clearfix">

        <button type="submit" class="signupbtn">Sign Up</button>
        <button type="button" onclick="document.getElementById(\'signupscreen\').style.display=\'none\'" class="cancelbtn">Cancel</button>
        
      </div>
    </div>
  </form>
</div> ';
echo $login;
echo $signup;
?>