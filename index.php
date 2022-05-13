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

    ?>
        <div class="container">
            <h1>Welcome <?= $_SESSION["user"] ?></h1>
            <a href="product.php" class="mt-2 mb-3 btn btn-primary">INSERT PRODUCT</a>
            <table class="table table-bordered text-center ">
                <thead class="text-capitalize">
                    <tr>
                        <th>Product Name</th>
                        <th>product price </th>
                        <th>UPC</th>
                        <th>Photo</th>
                        <th>Status</th>
                        <th>Update</th>
                        <th>delete</th>
                        <th width="10%"><a href="delete_select.php" class="btn btn-danger">delete <i class="fa fa-trash"></i></a></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <tr>
                            <td scope="row"><?= $row["p_name"] ?></td>
                            <td><?= $row["price"] ?></td>
                            <td><?= $row["upc"] ?></td>
                            <td><img src="image/<?= $row["image"] ?>" alt="" height="200" width="auto"></td>
                            <td><?= $row["status"] ?></td>
                            <td><a href="update.php?pid=<?= $row['id'] ?>" class="btn btn-primary">Update</a></td>
                            <td><a href="delete.php?pid=<?= $row['id'] ?>" class="btn btn-primary">Delete</a></td>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="data_id[]" type="checkbox" id="inlineCheckbox1" value="<?= $row['id'] ?>">
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

        </div>

    <?php
    } else {
        echo "<div class='text-center'><h1 >You can not access this file untill you are not login</h1><br>";
        echo "<h4><a href='login.php'>Click to Login</a></h4></div>";
    }
    ?>
</body>

</html>