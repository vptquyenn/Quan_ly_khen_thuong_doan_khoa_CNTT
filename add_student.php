<?php include 'partials/header.php';?>
<?php
    session_start();

    if(!isset($_SESSION['email'])){
        header('location:login.php');
    }
?>
<?php
	require_once 'bootstrap.php';

	use Ct271\Labs\Contact;

	$errors = [];

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$contact = new Contact($PDO);
		$contact->fill($_POST);
		if ($contact->validate()) {
			$contact->save() && redirect("student.php");
		} 
	
		$errors = $contact->getValidationErrors();
	} 
?>

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
        <form name="frm" id="frm" action="" enctype="multipart/form-data" method="post" class="col-md-6 col-md-offset-3" style="margin-left: 350px">
            <h2 class='text-center text-primary m-0 ps-5'>Thêm Sinh Viên</h2>
            
            <div class="form-group<?= isset($errors['mssv']) ? ' has-error' : '' ?>">
                <label for="mssv">MSSV</label>
                <input type="text" name="mssv" class="form-control" maxlen="255" id="mssv" placeholder="Nhập MSSV" 
                    value="<?= isset($_POST['mssv']) ? htmlspecialchars($_POST['mssv']) : '' ?>" />

                <?php if (isset($errors['mssv'])) : ?>
                    <span class="help-block">
                        <strong><?= htmlspecialchars($errors['mssv']) ?></strong>
                    </span>
                <?php endif ?>
            </div>

            <div class="form-group<?= isset($errors['ho_ten']) ? ' has-error' : '' ?>">
                <label for="ho_ten">Họ Tên</label>
                <input type="text" name="ho_ten" class="form-control" maxlen="255" id="ho_ten" placeholder="Nhập Họ Tên" 
                    value="<?= isset($_POST['ho_ten']) ? htmlspecialchars($_POST['ho_ten']) : '' ?>" />

                <?php if (isset($errors['ho_ten'])) : ?>
                    <span class="help-block">
                        <strong><?= htmlspecialchars($errors['ho_ten']) ?></strong>
                    </span>
                <?php endif ?>
            </div>

            <div class="form-group<?= isset($errors['lop']) ? ' has-error' : '' ?>">
                <label for="lop">Lớp</label>
                <input type="text" name="lop" class="form-control" maxlen="255" id="lop" placeholder="Nhập Lớp" 
                    value="<?= isset($_POST['lop']) ? htmlspecialchars($_POST['lop']) : '' ?>" />

                <?php if (isset($errors['lop'])) : ?>
                    <span class="help-block">
                        <strong><?= htmlspecialchars($errors['lop']) ?></strong>
                    </span>
                <?php endif ?>
            </div>

            <div class="form-group<?= isset($errors['khoa']) ? ' has-error' : '' ?>">
                <label for="khoa">Khoa</label>
                <input type="text" name="khoa" class="form-control" maxlen="255" id="khoa" placeholder="Nhập Khoa" 
                    value="<?= isset($_POST['khoa']) ? htmlspecialchars($_POST['khoa']) : '' ?>" />

                <?php if (isset($errors['khoa'])) : ?>
                    <span class="help-block">
                        <strong><?= htmlspecialchars($errors['khoa']) ?></strong>
                    </span>
                <?php endif ?>
            </div>

            <div class="form-group<?= isset($errors['gioi_tinh']) ? ' has-error' : '' ?>">
                <label for="gioi_tinh">Giới Tính</label>
                <input type="text" name="gioi_tinh" class="form-control" maxlen="255" id="gioi_tinh" placeholder="Nhập Giới Tính" 
                    value="<?= isset($_POST['gioi_tinh']) ? htmlspecialchars($_POST['gioi_tinh']) : '' ?>" />

                <?php if (isset($errors['gioi_tinh'])) : ?>
                    <span class="help-block">
                        <strong><?= htmlspecialchars($errors['gioi_tinh']) ?></strong>
                    </span>
                <?php endif ?>
            </div>

            <div class="form-group<?= isset($errors['ngay_sinh']) ? ' has-error' : '' ?>">
                <label for="ngay_sinh">Ngày Sinh</label>
                <input type="date" name="ngay_sinh" class="form-control" maxlen="255" id="ngay_sinh" placeholder="Nhập Ngày Sinh" 
                    value="<?= isset($_POST['ngay_sinh']) ? htmlspecialchars($_POST['ngay_sinh']) : '' ?>" />

                <?php if (isset($errors['ngay_sinh'])) : ?>
                    <span class="help-block">
                        <strong><?= htmlspecialchars($errors['ngay_sinh']) ?></strong>
                    </span>
                <?php endif ?>
            </div>

            <div class="form-group<?= isset($errors['noi_sinh']) ? ' has-error' : '' ?>">
                <label for="description">Nơi Sinh</label>
                <textarea name="noi_sinh" id="noi_sinh" class="form-control" 
                    placeholder="Nhập Nơi Sinh (maximum character limit: 255)"><?= isset($_POST['noi_sinh']) ? htmlspecialchars($_POST['noi_sinh']) : '' ?></textarea>

                <?php if (isset($errors['noi_sinh'])) : ?>
                    <span class="help-block">
                        <strong><?= htmlspecialchars($errors['noi_sinh']) ?></strong>
                    </span>
                <?php endif ?>
            </div>
            
            <div class="form-group<?= isset($errors['thuong_tru']) ? ' has-error' : '' ?>" style="margin-bottom: 20px">
                <label for="description">Quê Quán</label>
                <textarea name="thuong_tru" id="thuong_tru" class="form-control" 
                    placeholder="Nhập Quê Quán (maximum character limit: 255)"><?= isset($_POST['thuong_tru']) ? htmlspecialchars($_POST['thuong_tru']) : '' ?></textarea>

                <?php if (isset($errors['thuong_tru'])) : ?>
                    <span class="help-block">
                        <strong><?= htmlspecialchars($errors['thuong_tru']) ?></strong>
                    </span>
                <?php endif ?>
            </div>

            <!-- Submit -->
            <button class="btn btn-secondary">
                    <a class="return" href="student.php">Quay Lại</a>
            </button>
            <button type="submit" name="submit" id="submit" class="btn btn-primary">Thêm Sinh Viên</button>
            
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