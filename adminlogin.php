<?php
session_start();

if (isset($_SESSION['user_id']) != "") {
    header("Location: admin_apartment.php");
}

include_once 'dbconnect.php';


if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $result = mysqli_query($con, "SELECT * FROM admin WHERE email = '" . $email . "' and password = '" . md5($password) . "'");

    if ($row = mysqli_fetch_array($result)) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        header("Location: admin_apartment.php");
    } else {
        $errormsg = "Incorrect Email or Password!";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Login</title>	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
        <link href="css/login.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-1.10.2.js"></script> 
        <script src="js/bootstrap.min.js"></script>
        <script>
            $(window).load(function () {
                $('img.bgfade').hide();
                var dg_H = $(window).height();
                var dg_W = $(window).width();
                $('#wrap').css({'height': dg_H, 'width': dg_W});
                function anim() {
                    $("#wrap img.bgfade").first().appendTo('#wrap').fadeOut(1500);
                    $("#wrap img").first().fadeIn(1500);
                    setTimeout(anim, 3000);
                }
                anim();
            })
            $(window).resize(function () {
                window.location.href = window.location.href
            })
        </script>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="#bs-example-navbar-collapse-1" data-target="#navbar1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Home rental system</a>

            </div>

            <div class="collapse navbar-collapse" id="navbar1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="adminlogin.php">Login</a></li>
                    <li><a href="adminregister.php"> Admin Registration</a></li>
                </ul>
            </div>

        </nav>
        <div id="wrap">

            <img class="bgfade" src="images/bnr1.jpg" alt=""/>
            <img class="bgfade" src="images/bnr2.jpg" alt=""/>
            <img class="bgfade" src="images/bnr3.jpg" alt=""/>


        </div>

        <div class="container">

            <div class="row">
                <div class="col-md-4 col-md-offset-4 well">
                    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
                        <fieldset>
                            <legend>Login</legend>

                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="text" name="email" placeholder="Your Email" required class="form-control" />
                            </div>

                            <div class="form-group">
                                <label for="name">Password</label>
                                <input type="password" name="password" placeholder="Your Password" required class="form-control" />
                            </div>

                            <div class="form-group">
                                <input type="submit" name="login" value="Login" class="btn btn-primary" />

                            </div>

                        </fieldset>
                    </form>
                    <span class="text-danger"><?php
                        if (isset($errormsg)) {
                            echo $errormsg;
                        }
                        ?></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-center">	
                    New User? <a href="adminregister.php">Sign Up Here</a>
                </div>
            </div>

        </div>
    </body>
</html>
