
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="static/css/login1.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <style>
        * {
            margin: 0;
            padding: 0;
        }
    .background{
        width: 100%;
        height: 90vh;
        font-family: Arial, Helvetica, sans-serif;
        display: flex;
        align-items: center;/*Căn giữa theo chiều dọc*/
        justify-content: center;/*căn giữa theo chiều ngang*/
    }
    .divv {
        width: 450px;
        height: 450px;
    }
    .maching {
        margin-top: 10px;
    }
    .margin {
        margin-bottom: 10px;
    }
    .but_return {
        padding: 15px 0 15px 0;
    }
    .link_return {
        margin: 0;
    }
    </style>
    <!-- <script> 
		var account = '{"taikhoan":[{"email":"Quyen@gmail.com", "password":"Abc@1234"}]}';
		
		obj = JSON.parse(account); 
		
		function frmValidate(){
			var frm = document.forms['login'];
            var mail = frm.mail;
			var pwd = frm.pwd;
 				if((mail.value == obj.taikhoan[0].email) && (pwd.value == obj.taikhoan[0].password) ){
				alert("Đăng nhập thành công!")
                $('.form').attr('action', 'admin.php');
                }else {
					alert("Tên đăng nhập hoặc mật khẩu sai!")
                }
		}
	</script>  -->
</head>

<body class="container">
        <div class="modal-dialog background">
            <div class="modal-content divv">
                <h2 class="modal-title text-center d-block mt-2 mb-2"> Đăng Nhập </h2>
                <?php
                    session_start();

                    if (isset($_SESSION['email'])){
                        header('location:student.php');
                    }

                    if(isset($_POST['dangnhap'])){
                        $email = $_POST['email'];
                        $password = $_POST['password'];

                        if($email == 'Quyenb1910439@gmail.com' && $password == '123456'){
                            $_SESSION['email'] = $email;
                            header('location:b1910439.php');
                        } 
                        else if($email == '001234@gmail.com' && $password == '0123456'){
                            $_SESSION['email'] = $email;
                            header('location:student.php');
                        }
                         else {
                            echo "<p style='margin: 0 0 0 16px; color: red;'> Email hoặc password sai! </p>";
                        }
                    }
                ?>
                <div class="modal-body">
                    <form class="form" method="post" enctype="multipart/form-data" autocomplete="off" name="login" onsubmit="return  frmValidate()">
                        <div class="mb-3">
                            <label for="email" class="fw-bold"><i class="fas fa-user"></i> Người dùng:</label>
                            <input type="text" class="form-control maching" id="email" placeholder="Nhập tên hay email người dùng" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="fw-bold"><i class="fas fa-eye"></i> Mật khẩu:</label>
                            <input type="password" class="form-control maching" placeholder="Nhập mật khẩu" name="password" id="password" pattern=".{4,}" title="Nhập lớn hơn hoặc bằng 4 kí tự" required>
                        </div>
                        <div class="mb-3">
                            <div class="form-check m-0">
                                <input class="form-check-input" type="checkbox">
                                <label class="form-check-label">Ghi nhớ tôi</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" name="dangnhap"> Đăng nhập </button>
                        <div class="modal-footer justify-content-between but_return">
                            <a href="index.php" class="btn btn-danger link_return">
                                <i class="fas fa-times"></i> Hủy bỏ
                            </a>
                            <div class="text-end">
                                <div>Bạn chưa phải là thành viên? <a href="#">Đăng ký</a></div>
                                <div>Quên <a href="#">mật khẩu?</a></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

</html>