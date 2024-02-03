<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    新增講師資料
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


  

</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="position-absolute w-100 min-height-300 bg-primary" >
    <span class="mask bg-primary"></span>
  </div>
  <nav class="navbar navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl w-60 mx-auto position-relative" id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3 ">
        <nav aria-label="breadcrumb ">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">主頁面</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page" ><a class="opacity-5 text-white" href="teachers.php">講師管理</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">新增講師</li>
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
  
  <div class="main-content position-relative">
    <!-- Navbar -->
    
    
    <div class="container-fluid py-5">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
            <div class="card w-60">
                <div class="card-header pb-0">
                    <a class="btn btn-primary " href="teachers.php" role="button"><i class="fa-solid fa-angles-left fa-fw"></i>回講師列表</a>
                    <div class="d-flex align-items-center pt-2">
                        <h4 class="mb-0">新增講師資料</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="--doAddTeacher.php" method="post" enctype="multipart/form-data" onsubmit="return checkFile()">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label fs-6">講師姓名：</label>
                                    <input placeholder="請輸入姓名" class="form-control fs-6" type="text" name="name" oninput="checkNameLength(this)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label fs-6">性別：</label>
                                        <select placeholder="請選擇性別" name="gender" id="genderSelect" class="form-select" onchange="checkGenderValue(this)">
                                            <option value="">請選擇性別</option>
                                            <option value="男">男</option>
                                            <option value="女">女</option>
                                            <option value="其他">其他</option>
                                        </select>
                                        <!-- <input placeholder="請輸入性別" class="form-control fs-6" type="text" name="gender"> -->
                                    </div>
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label fs-6">手機：</label>
                                    <input placeholder="請輸入手機號碼" class="form-control fs-6" type="text" name="phone" oninput="checkPhoneLength(this)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label fs-6">信箱：</label>
                                    <input placeholder="請輸入有效電子信箱" class="form-control fs-6" type="email" name="email" oninput="checkEmailLength(this)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label fs-6">講師介紹：</label>
                                    <textarea placeholder="請輸入200字內講師介紹" class="form-control fs-6" type="text" rows="5" style="resize: none" name="intro" oninput="checkIntroLength(this)"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="form-label fs-6">選擇照片：</label>
                                    <input type="file" class="form-control" name="img" id="imgInput">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-sm ms-auto mx-auto d-flex justify-content-center m-4 fs-6">新增</button>

                    </form>
                    
                </div>
            </div>
            </div>
            
        </div>





































      
      <footer class="footer pt-3  w-60 mx-auto">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                for a better web.
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
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




  <script>

    // 設定名字字數不能超過50
    function checkNameLength(input) {
            var name = input.value;
            var maxLength = 50;
            
            if (name.length > maxLength) {
                alert("姓名字數過長");
                input.value = name.substring(0, maxLength); // 截斷超過的部分
            }
    }

    // 設定性別不能未選擇 (未完成)
    function checkGenderValue(select) {
      var gender = select.value;

        // 檢查是否選擇了性別
        if (gender === "") {
            alert("請選擇性別");
            return false; // 阻止表單提交
        }

        // 其他檢查條件...

        return true; // 允許表單提交
    }





    // 設定電話字數不能超過20
    function checkPhoneLength(input) {
            var phone = input.value;
            var maxLength = 20;
            
            if (phone.length > maxLength) {
                alert("手機號碼過長");
                input.value = phone.substring(0, maxLength); // 截斷超過的部分
            }
    }



    // 設定信箱字數不能超過50
    function checkEmailLength(input) {
            var email = input.value;
            var maxLength = 50;
            
            if (email.length > maxLength) {
                alert("信箱過長");
                input.value = email.substring(0, maxLength); // 截斷超過的部分
            }
    }





    // 設定介紹輸入欄位不可超過200字數
    function checkIntroLength(textarea) {
        var intro = textarea.value;
        var maxLength = 200;
        
        if (intro.length > maxLength) {
            alert("教師介紹字數請小於200");
            textarea.value = intro.substring(0, maxLength); // 截斷超過的部分
        }
    }

    // 設定必須繳交檔案
    function checkFile() {
        var fileInput = document.getElementById('imgInput');
        
        // 檢查是否有選擇檔案
        if (fileInput.files.length === 0) {
            alert("請選擇照片檔案");
            return false; // 阻止表單提交
        }

        // 檢查其他條件...
        
        return true; // 允許表單提交
    }
  </script>








</body>

</html>











