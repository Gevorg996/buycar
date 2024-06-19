<?php
include "database-connection.php";
if (isset($_POST["brand"])) {
    $selectedBrand = $_POST["brand"];
    $query = "SELECT modelName FROM models WHERE brandId = (SELECT brandId FROM brand WHERE brandName = ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $selectedBrand);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $models = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $models[] = $row;
    }
    echo json_encode($models);
} else {
    echo json_encode([]);
}
?>