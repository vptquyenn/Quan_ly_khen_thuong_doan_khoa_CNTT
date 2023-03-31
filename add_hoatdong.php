<?php include 'partials/header.php';?>
<?php
    session_start();

    if(!isset($_SESSION['email'])){
        header('location:login.php');
    }
?>
<?php
	require_once 'bootstrap.php';

	use Ct271\Labs\Hoatdong;

	$errors = [];

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$hoatdong = new Hoatdong($PDO);
		$hoatdong->fill($_POST);
		if ($hoatdong->validate()) {
			$hoatdong->save() && redirect("hoatdong.php");
		} 
	
		$errors = $hoatdong->getValidationErrors();
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
        <form name="frm" id="frm" action="" method="post" class="col-md-6 col-md-offset-3" style="margin-left: 350px">
            <h2 class='text-center text-primary m-0 ps-5'>Thêm Hoạt Động</h2>
            
            <div class="form-group<?= isset($errors['tenhoatdong']) ? ' has-error' : '' ?>" style="margin-bottom: 20px">
                <label for="tenhoatdong">Tiêu Đề Hoạt Động</label>
                <input type="text" name="tenhoatdong" class="form-control" maxlen="255" id="tenhoatdong" placeholder="Nhập Tiêu Đề Hoạt Động" 
                    value="<?= isset($_POST['tenhoatdong']) ? htmlspecialchars($_POST['tenhoatdong']) : '' ?>" />

                <?php if (isset($errors['tenhoatdong'])) : ?>
                    <span class="help-block">
                        <strong><?= htmlspecialchars($errors['tenhoatdong']) ?></strong>
                    </span>
                <?php endif ?>
            </div>

            <div class="form-group<?= isset($errors['noidunghoatdong']) ? ' has-error' : '' ?>" style="margin-bottom: 20px">
                <label for="description">Chương Trình Hoạt Động</label>
                <textarea name="noidunghoatdong" id="noidunghoatdong" class="form-control" style="margin-top:8px;"
                    placeholder="Nhập Chương Trình Hoạt Động (maximum character limit: 255)"><?= isset($_POST['noidunghoatdong']) ? htmlspecialchars($_POST['noidunghoatdong']) : '' ?></textarea>

                <?php if (isset($errors['noidunghoatdong'])) : ?>
                    <span class="help-block">
                        <strong><?= htmlspecialchars($errors['noidunghoatdong']) ?></strong>
                    </span>
                <?php endif ?>
            </div>

            <div class="form-group<?= isset($errors['hocki']) ? ' has-error' : '' ?>" style="margin-bottom: 20px">
                <label for="hocki">Học Kì</label>
                <input type="text" name="hocki" class="form-control" maxlen="255" id="hocki" placeholder="Nhập Học Kì" 
                    value="<?= isset($_POST['hocki']) ? htmlspecialchars($_POST['hocki']) : '' ?>" />

                <?php if (isset($errors['hocki'])) : ?>
                    <span class="help-block">
                        <strong><?= htmlspecialchars($errors['hocki']) ?></strong>
                    </span>
                <?php endif ?>
            </div>

            <div class="form-group<?= isset($errors['gio']) ? ' has-error' : '' ?>" style="margin-bottom: 20px">
                <label for="gio">Thời Gian Diễn Ra Chương Trình</label>
                <input type="text" name="gio" class="form-control" maxlen="255" id="gio" placeholder="Nhập Thời Gian Diễn Ra Chương Trình" 
                    value="<?= isset($_POST['gio']) ? htmlspecialchars($_POST['gio']) : '' ?>" />

                <?php if (isset($errors['gio'])) : ?>
                    <span class="help-block">
                        <strong><?= htmlspecialchars($errors['gio']) ?></strong>
                    </span>
                <?php endif ?>
            </div>

            <div class="form-group<?= isset($errors['ngay_bd']) ? ' has-error' : '' ?>" style="margin-bottom: 20px">
                <label for="ngay_bd">Ngày Diễn Ra Chương Trình</label>
                <input type="date" name="ngay_bd" class="form-control" maxlen="255" id="ngay_bd" placeholder="Nhập Ngày Diễn Ra Chương Trình" 
                    value="<?= isset($_POST['ngay_bd']) ? htmlspecialchars($_POST['ngay_bd']) : '' ?>" />

                <?php if (isset($errors['ngay_bd'])) : ?>
                    <span class="help-block">
                        <strong><?= htmlspecialchars($errors['ngay_bd']) ?></strong>
                    </span>
                <?php endif ?>
            </div>
            <!-- Submit -->
            <button class="btn btn-secondary">
                    <a class="return" href="hoatdong.php">Quay Lại</a>
            </button>
            <button type="submit" name="submit" id="submit" class="btn btn-primary">Thêm Hoạt Động</button>
            
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