<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registration Form</title>
</head>
<body>
    <h1>Registration Form</h1>
    <?php
        define("filepath", "data.txt");

        $firstName = $lastName = $dob = $gender = $religion = $presentAddress = $permanentAddress = $phone = $email = $website =
        $userName = $password = "";

        $firstNameErr = $lastNameErr = $dobErr = $genderErr = $religionErr = $emailErr = $userNameErr = $passwordErr = "";

        $flag = false;
        $successfulMessage = $errorMessage = "";

        if($_SERVER['REQUEST_METHOD'] === "POST") {
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $dob = $_POST['dob'];
            $gender = isset($_POST['gender']) ? $_POST['gender']:"";
            $religion = $_POST['religion'];
            $presentAddress = $_POST['presentAddress'];
            $permanentAddress = $_POST['permanentAddress'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $website = $_POST['website'];
            $userName = $_POST['userName'];
            $password = $_POST['password'];


            if(empty($firstName)) {
                $firstNameErr = "Field can not be empty";
                $flag = true;
            }

            if(empty($lastName)) {
                $lastNameErr = "Field can not be empty";
                $flag = true;
            }

            if(empty($dob)) {
                $dobErr = "Field can not be empty";
                $flag = true;
            }

            if(empty($gender)) {
                $genderErr = "Field can not be empty";
                $flag = true;
            }

            if(empty($religion)) {
                $religionErr = "Field can not be empty";
                $flag = true;
            }

            if(empty($email)) {
                $emailErr = "Field can not be empty";
                $flag = true;
            }

            if(empty($userName)) {
                $userNameErr = "Field can not be empty";
                $flag = true;
            }

            if(empty($password)) {
                $passwordErr = "Field can not be empty";
                $flag = true;
            }


            if(!$flag) {
                $fileData = read();

                if(empty($fileData)) {
                    $data[] = array("Firstname" => $firstName, "Lastname" => $lastName, "DOB" => $dob, "Gender" => $gender, "Religion" => $religion, "PresentAddress" => $presentAddress, "PermanentAddress" => $permanentAddress, "Phone" => $phone, "Email" => $email, "Website" => $website, "Username" => $userName, "Password" => $password);
                }
                else {
                    $data= json_decode($fileData);
                    array_push($data, array($firstName, "Lastname" => $lastName, "DOB" => $dob, "Gender" => $gender, "Religion" => $religion, "PresentAddress" => $presentAddress, "PermanentAddress" => $permanentAddress, "Phone" => $phone, "Email" => $email, "Website" => $website, "Username" => $userName, "Password" => $password));
                }


                $data_encode = json_encode($data);
                write("");
                $res = write($data_encode);
                if($res) {
                    $successfulMessage = "Sucessfully Registered.";
                }
                else {
                    $errorMessage = "Error! while Registering.";
                }
            }
        }

        function write($content) {
            $file = fopen(filepath, "w");
            $fw = fwrite($file, $content . "\n");
            fclose($file);
            return $fw;
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
            <legend>Basic Information</legend>
            <label for="firstName">First Name<span style="color: red">*</span>:</label>
            <input type="text" id="firstName" name="firstName">
            <span style="color: red"><?php echo $firstNameErr; ?></span>
            <br><br>

            <label for="lastName">Last Name<span style="color: red">*</span>:</label>
            <input type="text" id="lastName" name="lastName">
            <span style="color: red"><?php echo $lastNameErr; ?></span>
            <br><br>

            <label>Gender<span style="color: red">*</span>:</label>
            <input type="radio" id="male" name="gender" value="male">
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="female">
            <label for="female">Female</label>
            <input type="radio" id="others" name="gender" value="others">
            <label for="others">Others</label>
            <span style="color: red"><?php echo $genderErr; ?></span>
            <br><br>

            <label for="dob">DOB<span style="color: red">*</span>:</label>
            <input type="date" id="dob" name="dob">
            <span style="color: red"><?php echo $dobErr; ?></span>
            <br><br>

            <label for="religion">Religion<span style="color: red">*</span>:</label>
            <select id="religion" name="religion">
                <option value="islam">Islam</option>
                <option value="hinduism">Hinduism</option>
                <option value="buddhist">Buddhist</option>
                <option value="cristian">Cristian</option>
            </select>
            <span style="color: red"><?php echo $religionErr; ?></span>
        </fieldset>
        <br><br>

        <fieldset>
            <legend>Contact Information</legend>
            <label for="presentAddress">Present Address:</label>
            <textarea id="presentAddress" name="presentAddress"></textarea>
            <br><br>

            <label for="permanentaddress">Permanent Address:</label>
            <textarea id="permanentAddress" name="permanentAddress"></textarea>
            <br><br>

            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone">
            <br><br>

            <label for="email">Email<span style="color: red">*</span>:</label>
            <input type="email" id="email" name="email">
            <span style="color: red"><?php echo $emailErr; ?></span>
            <br><br>

            <label for="website">Website:</label>
            <input type="url" id="website" name="website">
            <br><br>

        </fieldset>
        <br><br>

        <fieldset>
            <legend>Account Information</legend>
            <label for="userName">Username<span style="color: red">*</span>:</label>
            <input type="text" id="userName" name="userName">
            <span style="color: red"><?php echo $userNameErr; ?></span>
            <br><br>

            <label for="password">Password<span style="color: red">*</span>:</label>
            <input type="password" id="password" name="password">
            <span style="color: red"><?php echo $passwordErr; ?></span>
            <br><br>

        </fieldset>
        <br><br>

        <input type="submit" name="submit" value="Register">
        <br><br>

    </form>

    <br>

    <span style="color: green"><?php echo $successfulMessage; ?></span>
    <span style="color: red"><?php echo $errorMessage; ?></span>

    <a href="login-form.php">Click to Login</a>

</body>
</html>