<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link rel="stylesheet" href="css/style.css">

    <title>ForgotPassword</title>
  </head>
  <body>
  <div class= "AppTitle">Bubble Share</div>

      <div class="AppIcon_Conatiner">
      
            <img class="appIcon" src="images/icons/icon_2.svg"/>
      
      </div>
<?php
    $crypted_token = $_GET['reset'];

    if (empty($crypted_token))
    {

        echo 
        
        "
        
        
        <div class='mainConatiner'>
     
      <div id='show1'>
          <div class='instruction'>Please enter your username</div>
        <input id='login_username' autocomplete='false' class='loginRegister' type='text' placeholder='username' />
    
        <div class='choiceConatiner'>
            <button class='signButtons' id='restPassword'>send</button>
        </div>
     </div>

     </div>
        
     <script>
    
     var restPassword = document.getElementById('restPassword');
     restPassword.addEventListener('click', function(e){
 
     var username  = document.getElementById('login_username').value;
     var xhr = new XMLHttpRequest();
     xhr.open('POST', 'includes/classes/forgotPassword.php', true);
     xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
     xhr.onload = function () {
     var results = document.getElementById('results');
     results.innerHTML = this.responseText;
 
     /*if (this.responseText == 'You are logined in successful')
     {
       window.location.href='main.php';
     }*/
 
 };
 xhr.send('username=' + username);           
 
 },false);
     
     </script>
        
        
        ";
       
    } else {

    list($crypted_token, $enc_iv) = explode("::", $crypted_token);
    $cipher_method = 'aes-128-ctr';
    $enc_key = openssl_digest(php_uname(), 'SHA256', TRUE);
    $token = openssl_decrypt($crypted_token, $cipher_method, $enc_key, 0, hex2bin($enc_iv));
    unset($crypted_token, $cipher_method, $enc_key, $enc_iv);
        
      echo 
      "
      
      <div class='mainConatiner'>
      <input type='hidden' id='username' value='$token'/>
      <div id='show1'>
          <div class='instruction'>Enter new password</div>
        <input id='password' autocomplete='false' class='loginRegister' type='password' placeholder='password' />
        <input id='re_password' autocomplete='false' class='loginRegister' type='password' placeholder='re-password' />
    
        <div class='choiceConatiner'>
            <button class='signButtons' id='changePassword'>Change</button>
        </div>
     </div>

     </div>
      
      ";


    }

?>
    <div id='results'></div>

    <script>

    

    
    
    var changePassword = document.getElementById('changePassword');
    changePassword.addEventListener('click', function(e){
      
    var password     = document.getElementById('password').value;
    var re_password  = document.getElementById('re_password').value;

    if (password != re_password || password == "" || password == " ")
    {
      alert("Passwords Don't Match");
    } else {

    var username     = document.getElementById('username').value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'includes/classes/changePassword.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
    var results = document.getElementById('results');
    results.innerHTML = this.responseText;

    if (this.responseText == 'redirecting')
    {
      alert("Password Changed Successfully");
      window.location.href='index.php';
    }
    }
    xhr.send('username=' + username + '&password=' + password);       
};
    

},false);
    
    </script>
    
</body>
</html>