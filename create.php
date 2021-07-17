<?php
    session_start();
    require 'dbconfig.php';

    $check1= $_SESSION['username'];
    $check2= $_SESSION['password'];
    if($check1 != true && $check2 != true) {
        header("Location: login.php");
    }

    $message = '';

    if (isset ($_POST['ten'])  && isset($_POST['gioi_tinh']) && isset($_POST['sdt']) && isset($_POST['chuc_vu']) && isset($_POST['ngay_sinh']) && isset($_POST['email']) && isset($_POST['dia_chi']) && isset($_POST['luong'])) {
        $ten = strip_tags($_POST['ten']);
        $gioi_tinh = strip_tags($_POST['gioi_tinh']);
        $sdt = strip_tags($_POST['sdt']);
        $chuc_vu = strip_tags($_POST['chuc_vu']);
        $ngay_sinh = strip_tags($_POST['ngay_sinh']);
        $email = strip_tags($_POST['email']);
        $dia_chi = strip_tags($_POST['dia_chi']);
        $luong = strip_tags($_POST['luong']);

        $sql = 'INSERT INTO employee(ten, gioi_tinh, sdt, chuc_vu, ngay_sinh, email, dia_chi, luong) VALUES(:ten, :gioi_tinh, :sdt, :chuc_vu, :ngay_sinh, :email, :dia_chi, :luong)';
        $statement = $conn->prepare($sql);
        if ($statement->execute([':ten' => $ten, ':gioi_tinh' => $gioi_tinh, ':sdt' => $sdt, ':chuc_vu' => $chuc_vu, ':ngay_sinh' => $ngay_sinh, ':email' => $email, ':dia_chi' => $dia_chi, ':luong' => $luong ])) {
            $message = 'Thêm mới thành công';
        }
    }
 ?>

<?php 
    include('includes/header.php');
    include('includes/navbar.php');
?>

        <div class="container-fluid">
            <div class="card mt-5">
                <div class="card-header">
                    <h2>Thêm mới nhân viên</h2>
                </div>
            <div class="card-body">
                <?php if(!empty($message)): ?>
                <div class="alert alert-success">
                    <?= $message; ?>
                </div>
            <?php endif; ?>
            <form method="post">
                <div class="form-group">
                    <label for="ten">Tên</label>
                    <input type="text" name="ten" id="ten" class="form-control">
                </div>
                <div class="form-group">
                    <label for="gioi_tinh">Giới tính</label>
                    </br>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="customRadio" name="gioi_tinh" value="nam" checked="checked">
                        <label class="custom-control-label" for="customRadio">Nam</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="customRadio2" name="gioi_tinh" value="nữ">
                        <label class="custom-control-label" for="customRadio2">Nữ</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="chuc_vu">Chức vụ</label>
                    <input type="text" name="chuc_vu" id="chuc_vu" class="form-control">
                </div>

                <div class="form-group">
                    <label for="sdt">SĐT</label>
                    <input type="text" name="sdt" id="sdt" class="form-control">
                </div>

                <div class="form-group">
                    <label for="ngay_sinh">Ngày sinh</label>
                    <input type="date" name="ngay_sinh" id="ngay_sinh" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>

                <div class="form-group">
                    <label for="dia_chi">Địa chỉ</label>
                    <input type="text" name="dia_chi" id="dia_chi" class="form-control">
                </div>

                <div class="form-group">
                    <label for="luong">Lương</label>
                    <input type="text" name="luong" id="luong" class="form-control">
                </div>
                
                <div class="form-group">
                <button type="submit" class="btn btn-primary">Thêm nhân viên</button>
                </div>
            </form>
        </div>
    </div>


<?php 
  include('includes/scripts.php');
  include('includes/footer.php');
?>