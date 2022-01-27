<?php
require("partials/_dbconnect.php");
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
}

$username = $_SESSION['username'];

$showAlert = false;
$alertType = "";
$alert = "";


if (isset($_SESSION['deleteAlert'])) {
    if ($_SESSION['deleteAlert']) {
        $showAlert = true;
        $alertType = "danger";
        $alert = "Note Deleted Successfully";
        $_SESSION['deleteAlert'] = false;
    }
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "SELECT * FROM `notes` WHERE `title`='$title' ";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $showAlert = true;
        $alertType = "danger";
        $alert = "Enter Another Title.";
    } else {
        $sql = "INSERT INTO `notes` (`sno`, `username`, `title`, `description`) VALUES (NULL, '$username', '$title', '$description')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $showAlert = true;
            $alertType = "success";
            $alert = "Notes Added Successfully.";
        } else {
            $showAlert = true;
            $alertType = "warning";
            $alert = "Something WWent Wrong !.";
        }
    }
}
?>



<?php
require("partials/_indexHeader.php");
?>
<div class="container my-4">
    <form method="POST" action="index.php">

        <?php

        if ($showAlert) {
            echo '<div class="container p-0 justify-content-center "><div class="alert alert-' . $alertType . '" role="alert">
' . $alert . '
</div></div>';
        }
        ?>
        <div class="form-group my-4">
            <label for="Title">Title</label>
            <input type="text" class="form-control" name="title" maxlength="50" placeholder="Enter Title">
        </div>

        <div class="form-group my-4">
            <label for="Description">Description</label>
            <textarea class="form-control" name="description" rows="3" placeholder="Enter Description"></textarea>
        </div>

        <button type="submit" name="go" class="btn btn-lg btn-primary btn-block">Add Note</button>

    </form>
</div>

<div class="container my-4">

    <table class="table" id="myTable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM `notes` WHERE `username`='$username' ";
            $result = mysqli_query($conn, $sql);
            $sno = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>
                    <th scope="row">' . $sno . '</th>
                    <td>' . $row['title'] . '</td>
                    <td>' . $row['description'] . '</td>
                    <td><a class="btn btn-sm btn-primary" href="#">Edit</a>
                        <a class="btn btn-sm btn-danger" href="delete.php?isDelete=true&title=' . $row["title"] . '">Delete</a>
                    </td>
                </tr>';
                $sno = $sno + 1;
            }
            ?>

        </tbody>
    </table>

</div>



<?php
require("partials/_footer.php");
?>