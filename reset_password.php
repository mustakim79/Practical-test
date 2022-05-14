<?php

session_start();
if (isset($_SESSION["reset"])) {
    include 'connection.php';
    include 'utility.php';
    if (isset($_POST['submit-btn'])) {
        extract($_POST);
        if ($password == $r_password) {
            $qr = "UPDATE user SET `password`='$password' WHERE  username='$_SESSION[username]' AND security_ans='$_SESSION[sec_ans]'AND security_que='$_SESSION[sec_que]'";
            $res = mysqli_query($conn, $qr);
            if ($res) {
                unset($_SESSION["reset"]);
                unset($_SESSION["sec_ans"]);
                unset($_SESSION["sec_que"]);
                unset($_SESSION["username"]);
                $_SESSION["st"]["msg"] = [1, "Password change successfully"];
                header("location:login.php");
            } else {
                $_SESSION["st"]["msg"] = [0, "Password does not change"];
            }
        } else {
            $_SESSION["st"]["msg"] = [0, "Repeat password does not match"];
        }
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php include 'links.html'; ?>

        <style>
            body {
                display: flex;
                align-items: center;
                justify-content: center;
                padding-top: 40px;
                padding-bottom: 40px;
                /* background-color: #f5f5f5; */

            }

            html,
            body {
                height: 100%;
            }
        </style>
        <title>Reset Password</title>
    </head>

    <body>
        <div class="container">
            <div id="msg">
                <?php
                printmsg();
                ?>
            </div>

            <div class="col-md-6 offset-md-3 ">
                <form method="post" class="g-3 needs-validation" id="form">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">Set New Password</h3>
                        </div>
                        <!-- <img class="card-img-top" src="holder.js/100px180/" alt=""> -->
                        <div class="card-body">
                            <div class="my-2">
                                <label for="validationUsername">Enter Password</label>
                                <input type="password" class="form-control" id="validationUsername" name="password" required>
                            </div>

                            <div class="my-2">
                                <label for="validationUsername">Repeat Password</label>
                                <input type="password" class="form-control" id="validationUsername" name="r_password" required>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" name="submit-btn" class="btn btn-primary w-50 ">Submit </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>

    </html>
<?php
} else {
    header("location:login.php");
}
?>