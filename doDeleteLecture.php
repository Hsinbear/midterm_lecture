<?php
require_once("./db_connect.php");

$id=$_GET["id"];

$sql = "UPDATE lecture SET valid='0' WHERE id=$id";

echo $sql;

if ($conn->query($sql) === TRUE) {
    echo "刪除成功";
} else {
    echo "刪除資料錯誤: " . $conn->error;
}

$conn->close();
header("location: lecture.php");