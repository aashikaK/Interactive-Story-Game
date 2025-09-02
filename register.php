<?php
require 'db.php';
$message = '';

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql="SELECT * from users where username=?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$username]);
    $users= $stmt->fetch(PDO::FETCH_ASSOC);

    if($users){
        $message = "Error: Username might already exist!";
    }
    else{
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $password]);
                $message = "User registered successfully! <a href='login.php' style='color:white;'>Login Now</a>" ;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - Adventure Stories</title>
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
        p.login-link { margin-top: 20px; }
        p.login-link a { color: #3498db; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <div class="overlay">
         <?php if($message) echo "<p class='message'>$message</p>"; ?>
        <h2>Register</h2>
        <form method="post" onSubmit="return validate()">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" id="pw" placeholder="Password" required>
            <p id="error-msg" style="color:red;"></p>
            <button type="submit" name="register" >Create Account</button>
        </form>
        <p class="login-link">Already have an account? <a href="login.php">Login here</a></p>
    </div>

    <script>
        function validate(){
            let pw= document.getElementById("pw").value;
             let regex = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])/;

    // Explanation: 
    // (?=.*[A-Z]) → at least 1 uppercase
    // (?=.*\d)   → at least 1 number
    // (?=.*[!@#$%^&*]) → at least 1 symbol
    // .{6,}      → minimum 6 characters

    if (!regex.test(pw)) {
        document.getElementById("error-msg").innerHTML="Password must have at least 1 uppercase letter, 1 number and 1 special character.";
        return false; 
    }
    return true; 
        }
    </script>
</body>
</html>
