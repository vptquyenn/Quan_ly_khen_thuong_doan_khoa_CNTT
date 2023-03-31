<?php
    session_start();

    if(!isset($_SESSION['email'])){
        header('location:login.php');
    }
?>

<?php
	require_once 'bootstrap.php';

	use Ct271\Labs\Hoatdong;

	$hoatdong = new Hoatdong($PDO);
	$list_hoatdong = $hoatdong->all();
?>

<?php
	require_once 'bootstrap.php';
    
	use Ct271\Labs\Contact;

	$contact = new Contact($PDO);
	$list_student = $contact->all();

    use Ct271\Labs\B1910439;

	$b1910439 = new B1910439($PDO);
	$list_b1910439 = $b1910439->all();
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
    $sheet = $objExcel->getActiveSheet()->setTitle('hd');

    $rowCount = 1;
    $sheet->setCellValue('A'.$rowCount, 'Chủ Đề Hoạt Động');
    $sheet->setCellValue('B'.$rowCount, 'Chương Trình Hoạt Động');
    $sheet->setCellValue('C'.$rowCount, 'Thời Gian Diễn Ra Chương Trình');
    $sheet->setCellValue('D'.$rowCount, 'Ngày Diễn Ra Chương Trình');
    $sheet->setCellValue('E'.$rowCount, 'Học Kì');
    $sheet->getColumnDimension("A")->setAutoSize(true);
    $sheet->getColumnDimension("B")->setAutoSize(true);
    $sheet->getColumnDimension("C")->setAutoSize(true);
    $sheet->getColumnDimension("D")->setAutoSize(true);
    $sheet->getColumnDimension("E")->setAutoSize(true);
    $sheet->getStyle('A1:E1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('00ffff00');
    $sheet->getStyle('A1:E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $result = $connect->query("SELECT tenhoatdong, noidunghoatdong, gio, ngay_bd, hocki FROM list_hoatdong");

    while($row = mysqli_fetch_array($result)){
        //print_r($row);
        $rowCount++;
        $sheet->setCellValue('A'.$rowCount, $row['tenhoatdong']);
        $sheet->setCellValue('B'.$rowCount, $row['noidunghoatdong']);
        $sheet->setCellValue('C'.$rowCount, $row['gio']);
        $sheet->setCellValue('D'.$rowCount, $row['ngay_bd']);
        $sheet->setCellValue('E'.$rowCount, $row['hocki']);
    }

    $styleArray = array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
    );
    $sheet->getStyle('A1:' . 'E'.($rowCount))->applyFromArray($styleArray);

    $objWriter = new PHPExcel_Writer_Excel2007($objExcel);
    $filename = 'hoatdong.xlsx';
    $objWriter->save($filename);

    header('Content-Disposition: attachment; filename="' . $filename .'"');
    header('Content-Type: application/vnd.openxmlformatsofficedocument.spreadsheetml.sheet');
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
                        <a class="header-navbar-link" href="hoatdong.php" style="padding-bottom: 16px; margin-bottom: 35px; border-bottom: 3px solid white; font-weight: 700;">QL Hoạt Động</a>
                    </div>
                    <!-- <div class="me-1 col-3 nav_item_link">
                        <a class="header-navbar-link" href="danhgia.php" style="font-weight: 700;">Phiếu ĐG Mẫu</a>
                    </div> -->
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
        <p class="timkiemsinhvien"><b>TÌM KIẾM CHƯƠNG TRÌNH HOẠT ĐỘNG:</b></p>
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Nhập tên chương trình hoạt động cần tìm...">
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
        <a href="importhd.php" class="nv import" data-toggle="tooltip" data-placement="bottom" title="import Hoạt Động">
            <i class="fa fa-folder"></i>
        </a>
        <a href="add_hoatdong.php" class="nv them" data-toggle="tooltip" data-placement="bottom" title="Thêm Hoạt Động">
            <i class="fa fa-plus"></i>
        </a>
        <a href="dangki.php" class="nv dangki" data-toggle="tooltip" data-placement="bottom" title="Danh Sách Sinh Viên Tham Gia Hoạt Động">
            <i class="fa fa-file"></i></i>
        </a>
        <table class=" table-bordered" id="myTable">
            <thead>
                <tr class="ex">
                    <th>Chủ Đề Hoạt Động</th>
                    <th>Chương Trình Hoạt Động</th>
                    <th width="150px;">Thời Gian Diễn Ra Chương Trình</th>
                    <th width="150px;">Ngày Diễn Ra Chương Trình</th>
                    <th>Học Kì</th>
                    <th width="180px;">Tính Năng</th>
                </tr>
            </thead>
            <tbody>
				<?php foreach($list_hoatdong as $hoatdong): ?>
					<tr>
						<th><?=htmlspecialchars($hoatdong->tenhoatdong)?></th>
						<td><?=htmlspecialchars($hoatdong->noidunghoatdong)?></td>
                        <td><?=htmlspecialchars($hoatdong->gio)?></td>
						<td><?=date("d-m-Y", strtotime($hoatdong->ngay_bd))?></td>
                        <td><?=htmlspecialchars($hoatdong->hocki)?></td>
						<td>
							<a href="<?=BASE_URL_PATH . 'edit_hoatdong.php?id=' . $hoatdong->getId()?>" class="btn btn-xs btn-warning">
								<i alt="Edit" class="fa fa-pencil"> Sửa</i>
							</a>
							<form class="delete" action="<?=BASE_URL_PATH . 'delete_hoatdong.php'?>" method="POST" style="display: inline;">
								<input type="hidden" name="id" value="<?=$hoatdong->getId()?>">
								<button type="submit" class="btn btn-xs btn-danger" name="delete-hoatdong">
									<i alt="Delete" class="fa fa-trash"> Xóa</i>
								</button>
							</form>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
        </table>

		<div id="delete-confirm" class="modal fade" role="dialog">"4. Mở trình duyệt web bất kì và kiểm tra xóa hoatdong.
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Confirmation</h4>
					</div>
					<div class="modal-body">Do you want to delete this hoatdong?</div>
					<div class="modal-footer">
						<button type="button" data-dismiss="modal" class="btn btn-danger" id="delete">Delete</button>
						<button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
					</div>
				</div>
			</div>
		</div>

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