<?php
session_start();
include 'connection.php';
include 'utility.php';
if (!isset($_SESSION["user"])) {
    if (isset($_POST['submit-btn'])) {
        extract($_POST);
        $username = mysqli_real_escape_string($conn, $username);
        $sec_que = mysqli_real_escape_string($conn, $sec_que);
        $sec_ans = mysqli_real_escape_string($conn, $sec_ans);
        $qr = "SELECT * FROM user WHERE username='$username' AND security_ans='$sec_ans'AND security_que='$sec_que'";
        $res = mysqli_query($conn, $qr);
        $row = mysqli_num_rows($res);
        if ($row == 1) {
            $_SESSION["reset"] = true;
            $_SESSION["sec_ans"] = $sec_ans;
            $_SESSION["sec_que"] = $sec_que;
            $_SESSION["username"] = $username;

            $_SESSION["st"]["msg"] = [1, "Match record"];
            header("location:reset_password.php");
        } else {
            $_SESSION["st"]["msg"] = [0, "Invalid !"];
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php include 'links.html';  ?>
        <title>forgot password</title>
    </head>

    <body>
        <div class="container">
            <div id="msg">
                <?php printmsg(); ?>
            </div>
            <div class="col-md-6 offset-md-3 ">
                <form method="post" class="g-3 needs-validation" id="form" novalidate>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">Forgot password</h3>
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
                                <label for="validations_que">Enter Security Question</label>
                                <select class="form-control" id="validations_que" name="sec_que" required>
                                    <option value="">Select Question</option>
                                    <option value="Your First School">Your First School</option>
                                    <option value="10th Percantage">10th Percantage</option>
                                    <option value="12th Percantage">12th Percantage</option>
                                    <option value="Father Name">Father Name</option>
                                    <option value="Mother Name">Mother Name</option>
                                    <option value="In what city were you born?">In what city were you born?</option>
                                    <option value="Your favourite place">Your favourite place</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please enter Security Question.
                                </div>
                            </div>
                            <div class="my-2">
                                <label for="validation_ans">Enter Answer</label>
                                <input type="text" class="form-control" id="validation_ans" name="sec_ans" required>
                                <div class="invalid-feedback">
                                    Security answer is required.
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
<?php
} else {
    header("location:logout.php");
}
?>