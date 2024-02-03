<?php

require_once("../machi_db_connect.php");
$perPage = 10;

$sql = "SELECT product.*, category.category_name
        FROM product
        INNER JOIN category ON product.category_id_fk = category.category_id";
$result = $conn->query($sql);

$rows = $result->fetch_all(MYSQLI_ASSOC);


$sqlAll = "SELECT * FROM product";
$resultAll = $conn->query($sqlAll);
$productTotalCount = $resultAll->num_rows;

$pageCount = ceil($productTotalCount / $perPage);


// 判斷是否有排序的參數
if (isset($_GET["order"])) {
  $order = $_GET["order"];

  if ($order == 1) {
    $orderStringAD = "ASC";
  } elseif ($order == 2) {
    $orderStringAD = "DESC";
  }
} else {
  $orderStringAD = "ASC";
}

// 判斷是否有排序的參數
if (isset($_GET["sort"])) {
  $sort = $_GET["sort"];
  if ($sort == 1) {
    $orderString = "ORDER BY product_id $orderStringAD";
  } elseif ($sort == 2) {
    $orderString = "ORDER BY product_name $orderStringAD";
  } elseif ($sort == 3) {
    $orderString = "ORDER BY product_price $orderStringAD";
  } elseif ($sort == 4) {
    $orderString = "ORDER BY product_count $orderStringAD";
  } elseif ($sort == 5) {
    $orderString = "ORDER BY category_id_fk $orderStringAD";
  } elseif ($sort == 6) {
    $orderString = "ORDER BY product_updatetime $orderStringAD";
  } elseif ($sort == 7) {
    $orderString = "ORDER BY product_valid $orderStringAD";
  }

} else {
  $orderString = "ORDER BY product_id $orderStringAD";
}




if (isset($_GET["search"])) {
  $search = $_GET["search"];
  $sql = "SELECT product.*, category.category_name
FROM product
INNER JOIN category ON product.category_id_fk = category.category_id WHERE product_name LIKE '%$search%'";
} elseif (isset($_GET["p"])) {
  $p = $_GET["p"];
  $startIndex = ($p - 1) * $perPage;
  // $orderString = "ORDER BY product_id ASC";
  $sql = "SELECT product.*, category.category_name
FROM product
INNER JOIN category ON product.category_id_fk = category.category_id $orderString LIMIT $startIndex,$perPage";
} else {
  $p = 1;
  // $orderString = "ORDER BY product_id ASC";
  $sql = "SELECT product.*, category.category_name
FROM product
INNER JOIN category ON product.category_id_fk = category.category_id $orderString LIMIT $perPage";
}

// echo "<pre>";
// print_r($rows);
// echo "</pre>";






$result = $conn->query($sql);

if (isset($_GET["search"])) {
  $productCount = $result->num_rows;
} else {
  $productCount = $productTotalCount;
}






?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrinks-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>商品頁面</title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/simple-datatables.js"></script>
  <style>
    .pagination {
      display: flex;
      list-style: none;
      padding: 0;

    }

    .pagination li {
      margin: 0;
    }

    .pagination a {
      color: black;
      padding: 8px 16px;
      text-decoration: none;
      transition: background-color .3s;
      border: 1px solid #ddd;
      margin: 0;
      /* 調整這裡的間距 */
    }

    .pagination a.active {
      background-color: dodgerblue;
      color: white;
      border: 1px solid dodgerblue;
    }

    .pagination a:hover:not(.active) {
      background-color: #ddd;
    }
  </style>
</head>

<body class="sb-nav-fixed">
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
        class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
          aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="#!">Settings</a></li>
          <li><a class="dropdown-item" href="#!">Activity Log</a></li>
          <li>
            <hr class="dropdown-divider" />
          </li>
          <li><a class="dropdown-item" href="#!">Logout</a></li>
        </ul>
      </li>
    </ul>
  </nav>
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link" href="index.html">
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">Interface</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
              aria-expanded="false" aria-controls="collapseLayouts">
              <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
              Layouts
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="layout-static.html">Static Navigation</a>
                <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
              </nav>
            </div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
              aria-expanded="false" aria-controls="collapsePages">
              <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
              Pages
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth"
                  aria-expanded="false" aria-controls="pagesCollapseAuth">
                  Authentication
                  <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                  data-bs-parent="#sidenavAccordionPages">
                  <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="login.html">Login</a>
                    <a class="nav-link" href="register.html">Register</a>
                    <a class="nav-link" href="password.html">Forgot Password</a>
                  </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError"
                  aria-expanded="false" aria-controls="pagesCollapseError">
                  Error
                  <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                  data-bs-parent="#sidenavAccordionPages">
                  <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="401.html">401 Page</a>
                    <a class="nav-link" href="404.html">404 Page</a>
                    <a class="nav-link" href="500.html">500 Page</a>
                  </nav>
                </div>
              </nav>
            </div>
            <div class="sb-sidenav-menu-heading">Addons</div>
            <a class="nav-link" href="charts.html">
              <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
              Charts
            </a>
            <a class="nav-link" href="product-list.php?sort=<?= $sort ?>&p=<?= $i ?>">
              <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
              商品頁面
            </a>
          </div>
        </div>
        <div class="sb-sidenav-footer">
          <div class="small">Logged in as:</div>
          Start Bootstrap
        </div>
      </nav>
    </div>
    <div id="layoutSidenav_content">
      <!-- machi -->
      <main>

        <div class="container-fluid px-4">
          <h1 class="mt-4">商品頁面</h1>
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">商品頁面</li>
          </ol>
          <div class="container">

            <div class="py-2">
              <div class="row g-3">

                <div class="col">
                  <?php if (isset($_GET["search"])): ?>
                    <div class="col-auto">
                      <a class="btn btn-outline-success me-2"
                        href="product-list.php?sort=<?= isset($_GET['sort']) ? $_GET['sort'] : '' ?>&p=<?= isset($_GET['p']) ? $_GET['p'] : '1' ?>"><i
                          class="fa-solid fa-rotate-right"></i></a>
                    </div>
                  <?php endif; ?>
                </div>
                <div class="col"></div>
                <div class="col"></div>
                <div class="col">
                  <form class="d-flex flex-grow-1" action="product-list.php" method="get">
                    <input class="form-control flex-grow-1 me-2" type="search" placeholder="輸入關鍵字" aria-label="搜尋"
                      name="search">
                    <input type="hidden" name="scope">
                    <button class="btn btn-outline-primary ms-auto" type="submit" style="min-width: 60px;"> <i
                        class="fa fa-search"></i></button>
                  </form>
                </div>
              </div>
            </div>

            <div class="d-flex justify-content-between pb-2 align-items-center">
              <div>
                共
                <?= $productCount ?> 項
              </div>


              <div>
                <div class="container-fluid d-flex justify-content-end my-2">
                  <!-- 排序根據的下拉選單 -->
                  <div class="dropdown ">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuSort"
                      data-bs-toggle="dropdown" aria-expanded="false">
                      排序依據
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuSort">
                      <li><a class="dropdown-item" href="?sort=1">
                          商品ID</a></li>
                      <li><a class="dropdown-item" href="?sort=2">商品名稱</a></li>
                      <li><a class="dropdown-item" href="?sort=3">售價</a></li>
                      <li><a class="dropdown-item" href="?sort=4">售出數量</a></li>
                      <li><a class="dropdown-item" href="?sort=5">商品主類</a></li>
                      <li><a class="dropdown-item" href="?sort=6">更改時間</a></li>
                      <li><a class="dropdown-item" href="?sort=7">上架狀態</a></li>
                    </ul>
                  </div>

                  <!-- 切換升降順序的按鈕 -->
                  <button class="btn btn-outline-success ml-2 mx-2" type="button" id="toggleSortOrder">
                    <i class="fa-solid fa-arrow-up-wide-short" id="sortIcon"> </i>
                  </button>
                  <a name="" id="" class="btn btn-primary " href="product-add.php" role="button">新增商品</i></a>
                </div>
              </div>


            </div>



            <table id="productTable" class="table table-bordered table-striped">
              <thead class="table-dark">
                <tr>
                  <th>商品ID

                  </th>
                  <th>商品名稱

                  </th>
                  <th>售價

                  </th>
                  <th>售出數量

                  </th>
                  <th>商品主類

                  </th>
                  <th>更改時間

                  </th>
                  <th>上架狀態

                  </th>
                  <th></th>

                </tr>
              </thead>
              <tbody>
                <?php

                $result = $conn->query($sql);

                $rows = $result->fetch_all(MYSQLI_ASSOC);
                foreach ($rows as $product):

                  ?>
                  <tr>
                    <td>
                      <?= $product["product_id"] ?>
                    </td>
                    <td>
                      <?= $product["product_name"] ?>
                    </td>
                    <td>
                      <?= $product["product_price"] ?>
                    </td>
                    <td>
                      <?= $product["product_count"] ?>
                    </td>
                    <td>
                      <?= $product["category_name"] ?>
                    </td>
                    <td>
                      <?= $product["product_updatetime"] ?>
                    </td>
                    <td>
                      <?php if ($product["product_valid"] == 1): ?>
                        <form action="product-valid.php" method="get">
                          <input type="hidden" name="product_id" value="<?= $product["product_id"] ?>">
                          <button type="submit" class="btn btn-outline-primary  mx-2"><i
                              class="fa-solid fa-eye"></i></button>
                        </form>
                      <?php else: ?>
                        <form action="product-valid.php" method="get">
                          <input type="hidden" name="product_id" value="<?= $product["product_id"] ?>">
                          <button type="submit" class="btn  btn-outline-secondary mx-2"><i
                              class="fa-solid fa-eye-slash"></i></button>
                        </form>
                      <?php endif ?>
                    </td>
                    <td class="d-flex justify-content-center ">

                      <a class="btn btn-primary mx-2 " href="product_edit.php?id=<?= $product["product_id"] ?>"
                        role="button">詳細資料</a>

                      <button class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#confirmModal<?= $product["product_id"] ?>"><i
                          class="fa-solid fa-trash fa-fw"></i></button>


                      <div class="modal fade" id="confirmModal<?= $product["product_id"] ?>" tabindex="-1"
                        aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">刪除商品</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              確認刪除?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                              <form action="product_delete.php" method="post">
                                <input type="hidden" name="product_id" value="<?= $product["product_id"] ?>">
                                <button type="submit" class="btn btn-danger">確認刪除

                                </button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>


                    </td>
                  </tr>
                <?php endforeach; ?>



              </tbody>



            </table>
            <nav aria-label="Page navigation example">
              <ul class="pagination" id="pagination">
                <!-- 此處將在JavaScript中動態生成分頁連結 -->
              </ul>
            </nav>

          </div>



        </div>
      </main>
      <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
          <div class="d-flex align-items-center justify-content-center small">
            <div class="text-muted">TaiwanNo.1 &copy; Machi bakery 2024</div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <?php include("../js.php") ?>
  <script>
    $(document).ready(function () {
      // 獲取網址的查詢參數
      var params = new URLSearchParams(window.location.search);

      // 從 PHP 程式碼中獲取總頁數
      var pageCount = <?php echo $pageCount; ?>;

      // 獲取當前頁碼
      var currentPage = <?php echo $p; ?>;

      // 計算起始和結束頁碼
      var startPage = Math.max(1, currentPage - 2);
      var endPage = Math.min(pageCount, startPage + 4);
      startPage = Math.max(1, endPage - 4);

      // 建立分頁連結
      var pagination = $('#pagination');

      // 添加首頁連結
      params.set('p', 1);
      pagination.append('<li><a href="?' + params.toString() + '">首頁</a></li>');

      // 添加分頁連結
      for (var i = startPage; i <= endPage; i++) {
        // 如果已經添加了5個分頁按鈕，則停止添加
        if (i - startPage >= 5) {
          break;
        }
        var li = $('<li></li>');
        var a = $('<a></a>');
        params.set('p', i);
        a.attr('href', '?' + params.toString());
        a.text(i);
        if (i === currentPage) {
          li.addClass('active');
        }
        li.append(a);
        pagination.append(li);
      }

      // 添加末頁連結
      params.set('p', pageCount);
      pagination.append('<li><a href="?' + params.toString() + '">末頁</a></li>');
    });
  </script>
  <!-------------------------------------------------------------分頁用的ajax↑ ------------------------------------------------ -->


  <script>
    $(document).ready(function () {
      // 獲取網址的查詢參數
      var params = new URLSearchParams(window.location.search);

      // 獲取 'scope' 參數的值
      var scope = params.get('scope');

      // 為 "找關鍵字" 按鈕添加點擊事件處理器
      $('#searchButton').click(function () {
        // 如果 'scope' 參數的值為 'all'，則將其設定為 'byid'，並將按鈕的文字設定為 '找ID'
        if (scope === 'id') {
          scope = 'all';
        } else {
          // 否則將 'scope' 參數的值設定為 'all'，並將按鈕的文字設定為 '找全部關鍵字'
          scope = 'id';
        }

        // 更新網址的查詢參數
        params.set('scope', scope);

        // 重新導向到新的網址
        window.location.href = window.location.pathname + '?' + params.toString();
      });

      // 獲取 'sort' 參數的值
      var sort = params.get('sort');

      // 獲取 'order' 參數的值
      var order = params.get('order');

      // 如果 'order' 參數的值為 '2'，則將箭頭圖標設定為向下，否則設定為向上
      if (order === '2') {
        $('#sortIcon').removeClass('fa-arrow-up-wide-short').addClass('fa-arrow-down-wide-short');
      } else {
        $('#sortIcon').removeClass('fa-arrow-down-wide-short').addClass('fa-arrow-up-wide-short');
      }

      // 為切換升降順序的按鈕添加點擊事件處理器
      $('#toggleSortOrder').click(function () {
        // 如果 'order' 參數的值為 '2'，則將其設定為 '1'，否則設定為 '2'
        if (order === '2') {
          order = '1';
        } else {
          order = '2';
        }


        $(document).ready(function () {
          // 獲取網址的查詢參數
          var params = new URLSearchParams(window.location.search);

          // 獲取 'sort' 參數的值
          var sort = params.get('sort');
          var scope = params.get('scope');

          // 根據 'sort' 參數的值來設定按鈕的文字
          switch (sort) {
            case '1':
              $('#dropdownMenuSort').text('商品ID');
              break;
            case '2':
              $('#dropdownMenuSort').text('商品名稱');
              break;
            case '3':
              $('#dropdownMenuSort').text('售價');
              break;
            case '4':
              $('#dropdownMenuSort').text('售出數量');
              break;
            case '5':
              $('#dropdownMenuSort').text('	商品主類');
              break;
            case '6':
              $('#dropdownMenuSort').text('更新時間');
              break;
            case '7':
              $('#dropdownMenuSort').text('上架狀態');
              break;
            default:
              $('#dropdownMenuSort').text('排序依據');
              break;
          }
          if (scope === 'id') {
            $('#searchButton').text('找ID');
            $('input[name="search"]').attr('placeholder', '輸入會員ID');
            $('input[name="scope"]').val('id');
          } else {
            $('#searchButton').text('找關鍵字');
            $('input[name="search"]').attr('placeholder', '輸入關鍵字');
            $('input[name="scope"]').val('all');
          }

        });



        // 更新網址的查詢參數
        params.set('order', order);

        // 重新導向到新的網址
        window.location.href = window.location.pathname + '?' + params.toString();
      });

      // 為每個下拉選單項目添加點擊事件處理器
      $('.dropdown-item').click(function (e) {
        e.preventDefault();

        // 獲取選擇的值
        sort = $(this).attr('href').split('=')[1];

        // 更新按鈕的文字
        $('#dropdownMenuSort').text($(this).text());

        // 更新網址的查詢參數
        params.set('sort', sort);

        // 重新導向到新的網址
        window.location.href = window.location.pathname + '?' + params.toString();
      });

      var url = new URL(window.location.href);

      // 獲取 search 參數的值
      var search = url.searchParams.get('search');

      // 如果 search 參數存在，則將搜尋輸入框的值設定為該值
      if (search) {
        document.querySelector('input[name="search"]').value = search;
      }
    });
  </script>

</body>

</html>