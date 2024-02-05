<?php
require_once("./db_connect.php");

if (!isset($_POST["name"])) {
    echo "請循正常管道進入";
    exit;
}


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

// 必填欄位
if (empty($name) || empty($location) || empty($description)  || empty($ending_date) || empty($staring_time) || empty($teacher_id) || empty($starting_date) || empty($price) || empty($amount)) {
    echo "請輸入必要欄位";
    exit;
}

// cover資料夾接照片檔案
if ($_FILES["cover"]["error"] == 0 && $_FILES["img"]["error"] == 0) {
    // 防止上傳相同檔案覆蓋原有檔案
    // 所以使用當下時間來建立檔案名稱
    $filenameCover = time();
    $filenameImg = time();
    // 獲取上傳檔案的副檔名
    $fileExtCover = pathinfo($_FILES["cover"]["name"], PATHINFO_EXTENSION);
    $fileExtImg = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
    // 將以上兩者合併成檔名與副檔名重新存於filename中
    $filenameCover = "add" . $filenameCover . "." . $fileExtCover;
    $filenameImg = "add" . $filenameImg . "." . $fileExtImg;
    // echo $filename;
    // exit;

    // 將檔案移至指定目錄
    if (move_uploaded_file($_FILES["cover"]["tmp_name"], "./lecture_cover/" . $filenameCover) && move_uploaded_file($_FILES["img"]["tmp_name"], "./lecture_img/" . $filenameImg)) {

        echo "upload success!";
        // var_dump($_FILES["cover"]["name"]);
        // var_dump($_FILES["img"]["name"]);
    } else {
        echo "upload failed!";
    }
}


// 將新增資料收入sql變數中
$sql = "INSERT INTO lecture (teacher_id, `name`, price, amount, `location`, starting_date, ending_date, staring_time, ending_time, `description`, cover, img, valid) VALUES ($teacher_id, '$name', $price, $amount, $location, '$starting_date', '$ending_date', '$staring_time', '$ending_time', '$description', '$filenameCover', '$filenameImg', 1)";
var_dump($sql);
// 是否成功輸入資料表中
if ($conn->query($sql)) {
    echo "新增課程完成";
} else {
    echo "新增課程錯誤: " . $conn->error;
}

header("Location: add-lecture.php");
exit;
?>
