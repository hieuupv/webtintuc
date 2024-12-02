<?php
session_start();
require_once "../functions.php";
if (checklogin() == false) {
    header('Location: login.php');
    exit();
}
$page = $_GET['page'] ?? "users";
?>
<?php
$msg = "";
$h2 = "THÊM MỚI NGƯỜI DÙNG";
$user_id = $_GET['user_id'] ?? "";
if ($user_id != "") {
    $h2 = "CHỈNH SỬA NGƯỜI DÙNG";
    $sql = "SELECT * FROM users WHERE user_id =$user_id";
    $result = executeResult($sql);
} else {
}
if (isset($_POST['submit'])) {
    $user_name = $_POST['user_name'] ?? "";
    $anHien = $_POST['anHien'] ?? 0;
    $lang = $_POST['lang'] ?? "vi";
    if ($user_name != "") {
        if ($user_id != "") {
            $sql = "UPDATE users set user_name='$user_name',
                     ThuTu=$thutu, AnHien=$anHien, lang  ='$lang'
                     WHERE user_id =$user_id";
            $kq = execute($sql);
            header('Location: index.php?page=users');
            die();
        } else {
            $sql = "INSERT INTO users(user_name,ThuTu,AnHien,lang)
                     VALUES ('$user_name',$thutu,$anHien,'$lang')";
            $kq = execute($sql);
            header('Location: index.php?page=users');
            die();
        }
    } else {
        $msg = "Vui lòng nhập đầy đủ thông tin";
    }
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./main.css">
    <title>Quản trị web tổng hợp</title>
    <style>
        .error-msg {
            width: 100%;
            text-align: center;
            color: rgb(92, 2, 2);
            background: rgba(218, 77, 77, 0.729);
            border-radius: 5px;
            margin: 5px 0;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <!-- Nav tabs -->
    <div class="container">
        <?php require_once "menu.php"; ?>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="">
                &nbsp;
                <div class="container col-8 m-auto">
                    <h2 class="py-2 text-center h4 "><?= $h2 ?></h2>
                    <form action="" method="post">
                            <div class="mb-3 form-line active">
                                <label style="min-width:10px">Hình Ảnh:</label>
                                <input type="text" name="file_img" value="<?= $result[0]['file_img'] ?? "" ?>">
                            </div>
                        <div class="form-line active">
                            <label for="">Tên người dùng</label>
                            <input type="text" name="user_name" value="<?= $result[0]['user_name'] ?? "" ?>" class="form-control">
                        </div>
                        <div class="form-line mb-3">
                           
                                <label style="min-width:10px">Email:</label>
                                <input type="email" name="email" value="<?= $result[0]['email'] ?? "" ?>">
                         
                            
                        </div>
                        <div class="mb-3 form-line">
                                <label style="min-width:10px">Mật khẩu:</label>
                                <input type="password" name="password" value="<?= $result[0]['password'] ?? "" ?>">
                            </div>
                            <div class="mb-3 form-line">
                                <label style="min-width:10px">Giới tính:</label>
                                <input type="text" name="gt" value="<?= $result[0]['gt'] ?? "" ?>">
                            </div>
                            <div class="mb-3 form-line">
                                <label style="min-width:10px">Sở Thích:</label>
                                <input type="text" name="hobby" value="<?= $result[0]['hobby'] ?? "" ?>">
                            </div>
                            <div class="mb-3 form-line">
                                <label style="min-width:10px">Nghề nghiệp:</label>
                                <input type="text" name="nghe_nghiep" value="<?= $result[0]['nghe_nghiep'] ?? "" ?>">
                            </div>
                            <div class="mb-3 form-line">
                                <label style="min-width:10px">Giới Thiệu:</label>
                                <input type="text" name="intro" value="<?= $result[0]['intro'] ?? "" ?>">
                            </div>
                            <div class="mb-3 form-line">
                                <label style="min-width:10px">Quyền hạn:</label>
                                <input type="text" name="group_id" value="<?= $result[0]['group_id'] ?? "" ?>">
                            </div>
                        <button class="btn btn-success px-3" name="submit">Lưu</button>
                        <div class="error-msg"><?= $msg ?></div>
                    </form>
                </div>
            </div> <!-- tab-pane-->
        </div>
    </div>
</body>

</html>