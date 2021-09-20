<?php

function check($username,$password){
    global $connection;
    $query = $connection->query("SELECT * FROM users WHERE USERNAME ='$username' AND PASSWORD = '$password'");
    if($query->num_rows>0){
        return true;
    }else{
        return false;
    }

}

function filter($post){
    if(is_array($post)){
        return array_map('filter',$post);
    }
    return htmlspecialchars(trim($post));
}

$_POST = array_map('filter',$_POST);

function post($name){
    if(isset($_POST[$name])){
        return $_POST[$name];
    }
}

if(isset($_POST['submit'])){
    if(isset($_POST['login_button'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        if(isset($username) && isset($password)){
            if(check($username,$password)){
                $_SESSION['username'] = $username;
                echo 'GİRİŞ BAŞARILI ADMİN SAYFASINA YÖNLENDİRİLİYORSUNUZ';
                header("Refresh:4;url=admin.php");
            }else{
                echo 'kullanıcı adı veya şifre yanlış';
            }

        }else{
            echo 'lütfen bütün bilgileri doldurunuz!';
        }

    }elseif(isset($_POST['register_button'])){
        $register_namesurname = $_POST['reg_namesurname'];
        $register_email = $_POST['reg_email'];
        $register_username = $_POST['reg_username'];
        $register_password = $_POST['reg_password'];
        $register_conf_password = $_POST['conf_reg_password'];

        if(isset($register_namesurname,$register_email,$register_username,$register_password,$register_conf_password)){
            if($register_password===$register_conf_password){
                global $connection;
                $query = $connection->query("INSERT INTO users (NAME_SURNAME,USERNAME,PASSWORD,EMAIL) VALUES('$register_namesurname','$register_username','$register_password','$register_email')");
                if($query){
                    echo 'KULLANICI BAŞARILI BİR ŞEKİLDE KAYDEDİLDİ';
                }else{
                    echo 'HATA!';
                }
            }else{
                echo 'lütfen şifre kısmını doğru bir şekilde doldurunuz';
            }
        }else{
            echo 'lütfen bilgileri eksiksiz doldurunuz';
        }
    }
}




?>


<!doctype html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="" method="post">
    <div style="float:left">
        <h1>Login</h1>
        Username:
        <input type="text" name="username" value="<?php echo post('username')?>">
        <br>
        Password:
        <input type="password" name="password">
        <br>
        <button type="submit" name="login_button">Login</button>
    </div>
    <div style="float:left;margin:auto 50px">
        <h1>Register</h1>
        Name Surname:
        <input type="text" name="reg_namesurname">
        <br>
        Email:
        <input type="text" name="reg_email">
        <br>
        Username:
        <input type="text" name="reg_username">
        <br>
        Password:
        <input type="password" name="reg_password">
        <br>
        Confirm Password:
        <input type="password" name="conf_reg_password">
        <br>
        <button type="submit" name="register_button">Register</button>
    </div>
    <input type="hidden" name="submit" value=1>
</form>
</body>
</html>
