<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show</title>
    <style>
        table,th,td
        {
           border: 1px solid black;
           border-collapse: collapse;
        }
    </style>
</head>
<body>
    <?php 
         $conn = mysqli_connect("localhost", "root", "root", "testing");
         if ($conn)
         {
             $sql = "SELECT * FROM user;";
             $result = mysqli_query($conn,$sql);
             ?>
              <table>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Date of Birth</th>
                            <th>Phone</th>
                            <th>Designation</th>
                            <th>Gender</th>
                            <th>Hobbies</th>
                        </tr>
                        <?php
             if (mysqli_num_rows($result)>0)
             {
                 while ($row = mysqli_fetch_assoc($result))
                 {
                   
                       echo "<tr>
                            <td>".$row['FirstName']."</td>
                            <td>".$row['LastName']."</td>
                            <td>".$row['Email']."</td>
                            <td>".$row['Dob']."</td>
                            <td>".$row['Phone']."</td>
                            <td>".$row['Designation']."</td>
                            <td>".$row['Gender']."</td>
                            <td>".$row['Hobbies']."</td>
                        </tr>";
                 }
             }
         }
         else
         {
            echo "<script>alert('Error in Connection.');</script>";
         }
    ?>
              </table>
</body>
</html>