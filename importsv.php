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
require('Classes/PHPExcel.php');

if(isset($_POST['submit'])){
    $file = $_FILES['file']['tmp_name'];

    $objReader = PHPExcel_IOFactory::createReaderForFile($file);
    $objReader->setLoadSheetsOnly('sv');

    $objExcel = $objReader->load($file);
    $sheetData = $objExcel->getActiveSheet()->toArray('null','null','null','null','null','null','null','null');

    $highestRow = $objExcel->setActiveSheetIndex()->getHighestRow();
    //echo $highestRow;
    for($row = 2; $row<=$highestRow; $row++){
        $mssv = $sheetData[$row]['A'];
        $ho_ten = $sheetData[$row]['B'];
        $lop = $sheetData[$row]['C'];
        $khoa = $sheetData[$row]['D'];
        $gioi_tinh = $sheetData[$row]['E'];
        $ngay_sinh = $sheetData[$row]['F'];
        $noi_sinh = $sheetData[$row]['G'];
        $thuong_tru = $sheetData[$row]['H'];

        $sql = "INSERT INTO list_student(mssv,ho_ten,lop,khoa,gioi_tinh,ngay_sinh,noi_sinh,thuong_tru) VALUES ('$mssv','$ho_ten','$lop','$khoa','$gioi_tinh','$ngay_sinh','$noi_sinh','$thuong_tru')";
        //print_r($sql);
        $query = mysqli_query($connect, $sql);
        header("location: student.php");
    }
    
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
        <form name="frm" id="frm" action="" enctype="multipart/form-data" method="post" class="col-md-6 col-md-offset-3" style="margin-left: 350px">
            <h2 class='text-center text-primary m-0 ps-5'>Import Danh Sách Sinh Viên</h2>

            <div style="margin-bottom: 20px; margin-top: 20px;">
                <label for="">Flie Sinh Viên</label>
                <input type="file" name="file" class="form-control" maxlen="255" id="file" placeholder="" value="" />
            </div>
            <!-- Submit -->
            <button class="btn btn-secondary">
                    <a class="return" href="student.php">Quay Lại</a>
            </button>
            <button type="submit" name="submit" id="submit" class="btn btn-primary">Import</button>
            
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