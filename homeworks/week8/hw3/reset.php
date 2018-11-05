<?php
    // create connection
    require("../connect.php");

    $sql = "UPDATE products SET quantity = 3";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    header("location:./index.php")

?>