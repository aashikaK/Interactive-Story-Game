<?php
session_start();
require 'db.php';
$message = '';

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql="SELECT * from users where username=? and password=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$username,$password]);
   $users=$stmt->fetch(PDO::FETCH_ASSOC);
   
   $_SESSION['user_id']=$users['id'];
   $_SESSION['username']=$users['username'];

    if($stmt->rowCount()>0){
        header("Location:index.php");
        exit;
    }
    else{
        $message = "Username or password do not match. Use correct credentials and try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Adventure Stories</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; font-family: Arial; }
        body {
            height: 100vh;
            background: url('register.png') no-repeat center center;
            background-size:cover;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }
        .overlay {
            background: rgba(0,0,0,0.7);
            padding: 40px;
            border-radius: 20px;
            width: 350px;
            text-align: center;
            box-shadow: 0 0 20px rgba(0,0,0,0.5);
        }
        h2 { margin-bottom: 20px; font-size: 32px; text-shadow: 2px 2px 5px #000; }
        input {
            width: 90%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 10px;
            border: none;
            font-size: 16px;
        }
        button {
            width: 95%;
            padding: 12px;
            margin-top: 15px;
            background: #e74c3c;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover { opacity: 0.8; }
        p.message { margin-top: 15px; font-size: 16px; color: #f1c40f; }
    </style>
</head>
<body>
    <div class="overlay">
        <h2>Login</h2>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>
