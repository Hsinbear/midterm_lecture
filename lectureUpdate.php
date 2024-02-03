<?php
require_once("./db_connect.php");

if (!isset($_POST["name"])) {
    die("請循正常管道登入");
};

$teacher_id = $_POST["teacher_id"];
$name = $_POST["name"];
$price = $_POST["price"];
$amount = $_POST["amount"];
$location = $_POST["location"];
$starting_date = $_POST["starting_date"];
$ending_date = $_POST["ending_date"];
$staring_time = $_POST["staring_time"];
$ending_time = $_POST["ending_time"];
$description = $_POST["description"];
$id=$_POST["id"];
$valid=$_POST["valid"];


$sql = "UPDATE lecture SET teacher_id='$teacher_id',name='$name',price='$price',amount='$amount',location='$location',starting_date='$starting_date',ending_date='$ending_date',staring_time='$staring_time',ending_time='$ending_time' ,description='$description',valid='$valid' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "更新成功";
} else {
    echo "更新資料錯誤: " . $conn->error;
}

$conn->close();
header("location:lecture.php");