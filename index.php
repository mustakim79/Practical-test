<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include 'links.html';
    ?>
</head>

<body>
    <?php
    session_start();
    include 'connection.php';
    if (isset($_SESSION["user"])) {
        $qr = "SELECT * FROM product";
        $res = mysqli_query($conn, $qr);
        $num = mysqli_num_rows($res);

    ?>
        <div class="container">
            <h1 class="text-center">Welcome <?= $_SESSION["user"] ?></h1>
            <div id="msg">
            </div>
            <div class="">
                <a href="product.php" class="mt-2 mb-3 btn btn-primary">INSERT PRODUCT</a>
                <a href="logout.php" class="float-end mt-2 mb-3 btn btn-warning">Logout<i class="fa fa-sign-out" aria-hidden="true"></i></a>
            </div>
            <?php
            if ($num > 0) {
            ?>
                <form method="post" id="deleteform">
                    <table class="table table-bordered text-center align-middle">
                        <thead class=" text-capitalize">
                            <tr>
                                <th>Product Name</th>
                                <th>product price </th>
                                <th>UPC</th>
                                <th>Photo</th>
                                <th>Status</th>
                                <th>Update</th>
                                <th>delete</th>
                                <th width=" 10%"><button type="submit" class="btn btn-danger">Delete <i class="fa fa-trash"></i></button></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($res)) {
                            ?>
                                <tr id="row<?= $row['id'] ?>">
                                    <td scope="row"><?= $row["p_name"] ?></td>
                                    <td><?= $row["price"] ?></td>
                                    <td><?= $row["upc"] ?></td>
                                    <td><img src="image/<?= $row["image"] ?>" alt="image" height="80"></td>
                                    <td> <span class="badge bg-<?= $row["status"] == "Available" ? 'primary' : 'danger' ?>"><?= $row["status"] ?></span></td>
                                    <td><a href="update.php?pid=<?= $row['id'] ?>" class="btn btn-success">Update</a></td>
                                    <td><a href="#" data-pid="<?= $row['id'] ?>" class="delete btn btn-danger">Delete</a></td>
                                    <td>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name="p_id[]" type="checkbox" value="<?= $row['id'] ?>">
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </form>
            <?php
            } else {
            ?>
                <h1 class="text-center">Nothing to show please insert some product</h1>
            <?php
            }
            ?>
        </div>
        <script>
            $(document).ready(function() {
                $(".delete").click(function() {
                    var pid = $(this).attr("data-pid");
                    var ele = $(this).closest("tr");
                    // console.log(ele);
                    $.ajax({
                        url: `delete.php?pid=${pid}`,
                        method: "get",
                        success: function(data) {
                            console.log(data);
                            var t = /product has been deleted/i;
                            var rs = t.test(data);
                            if (rs) {
                                ele.fadeOut("normal", function() {
                                    $(this).remove();
                                });
                            }
                            $("#msg").html(data);
                        }
                    });
                })
                $("#deleteform").submit(function(e) {
                    e.preventDefault();

                    // console.log(ele);
                    console.log($(this).serialize());
                    $.ajax({
                        url: `delete.php`,
                        method: "post",
                        data: $(this).serialize(),
                        success: function(data) {
                            console.log(data);
                            location.reload();

                        }
                    });
                })
            });
        </script>
    <?php
    } else {
    ?>
        <div style="display: flex; justify-content: center; flex-direction: column; align-items: center; height: 100vh; background-color: #f5f5f5;">
            <h1>You can not access this file untill you are not login</h1><br>
            <h4><a href='login.php'>Click to Login</a></h4>
        </div>
    <?php
    }
    ?>

</body>

</html>