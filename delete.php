<?php
    require 'dbconfig.php';
    $id = $_GET['id'];
    $sql = 'DELETE FROM employee WHERE id=:id';
    $statement = $conn->prepare($sql);
    if ($statement->execute([':id' => $id])) {
        header("Location: list-employee.php");
        echo 'alert("Xóa nhân viên thành công")';
    }
?>