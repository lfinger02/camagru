
<?php include_once("includes/config/database.php") ?>
<?php 

session_start();
if(!isset($_SESSION['userLoggedIn']))
{
  header("Location: main.php");
} 
else {

$hash_imageName = $_SESSION['userLoggedIn']. "_" .bin2hex(random_bytes(5));
$session_username = $_SESSION['userLoggedIn'];

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
  <input id="current_username" type="hidden" value="<?php echo $session_username; ?>">
    
    <div class="headerEdit">

        <button id="back" class="editPhoto">Back</button>
        <button id="save_image" class="editPhoto">Save</button>

    </div>

    <div class="topMimic"></div>

    <video id='camera' class="videoStream">

    
    </video>

    <div id='stickers' class="StickersHolder">
        <button id="disguise" class="stickerContainer">
            <img class="sticker" src="images/stickers/disguise.png" />
        </button>
        <button id="glass" class="stickerContainer">
            <img class="sticker" src="images/stickers/glass.png" />
        </button>
        <button id="happy" class="stickerContainer">
            <img class="sticker" src="images/stickers/happy.png" />
        </button>
        <button id="like" class="stickerContainer">
            <img class="sticker" src="images/stickers/like.png" />
        </button>
        <button id="skull" class="stickerContainer">
            <img class="sticker" src="images/stickers/skull.png" />
        </button>
        <button id="snorkel" class="stickerContainer">
            <img class="sticker" src="images/stickers/snorkel.png" />
        </button>
    </div>

      
      <a id='retake' class='retake' href='editphoto.php'>
        Retake
      </a>

        <p id="results"></p>

    
    <script>
const vid = document.querySelector('video');
var sticker = "disguise.png";
navigator.mediaDevices.getUserMedia({video: true}) // request cam
.then(stream => {
  vid.srcObject = stream; // don't use createObjectURL(MediaStream)
  return vid.play(); // returns a Promise
}).then(()=>{ // enable the button
  const btn = document.getElementById("disguise");
  btn.disabled = false;
  btn.onclick = e => {
    takeASnap()
    .then(download);
    removeStaff();
  };

  const btn2 = document.getElementById("glass");
  btn2.disabled = false;
  btn2.onclick = e => {
    sticker = "glass.png"
    takeASnap()
    .then(download);
    removeStaff();
  };

  const btn3 = document.getElementById("happy");
  btn3.disabled = false;
  btn3.onclick = e => {
    sticker = "happy.png"
    takeASnap()
    .then(download);
    removeStaff();
  };

  const btn4 = document.getElementById("skull");
  btn4.disabled = false;
  btn4.onclick = e => {
    sticker = "skull.png"
    takeASnap()
    .then(download);
    removeStaff();
  };

  const btn5 = document.getElementById("snorkel");
  btn5.disabled = false;
  btn5.onclick = e => {
    sticker = "snorkel.png"
    takeASnap()
    .then(download);
    removeStaff();
  };

  const btn6 = document.getElementById("like");
  btn6.disabled = false;
  btn6.onclick = e => {
    sticker = "like.png"
    takeASnap()
    .then(download);
    removeStaff();
  };

  function removeStaff(){
    rm1 = document.getElementById("camera");
    rm2 = document.getElementById("stickers");
    rm3 = document.getElementById("retake");
    
    rm1.style.display = 'none';
    rm2.style.display = 'none';
    rm3.style.display = 'flex';
  }

});

function takeASnap(){
  const canvas = document.createElement('canvas'); // create a canvas
  const ctx = canvas.getContext('2d'); // get its context
  canvas.width = vid.videoWidth; // set its size to the one of the video
  canvas.height = vid.videoHeight;
  ctx.drawImage(vid, 0,0); // the video
  return new Promise((res, rej)=>{
    canvas.toBlob(res, 'image/jpeg'); // request a Blob from the canvas
  });
}
function download(blob){
  // uses the <a download> to download a Blob
  let a = document.createElement('a'); 
  a.href = URL.createObjectURL(blob);
  a.download = 'screenshot.jpg';
  var tempImgUrl = document.body.appendChild(a);
  a.click();

  var myTimer = setInterval(function(){ 
  
    var xhr = new XMLHttpRequest();
            xhr.open('POST', 'includes/classes/editPhoto.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
              var results = document.getElementById('results');
              results.innerHTML = this.responseText;
            };
            xhr.send('imageChoosen=' + sticker + '&imageTempUrl=' + tempImgUrl);  
            clearInterval(myTimer);
  }, 1000);
  
}

var save = document.getElementById("save_image");
save.addEventListener("click", function(e){

var login_username  = document.getElementById('current_username').value;
var xhr = new XMLHttpRequest();
xhr.open('POST', 'includes/classes/uploadImage.php', true);
xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
xhr.onload = function () {
  var results = document.getElementById('results');
  results.innerHTML = this.responseText;
};
xhr.send('login_username=' + login_username);           

},false);

var back = document.getElementById("back");
back.addEventListener("click", function(e){

  window.location.href = "main.php";

},false);

/*var disguise = document.getElementById("disguise");
disguise.addEventListener("click", function(e){

                     
        

},false);*/

</script>
  </body>
</html>

<?php

}

?>