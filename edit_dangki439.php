<?php
    session_start();

    if(!isset($_SESSION['email'])){
        header('location:login.php');
    }
?>
<?php
	require_once 'bootstrap.php';
	include "src/Dangki439.php";

	use Ct271\Labs\Dangki439;

	$dangki439 = new Dangki439($PDO);

	$id = isset($_REQUEST['id']) ?
		filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT) : -1;

	if ($id < 0 || !($dangki439->find($id))) {
		redirect("dangki.php");
	} 
	
	$errors = [];
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if ($dangki439->update($_POST)) {
			// Cập nhật dữ liệu thành công
			redirect("dangki.php");
		} 
		// Cập nhật dữ liệu không thành công
		$errors = $dangki439->getValidationErrors();
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
            <input type="hidden" name="id" value="<?= htmlspecialchars($dangki439->getId()) ?>">

            <h2 class='text-center text-primary m-0 ps-5'>Cập Nhật Trạng Thái Tham Gia Của Sinh Viên</h2>

            <div class="form-group<?= isset($errors['mssv']) ? ' has-error' : '' ?>" style="margin-top: 20px">
                <label for="mssv">MSSV</label>
                <input type="text" name="mssv" class="form-control" maxlen="255" id="mssv" placeholder="Nhập MSSV" 
                    value="<?= htmlspecialchars($dangki439->mssv) ?>" />

                <?php if (isset($errors['mssv'])) : ?>
                    <span class="help-block">
                        <strong><?= htmlspecialchars($errors['mssv']) ?></strong>
                    </span>
                <?php endif ?>
            </div>

            <div class="form-group<?= isset($errors['ho_ten']) ? ' has-error' : '' ?>">
                <label for="ho_ten">Họ Tên</label>
                <input type="text" name="ho_ten" class="form-control" maxlen="255" id="ho_ten" placeholder="Nhập Họ Tên" 
                    value="<?= htmlspecialchars($dangki439->ho_ten) ?>" />

                <?php if (isset($errors['ho_ten'])) : ?>
                    <span class="help-block">
                        <strong><?= htmlspecialchars($errors['ho_ten']) ?></strong>
                    </span>
                <?php endif ?>
            </div>

            <div class="form-group<?= isset($errors['lop']) ? ' has-error' : '' ?>">
                <label for="lop">Lớp</label>
                <input type="text" name="lop" class="form-control" maxlen="255" id="lop" placeholder="Nhập Lớp"
                    value="<?= htmlspecialchars($dangki439->lop) ?>" />

                <?php if (isset($errors['lop'])) : ?>
                    <span class="help-block">
                        <strong><?= htmlspecialchars($errors['lop']) ?></strong>
                    </span>
                <?php endif ?>
            </div>

            <div class="form-group<?= isset($errors['khoa']) ? ' has-error' : '' ?>">
                <label for="khoa">Khoa</label>
                <input type="text" name="khoa" class="form-control" maxlen="255" id="khoa" placeholder="Nhập Khoa"
                    value="<?= htmlspecialchars($dangki439->khoa) ?>" />

                <?php if (isset($errors['khoa'])) : ?>
                    <span class="help-block">
                        <strong><?= htmlspecialchars($errors['khoa']) ?></strong>
                    </span>
                <?php endif ?>
            </div>

            <div class="form-group<?= isset($errors['fk_idct']) ? ' has-error' : '' ?>" style="margin-bottom: 20px">
                <label for="fk_idct">Trạng Thái Tham Gia</label>
                <select type="text" name="fk_idct" class="form-control" maxlen="255" id="fk_idct" placeholder="" value="<?= htmlspecialchars($dangki439->fk_idct) ?>">
                    <option value="1">Đã Đăng Ký</option>
                    <option value="2">Không tham gia</option>
                    <option value="3">Có tham gia</option>
                </select>

                <?php if (isset($errors['fk_idct'])) : ?>
                    <span class="help-block">
                        <strong><?= htmlspecialchars($errors['fk_idct']) ?></strong>
                    </span>
                <?php endif ?>                
            </div>

            <!-- Submit -->
            <button class="btn btn-secondary">
                    <a class="return" href="dangki.php">Quay Lại</a>
            </button>
            <button type="submit" name="submit" id="submit" class="btn btn-primary">Cập Nhật Trạng Thái</button>
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
