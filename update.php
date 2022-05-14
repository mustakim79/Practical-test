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
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        body,
        html {
            height: 100%;
        }
    </style>
    <title>Insert Product</title>
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION["user"])) {
        if (isset($_GET["pid"])) {
            include 'connection.php';
            $qr = "SELECT * FROM product WHERE id=$_GET[pid]";
            $res = mysqli_query($conn, $qr);
            $row = mysqli_fetch_assoc($res);
            // print_r($row);

    ?>
            <div class="container">
                <div id="msg" class="text-center">
                </div>
                <div class="col-md-6 offset-md-3 ">
                    <form action="update_product.php" method="post" enctype="multipart/form-data" class="g-3 needs-validation" id="form" novalidate>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="text-center">Update Product</h3>
                            </div>
                            <!-- <img class="card-img-top" src="holder.js/100px180/" alt=""> -->
                            <div class="card-body">
                                <div class="my-2">
                                    <label for="p_name">Product Name</label>
                                    <input type="text" class="form-control" value="<?= $row['p_name'] ?>" pattern=".{1,30}" id="p_name" name="p_name" required>
                                    <div class="invalid-feedback">
                                        Please enter product name max 30 character.
                                    </div>
                                </div>
                                <div class="my-2">
                                    <label for="validationPrice">Price</label>
                                    <input type="number" class="form-control" value="<?= $row['price'] ?>" step=".5" id="validationPrice" name="price" required>
                                    <div class="invalid-feedback">
                                        Please enter price.
                                    </div>
                                </div>
                                <div class="my-2">
                                    <label for="validationUpc">UPC</label>
                                    <input type="text" class="form-control" value="<?= $row['upc'] ?>" pattern=".{1,30}" id="validationUpc" name="upc" required>
                                    <div class="invalid-feedback">
                                        Please enter Upc.
                                    </div>
                                </div>
                                <div class="my-2">
                                    <img src="image/<?= $row['image'] ?>" alt="image" height="50">
                                    <input type="file" class="form-control" value="<?= $row['image'] ?>" accept="image/*" id="validationimage" name="file" required>
                                    <div class="invalid-feedback">
                                        Please enter image.
                                    </div>
                                </div>
                                <div class="my-2">
                                    <label for="validationstatus">Status</label>
                                    <select class="form-control" id="validationstatus" name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="Available" <?= $row['status'] == "Available" ? "selected" : "" ?>>Available</option>
                                        <option value="Sold out" <?= $row['status'] == "Sold out" ? "selected" : "" ?>>Sold out</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please enter status.
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" name="submit-btn" class="btn btn-primary w-50 ">Submit </button>
                            </div>
                        </div>
                    </form>
                    <div class="text-center my-4">See product by <a href="index.php">Click here</a></div>
                </div>
            </div>
            <script>
                $(document).on('submit', '#form', function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    console.log(formData);
                    $.ajax({
                        url: "update_product.php",
                        type: "post",
                        data: formData,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            // console.log(data);
                            $("#msg").html(data).fadeIn();
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
    <?php
        } else {
            header("location:index.php");
        }
    } else {
        echo "<div class='w-100 text-center'><h1 >You can not access this file untill you are not login</h1><br>";
        echo "<h4><a href='login.php'>Click to Login</a></h4></div>";
    }
    ?>
</body>

</html>