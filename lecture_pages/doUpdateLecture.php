<?php
require_once("../db_connect.php");

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
$id=$_POST["lecture_id"];
$valid=$_POST["valid"];

//更新圖片
$lecture_id = $_POST["lecture_id"];
$sql = "SELECT * FROM lecture WHERE id=" . $lecture_id;
$result= $conn->query($sql);
$row = $result->fetch_assoc();

$oldCover = $_POST["old_cover"];
$oldImg = $_POST["old_img"];

// 封面更新
if ($_FILES['cover']['error'] == 0) {
    #如果有選擇圖片就使用新上傳的圖片
    $filenameCover = time(); // 取得當前的 Unix 時間戳（秒級別）
    // pathinfo 取得上傳檔案的擴展名(路徑/PATHINFO_EXTENSION(.jpg))
    $fileExtCover = pathinfo($_FILES["cover"]["name"], PATHINFO_EXTENSION);
    $filenameCover = "update" . $filenameCover . "." . $fileExtCover;

    #上傳圖片
    if (move_uploaded_file($_FILES['cover']['tmp_name'], '../lecture_cover/' . $filenameCover)) {
        echo "封面更新成功";
    } else {
        echo "封面更新失敗";
    }
} else {
    echo $_FILES['cover']['error'];
    #如果沒有選擇圖片就使用原本資料庫的圖片
    $filenameCover = $oldCover;
}

$sql = "UPDATE lecture SET name='" . $name . "', cover='" . $filenameCover . "' WHERE id=" . $lecture_id;
$conn->query($sql);

// 細節照片更新
if ($_FILES['img']['error'] == 0) {
    #如果有選擇圖片就使用新上傳的圖片
    $filenameImg = time(); // 取得當前的 Unix 時間戳（秒級別）
    // pathinfo 取得上傳檔案的擴展名(路徑/PATHINFO_EXTENSION(.jpg))
    $fileExtImg = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
    $filenameImg = "update" . $filenameImg . "." . $fileExtImg;

    #上傳圖片
    if (move_uploaded_file($_FILES['img']['tmp_name'], '../lecture_img/' . $filenameImg)) {
        echo "細節照更新成功";
    } else {
        echo "細節照更新失敗";
    }
} else {
    echo $_FILES['img']['error'];
    #如果沒有選擇圖片就使用原本資料庫的圖片
    $filenameImg = $oldImg;
}

$sql = "UPDATE lecture SET name='" . $name . "', img='" . $filenameImg . "' WHERE id=" . $lecture_id;
$conn->query($sql);

$sql = "UPDATE lecture SET teacher_id='$teacher_id',name='$name',price='$price',amount='$amount',location='$location',starting_date='$starting_date',ending_date='$ending_date',staring_time='$staring_time',ending_time='$ending_time' ,description='$description',valid='$valid' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "更新成功";
} else {
    echo "更新資料錯誤: " . $conn->error;
}

$conn->close();
header("location:lecture.php");