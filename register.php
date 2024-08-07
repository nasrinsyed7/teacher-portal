<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $con->prepare("INSERT INTO teachers (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    
    if ($stmt->execute()) {
        echo "<script>alert('Successfully registered'); window.location.href='index.php';</script>";
        exit();
    } else {
        $error = "Registration failed!";
    }
    
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Teacher Portal - Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
       *{
        margin:0;
        padding:0;
        box-sizing:border-box;
       }

      
       .rigister-box{
           display: flex;
           justify-content: center;
           align-items: center;
           flex-direction: column;
           height: 100vh;
           width: 100%;
           gap:20px;
           background-color: rgb(150, 148, 148);
        }
        .rigister-box h1{
            color: rgb(253, 10, 10);
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }
        .rigister-box .register-container{
           
           display: flex;
          flex-direction: column;
          column-gap: 30px;
          width: 400px;
          padding:30px 0;
          box-shadow: 0 2px 10px 0 rgb(127, 126, 126);
          background-color: white;  
          column-gap:20px;  

       }
        
        form{
            display:flex;
            flex-direction:column;
            align-items: center;
            gap:30px;
           
        }
       form .register-input{
            display: flex;
            flex-direction: column;
            width: 80%;
        }
        form .register-input input{
           border: 1px solid rgb(146, 145, 145);
           font-size: 13px;
           padding: 7px 20px;
           background: rgba(255, 255, 255, 0.1);
           cursor: pointer;
          
        }
        form .register-input label{
            font-size:14px;
        }
        form .register-submit{
            width:50%;
            padding:10px 20px;
            background-color:black;
            cursor: pointer;
        }
        form .register-submit button {
            width:100%;
            color:white;
            border:none;
            background-color:black;

        }

    </style>
</head>
<body>
    <div class=rigister-box>
    <h1>Tailwebs.</h1>
    <div class="register-container">
        
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
        <form method="POST">
            <div class="register-input">
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="Enter Username"required>
            </div>
            <div class="register-input">
                <label for="password">Password</label>
                <input type="password" name="password"placeholder="Enter Password" required>
            </div>
            <div class="register-submit">
                <button type="submit" class="reg-btn">Register</button>
            </div>
        </form>
    </div>
    </div>
</body>
</html>
