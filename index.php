<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD With OOP and mysqli in PHP</title>
    <link rel="stylesheet" href="./style/style.css">
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
         if(isset($_GET['msg'])) {?>
            <span class="insert"><?php echo $_GET['msg']?></span>

        <?php }?>
        <?php
          $db =  new Database();
          $query = "SELECT * FROM  tbl_user ORDER BY id";
          $read = $db->selectData($query);
        ?>
        <table class="table_one">
            <tr>
                <th>Serial</th>
                <th>Name</th>
                <th>Email</th>
                <th>Skill</th>
                <th>Action</th>
            </tr>
            <?php

            if($read) {?>
            <?php

                $slNo = 0;
                while($row = $read->fetch_assoc()) {
                    $slNo++;
            ?>
                <tr>
                    <td><?php echo $slNo; ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['skill'] ?></td>
                    <td>
                        <a class="btn btn-success" href="update.php?id=<?php echo urlencode($row['id'])?>">Edit</a>
                        <a onClick='return  confirm("Are You Want to Delete <?php echo $row['name']; ?> Data ?")' class="btn btn-danger" href="delete.php?id=<?php echo urlencode($row['id'])?>">Delete</a>
                    </td>
                </tr>
            <?php  } } else { echo "Data Not Found!";} ?>
        </table>
    <a href="create.php" class="btn btn-primary">Create User</a>

    </main>
        <?php include 'inc/footer.php'?>
</div>
</body>
</html>