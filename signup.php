<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include 'links.html';
    ?>
    <title>Signup</title>

</head>

<body>
    <?php

    include 'utility.php';
    ?>
    <div class="container">
        <div id="msg">
        </div>
        <div class="col-md-6 offset-md-3 mt-5">
            <form method="post" class="g-3 needs-validation" id="form" novalidate>
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Sign up User</h3>
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
                        <div class="my-2">
                            <label for="validationEmail">Email</label>
                            <input type="email" class="form-control" plc id="validationEmail" name="email" required>
                            <div class="invalid-feedback">
                                Valid email is required.
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" name="submit-btn" class="btn btn-primary float-end">Submit </button>
                    </div>
                </div>
            </form>
            <div class="text-center my-4">Already have account ? <a href="login.php">Login here</a></div>
        </div>
    </div>

    <script>
        $(document).on('submit', '#form', function(e) {
            e.preventDefault();
            $.ajax({
                url: "insert.php",
                type: "post",
                data: $(this).serialize(),
                success: function(data) {
                    // console.log(data);
                    $("#msg").html(data);
                    $("#form").find('input').val('');
                    $("#form").removeClass("was-validated");
                }
            });
        });


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