<?php
    if($_GET['isDelete']){

        session_start();
        $_SESSION['deleteAlert']=true;

        require("partials/_dbconnect.php");

        $title=$_GET['title'];
        $username=$_SESSION['username'];

        $sql="DELETE FROM `notes` WHERE `notes`.`title` ='$title' ";
        $result=mysqli_query($conn,$sql);

    }

    header("location: index.php")
?>