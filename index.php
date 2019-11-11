
<?php 

session_start();
if(isset($_SESSION['userLoggedIn']))
{
  //echo "User is not logged in";
  header("Location: main.php");
}


?>


<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link rel="stylesheet" href="css/style.css">

    <title>BubbleShare</title>
  </head>
  <body>

   
      <div class= "AppTitle">Bubble Share</div>

      <div class="AppIcon_Conatiner">
      
            <img class="appIcon" src="images/icons/icon_2.svg"/>
      
      </div>

     
      <div class="mainConatiner">
     
      <div id='show1'>
          <div class="instruction">Sign In</div>
        <input id="login_username" autocomplete="false" class='loginRegister' type='text' placeholder='username' />
        <input id="login_password" autocomplete="false" class='loginRegister' type='password' placeholder='password' />
        
        <a class='forgot_pass' href='forgotPassword.php'>Forgot password</a>

        <div class="choiceConatiner">
            <button class='signButtons' id='loginUser'>login</button>
            <button class='signButtons' id='registerNew'>I'm still new</button>
        </div>
     </div>

     <div id='show2'>
          <div class="instruction">Register</div>
        <input id="regName" autocomplete="false" class='loginRegister' type='text'     placeholder='name' />
        <input id="regEmail" autocomplete="false" class='loginRegister' type='email'    placeholder='email' />
        <input id="regUsername" autocomplete="false" class='loginRegister' type='text'     placeholder='username' />
        <input id="regPassword" autocomplete="false" class='loginRegister' type='password' placeholder='password' />
        <input id="regRepassword" autocomplete="false" class='loginRegister' type='password' placeholder='re-password' />
        

        <div class="choiceConatiner">
            <button class='signButtons' id='registerUser'>Create</button>
            <button class='signButtons' id='login'>Already a User!</button>
        </div>
     </div>

      </div>

      <P id="results"></P>

      <!--div id='show1' class="text">1</div>
      <div id='show2' class="text 2">2</div-->

     <?php 
     
        include("html_includes/FootDecorate.html");
     
     ?>

     <script>
     
     (function() {
   
        var stillNewButton = document.getElementById("registerNew");
        var loginButton = document.getElementById("login");
        var createAccount = document.getElementById("registerUser");
        var logIn = document.getElementById("loginUser");
        var show1 = document.getElementById("show1");
        var show2 = document.getElementById("show2");

        

        stillNewButton.addEventListener("click", function(e){

            show2.style.display = 'block';
            show1.style.display = 'none';
            
        },false);

        loginButton.addEventListener("click", function(e){

            show1.style.display = 'block';
            show2.style.display = 'none';
            
        },false);

        createAccount.addEventListener("click", function(e){

            var regName       = document.getElementById('regName').value;
            var regEmail      = document.getElementById('regEmail').value;
            var regUsername   = document.getElementById('regUsername').value;
            var regPassword   = document.getElementById('regPassword').value;
            var regRepassword = document.getElementById('regRepassword').value;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'includes/classes/registerUser.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
              var results = document.getElementById('results');
              results.innerHTML = this.responseText;
            };
            xhr.send('regName=' + regName + '&regEmail='+ regEmail+ '&regUsername=' + regUsername + '&regPassword=' + regPassword + '&regRepassword=' + regRepassword);           
        
        },false);

        logIn.addEventListener("click", function(e){

            var login_username  = document.getElementById('login_username').value;
            var login_password  = document.getElementById('login_password').value;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'includes/classes/loginUser.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
              var results = document.getElementById('results');
              results.innerHTML = this.responseText;

              if (this.responseText == "You are logined in successful")
                {
                  window.location.href='main.php';
                }
            };
            xhr.send('login_username=' + login_username + '&login_password='+ login_password);           
        
        },false);
       
    })();
     
     </script>

    
  </body>
</html>