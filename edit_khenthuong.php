<?php
    session_start();

    if(!isset($_SESSION['email'])){
        header('location:login.php');
    }
?>
<?php
	require_once 'bootstrap.php';
	include "src/Khenthuong.php";

	use Ct271\Labs\Khenthuong;

	$khenthuong = new Khenthuong($PDO);

	$id = isset($_REQUEST['id']) ?
		filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT) : -1;

	if ($id < 0 || !($khenthuong->find($id))) {
		redirect("khenthuong.php");
	} 
	
	$errors = [];
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if ($khenthuong->update($_POST)) {
			// Cập nhật dữ liệu thành công
			redirect("khenthuong.php");
		} 
		// Cập nhật dữ liệu không thành công
		$errors = $khenthuong->getValidationErrors();
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

            <input type="hidden" name="id" value="<?= htmlspecialchars($khenthuong->getId()) ?>">

            <h2 class='text-center text-primary mb-4 ps-5'>Khen THưởng</h2>

            <div class="form-group<?= isset($errors['noidung_hoatdong']) ? ' has-error' : '' ?>" style="margin-bottom: 20px">
                <label for="noidung_hoatdong">Chương Trình Hoạt Động Đã Tham Gia</label>
                <textarea name="noidung_hoatdong" id="noidung_hoatdong" class="form-control" style="margin-top:8px;" 
                    placeholder="Nhập Chương Trình Hoạt Động Đã Tham Gia (maximum character limit: 255)"><?= htmlspecialchars($khenthuong->noidung_hoatdong) ?></textarea>

                <?php if (isset($errors['noidung_hoatdong'])) : ?>
                    <span class="help-block">
                        <strong><?= htmlspecialchars($errors['noidung_hoatdong']) ?></strong>
                    </span>
                <?php endif ?>
            </div>

            <div class="form-group<?= isset($errors['hoc_ki']) ? ' has-error' : '' ?>" style="margin-bottom: 20px">
                <label for="description">Học Kì</label>
                <input type="text" name="hoc_ki" class="form-control" maxlen="255" id="hoc_ki" placeholder="Nhập Học Kì"
                    value="<?= htmlspecialchars($khenthuong->hoc_ki) ?>" />

                <?php if (isset($errors['hoc_ki'])) : ?>
                    <span class="help-block">
                        <strong><?= htmlspecialchars($errors['hoc_ki']) ?></strong>
                    </span>
                <?php endif ?>
            </div>

            <div class="form-group<?= isset($errors['diemrl']) ? ' has-error' : '' ?>" style="margin-bottom: 20px">
                <label for="description">Điểm Rèn Luyện</label>
                <input type="text" name="diemrl" class="form-control" maxlen="255" id="diemrl" placeholder="Nhập Điểm Rèn Luyện"
                    value="<?= htmlspecialchars($khenthuong->diemrl) ?>" />

                <?php if (isset($errors['diemrl'])) : ?>
                    <span class="help-block">
                        <strong><?= htmlspecialchars($errors['diemrl']) ?></strong>
                    </span>
                <?php endif ?>
            </div>

            <div class="form-group<?= isset($errors['xeploai']) ? ' has-error' : '' ?>" style="margin-bottom: 20px">
                <label for="description">Xếp Loại</label>
                <input type="text" name="xeploai" class="form-control" maxlen="255" id="xeploai" placeholder="Nhập Xếp Loại"
                    value="<?= htmlspecialchars($khenthuong->xeploai) ?>" />

                <?php if (isset($errors['xeploai'])) : ?>
                    <span class="help-block">
                        <strong><?= htmlspecialchars($errors['xeploai']) ?></strong>
                    </span>
                <?php endif ?>
            </div>

            <button class="btn btn-secondary">
                <a class="return" href="khenthuong.php">Quay Lại</a>
            </button>
            <button type="submit" name="submit" id="submit" class="btn btn-primary" href="hoatdong.php">Khen Thưởng</button>
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