<?php
require_once("./db_connect.php");

$sql = "SELECT img FROM lecture ORDER By id DESC";
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

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
        新增課程
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

    <style>
        .previewimage {
            --width: 400px;
            width: var(--width);
            height: var(--width);
            overflow: hidden;
            position: relative;

            img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .deletebtn {
                position: absolute;
                left: 150px;
                bottom: 0;
                display: none;

            }
        }

        .st {
            width: auto;
            margin: 20px;
            border-bottom: 1px solid #3d56e0;
            padding-bottom: 10px;
        }
    </style>
</head>

<body class="g-sidenav-show   bg-gray-100">
    <div class="position-absolute w-100 min-height-300 bg-primary">
        <span class="mask bg-primary"></span>
    </div>
    <nav class="navbar navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl w-60 mx-auto position-relative" id="navbarBlur" data-scroll="false">
        <div class="container-fluid py-1 px-3 ">
            <!-- <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">主頁面</a></li>
          <li class="breadcrumb-item text-sm text-white active" aria-current="page"><a class="opacity-5 text-white" href="teachers.php">講師管理</a></li>
          <li class="breadcrumb-item text-sm text-white active" aria-current="page">新增講師</li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">主頁面</h6>
      </nav> -->
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

    <div class="main-content position-relative">
        <!-- Navbar -->
        <div class="container-fluid py-5">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                    <div class="card w-60">
                        <div class="card-header pb-0">
                            <a class="btn btn-primary " href="lecture.php" role="button"><i class="fa-solid fa-angles-left fa-fw"></i>回課程管理清單</a>
                            <div class="d-flex align-items-center pt-2">
                                <h4 class="mb-0">新增課程</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="doAddLecture.php" method="post" enctype="multipart/form-data">
                                <div class="container">
                                    <div class="st"></div>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-6 col-md-8 d-flex justify-content-center mt-8">
                                            <div class="previewimage border ">
                                                <img alt="圖片預覽">
                                                <div>
                                                    <button class="btn btn-danger deletebtn" type="hidden" id="deletebtn">刪除圖片</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-8">
                                            <div class="mb-2 st">
                                                <input type="text" class="form-control" name="name" placeholder="輸入課程名稱">
                                            </div>
                                            <div class="mb-2 d-flex st">
                                                <input type="text" class="form-control me-2" name="price" placeholder="輸入價格">
                                                <input type="text" class="form-control" name="amount" placeholder="輸入學生人數">
                                            </div>
                                            <div class="st mb-2 d-flex justify-content-evenly">
                                                <div>
                                                    <label for="" class="title">上課地點：</label>
                                                    <select name="location" id="">
                                                        <!-- multiple放在select本身 -->
                                                        <option value="">下拉選取</option>
                                                        <option value="1">台北市</option>
                                                        <option value="2">新北市</option>
                                                        <option value="3">基隆市</option>
                                                        <option value="4">桃園市</option>
                                                        <option value="5">新竹縣</option>
                                                        <option value="6">苗栗縣</option>
                                                        <option value="7">台中市</option>
                                                        <option value="8">彰化縣</option>
                                                        <option value="9">南投縣</option>
                                                        <option value="10">雲林縣</option>
                                                        <option value="11">嘉義縣</option>
                                                        <option value="12">台南市</option>
                                                        <option value="13">高雄市</option>
                                                        <option value="14">屏東縣</option>
                                                        <option value="15">台東縣</option>
                                                        <option value="16">花蓮縣</option>
                                                        <option value="17">宜蘭縣</option>
                                                        <option value="18">澎湖縣</option>
                                                        <option value="19">金門縣</option>
                                                        <option value="20">連江縣</option>
                                                        <!-- selected預設選項 -->
                                                    </select>
                                                </div>
                                                <div>
                                                    <label for="" class="title">授課老師：</label>
                                                    <select name="teacher_id" id="">
                                                        <!-- multiple放在select本身 -->
                                                        <option value="">下拉選取</option>
                                                        <option value="1">黃湘苗</option>
                                                        <option value="2">黃甄芸</option>
                                                        <option value="3">鍾家鋒</option>
                                                        <option value="4">薛昱靜</option>
                                                        <option value="5">潘培倫</option>
                                                        <option value="6">范佑柏</option>
                                                        <option value="7">卓毓國</option>
                                                        <option value="8">顏致宏</option>
                                                        <option value="9">連子昇</option>
                                                        <option value="10">施廷奕</option>
                                                        <option value="11">張少淳</option>
                                                        <option value="12">連澤恆</option>
                                                        <option value="13">傅靜婕</option>
                                                        <option value="14">顏睿恆</option>
                                                        <option value="15">張正昕</option>
                                                        <option value="16">王卓延</option>
                                                        <option value="17">羅嘉寧</option>
                                                        <option value="18">沈靖程</option>
                                                        <option value="19">連家恩</option>
                                                        <option value="20">楊敬祥</option>
                                                        <!-- selected預設選項 -->
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-2 st">
                                                <label for="" class="form-label">上課日期</label>
                                                <input type="date" class="form-control" name="starting_date">
                                                到
                                                <input type="date" class="form-control" name="ending_date">
                                            </div>
                                            <div class="mb-2 st">
                                                <label for="" class="form-label">上課日期</label>
                                                <input type="time" class="form-control" name="staring_time">
                                                到
                                                <input type="time" class="form-control" name="ending_time">
                                            </div>
                                            <div class="mb-2 form-floating st">
                                                <textarea class="form-control" name="description" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 150px"></textarea>
                                                <label for="floatingTextarea2">課程介紹</label>
                                            </div>
                                            <div class="mb-3 st">
                                                <label for="img" class="form-label">課程照片</label>
                                                <input class="form-control" type="file" id="img" name="img" multiple>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-grid d-flex gap-2 mx-auto text-center justify-content-center mt-6">
                                        <button type="submit" class="btn btn-primary">
                                            新增
                                        </button>
                                        <button type="reset" class="btn btn-primary">
                                            清除
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                <hr class="horizontal dark my-sm-4">
                <div class="mt-2 mb-5 d-flex">
                    <h6 class="mb-0">Light / Dark</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
                    </div>
                </div>
                <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/argon-dashboard">Free Download</a>
                <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard">View documentation</a>
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
    <!--   Core JS Files   -->
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
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>