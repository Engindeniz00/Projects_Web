<?php
include 'db.php';
echo 'burası admin sayfası';
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    global $connection;
    $query = $connection->query("DELETE FROM users WHERE ID='$id'");
    if ($query) {
        echo 'Kullanıcı Silindi';
        header("location:admin.php");
    } else {
        echo 'HATA';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<table border="2">
    <tr>
        <th>ID</th>
        <th>NAME SURNAME</th>
        <th>USER NAME</th>
        <th>PASSWORD</th>
        <th>EMAIL</th>
        <th>DELETE</th>
        <th>UPDATE</th>
    </tr>
    <?php
    global  $connection;
    $query =$connection->query("SELECT * FROM users");
    $count= 0;
    while($data = mysqli_fetch_array($query)){
        ?>
        <tr>
            <td>
                <input type="text" name="ColumnId" id="clmnID" value="<?php echo $data['ID'];?>">
            </td>
            <td>
                <input type="text" name="ColumnNameSurname" id="clmnNameSurname" value="<?php echo $data['NAME_SURNAME'];?>">
            </td>
            <td>
                <input type="text" name="ColumnUsername" id="clmnUserame" value="<?php echo $data['USERNAME'];?>">
            </td>
            <td>
                <input type="text" name="ColumnPassword" id="clmnPassword" value="<?php echo $data['PASSWORD'];?>">
            </td>
            <td>
                <input type="text" name="ColumnEmail" id="clmnEmail" value="<?php echo $data['EMAIL'];?>">
            </td>
            <td><a href="admin.php?id=<?php echo $data['ID'];?>">SİL</a></td>
            <td><a href="edit.php?id=<?php echo $data['ID'];?>">GÜNCELLE</a></td>
        </tr>

        <?php
        $count++;
    }
    ?>
</table>

<?php
echo '<br>';
echo '<a href="logout.php">ÇIKIŞ</a>';
echo '<br>';
?>

</body>
</html>