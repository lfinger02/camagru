
<?php include_once("includes/config/database.php");

$userIsLoggedIn = false;

if(!isset($_SESSION['userLoggedIn']))
{
  
  $userLoggedIn = false;

  echo "<!doctype html>
    <html lang='en'>
  <head>
    
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>

    
    <link rel='stylesheet' href='css/style.css'>

    <title>BubbleShare</title>
  </head>
  <body>
    <div class='header'>

        <button class='icon_header' style='
        padding: 18px;'><img class='img_header' src='images/icons/icon.svg'></button>
        <div class='header_title'>Bubble Share</div>
      
        
    </div>

    <div class='heightt'></div>
    <a class='requestLogin' href='index.php'>Login</a>
    <div class='feed'>
    ";

    

    $query = $conn->prepare("SELECT * FROM `post`");
    $query->execute();

    while ($results = $query->fetch(PDO::FETCH_ASSOC)) {

        $post_ID      = $results['post_id'];
        $uploaded_By  = $results['upload_by'];
        $uploadLink   = $results['upload_link'];
        $uploadDate   = $results['upload_date'];

     echo  " <div class='postCard'>
    <div class='cardHearder'>
    <div class='infoContainer'>
        <div class='userProfile'>
            <img src='images/post/$uploadLink.jpg' class='profile'>
        </div>
        <div class='nameConatiner'>$uploaded_By</div>
    </div>
    <div class='time'>$uploadDate</div>
    </div>
    <div class='imagePost'>
        <img src='images/post/$uploadLink.jpg' class='post'/>
    </div>

    <div class='bottomContainer'>
        <button id='$post_ID' class='reactiveButton'><img class='img_post' src='images/icons/like.svg'><span class='numCounter'>
        
        ";
        
        $query_likes = $conn->prepare("SELECT COUNT(post_id) As `likes` FROM `likes` WHERE post_id=$post_ID");
        $query_likes->execute();
        foreach($query_likes->fetchAll() AS $v)
                $likes = $v;
    echo $likes['likes'];
        
        echo " </span></button><button class='reactiveBut'><img class='img_post' src='images/icons/comment.svg'><span class='numCounter'>
        
        ";
        
        $query_likes = $conn->prepare("SELECT COUNT(post_id) As `comments` FROM `comments` WHERE post_id=$post_ID");
        $query_likes->execute();
        foreach($query_likes->fetchAll() AS $v)
                $comments = $v;
        echo $comments['comments'];
        
        echo "</span></button>
    </div>
    <div class='comments_section'>
    <div class='commentConatiner'><textarea id='comment_$post_ID' placeholder='Login to comment...' class='comment_input' disabled></textarea>
    <button id='$post_ID' class='submitComment' disabled>Login</button></div>
        
    <div id='updateCommentSection_$post_ID' class='commentScroll'>
    ";

    $query_fetchComment = $conn->prepare("SELECT * FROM `comments` WHERE post_id='$post_ID'");
    $query_fetchComment ->execute();

    
    while ($results = $query_fetchComment ->fetch(PDO::FETCH_ASSOC)) {
        $comment    = $results['comment'];
        $comment_by = $results['comment_by'];

        echo "<div class='comment_fromUsers'>
        <span class='usernameofcommenter'>$comment_by</span>  
        $comment
        </div>";
    }


    echo "
    </div>
    </div>
    
    
</div>";



    
    

    }

   echo "</div>";

    




    echo "

</body>
</html>";

}
else
{
  $userLoggedIn = true;
  $username_login = $_SESSION['userLoggedIn'];

  



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
    <input id="isUserLoggin" type="text" value="<?php
      if (isset($_SESSION['userLoggedIn']))
            echo "Yes";
        else
            echo "No";
    
    ?>"/>
    <input id="username" type="text" value="<?php echo $username_login;?>"/>
    <div class="header">

        <button class="icon_header" style="
        padding: 18px;"><img class="img_header" src="images/icons/icon.svg"></button>
        <div class='header_title'>Bubble Share</div>
        <button id='accountCall' class='icon_header'><img class='img_header' src='images/icons/account.svg'/></button>
        
    </div>

    <div class="topFilter"></div>

    <div class="feed">

        
        <?php

            $query = $conn->prepare("SELECT * FROM `post` ORDER BY upload_date DESC");
            $query->execute();

            while ($results = $query->fetch(PDO::FETCH_ASSOC)) {

                $post_ID      = $results['post_id'];
                $uploaded_By  = $results['upload_by'];
                $uploadLink   = $results['upload_link'];
                $uploadDate   = $results['upload_date'];

             echo  " <div class='postCard'>
            <div class='cardHearder'>
            <div class='infoContainer'>
                <div class='userProfile'>
                    <img src='images/post/$uploadLink.jpg' class='profile'>
                </div>
                <div class='nameConatiner'>$uploaded_By</div>
            </div>
            <div class='time'>$uploadDate</div>
            </div>
            <div class='imagePost'>
                <img src='images/post/$uploadLink.jpg' class='post'/>
            </div>

            <div class='bottomContainer'>
                <button id='$post_ID' class='reactiveButton'><img class='img_post' src='images/icons/like.svg'><span class='numCounter'>
                
                ";
                
                $query_likes = $conn->prepare("SELECT COUNT(post_id) As `likes` FROM `likes` WHERE post_id=$post_ID");
                $query_likes->execute();
                foreach($query_likes->fetchAll() AS $v)
                        $likes = $v;
            echo $likes['likes'];
                
                echo " </span></button><button class='reactiveBut'><img class='img_post' src='images/icons/comment.svg'><span class='numCounter'>
                
                ";
                
                $query_likes = $conn->prepare("SELECT COUNT(post_id) As `comments` FROM `comments` WHERE post_id=$post_ID");
                $query_likes->execute();
                foreach($query_likes->fetchAll() AS $v)
                        $comments = $v;
                echo $comments['comments'];
                
                echo "</span></button>
            </div>
            <div class='comments_section'>
            <div class='commentConatiner'><textarea id='comment_$post_ID' placeholder='write something...' class='comment_input'></textarea>
            <button id='$post_ID' class='submitComment'>comment</button></div>
                
            <div id='updateCommentSection_$post_ID' class='commentScroll'>
            ";

            $query_fetchComment = $conn->prepare("SELECT * FROM `comments` WHERE post_id='$post_ID'");
            $query_fetchComment ->execute();
    
            
            while ($results = $query_fetchComment ->fetch(PDO::FETCH_ASSOC)) {
                $comment    = $results['comment'];
                $comment_by = $results['comment_by'];
    
                echo "<div class='comment_fromUsers'>
                <span class='usernameofcommenter'>$comment_by</span>  
                $comment
                </div>";
            }


            echo "
            </div>
            </div>
            
        </div>";

        
       
            
            

            }

           echo "<div class='heightt'></div>";

            


        ?>



            <div id='profileBlock' class='edit_profileContainer'>
            <button id='close' class="close_button" style="
        padding: 18px;"><img class="img_close" src="images/icons/close.svg"></button>
            <div class='profileContainer'>
            <div class='header_profile'>Profile</div>

                <div class='profile_inputs'>
                      
                <?php
            $query_update = $conn->prepare("SELECT * FROM `users` WHERE username='$username_login'");
            $query_update->execute();

            while ($update = $query_update->fetch(PDO::FETCH_ASSOC)) {

                $username_u = $update['username'];
                $email_u    = $update['email'];
                $password_u = $update['password'];

                echo "
                
                <input id='changeUsername' placeholder='username' value='$username_u' type='text' class='input_update'/>
                <input id='changeEmail' placeholder='email' value='$email_u' type='email' class='input_update'/>
                <input id='changePassword' placeholder='password' value='$password_u' type='password' class='input_update'/>
                
                ";

               
            }
            
            
            ?>

                      <div class='notification'><input type="checkbox" id='mail_preference' name="notification" value="Yes" checked>Mail Notifications</div>
                      <button id='updateProfile' class='update_details'>update</button>
                      <button id='logout' class='update_details red'>Logout</button>
                      <div id='res'></div>
                </div>
  
            
            </div>

            </div>

            



    </div>
    <div id='postContainer' class='postsContainer'>
    <button id='close_2' class="close_button" style="
        padding: 18px;"><img class="img_close" src="images/icons/close.svg"> <?php echo $username_login;?></button>

            <div class='MyPostContainer'>

                <div class='myContainer'>My Post</div>

                <div class='posts'>

                <?php 

$query_myPost = $conn->prepare("SELECT * FROM `post` WHERE upload_by='$username_login'");
$query_myPost->execute();

while ($myPost = $query_myPost->fetch(PDO::FETCH_ASSOC)) {

    $post_id = $myPost['post_id'];
    $post    = $myPost['upload_link'];

    echo "<div id='del_post_$post_id' class='postContainer'>
    <img class='myImage' src='images/post/$post.jpg'>
    <button id='$post_id' class='delete_poo'><img class='delete_post' src='images/icons/close.svg'></button>
    </div>";

}

?>

                    



                </div>

            </div>

    </div>
   
            <p id='results'></p>
            
     <div class="footerApp">

        <button class="Footericons"></button>
        <button id='editPhoto' class="shareImageicons"><img class="img_footer" src="images/icons/icon_2.svg"></button>
        <button id='myPost' class="Footericons"></button>

     </div>
     

    <script>
    
    
    (function() {

        $editPhoto = document.getElementById('editPhoto');
        $isUserLoggin = document.getElementById('isUserLoggin').value;
        editPhoto.addEventListener("click", function(e){

        if ($isUserLoggin == "Yes") {

            window.location.href = 'editphoto.php';

            }
            else {

                alert("Please login to use this feature");

            }

        },false); 


            var like = document.getElementsByClassName("reactiveButton");
            var numCounter = document.getElementsByClassName("numCounter");
            
            Array.from(like).forEach(function(element) {
            element.addEventListener('click', function(e){
                var post_id  = element.getAttribute("id");
                var username = document.getElementById("username").value;
                

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'includes/classes/likePost.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                var results = document.getElementById('results');
                //results.innerHTML = this.responseText;
                    
                var currentValue = element.getElementsByTagName("span")[0].innerHTML;
                var new_val = 0;
                
            
                    if (this.responseText == "Liked Before")
                    {
                        new_val = parseInt(currentValue) - 1;

                        element.getElementsByTagName("span")[0].innerHTML = new_val;
                    } else {

                        new_val = parseInt(currentValue) + 1;
                        element.getElementsByTagName("span")[0].innerHTML = new_val;
                    }
               
                    

                };
                xhr.send('post_id=' + post_id + '&username='+ username);  

            });
        });

        var comment = document.getElementsByClassName("submitComment");

        Array.from(comment).forEach(function(element) {
            element.addEventListener('click', function(e){

                var post_id  = element.getAttribute("id");
                var username = document.getElementById("username").value;
                var commentMessage = document.getElementById("comment_" + post_id).value;
                var comment_id = document.getElementById("comment_" + post_id);

                if (commentMessage == "") {

                    

                } else {

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'includes/classes/comment.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                var results = document.getElementById('updateCommentSection_' + post_id);
                results.innerHTML = this.responseText;
                    
                comment_id.innerHTML="";
                
                };
                xhr.send('post_id=' + post_id + '&username='+ username + '&message=' + commentMessage);
                }


            });
        });

        $account = document.getElementById('accountCall');
        $profileBlock = document.getElementById('profileBlock');
        $account.addEventListener("click", function(e){

            profileBlock.style.display = 'block';

        });

        $close = document.getElementById('close');
        $close.addEventListener("click", function(e){

            profileBlock.style.display = 'none';

        });


        $logout = document.getElementById('logout');
        $logout.addEventListener("click", function(e){


            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'includes/classes/signOutUser.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (this.response == "Out")
                {
                    window.location.href='index.php';
                }
            };
            xhr.send();

        });
        
        $postContainer = document.getElementById('postContainer');
        $myPost = document.getElementById('myPost');
        $myPost.addEventListener("click", function(e){

            postContainer.style.display = 'block';

        });

        $close_2 = document.getElementById('close_2');
        $close_2.addEventListener("click", function(e){

            postContainer.style.display = 'none';

        });

        
        $update = document.getElementById('updateProfile');
        var errorControl = 0;
        $update.addEventListener("click", function(e){

            var mail_preference = document.getElementById('mail_preference');
            var wantEmails = true;

            if (mail_preference.checked)
            {
                wantEmails = true;
            } else {
                wantEmails = false;
            }

            var changeUsername = document.getElementById('changeUsername').value;
            var changeEmail    = document.getElementById('changeEmail').value;
            var changePassword = document.getElementById('changePassword').value;
            var username = document.getElementById("username").value;

            if (changeUsername == "" || changeUsername == " ")
            {
                document.getElementById("changeUsername").style.border = "thin solid #F44336";
                errorControl++;
            }

            if (changeEmail == "" || changeEmail == " ")
            {
                document.getElementById("changeEmail").style.border = "thin solid #F44336";
                errorControl++;
            }

            if (changePassword == "" || changePassword == " ")
            {
                document.getElementById("changePassword").style.border = "thin solid #F44336";
                errorControl++;
            }

            if (errorControl == 0)
            {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'includes/classes/updateInfo.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                var results = document.getElementById('res');
                results.innerHTML = this.responseText;
                    
                
                
                };
                xhr.send('previousUsername='+ username + '&username='+ changeUsername + '&email=' + changeEmail + '&password=' + changePassword + '&mail_preference=' + wantEmails);
            }

            errorControl=0;

            // || $changeEmail == "" || $changePassword == ""

        });


            var deleteMyPost = document.getElementsByClassName("delete_poo");
            
            
            Array.from(deleteMyPost).forEach(function(element) {
            element.addEventListener('click', function(e){
                var post_id  = element.getAttribute("id");

                var deletedPost = document.getElementById("del_post_" + post_id);
                
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'includes/classes/DeletePost.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {

                deletedPost.style.opacity = "0.5";
                    
                
                
                };
                xhr.send('post_id='+ post_id);
                

            });
        });


    
    })();
    
    
    
    </script>
  </body>
</html>

<?php

}

?>