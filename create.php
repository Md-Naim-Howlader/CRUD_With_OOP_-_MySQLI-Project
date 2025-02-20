<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD With OOP and mysqli in PHP</title>
   <link rel="stylesheet" href="style/style.css">
</head>
<body>

<div class="container">
    <?php
        include "inc/header.php";
        include "Classes/Database.php";
        include "config.php";

    ?>

    <main class="main">
    <?php

        $db = new Database();
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])){
            $name = mysqli_real_escape_string($db->link, $_POST['name']);
            $email = mysqli_real_escape_string($db->link, $_POST['email']);
            $skill = mysqli_real_escape_string($db->link, $_POST['skill']);

            if($name == "" || $email == "" || $skill == "") {
                $error = "Field Must not be empty";

            } else if(strlen($name) < 2) {
                 $error = "Name must be atleast 2 charecters";


            }else if(filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
                 $error = "Invalid E-mail address!";

            }

            // insert query
                $query = "INSERT INTO tbl_user(name, email, skill) VALUES ('$name','$email','$skill')" ;
                $create = $db->insertData($query);

        }

    ?>
     <?php
         if(isset($error)) {
            echo "<span style='color: red;'>".$error."</span>";
        }
        ?>
   <form action="create.php" method="post">
    <table >
        <tr>
            <td>Name:</td>
            <td><input type="text"  name="name" placeholder="Please enter name"></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><input type="email" name="email"  placeholder="Please enter email"></td>
        </tr>
        <tr>
            <td>Skill:</td>
            <td><input type="text"  name="skill" placeholder="Please enter skill"></td>
        </tr>
        <tr>

            <td></td>
            <td>
                <input type="reset" value="Clear">
                <input type="submit" name="create" value="Create">
            </td>
        </tr>
    </table>
   </form>
    <a class="btn btn-primary" href="index.php"><- Go Back</a>
    </main>
        <?php include 'inc/footer.php'?>
</div>
</body>
</html>