<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
    <style>
        .Container
        {
            margin-top: 100px;
            margin-left: 450px;
            width: 500px;
            height: 530px;
            border-color: black;
            border-width: 3px;
            border-style: solid;
        }
        .field
        {
            margin-left: 50px;
            margin-top: 8px;
            margin-bottom: 8px;
        }
        label
        {
            margin-left: 30px;
        }
        .submit
        {
            margin-left: 150px;
            margin-top: 5px;
            width: 80px;
            padding: 5px;
            background-color: lightblue;
            font-size: 20px;
            border-style: none;
        }
        .error
        {
            color: red;
        }
        input
        {
            padding: 3px;
        }
        a
        {
            text-decoration: none;
            margin-left: 20px;

        }
        
    </style>
</head>
<body>
    <?php
    $fnameErr = $lnameErr= $emailErr = $genderErr = $phoneErr= $dobErr= $designationErr="";
    $fname = $lname= $dob= $email = $gender = $phone = $designation = $hobbies="";
        if ($_SERVER["REQUEST_METHOD"]== "POST")
        {
            if (empty($_POST['firstname']))
            {
               $fnameErr ="First Name Is Required!";
            }
            else
            {
                $fname= $_POST['firstname'];
                if (!preg_match("/^[a-zA-Z-' ]*$/",$fname)) {
                    $fnameErr = "Only letters and white space allowed";
                  } 
            }
            if (empty($_POST['lastname']))
            {
               $lnameErr ="Last Name Is Required !";
            }
            else
            {
                $lname= $_POST['lastname'];
                if (!preg_match("/^[a-zA-Z-' ]*$/",$lname)) {
                    $lnameErr = "Only letters and white space allowed";
                  } 
            }
            if (empty($_POST['email']))
            {
               $emailErr ="Email Is Required !";
            }
            else
            {
                $email= $_POST['email'];
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $emailErr = "Insert valid email!";
                  } 
            }
            if (empty($_POST['dob']))
            {
                $dobErr = "Date of birth is required";
            }
            else
            {
                $dob = $_POST['dob'];
                $date = date("d-m-y");
                if ($dob >= $date)
                {
                    $dobErr = "Date of Birth should be less than " . $date;
                }
            }
            if (empty($_POST['phone']))
            {
                $phoneErr = "Phone Number is required";
            }
            else
            {
                $phone = $_POST['phone'];
                if (!preg_match("/^[1-9][0-9]{10}$/",$phone)) {
                    $phoneErr = "Enter valid Phone Number";
                }
            }
            if (empty($_POST['designation'])) {
                $designationErr = "Designation is required";
            }
            else
            {
                $designation = $_POST['designation'];
            }
            if (empty($_POST['gender']))
            {
                $genderErr = "Gender is required";
            }
            else
            {
                $gender = $_POST['gender'];
            }
            if (empty($_POST['hobbies']))
            {
                $hobbies = " ";
            }
            else
            {
                $hobbies = implode(",", $_POST['hobbies']);
            }

            $conn = mysqli_connect("localhost", "root", "root", "testing");
            if ($conn)
            {
                $sql="INSERT INTO user(FirstName,LastName,Email,Dob,Phone,Designation,Gender,Hobbies) VALUES('$fname','$lname','$email','$dob','$phone','$designation','$gender','$hobbies');";
                if (mysqli_query($conn,$sql))
                {
                    echo "<script>alert('Successfully Submitted.');</script>";  
                }
                else
                {
                   
                    echo mysqli_error($conn);
                }
            }
            else
            {
                echo "<script>alert('Error in Connection.');</script>";
            }
            mysqli_close($conn);

        }
    ?>
    <div class="Container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" >
        <label for="First Name">First Name</label>
            <div class="field"><input type="text" name="firstname"><span class="error"><?php echo $fnameErr;?></span></div>
            <label for="Last Name">Last Name</label>
            <div class="field"><input type="text" name="lastname"> <span class="error"> <?php echo $lnameErr;?></span></div>
            <label for="Email">Email</label>
            <div class="field"><input type="Email" name="email"><span class="error"><?php echo $emailErr;?></span></div>
            <label for="DOB">Date Of Birth</label>
            <div class="field"><input type="date" name="dob"><span class="error"><?php echo $dobErr;?></span></div>
            <label for="Phone">Phone</label>
            <div class="field"><input type="text" name="phone"><span class="error"><?php echo $phoneErr;?></span></div>
            <label for="Designation">Designation</label>
            <div class="field"><input type="text" name="designation"><span class="error"><?php echo $designationErr;?></span></div>
            <label for="gender">Gender:</label>
            <div class="field"><input type="Radio" name="gender" value="Male">Male  <input type="radio" name="gender" value="Female">Female<span class="error"><?php echo $genderErr;?></span></div>
            <label for="Hobbies">Hobbies:</label>
            <div class="field"><input type="checkbox" name="hobbies[]" value="Singing">Singing  <input type="checkbox" value="Dancing" name="hobbies[]">Dancing  <input type="checkbox" name="hobbies[]" value="Reading" >Reading <input type="checkbox" value="Poetry" name="hobbies[]">Poetry </div>
           <input type="submit" name="submit" class="submit" value="Submit">
           <a href="show.php">View data</a>
        </form>
    </div>
</body>
</html>