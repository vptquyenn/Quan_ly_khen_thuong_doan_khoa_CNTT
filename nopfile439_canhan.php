<?php
    session_start();

    if(!isset($_SESSION['email'])){
        header('location:login.php');
    }
?>
<?php
	require_once 'bootstrap.php';
	include "src/B1910439.php";

	use Ct271\Labs\B1910439;

	$b1910439 = new B1910439($PDO);

	$id = isset($_REQUEST['id']) ?
		filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT) : -1;

	if ($id < 0 || !($b1910439->find($id))) {
		redirect("kt_of_sv.php");
	}
	
	$errors = [];
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if ($b1910439->update($_POST)) {
			// Cập nhật dữ liệu thành công
			redirect("kt_of_sv.php");
		} 
		// Cập nhật dữ liệu không thành công
		$errors = $b1910439->getValidationErrors();
    }
?>
<?php include 'partials/header.php';?>

<body onload="time()">
    <nav class="navbar-default navbar-fixed-top">
        <div class=" container-header-all">
            <div class="container navbar-header-header">
                <div class="navbar-header col-12" style="margin-top: 34px; margin-left: -183px;">
                    <span class="navbar-brand"><i class="fa fa-user-circle" aria-hidden="true"></i> QUẢN
                        LÝ CÔNG TÁC KHEN THƯỞNG ĐOÀN KHOA CNTT&TT
                    </span>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid al">
        <div id="clock"></div>
        <Br>
		<form name="frm" id="frm" action="" method="post" class="col-md-6 col-md-offset-3" style="margin-left: 350px">
            <input type="hidden" name="id" value="<?= htmlspecialchars($b1910439->getId()) ?>">

            <h2 class='text-center text-primary m-0 ps-5'>Nộp File Đánh Giá</h2>
            <div class="form-group<?= isset($errors['mssv']) ? ' has-error' : '' ?>">
                <label for="mssv">MSSV</label>
                <input type="text" name="mssv" class="form-control" maxlen="255" id="mssv" placeholder="Nhập MSSV" 
                    value="<?= htmlspecialchars($b1910439->mssv) ?>" />

                <?php if (isset($errors['mssv'])) : ?>
                    <span class="help-block">
                        <strong><?= htmlspecialchars($errors['mssv']) ?></strong>
                    </span>
                <?php endif ?>
            </div>

            <div class="form-group<?= isset($errors['ho_ten']) ? ' has-error' : '' ?>">
                <label for="ho_ten">Họ Tên</label>
                <input type="text" name="ho_ten" class="form-control" maxlen="255" id="ho_ten" placeholder="Nhập Họ Tên" 
                    value="<?= htmlspecialchars($b1910439->ho_ten) ?>" />

                <?php if (isset($errors['ho_ten'])) : ?>
                    <span class="help-block">
                        <strong><?= htmlspecialchars($errors['ho_ten']) ?></strong>
                    </span>
                <?php endif ?>
            </div>

            <div class="form-group<?= isset($errors['lop']) ? ' has-error' : '' ?>">
                <label for="lop">Lớp</label>
                <input type="text" name="lop" class="form-control" maxlen="255" id="lop" placeholder="Nhập Lớp"
                    value="<?= htmlspecialchars($b1910439->lop) ?>" />

                <?php if (isset($errors['lop'])) : ?>
                    <span class="help-block">
                        <strong><?= htmlspecialchars($errors['lop']) ?></strong>
                    </span>
                <?php endif ?>
            </div>

            <div class="form-group<?= isset($errors['filename']) ? ' has-error' : '' ?>">
                <label for="filename">Nộp File Đánh Giá</label>
                <input type="file" name="filename" class="form-control" maxlen="255" id="filename" placeholder="Nhập filename" 
                    value="<?= htmlspecialchars($b1910439->filename) ?>" />

                <?php if (isset($errors['filename'])) : ?>
                    <span class="help-block">
                        <strong><?= htmlspecialchars($errors['filename']) ?></strong>
                    </span>
                <?php endif ?>
            </div>

            <!-- Submit -->
            <button class="btn btn-secondary">
                    <a class="return" href="kt_of_sv.php">Quay Lại</a>
            </button>
            <button type="submit" name="submit" id="submit" class="btn btn-primary">Nộp File</button>
        </form>

        <?php include 'partials/footer.php';?>

       
        <script>
            function time() {
			    var today = new Date();
                var weekday = new Array(7);
                weekday[0] = "Chủ Nhật";
                weekday[1] = "Thứ Hai";
                weekday[2] = "Thứ Ba";
                weekday[3] = "Thứ Tư";
                weekday[4] = "Thứ Năm";
                weekday[5] = "Thứ Sáu";
                weekday[6] = "Thứ Bảy";
                var day = weekday[today.getDay()];
                var dd = today.getDate();
                var mm = today.getMonth() + 1;
                var yyyy = today.getFullYear();
                var h = today.getHours();
                var m = today.getMinutes();
                var s = today.getSeconds();
                m = checkTime(m);
                s = checkTime(s);
                nowTime = h + ":" + m + ":" + s;
                if (dd < 10) {
                    dd = '0' + dd
                }
                if (mm < 10) {
                    mm = '0' + mm
                }
                today = day + ', ' + dd + '/' + mm + '/' + yyyy;
                tmp = '<i class="fa fa-clock-o" aria-hidden="true"></i> <span class="date">' + today + ' | ' + nowTime +
                    '</span>';
                document.getElementById("clock").innerHTML = tmp;
                clocktime = setTimeout("time()", "1000", "Javascript");

                function checkTime(i) {
                    if (i < 10) {
                        i = "0" + i;
                    }
                    return i;
                }
            }
        </script>
</body>
</html>
