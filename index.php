<?php 

$db = mysqli_connect('localhost', 'root', '', 'simple_crud');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>I Change the Title</title>
    <style>
        *{
            margin: 0;
        }
        input{
            margin: 10px;
            padding: 10px;
        }
        p{
            margin: 10px;
        }

        table{
            margin: 10px;
        }
    </style>
</head>
<body>
    


<form method="POST">

    <input type="text" name="username" placeholder="Enter Name"><br>
    <input type="text" name="number" placeholder="Enter Number"><br>
    <input type="submit" value="Click to INSERT" name="add_btn">

</form>
<?php 

if(isset($_POST['add_btn'])){

    $username = $_POST['username'];
    $number   = $_POST['number'];

    $insert = mysqli_query($db, "INSERT INTO table_name(username, number) VALUES('$username', '$number') ");

    if($insert){
        echo "<p>Data Inserted!</p>";
    }else{
        echo "<p>Something Went Wrong!</p>";
    }

}


?>



<hr>


<table border="1" width="98%">
<tr>
    <th>No</th>
    <th>Username</th>
    <th>Number</th>
    <th>Action</th>
</tr>
<?php 


$select = mysqli_query($db, "SELECT * FROM table_name");
if(mysqli_num_rows($select)){

    $count = 0;
    while($row = mysqli_fetch_assoc($select)){

        $username = $row['username'];
        $number   = $row['number'];
        $count++;

        ?>


<tr>
    <td><?php echo $count; ?></td>
    <td><?php echo $username; ?></td>
    <td><?php echo $number; ?></td>
    <td>
        <a href="index.php?remove=<?php echo $row['id']; ?>">Remove</a>
        <a href="index.php?edit=<?php echo $row['id']; ?>">Edit</a>
    </td>
</tr>


        <?php

    }

}


?>
</table>




<?php 


if(isset($_GET['edit'])){

    $edit_id = $_GET['edit'];
    $get_data = mysqli_query($db, "SELECT * FROM table_name WHERE id = '$edit_id' ");
    if(mysqli_num_rows($get_data)){

        $fetch = mysqli_fetch_assoc($get_data);
        $username_edit = $fetch['username'];
        $number_edit   = $fetch['number'];


        ?>

        <form action="" method="post">
            <input type="text" name="username" value="<?php echo $username_edit ?>" required><br>
            <input type="text" name="number" value="<?php echo $number_edit ?>" required><br>
            <input type="submit" value="Click to UPDATE" name="update_btn">
        </form>
        <?php 
        
        if(isset($_POST['update_btn'])){

            $username = $_POST['username'];
            $number   = $_POST['number'];

            $update = mysqli_query($db, "UPDATE table_name SET username = '$username', number = '$number' WHERE id = '$edit_id' ");
            if($update){

                header("Location: index.php");

            }

        }
        
        
        ?>


        <?php



    }

}


?>















<?php 


// Remove Code / Delete Code
if(isset($_GET['remove'])){

    $remove_id = $_GET['remove'];
    $delete = mysqli_query($db, "DELETE FROM table_name WHERE id = '$remove_id' ");
    if($delete){

        header("Location: index.php");

    }

}


?>
</body>
</html>
