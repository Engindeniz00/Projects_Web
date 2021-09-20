<?php
include 'db.php';
global $connection;
$id = $_GET['id'];
$query = $connection->query("SELECT * FROM users WHERE id ='$id'");
$data = mysqli_fetch_array($query);

if(isset($_POST['update'])){
    global $connection;
    $new_namesurname = $_POST['update_namesurname'];
    $new_username = $_POST['update_username'];
    $new_password = $_POST['update_password'];
    $new_email = $_POST['update_email'];

    $edit = $connection->query("UPDATE users SET NAME_SURNAME ='$new_namesurname',USERNAME='$new_username',PASSWORD='$new_password',EMAIL='$new_email' WHERE ID='$id'");

    if($edit){
        mysqli_close($connection);
        echo 'Başarılı bir şekilde güncellendi';
        header("Refresh:3;url=admin.php");
        exit();
    }else{
        mysqli_error();
    }

}

?>


<h1>UPDATE DATA</h1>
<form method="post">
    Name Surname
    <input type="text" name="update_namesurname" value="<?php echo($data['NAME_SURNAME'])?>">
    <br>
    Username
    <input type="text" name="update_username" value="<?php echo($data['USERNAME'])?>">
    <br>
    Password
    <input type="text" name="update_password" value="<?php echo($data['PASSWORD'])?>">
    <br>
    Email
    <input type="text" name="update_email" value="<?php echo($data['EMAIL'])?>">
    <br>
    Güncelle
    <input type="submit" name="update" value="Update">
</form>