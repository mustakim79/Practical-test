<?php
session_start();
include 'connection.php';
include 'utility.php';
if (isset($_POST['submit-btn'])) {
    extract($_POST);
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $qr = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $res = mysqli_query($conn, $qr);
    $row = mysqli_num_rows($res);
    if ($row == 1) {
        $_SESSION["user"] = $username;
        $_SESSION["st"]["msg"] = [1, "User login successfully"];
        header("location:index.php");
    } else {
        $_SESSION["st"]["msg"] = [0, "Invalid username or password"];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include 'links.html';
    ?>
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
    <title>Login User</title>
</head>

<body>
    <div class="container">
        <div id="msg">
            <?php
            printmsg();
            ?>
        </div>
        <div class="col-md-6 offset-md-3 ">
            <form method="post" class="g-3 needs-validation" id="form" novalidate>
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Login User</h3>
                    </div>
                    <!-- <img class="card-img-top" src="holder.js/100px180/" alt=""> -->
                    <div class="card-body">
                        <div class="my-2">
                            <label for="validationUsername">Username</label>
                            <input type="text" class="form-control" plc id="validationUsername" name="username" required>
                            <div class="invalid-feedback">
                                Please enter username.
                            </div>
                        </div>
                        <div class="my-2">
                            <label for="validationPassword">Password</label>
                            <input type="text" class="form-control" plc id="validationPassword" name="password" required>
                            <div class="invalid-feedback">
                                Please enter Password.
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" name="submit-btn" class="btn btn-primary w-50 ">Submit </button>
                    </div>
                </div>
            </form>
            <div class="text-center my-4">Don't have account ? <a href="login.php">Register</a></div>
        </div>
    </div>
    <script>
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>

</html>