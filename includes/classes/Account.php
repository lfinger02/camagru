<?php


class Account {

    private $conn;

    private $errorArray = array();

    public function __construct($conn) {

        $this->conn = $conn;

    }

    
    public function register($regName, $regEmail, $regUsername, $regPassword, $regRepassword) {
        
        $this->validateFirstName($regName);
        $this->validateUsername($regUsername);
        $this->validateEmails($regEmail);
        $this->validatePasswords($regPassword, $regRepassword);

        $res = $this->conn->prepare("SELECT * FROM users WHERE username = '$regUsername'");
        $res->execute();
        $num = $res->rowCount();

        if (empty($this->errorArray)) {

            if ($num != 0)
                    echo "<div class='error_registerMessage'>Username already taken</div>";
                else
                    return $this->insertUserDetails($regName, $regEmail, $regUsername, $regPassword);

        } else {

            
            return (false);

        }

    }
    

    public function login($Lu, $Lp) {

    $Lp = hash("sha512", $Lp);

    $query = $this->conn->prepare("SELECT * FROM users WHERE username=:Lu AND password=:Lp");
    $query->bindParam(":Lu", $Lu);
    $query->bindParam(":Lp", $Lp);

    $query->execute();

    if($query->rowCount() == 1) {
      return true;
    } else {
      array_push($this->errorArray, Constants::$loginFailed);
      echo $this->errorMessageDisplay(Constants::$loginFailed);
      return false;
    }

  }


    public function uploadImage($Lu) {

        $hash_ImageName = $Lu. "_" .bin2hex(random_bytes(5));
        $current_date = date('Y-m-d');

        $query = $this->conn->prepare("INSERT INTO `post` (`post_id`, `upload_by`, `upload_link`, `upload_date`) VALUES (NULL, :Lu, :Hi, :Cd)");
        $query->bindParam(":Lu", $Lu);
        $query->bindParam(":Hi", $hash_ImageName);
        $query->bindParam(":Cd", $current_date);

        $query->execute();

        

        
        rename('../../images/uploads/goat_watermark.JPEG', '../../images/post/'. $hash_ImageName . '.jpg');

    }

    
        
        public function insertUserDetails($regName, $regEmail, $regUsername, $regPassword) {

        $regPassword = hash("sha512", $regPassword);
        //$profilePic = "none";

        $query = $this->conn->prepare("INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `verified`, `mail_preference`) VALUES (NULL, :regName, :regUsername , :regEmail , :regPassword , 'No', 'Yes')");


        $query->bindParam(":regName", $regName);
        $query->bindParam(":regUsername", $regUsername);
        $query->bindParam(":regEmail", $regEmail);
        $query->bindParam(":regPassword", $regPassword);
        //$query->bindParam(":pic", $profilePic);

        return $query->execute();

    }

   
    private function validateFirstName($Rn) {

        if (strlen($Rn) > 25 || strlen($Rn) < 2) {
            array_push($this->errorArray, Constants::$firstNameCharacters);

            echo $this->errorMessageDisplay(Constants::$firstNameCharacters);

        }

    }

    private function validateLastName($Rs) {

        if (strlen($Rs) > 25 || strlen($Rs) < 2) {
            array_push($this->errorArray, Constants::$lastNameCharacters);

            echo $this->errorMessageDisplay(Constants::$lastNameCharacters);


        }

    }

    private function validateUsername($Ru) {

        if (strlen($Ru) > 25 || strlen($Ru) < 5) {
            array_push($this->errorArray, Constants::$usernameCharacters);

            echo $this->errorMessageDisplay(Constants::$usernameCharacters);
            return;
        }

        $query = $this->conn->prepare("SELECT username From scp_users WHERE username=:Ru");
        $query->bindParam(":Ru", $Ru);
        $query->execute();

        if ($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$usernameTaken);

            echo $this->errorMessageDisplay(Constants::$usernameTaken);
        }

    }

    private  function validateEmails($Re) {



        if (!filter_var($Re, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailInvalid);

            echo $this->errorMessageDisplay(Constants::$emailInvalid);
            return;
        }

        $query = $this->conn->prepare("SELECT email From scp_users WHERE email=:Re");
        $query->bindParam(":Re", $Re);
        $query->execute();

        if ($query->rowCount() != 0) {
            array_push($this->errorArray, Constants::$emailTaken);

            echo $this->errorMessageDisplay(Constants::$emailTaken);
        }


    }


    private function validatePasswords($Rp, $R2p) {

        if ($Rp != $R2p) {
            array_push($this->errorArray, Constants::$passwordDoNotMatch);

            echo $this->errorMessageDisplay(Constants::$passwordDoNotMatch);
            return;
        }

        if (preg_match("/[^A-Za-z0-9]/", $Rp)) {
            array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
            echo $this->errorMessageDisplay(Constants::$passwordNotAlphanumeric);
            return;
        }


        if (strlen($Rp) > 30 || strlen($Rp) < 5) {
            array_push($this->errorArray, Constants::$passwordLength);
            echo $this->errorMessageDisplay(Constants::$passwordLength);

        }


    }

    /*
	 A function we have defined to collect all errors that might be encountered during the 
	 registeration process.
 	*/

    public function getError($error) {

        if (in_array($error, $this->errorArray)) {
            return "<span class='errorMessage'>$error</span>";
        }
    }

    private function errorMessageDisplay($error) {

        $this->errorDecorateBorderInput($error);
        return "<div class='error_registerMessage'>$error</div>";
    }

    private function errorDecorateBorderInput($error_input) {
        switch ($error_input) {
            case Constants::$firstNameCharacters:
                echo "<script>$('#register-name').css({'border':'2px solid #F44336'});</script>";
                break;
            case Constants::$lastNameCharacters:
                echo "<script>$('#register-surname').css({'border':'2px solid #F44336'});</script>";
                break;
            case Constants::$usernameCharacters:
                echo "<script>$('#register-username').css({'border':'2px solid #F44336'});</script>";
                break;
            case Constants::$usernameTaken:
                echo "<script>$('#register-username').css({'border':'2px solid #F44336'});</script>";
                break;
            case Constants::$emailInvalid:
                echo "<script>$('#register-email').css({'border':'2px solid #F44336'});</script>";
                break;
            case Constants::$emailTaken:
                echo "<script>$('#register-email').css({'border':'2px solid #F44336'});</script>";
                break;
            case Constants::$passwordDoNotMatch:
                echo "<script>$('#register-password').css({'border':'2px solid #F44336'});</script>";
                echo "<script>$('#register-re-password').css({'border':'2px solid #F44336'});</script>";
                break;
            case Constants::$passwordNotAlphanumeric:
                echo "<script>$('#register-password').css({'border':'2px solid #F44336'});</script>";
                break;
            case Constants::$passwordLength:
                echo "<script>$('#register-password').css({'border':'2px solid #F44336'});</script>";
                break;
        }
    }



}

?>