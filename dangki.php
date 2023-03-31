<?php
    session_start();

    if(!isset($_SESSION['email'])){
        header('location:login.php');
    }
?>

<?php
	require_once 'bootstrap.php';

	use Ct271\Labs\Dangki;

	$dangki = new Dangki($PDO);
	$list_svdkhd = $dangki->all();

    use Ct271\Labs\Dangki439;

	$dangki439 = new Dangki439($PDO);
	$list_439dkhd = $dangki439->all();
?>

<?php
$connect = mysqli_connect('localhost', 'root','','web_qld');
if($connect){
    mysqli_query($connect, "SET NAMES 'UTF8'");
}else {
    echo'kết nối thất bại';
}
require('Classes/PHPExcel.php');

if(isset($_POST['btnExport'])){
    $objExcel = new PHPExcel;
    $objExcel->setActiveSheetIndex(0);
    $sheet = $objExcel->getActiveSheet()->setTitle('dshdsv');

    $rowCount = 1;
    $sheet->setCellValue('A'.$rowCount, 'MSSV');
    $sheet->setCellValue('B'.$rowCount, 'Họ và Tên');
    $sheet->setCellValue('C'.$rowCount, 'Giới Tính');
    $sheet->setCellValue('D'.$rowCount, 'Lớp');
    $sheet->setCellValue('E'.$rowCount, 'Khoa');
    $sheet->setCellValue('F'.$rowCount, 'Chủ Đề Hoạt Động');
    $sheet->setCellValue('G'.$rowCount, 'Chương Trình Hoạt Động');
    $sheet->setCellValue('H'.$rowCount, 'Ngày Diễn Ra Chương Trình');
    $sheet->setCellValue('I'.$rowCount, 'Học Kì');
    $sheet->setCellValue('J'.$rowCount, 'Trạng Thái	');
    $sheet->getColumnDimension("A")->setAutoSize(true);
    $sheet->getColumnDimension("B")->setAutoSize(true);
    $sheet->getColumnDimension("C")->setAutoSize(true);
    $sheet->getColumnDimension("D")->setAutoSize(true);
    $sheet->getColumnDimension("E")->setAutoSize(true);
    $sheet->getColumnDimension("F")->setAutoSize(true);
    $sheet->getColumnDimension("G")->setAutoSize(true);
    $sheet->getColumnDimension("H")->setAutoSize(true);
    $sheet->getColumnDimension("I")->setAutoSize(true);
    $sheet->getColumnDimension("J")->setAutoSize(true);
    $sheet->getStyle('A1:J1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('00ffff00');
    $sheet->getStyle('A1:J1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $result = $connect->query("SELECT list_svdkhd.mssv, list_svdkhd.ho_ten, list_svdkhd.lop, list_svdkhd.gioi_tinh, list_svdkhd.khoa, list_hoatdong.tenhoatdong, list_hoatdong.noidunghoatdong, list_hoatdong.hocki, list_hoatdong.ngay_bd, list_chitiet.trang_thai
                                FROM list_svdkhd
                                JOIN list_hoatdong ON list_svdkhd.fk_idhd = list_hoatdong.id
                                JOIN list_chitiet ON list_svdkhd.id_ctht = list_chitiet.id");
    $result1 = $connect->query("SELECT list_439dkhd.id, list_439dkhd.mssv, list_439dkhd.ho_ten, list_439dkhd.lop, list_439dkhd.gioi_tinh, list_439dkhd.khoa, list_hoatdong.tenhoatdong, list_hoatdong.noidunghoatdong, list_hoatdong.hocki, list_hoatdong.ngay_bd, list_chitiet.trang_thai
                                FROM list_439dkhd
                                JOIN list_hoatdong ON list_439dkhd.fk_idhd = list_hoatdong.id
                                JOIN list_chitiet ON list_439dkhd.fk_idct = list_chitiet.id");

    while($row = mysqli_fetch_array($result)){
        //print_r($row);
        $rowCount++;
        $sheet->setCellValue('A'.$rowCount, $row['mssv']);
        $sheet->setCellValue('B'.$rowCount, $row['ho_ten']);
        $sheet->setCellValue('C'.$rowCount, $row['gioi_tinh']);
        $sheet->setCellValue('D'.$rowCount, $row['lop']);
        $sheet->setCellValue('E'.$rowCount, $row['khoa']);
        $sheet->setCellValue('F'.$rowCount, $row['tenhoatdong']);
        $sheet->setCellValue('G'.$rowCount, $row['noidunghoatdong']);
        $sheet->setCellValue('H'.$rowCount, $row['ngay_bd']);
        $sheet->setCellValue('I'.$rowCount, $row['hocki']);
        $sheet->setCellValue('J'.$rowCount, $row['trang_thai']);
    }
    while($row = mysqli_fetch_array($result1)){
        //print_r($row);
        $rowCount++;
        $sheet->setCellValue('A'.$rowCount, $row['mssv']);
        $sheet->setCellValue('B'.$rowCount, $row['ho_ten']);
        $sheet->setCellValue('C'.$rowCount, $row['gioi_tinh']);
        $sheet->setCellValue('D'.$rowCount, $row['lop']);
        $sheet->setCellValue('E'.$rowCount, $row['khoa']);
        $sheet->setCellValue('F'.$rowCount, $row['tenhoatdong']);
        $sheet->setCellValue('G'.$rowCount, $row['noidunghoatdong']);
        $sheet->setCellValue('H'.$rowCount, $row['ngay_bd']);
        $sheet->setCellValue('I'.$rowCount, $row['hocki']);
        $sheet->setCellValue('J'.$rowCount, $row['trang_thai']);
    }

    $styleArray = array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
    );
    $sheet->getStyle('A1:' . 'J'.($rowCount))->applyFromArray($styleArray);

    $objWriter = new PHPExcel_Writer_Excel2007($objExcel);
    $filename = 'dssvdkhd.xlsx';
    $objWriter->save($filename);

    header('Content-Disposition: attachment; filename="' . $filename .'"');
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Length: ' .filesize($filename));
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: no-cache');
    readfile($filename);
    return;
}
?>

<?php include 'partials/header.php';?>

<body onload="time()">
    <!-- <script>
        swal("Xin Chào Admin", "Chúc Bạn 1 Ngày Tốt Lành Nhé", "");
    </script> -->
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
                        <a class="header-navbar-link"  href="student.php" style="font-weight: 700;">QL Sinh Viên</a>
                    </div>
                    <div class="me-1 col-3 nav_item_link">
                        <a class="header-navbar-link"  href="khenthuong.php" style="font-weight: 700;">Khen thưởng</a>
                    </div>
                    <div class="me-1 col-3 nav_item_link">
                        <a class="header-navbar-link" href="hoatdong.php" style="font-weight: 700;">QL Hoạt Động</a>
                    </div>
                    <div class="me-1 col-3 nav_item_link">
                        <a class="header-navbar-link" href="logout.php" style="font-weight: 700;">Đăng xuất</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid al">
        <div id="clock"></div>
        <Br>
        <p class="timkiemsinhvien"><b>TÌM KIẾM Sinh Viên:</b></p>
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Nhập Mã Số Sinh Viên cần tìm...">
        <i class="fa fa-search" aria-hidden="true" style="margin-top: -44px;"></i>
        <b>CHỨC NĂNG CHÍNH:</b><Br>
        <button class="nv" type="button" onclick="sortTable()" data-toggle="tooltip" data-placement="bottom" title="Lọc Dữ Liệu">
            <i class="fa fa-filter" aria-hidden="true"></i>
        </button>
        <form method="POST">
            <button name="btnExport" class="nv xuat" data-toggle="tooltip" data-placement="bottom" title="Xuất File">
                <i class="fa fa-download"></i>
            </button>
        </form>
        <button class="nv cog" data-toggle="tooltip" data-placement="bottom" title="Cài Đặt">
            <i class="fa fa-gear"></i>
        </button>
        <a href="importdshdsv.php" class="nv import" data-toggle="tooltip" data-placement="bottom" title="import Danh Sách Hoạt Động Của Sinh Viên">
            <i class="fa fa-folder"></i>
        </a>
        <a href="add_dangki.php" class="nv dangki" data-toggle="tooltip" data-placement="bottom" title="Đăng kí tham gia hoạt động">
            <i class="fa fa-plus"></i>
        </a>
        <table class=" table-bordered" id="myTable">
            <thead>
                <tr class="ex">
                    <th>MSSV</th>
                    <th>Họ Và Tên</th>
                    <th>Giới Tính</th>
                    <th>Lớp</th>
                    <th>Khoa</th>
                    <th>Chủ Đề Hoạt Động</th>
                    <th>Chương Trình Hoạt Động</th>
                    <th width="150px;">Ngày Diễn Ra Chương Trình</th>
                    <th>Học Kì</th>
                    <th>Trạng Thái</th>
                    <th width="130px;">Tính Năng</th>
                </tr>
            </thead>
            <tbody>
				<?php foreach($list_svdkhd as $dangki): ?>
					<tr>
						<td><?=htmlspecialchars($dangki->mssv)?></td>
                        <td><?=htmlspecialchars($dangki->ho_ten)?></td>
                        <td><?=htmlspecialchars($dangki->gioi_tinh)?></td>
                        <td><?=htmlspecialchars($dangki->lop)?></td>
                        <td><?=htmlspecialchars($dangki->khoa)?></td>
                        <td><?=htmlspecialchars($dangki->tenhoatdong)?></td>
						<td><?=htmlspecialchars($dangki->noidunghoatdong)?></td>
						<td><?=date("d-m-Y", strtotime($dangki->ngay_bd))?></td>
                        <td><?=htmlspecialchars($dangki->hocki)?></td>
                        <td><?=htmlspecialchars($dangki->trang_thai)?></td>
						<td>
							<a href="<?=BASE_URL_PATH . 'edit_dangki.php?id=' . $dangki->getId()?>" class="btn btn-xs btn-success">
								<i alt="Edit" class="fa fa-pencil"> Cập Nhật</i>
							</a>
						</td>
					</tr>
				<?php endforeach ?>
                <?php foreach($list_439dkhd as $dangki439): ?>
					<tr>
						<td><?=htmlspecialchars($dangki439->mssv)?></td>
                        <td><?=htmlspecialchars($dangki439->ho_ten)?></td>
                        <td><?=htmlspecialchars($dangki439->gioi_tinh)?></td>
                        <td><?=htmlspecialchars($dangki439->lop)?></td>
                        <td><?=htmlspecialchars($dangki439->khoa)?></td>
                        <td><?=htmlspecialchars($dangki439->tenhoatdong)?></td>
						<td><?=htmlspecialchars($dangki439->noidunghoatdong)?></td>
						<td><?=date("d-m-Y", strtotime($dangki439->ngay_bd))?></td>
                        <td><?=htmlspecialchars($dangki439->hocki)?></td>
                        <td><?=htmlspecialchars($dangki439->trang_thai)?></td>
                        <td>
							<a href="<?=BASE_URL_PATH . 'edit_dangki439.php?id=' . $dangki439->getId()?>" class="btn btn-xs btn-success">
								<i alt="Edit" class="fa fa-pencil"> Cập Nhật</i>
							</a>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
        </table>

    <script type="text/javascript">
        //Phân Trang Cho Table
        function Pager(tableName, itemsPerPage) {
            this.tableName = tableName;
            this.itemsPerPage = itemsPerPage;
            this.currentPage = 1;
            this.pages = 0;
            this.inited = false;

            this.showRecords = function (from, to) {
                var rows = document.getElementById(tableName).rows;
                for (var i = 1; i < rows.length; i++) {
                    if (i < from || i > to)
                        rows[i].style.display = 'none';
                    else
                        rows[i].style.display = '';
                }
            }

            this.showPage = function (pageNumber) {
                if (!this.inited) {
                    alert("not inited");
                    return;
                }
                var oldPageAnchor = document.getElementById('pg' + this.currentPage);
                oldPageAnchor.className = 'pg-normal';

                this.currentPage = pageNumber;
                var newPageAnchor = document.getElementById('pg' + this.currentPage);
                newPageAnchor.className = 'pg-selected';

                var from = (pageNumber - 1) * itemsPerPage + 1;
                var to = from + itemsPerPage - 1;
                this.showRecords(from, to);
            }

            this.prev = function () {
                if (this.currentPage > 1)
                    this.showPage(this.currentPage - 1);
            }

            this.next = function () {
                if (this.currentPage < this.pages) {
                    this.showPage(this.currentPage + 1);
                }
            }

            this.init = function () {
                var rows = document.getElementById(tableName).rows;
                var records = (rows.length - 1);
                this.pages = Math.ceil(records / itemsPerPage);
                this.inited = true;
            }
            this.showPageNav = function (pagerName, positionId) {
                if (!this.inited) {
                    alert("not inited");
                    return;
                }
                var element = document.getElementById(positionId);

                var pagerHtml = '<span onclick="' + pagerName +
                    '.prev();" class="pg-normal">&#171</span> | ';
                for (var page = 1; page <= this.pages; page++)
                    pagerHtml += '<span id="pg' + page + '" class="pg-normal" onclick="' + pagerName +
                        '.showPage(' + page + ');">' + page + '</span> | ';
                pagerHtml += '<span onclick="' + pagerName + '.next();" class="pg-normal">&#187;</span>';

                element.innerHTML = pagerHtml;
            }
        }
    </script>
    
    <div id="pageNavPosition" class="text-right"></div>
    <script type="text/javascript">
        var pager = new Pager('myTable', 10);
        pager.init();
        pager.showPageNav('pager', 'pageNavPosition');
        pager.showPage(1);
    </script>

    <?php include 'partials/footer.php';?>

    <script src="<?= BASE_URL_PATH . "static/js/wow.min.js" ?>"></script>
	<script>
		$(document).ready(function() {
			new WOW().init();
			$('#list_hoatdong').DataTable();

			$('button[name="delete-hoatdong"]').on('click', function(e){
				e.preventDefault();

				const form = $(this).closest('form');
				const nameTd = $(this).closest('tr').find('td:first');
				if (nameTd.length > 0) {
					$('.modal-body').html(
						`Do you want to delete "${nameTd.text()}"?`
					);
				} 
				$('#delete-confirm').modal({
					backdrop: 'static', keyboard: false
				})
				.one('click', '#delete', function() {
					form.trigger('submit');
				});
			})
		});
	</script>
    
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