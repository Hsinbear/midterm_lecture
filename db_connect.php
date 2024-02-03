<?php
$servername = "localhost";
$username = "admin";
$password = "group354321";
$dbname = "hasbi";

// try{
//     $db_host = new PDO(
//     "mysql:host={$servername};dbname={$dbname};charset=utf8", $username,$password);
//     // echo "連線成功";
// }catch(PDOException $e){
//     echo "資料庫連線失敗<br>";
//     echo "Error: ".$e->getMessage();
//     exit;
// }

$conn = new mysqli($servername, $username, $password, $dbname);
// 檢查連線
if ($conn->connect_error) {
  	die("連線失敗: " . $conn->connect_error);
}