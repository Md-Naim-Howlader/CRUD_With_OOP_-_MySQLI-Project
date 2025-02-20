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
        include "config.php";
        include "Classes/Database.php";

    ?>

    <main class="main">
    <?php
    //get spacific id from index.php Edit button
        $id = $_GET['id'];
        $db = new Database();

        $query = "SELECT * FROM  tbl_user WHERE id=$id";

        $getData = $db->selectData($query)->fetch_assoc();

        if(isset($_POST['update'])) {
            $name = trim(mysqli_real_escape_string($db->link, $_POST['name']));
            $email = trim(mysqli_real_escape_string($db->link, $_POST['email']));
            $skill = trim(mysqli_real_escape_string($db->link, $_POST['skill']));


            if($name === '' || $email === '' || $skill === '') {
                $error = 'field must not be empty!';
            } else {

                $query = "UPDATE tbl_user
                SET
                 name = '$name',
                  email='$email',
                   skill='$skill'
                    WHERE id = $id" ;
                $create = $db->updateData($query);
            }
        }

    ?>
     <?php
         if(isset($error)) {
            echo "<span style='color: red;'>".$error."</span>";
        }
        ?>
   <form  action="update.php?id='<?php echo $id?>'" method="post">
    <table >
        <tr>
            <td>Name:</td>
            <td><input required autofocus type="text"  name="name" value="<?php echo $getData['name']?>"></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><input required type="email" name="email" value="<?php echo $getData['email']?>"></td>
        </tr>
        <tr>
            <td>Skill:</td>
            <td><input required type="text"  name="skill" value="<?php echo $getData['skill']?>"></td>
        </tr>
        <tr>

            <td></td>
            <td>
                <input type="reset" value="Clear">
                <input type="submit" name="update" value="Update">
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