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

    use Ct271\Labs\KTB1910439;

	$ktb1910439 = new KTB1910439($PDO);
	$list_hdb1910439 = $ktb1910439->all();

?>

<?php include 'partials/header.php';?>

<body onload="time()">
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
                        <a class="header-navbar-link"  href="b1910439.php" style="font-weight: 700;">TT Cá Nhân</a>
                    </div>
                    <div class="me-1 col-3 nav_item_link">
                        <a class="header-navbar-link"  href="dangki439.php" style="font-weight: 700;">DS Hoạt Động</a>
                    </div>
                    <div class="me-1 col-3 nav_item_link">
                        <a class="header-navbar-link"  href="kt_of_sv.php" style="padding-bottom: 16px; margin-bottom: 35px; border-bottom: 3px solid white; font-weight: 700;">Khen Thưởng</a>
                    </div>
                    <div class="me-1 col-3 nav_item_link">
                        <a class="header-navbar-link" href="logout.php" style="font-weight: 700;">Đăng Xuất</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid al">
        <div id="clock"></div><Br>
        <b>CHỨC NĂNG CHÍNH:</b><Br>
        <button class="nv cog" data-toggle="tooltip" data-placement="bottom" title="Cài Đặt">
            <i class="fa fa-gear"></i>
        </button>
        <a href="danhgia.php" class="nv danhgia" data-toggle="tooltip" data-placement="bottom" title="file Đánh Giá Mẫu">
            <i class="fa fa-file"></i></i>
        </a>

        <table class=" table-bordered" id="myTable">
            <thead>
                <tr class="ex">
                    <th width="80px;">MSSV</th>
                    <th width="150px;">Họ Tên Sinh Viên</th>
                    <th width="60px;">Lớp</th>
                    <th width="150px;">Khoa</th>
                    <th width="80px;">File Đánh Giá</th>
                    <th>Chương Trình Hoạt Động Đã Tham Gia</th>
                    <th width="120px;">Học Kì</th>
                    <th width="70px;">Điểm Rèn Luyện</th>
                    <th width="80px;">Xếp Loại</th>
                    <th width="90px;">Ngày Khen Thưởng</th>
                    <th width="125px;">Nộp File Đánh Giá</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($list_hdb1910439 as $ktb1910439): ?>
					<tr>
                        <td><?=htmlspecialchars($ktb1910439->mssv)?></td>
                        <td><?=htmlspecialchars($ktb1910439->ho_ten)?></td>
                        <td><?=htmlspecialchars($ktb1910439->lop)?></td>
                        <td><?=htmlspecialchars($ktb1910439->khoa)?></td>
                        <td>
                            <a href="download.php?file=<?=htmlspecialchars($ktb1910439->filename)?>" style="text-decoration: none; font-size:13px;"><?=htmlspecialchars($ktb1910439->filename)?></a>
                        </td>
						<td><?=htmlspecialchars($ktb1910439->noidung_hoatdong)?></td>
                        <td><?=htmlspecialchars($ktb1910439->hoc_ki)?></td>
                        <td><?=htmlspecialchars($ktb1910439->diemrl)?></td>
                        <td><?=htmlspecialchars($ktb1910439->xeploai)?></td>
						<td><?=date("d-m-Y", strtotime($ktb1910439->created_at))?></td>
                        <td>
                            <?php foreach($list_b1910439 as $b1910439): ?>
                                <a href="<?=BASE_URL_PATH . 'nopfile439_canhan.php?id=' . $b1910439->getId()?>" class="btn btn-xs btn-success">
                                    <i alt="Nộp File" class="fa fa-pencil"> Nộp File</i>
                                </a>
                            <?php endforeach ?>
                        </td>
					</tr>
				<?php endforeach ?>
                
			</tbody>
        </table>

    <?php include 'partials/footer.php';?>
    <script src="<?= BASE_URL_PATH . "static/js/jquery.min.js" ?>"></script>
    <script type="text/javascript">
        //Tìm kiếm
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";  }}}}
        //Lọc bảng
        function sortTable() {
            var table, rows, switching, i, x, y, shouldSwitch;
            table = document.getElementById("myTable");
            switching = true;
            while (switching) {
                switching = false;1
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[0];
                    y = rows[i + 1].getElementsByTagName("TD")[0];
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    swal("Thành Công!", "Bạn Đã Lọc Thành Công", "success");
                }
            }
        }
        //Thời Gian
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
        
        //Thêm
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
            var actions = $("table td:last-child").html();
            $(".add-new").click(function () {
                $(this).attr("disabled", "disabled");
                var index = $("table tbody tr:last-child").index();
                var row = '<tr>' +
                    '<td><input type="text" class="form-control" name="name" id="name" placeholder="Nhập Tên"></td>' +
                    '<td><input type="text" class="form-control" name="gioitinh" id="gioitinh" placeholder="Nhập Giới Tính"></td>' +
                    '<td><input type="text" class="form-control" name="namsinh" id="namsinh" value="" placeholder="Nhập Ngày Sinh"></td>' +
                    '<td><input type="text" class="form-control" name="diachi" id="diachi" value="" placeholder="Nhập Địa Chỉ"></td>' +
                    '<td><input type="text" class="form-control" name="chucvu" id="chucvu" value="" placeholder="Nhập Chức Vụ"></td>' +
                    '<td>' + actions + '</td>' + '</tr>';
                $("table").append(row);
                $("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
                $('[data-toggle="tooltip"]').tooltip();
            });
            //Kiểm tra rỗng
            $(document).on("click", ".add", function () {
                var empty = false;
                var input = $(this).parents("tr").find('input[type="text"]');
                input.each(function () {
                    if (!$(this).val()) {
                        $(this).addClass("error");
                        swal("Thông Báo!", "Dữ Liệu Trống Vui Lòng Kiểm Tra", "error");
                        empty = true;
                    } else {
                        $(this).removeClass("error");
                        swal("Thông Báo!", "Bạn Chưa Nhập Dữ Liệu", "warning");
                    }
                });
                $(this).parents("tr").find(".error").first().focus();
                if (!empty) {
                    input.each(function () {
                        $(this).parent("td").html($(this).val());
                        swal("Thành Công", "Bạn Đã Cập Nhật Thành Công", "success");
                    });
                    $(this).parents("tr").find(".add, .edit").toggle();
                    $(".add-new").removeAttr("disabled");
                }
            });
            // Sửa
            $(document).on("click", ".edit", function () {
                $(this).parents("tr").find("td:not(:last-child)").each(function () {
                    $(this).html('<input type="text" class="form-control" value="' + $(this)
                        .text() + '">');
                });
                $(this).parents("tr").find(".add, .edit").toggle();
                $(".add-new").attr("disabled", "disabled");
            });
            jQuery(function () {
                jQuery(".add").click(function () {
                    swal("Thành Công!", "Bạn Đã Sửa Thành Công", "success");
                });
            });
            // Xóa
            $(document).on("click", ".delete", function () {
                $(this).parents("tr").remove();
                swal("Thành Công!", "Bạn Đã Xóa Thành Công", "success");
                $(".add-new").removeAttr("disabled");
            });
        });
        //Not use
        jQuery(function () {
            jQuery(".cog").click(function () {
                swal("Sorry!", "Tính Năng Này Chưa Có", "error");
            });
        });
        //Tool tip
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>
</html>