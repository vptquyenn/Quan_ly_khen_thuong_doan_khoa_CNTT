<?php
    session_start();

    if(!isset($_SESSION['email'])){
        header('location:login.php');
    }
?>
<?php
	require_once 'bootstrap.php';
    
	use Ct271\Labs\B1910439;

	$b1910439 = new B1910439($PDO);
	$list_b1910439 = $b1910439->all();
?>

<?php include 'partials/header.php';?>

<body>
    <nav class="navbar-default navbar-fixed-top">
        <div class=" container-header-all">
            <div class="container navbar-header-header">
                <div class="navbar-header col-8">
                    <span class="navbar-brand"><i class="fa fa-user-circle" aria-hidden="true"></i> QUẢN
                        LÝ CÔNG TÁC KHEN THƯỞNG ĐOÀN KHOA CNTT&TT
                    </span>
                </div>
                <div class="navbar-collaps col-4" id="myNavbar" style="font-size: 12px;">
                    <div class="me-1 col-3 nav_item_link">
                        <a class="header-navbar-link"  href="ttstudent.php" style="padding-bottom: 16px; margin-bottom: 35px; border-bottom: 3px solid white; font-weight: 700;">TT Cá Nhân</a>
                    </div>
                    <div class="me-1 col-3 nav_item_link">
                        <a class="header-navbar-link"  href="dangki439.php" style="font-weight: 700;">DS Hoạt Động</a>
                    </div>
                    <div class="me-1 col-3 nav_item_link">
                        <a class="header-navbar-link"  href="kt_of_sv.php" style="font-weight: 700;">Khen Thưởng</a>
                    </div>
                    <div class="me-1 col-3 nav_item_link">
                        <a class="header-navbar-link" href="logout.php" style="font-weight: 700;">Đăng Xuất</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid al">
        <div id="clock"></div>
        <Br>
        <table class="table-bordered" id="myTable" style="margin-left: 400px; width: 700px;">
            <thead>
                <tr class="ex">
                    <th style="font-size:18px;">Thông Tin Cá Nhân</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($list_b1910439 as $b1910439): ?>
				<tr>
                    <th style="font-size:16px;" >Mã Số Sinh Viên: <?=htmlspecialchars($b1910439->mssv)?></th>
				</tr>
                <tr>
                    <th style="font-size:16px;">Họ Tên: <?=htmlspecialchars($b1910439->ho_ten)?></th>
				</tr>
                <tr>
                    <th style="font-size:16px;">Giới Tính:  <?=htmlspecialchars($b1910439->gioi_tinh)?></th>
				</tr>
                <tr>
                    <th style="font-size:16px;">Lớp: <?=htmlspecialchars($b1910439->lop)?></th>
				</tr>
                <tr>
                    <th style="font-size:16px;">Khoa: <?=htmlspecialchars($b1910439->khoa)?></th>
				</tr>
                <tr>
                    <th style="font-size:16px;">Ngày Sinh: <?=date("d-m-Y", strtotime($b1910439->ngay_sinh))?></th>
				</tr>
                <tr>
                    <th style="font-size:16px;">Nơi Sinh: <?=htmlspecialchars($b1910439->noi_sinh)?></th>
				</tr>
                <tr>
                    <th style="font-size:16px;">Quê Quán: <?=htmlspecialchars($b1910439->thuong_tru)?></th>
				</tr>
                <tr>
                    <td class="text-center">
                        <a href="<?=BASE_URL_PATH . 'edit_canhan.php?id=' . $b1910439->getId()?>" style="text-decoration: none; font-size:14px;">Cập Nhật Thông Tin</a>
                    </td>
				</tr>
            <?php endforeach ?>
			</tbody>
        </table>

    <?php include 'partials/footer.php';?>
</body>
</html>