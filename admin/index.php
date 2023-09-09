<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include ("../head.php");
    ?>
    <style>
        body {
            background-image: url('https://drnutrition.com/themes/storefront/public/images/wave.svg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            width: 300px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    
<div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="login-box">
            <h5 class="text-center mb-4">Login</h5>
            <form action= "login.php" method="post" >
            <?php
                if (isset($_GET['status']) && $_GET['status'] === 'failed') {
                    echo '<p style="color: red;">Incorrect username or password.</p>';
                }
            ?>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
        </div>
    </div>


<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/all.min.js"></script>
<script src="js/mainj.js?v=<?php echo time()?>"></script>
</body>
</html>