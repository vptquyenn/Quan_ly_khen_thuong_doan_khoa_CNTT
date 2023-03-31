<?php include 'partials/header.php';?>
<?php
    session_start();

    if(!isset($_SESSION['email'])){
        header('location:login.php');
    }
?>
<?php
    $connect = mysqli_connect('localhost', 'root','','web_qld');
    if($connect){
        mysqli_query($connect, "SET NAMES 'UTF8'");
    }else {
        echo'kết nối thất bại';
    }

    $sql_hoatdong = "SELECT * FROM list_hoatdong";
    $query_hoatdong = mysqli_query($connect, $sql_hoatdong);

    if(isset($_POST['submit'])){
        $fk_idhd = $_POST['fk_idhd'];
        $mssv = $_POST['mssv'];
        $ho_ten = $_POST['ho_ten'];
        $gioi_tinh = $_POST['gioi_tinh'];
        $lop = $_POST['lop'];
        $khoa = $_POST['khoa'];

        $sql = "INSERT INTO list_svdkhd (fk_idhd, mssv, ho_ten, gioi_tinh, lop, khoa)
        VALUE ('$fk_idhd', '$mssv', '$ho_ten', '$gioi_tinh', '$lop', '$khoa')";
        $query = mysqli_query($connect, $sql);
        header("location: dangki.php");
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
            <h2 class='text-center text-primary m-0 ps-5'>Đăng Kí Tham Gia Hoạt Động</h2>

            <div class="form-group" style="margin-bottom: 20px; margin-top: 20px">
                <label for="">Chương Trình Hoạt Động</label>
                <select type="text" name="fk_idhd" class="form-control" maxlen="255" id="" placeholder="" value="">
                    <option>-Chọn Hoạt Động Muốn Tham Gia-</option>
                    <?php
                        while($row_hoatdong = mysqli_fetch_assoc($query_hoatdong)){?>
                            
                            <option value = "<?php echo $row_hoatdong['id']?>"><?php echo $row_hoatdong['noidunghoatdong']?> - <?php echo $row_hoatdong['hocki']?> (Ngày <?php echo $row_hoatdong['ngay_bd']?> Lúc <?php echo $row_hoatdong['gio']?>)</option>
                        <?php } ?>
                </select>
            </div>

            <div class="form-group" style="margin-bottom: 20px">
                <label for="">Mã Số Sinh Viên</label>
                <input type="text" name="mssv" class="form-control" maxlen="255" id="" placeholder="" value="" />
            </div>

            <div class="form-group" style="margin-bottom: 20px">
                <label for="">Họ Và Tên</label>
                <input type="text" name="ho_ten" class="form-control" maxlen="255" id="" placeholder="" value="" />
            </div>

            <div class="form-group" style="margin-bottom: 20px">
                <label for="">Giới Tính</label>
                <input type="text" name="gioi_tinh" class="form-control" maxlen="255" id="" placeholder="" value="" />
            </div>

            <div class="form-group" style="margin-bottom: 20px">
                <label for="">Lớp</label>
                <input type="text" name="lop" class="form-control" maxlen="255" id="" placeholder="" value="" />
            </div>

            <div class="form-group" style="margin-bottom: 20px">
                <label for="">Khoa</label>
                <input type="text" name="khoa" class="form-control" maxlen="255" id="" placeholder="" value="" />
            </div>
            <!-- Submit -->
            <button class="btn btn-secondary">
                    <a class="return" href="dangki.php">Quay Lại</a>
            </button>
            <button type="submit" name="submit" id="submit" class="btn btn-primary">Đăng Kí Tham Gia</button>
            
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