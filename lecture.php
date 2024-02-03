<?php
require_once("./db_connect.php");

$perPage = 5;
$sqlAll = "SELECT * FROM lecture";
$resultAll = $conn->query($sqlAll);
$lectureTotalCount = $resultAll->num_rows;

$pageCount = ceil($lectureTotalCount / $perPage);

$orderStr = ""; // 初始化 $orderStr

if (isset($_GET["order"])) {
    $order = $_GET["order"];
    if ($order == 1) {
        $orderStr = "ORDER BY id ASC";
    } elseif ($order == 2) {
        $orderStr = "ORDER BY id DESC";
    } elseif ($order == 3) {
        $orderStr = "ORDER BY price ASC";
    } elseif ($order == 4) {
        $orderStr = "ORDER BY price DESC";
    }
}

if (isset($_GET["search"])) {
    $search = "%" . mysqli_real_escape_string($conn, $_GET["search"]) . "%";
    $sql = "SELECT lecture.*, teacher.name AS teacher_name, location.name AS location_name
    FROM lecture
    JOIN teacher ON lecture.teacher_id = teacher.id
    JOIN lecture_location AS location ON lecture.location = location.id
    WHERE lecture.name LIKE '$search'";
    $result = $conn->query($sql);
    $lectureCount = $result->num_rows;
} elseif (isset($_GET["p"])) {
    $p = $_GET["p"];
    $startIndex = ($p - 1) * $perPage;
    $sql = "SELECT lecture.*, teacher.name AS teacher_name, location.name AS location_name
    FROM lecture
    JOIN teacher ON lecture.teacher_id = teacher.id
    JOIN lecture_location AS location ON lecture.location = location.id
    $orderStr LIMIT $startIndex, $perPage";
    $result = $conn->query($sql);
} else {
    $p = 1;
    $order = 1;
    $orderStr = "ORDER BY id ASC";
    $sql = "SELECT lecture.*, teacher.name AS teacher_name, location.name AS location_name
    FROM lecture
    JOIN teacher ON lecture.teacher_id = teacher.id
    JOIN lecture_location AS location ON lecture.location = location.id
    $orderStr LIMIT $perPage";
    $result = $conn->query($sql);

}

if (isset($_GET["search"])) {
    $lectureCount = $result->num_rows;
} else {
    $lectureCount = $lectureTotalCount;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="./assets/img/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>
        課程管理清單
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="./assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <!-- Bootstrap JavaScript (Popper.js and Bootstrap JS) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="..." crossorigin="anonymous"></script>
</head>

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html " target="_blank">
                <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold">MIDTERM PROJECT</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class=" w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="./pages/dashboard.html">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">主頁面
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="./pages/tables.html">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">會員管理/註冊</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="./pages/billing.html">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">商品管理</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="./pages/virtual-reality.html">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-app text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">商品類別管理</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="./pages/rtl.html">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">文章管理</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="./pages/rtl.html">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">訂單管理</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="./pages/rtl.html">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">講師管理</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="./pages/rtl.html">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">課程管理</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="./pages/rtl.html">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">優惠券管理</span>
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">個人主頁</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="../pages/profile.html">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">個人檔案</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="../pages/sign-in.html">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">登入</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="../pages/sign-up.html">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-collection text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">登出</span>
                    </a>
                </li>
            </ul>
        </div>

    </aside>
    <main class="main-content position-relative border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">主頁面</a>
                        </li>
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">主頁面</li>
                    </ol>
                    <!-- <h6 class="font-weight-bolder text-white mb-0">主頁面</h6> -->
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">

                    </div>
                    <div class="text-white px-4">
                        HI, USER
                    </div>
                    <ul class="navbar-nav  justify-content-end">
                        <li class="nav-item d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none">登入</span>
                            </a>
                        </li>
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line bg-white"></i>
                                    <i class="sidenav-toggler-line bg-white"></i>
                                    <i class="sidenav-toggler-line bg-white"></i>
                                </div>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between">
                                <h4>課程管理清單</h4>
                                <div>
                                    新增
                                    <a name="" id="" class="btn btn-primary" href="add-lecture.php" role="button">
                                        <i class="fa-solid fa-plus fa-fw"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="row g-3">
                                <?php if (isset($_GET["search"])) : ?>
                                    <div class="col-auto">
                                        <a name="" id="" class="btn btn-primary" href="lecture.php" role="button"><i class="fa-solid fa-house-user fa-fw"></i></a>
                                    </div>
                                <?php endif; ?>
                                <div class="col">
                                    <form action="">
                                        <div class="input-group ">
                                            <input style="height: 41px;" type="search" class="form-control box-sizing inline-block" placeholder="課程名稱" aria-label="Recipient's username" aria-describedby="button-addon2" name="search" <?php if (isset($_GET["search"])) : $searchValue = $_GET["search"]; ?> value="<?= $searchValue ?>" <?php endif; ?>>
                                            <!-- 這段是把搜尋條件留在欄位裡面 -->
                                            <button class="btn btn-primary" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass fa-fw"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php if (!isset($_GET["search"])) : ?>
                                <div class="d-flex justify-content-between pb-2 align-items-center">
                                    <div>
                                        共 <?= $lectureCount ?> 個課程
                                    </div>
                                    <div class="py-2 justify-content-end d-flex align-items-center">
                                        <div class="me-2">排序</div>
                                        <div class="btn-group">
                                            <a class="btn btn-primary <?php if ($order == 1) echo "active" ?>" href="lecture.php?order=1&p=<?= $p ?>">id<i class="fa-solid fa-arrow-down-1-9 fa-fw"></i></a>
                                            <a class="btn btn-primary <?php if ($order == 2) echo "active" ?>" href="lecture.php?order=2&p=<?= $p ?>">id<i class="fa-solid fa-arrow-down-9-1 fa-fw"></i></a>
                                            <a class="btn btn-primary <?php if ($order == 3) echo "active" ?>" href="lecture.php?order=3&p=<?= $p ?>">$<i class="fa-solid fa-arrow-down-1-9 fa-fw"></i></a>
                                            <a class="btn btn-primary <?php if ($order == 4) echo "active" ?>" href="lecture.php?order=4&p=<?= $p ?>">$<i class="fa-solid fa-arrow-down-9-1 fa-fw"></i></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <?php if ($lectureCount > 0) : ?>
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    課程編號</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    課程名稱</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    人數限制</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    授課教師
                                                </th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    課程價格</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    上課地點</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    上課日期</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    上課時間</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    開放報名</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    操作</th>
                                                <th class="text-secondary opacity-7"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $rows = $result->fetch_all(MYSQLI_ASSOC);
                                            foreach ($rows as $lecture) :
                                                $valid = $lecture["valid"];
                                            ?>

                                                <tr>
                                                    <td class="text-center"><?= $lecture["id"] ?></td>
                                                    <td class="text-center"><?= $lecture["name"] ?></td>
                                                    <td class="text-center"><?= $lecture["amount"] ?></td>
                                                    <td class="text-center"><?= $lecture["teacher_name"] ?></td>
                                                    <td class="text-center"><?= number_format($lecture["price"]) ?></td>
                                                    <td class="text-center"><?= $lecture["location_name"] ?></td>
                                                    <td class="text-center"><?= $lecture["starting_date"] ?><br><?= $lecture["ending_date"] ?></td>
                                                    <td class="text-center"><?= $lecture["staring_time"] ?><br><?= $lecture["ending_time"] ?></td>
                                                    <td class="text-center"><?php
                                                                            if ($valid == 1) {
                                                                                echo "已開放";
                                                                            } elseif ($valid == 0) {
                                                                                echo "未開放";
                                                                            }
                                                                            ?></td>

                                                    <td class="align-middle text-center">
                                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $lecture["id"] ?>"><i class="fa-solid fa-eye fa-fw text-white"></i></button>

                                                        <!-- MODAL模型 -->
                                                        <div class="modal modal-dialog-scrollable fade" id="staticBackdrop<?= $lecture["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-xl">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                                            <?= $lecture["name"] ?>
                                                                        </h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="container">
                                                                            <div class="row">
                                                                                <div class="col-4">
                                                                                    <img src="/lecture/img/<?= $lecture["lecture_img"] ?>" class="avatar avatar-sm me-3" alt="user1">
                                                                                </div>
                                                                                <div class="col-8">
                                                                                    <table class="table table-bordered">
                                                                                        <tr>
                                                                                            <th>課程編號</th>
                                                                                            <td>
                                                                                                <?= $lecture["id"] ?>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>名字</th>
                                                                                            <td>
                                                                                                <?= $lecture["name"] ?>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>人數限制</th>
                                                                                            <td>
                                                                                                <?= $lecture["amount"] ?>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>授課教師</th>
                                                                                            <td>
                                                                                                <?= $lecture["teacher_name"] ?>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>課程價格</th>
                                                                                            <td>
                                                                                                <?= number_format($lecture["price"]) ?>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>上課地點</th>
                                                                                            <td>
                                                                                                <?= $lecture["location_name"] ?>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>上課日期</th>
                                                                                            <td>
                                                                                                <?= $lecture["starting_date"] ?><br>
                                                                                                <?= $lecture["ending_date"] ?>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>上課時間</th>
                                                                                            <td>
                                                                                                <?= $lecture["staring_time"] ?><br>
                                                                                                <?= $lecture["ending_time"] ?>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>課程資訊</th>
                                                                                            <td>
                                                                                                <div class="text-wrap">
                                                                                                    <?= $lecture["description"] ?>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>報名狀況</th>
                                                                                            <td>
                                                                                                <?php
                                                                                                if ($valid == 1) {
                                                                                                    echo "已開放";
                                                                                                } elseif ($valid == 0) {
                                                                                                    echo "未開放";
                                                                                                }
                                                                                                ?>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer d-flex justify-content-lg-between">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                                                                        <div>
                                                                            <!-- 修改 -->
                                                                            <a class="btn btn-primary" href="update-lecture.php?id=<?= $lecture["id"] ?>" method="GET">
                                                                                修改
                                                                            </a>
                                                                            <!-- 刪除 -->
                                                                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal<?= $lecture["id"] ?>" role="button"><i class="fa-solid fa-trash fa-fw"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="confirmModal<?= $lecture["id"] ?>" tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">關閉課程</h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        確認關閉?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                                                        <a role="button" class="btn btn-danger" href="doDeleteLecture.php?id=<?= $lecture["id"] ?>" method="POST">確認</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal<?= $lecture["id"] ?>" role="button"><i class="fa-solid fa-trash fa-fw"></i></button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <?php if (!isset($_GET["search"])) : ?>
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination d-flex justify-content-center">
                                                <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                                                    <li class="page-item <?php if ($i == $p) echo "active" ?>"><a class="page-link" href="lecture.php?order=<?= $order ?>&p=<?= $i ?>"><?= $i ?></a></li>
                                                <?php endfor; ?>
                                            </ul>
                                        </nav>
                                    <?php endif ?>
                                </div>
                            <?php else : ?>
                                搜尋範圍內沒有符合條件的課程
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <div class="fixed-plugin">
        <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
            <i class="fa fa-cog py-2"> </i>
        </a>
        <div class="card shadow-lg">
            <div class="card-header pb-0 pt-3 ">
                <div class="float-start">
                    <h5 class="mt-3 mb-0">Argon Configurator</h5>
                    <p>See our dashboard options.</p>
                </div>
                <div class="float-end mt-4">
                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0 overflow-auto">
                <!-- Sidebar Backgrounds -->
                <div>
                    <h6 class="mb-0">Sidebar Colors</h6>
                </div>
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="badge-colors my-2 text-start">
                        <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
                    </div>
                </a>
                <!-- Sidenav Type -->
                <div class="mt-3">
                    <h6 class="mb-0">Sidenav Type</h6>
                    <p class="text-sm">Choose between 2 different sidenav types.</p>
                </div>
                <div class="d-flex">
                    <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
                    <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default" onclick="sidebarType(this)">Dark</button>
                </div>
                <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
                <!-- Navbar Fixed -->
                <div class="d-flex my-3">
                    <h6 class="mb-0">Navbar Fixed</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-sm-4">
                <div class="mt-2 mb-5 d-flex">
                    <h6 class="mb-0">Light / Dark</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
                    </div>
                </div>
                <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/argon-dashboard">Free
                    Download</a>
                <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard">View
                    documentation</a>
                <div class="w-100 text-center">
                    <a class="github-button" href="https://github.com/creativetimofficial/argon-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/argon-dashboard on GitHub">Star</a>
                    <h6 class="mt-3">Thank you for sharing!</h6>
                    <a href="https://twitter.com/intent/tweet?text=Check%20Argon%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fargon-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
                        <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/argon-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
                        <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Core JS Files  
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script> -->
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="./assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>