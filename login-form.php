

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login Form</title>
</head>
<body>
    <h1>Login Form</h1>
    <?php
    define("filepath", "data.txt");
    $userName1 = $password1 = "";
    $userNameErr1 = $passwordErr1 = "";

    $flag = false;
    $successfulMessage = $errorMessage = "";

    if($_SERVER['REQUEST_METHOD'] === "POST") {
        $userName1 = $_POST['userName1'];
        $password1 = $_POST['password1'];

        if(empty($userName1)) {
            $userNameErr1 = "Field can not be empty";
            $flag = true;
        }

        if(empty($password1)) {
            $passwordErr1 = "Field can not be empty";
            $flag = true;
        }


        if(!$flag) {
            $fileData = read();
            $data= json_decode($fileData);

            ;
            for ($i=0; $i <sizeof($data) ; $i++) { 
                if($userName1 === $data[$i]->Username and $password1 === $data[$i]->Password) {
                header("Location: welcome.html");
            }
            else{

                $errorMessage = "username or password is incorrect";
            }
            }
            
            
        }
        else {
            $errorMessage = "Please enter your username and password";
        }
    }

    function read() {
        $file = fopen(filepath, "r");
        $fz = filesize(filepath);
        $fr = "";
        if($fz > 0) {
            $fr = fread($file, $fz);
        }
        fclose($file);
        return $fr;
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

      <fieldset>
        <legend>Login</legend>
        <label for="userName1">Username<span style="color: red">*</span>:</label>
        <input type="text" id="userName1" name="userName1">
        <span style="color: red"><?php echo $userNameErr1; ?></span>
        <br><br>

        <label for="password1">Password<span style="color: red">*</span>:</label>
        <input type="password" id="password1" name="password1">
        <span style="color: red"><?php echo $passwordErr1; ?></span>
        <br><br>

    </fieldset>
    <br><br>

    <input type="submit" name="submit" value="Login">
</form>

<br>

<span style="color: green"><?php echo $successfulMessage; ?></span>
<span style="color: red"><?php echo $errorMessage; ?></span>
<br>

<a href="registration-form.php">Click to Register</a>

</body>
</html>