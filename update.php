<?php
    session_start();
    require 'dbconfig.php';

    $check1= $_SESSION['username'];
    $check2= $_SESSION['password'];
    if($check1 != true && $check2 != true) {
    header("Location:login.php");
    }

    $message = '';

    $id = $_GET['id'];
    $sql = 'SELECT * FROM employee WHERE id=:id';
    $statement = $conn->prepare($sql);
    $statement->execute([':id' => $id ]);
    $person = $statement->fetch(PDO::FETCH_OBJ);

    if (isset ($_POST['ten'])  && isset($_POST['gioi_tinh']) && isset($_POST['sdt']) && isset($_POST['chuc_vu']) && isset($_POST['ngay_sinh']) && isset($_POST['email']) && isset($_POST['dia_chi']) && isset($_POST['luong'])) {
        $ten = $_POST['ten'];
        $gioi_tinh = $_POST['gioi_tinh'];
        $sdt = $_POST['sdt'];
        $chuc_vu = $_POST['chuc_vu'];
        $ngay_sinh = $_POST['ngay_sinh'];
        $email = $_POST['email'];
        $dia_chi = $_POST['dia_chi'];
        $luong = $_POST['luong'];
        $sql = 'UPDATE employee SET ten=:ten, gioi_tinh=:gioi_tinh, sdt=:sdt, chuc_vu=:chuc_vu, ngay_sinh=:ngay_sinh, email=:email, dia_chi=:dia_chi, luong=:luong WHERE id=:id';
        $statement = $conn->prepare($sql);
        if ($statement->execute([':id' => $id, ':ten' => $ten, ':gioi_tinh' => $gioi_tinh, ':sdt' => $sdt, ':chuc_vu' => $chuc_vu, ':ngay_sinh' => $ngay_sinh, ':email' => $email, ':dia_chi' => $dia_chi, ':luong' => $luong ])) {
            $message = 'Cập nhật thành công!';
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
      <h2>Cập nhật nhân viên</h2>
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
          <input value="<?= $person->ten; ?>" type="text" name="ten" id="ten" class="form-control">
        </div>
        <div class="form-group">
          <label for="gioi_tinh">Giới tính</label>
          </br>
            <?php if($person->gioi_tinh == 'nam'): ?>
                <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" id="customRadio" name="gioi_tinh" value="nam" checked>
                <label class="custom-control-label" for="customRadio">Nam</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="customRadio2" name="gioi_tinh" value="nữ" >
                    <label class="custom-control-label" for="customRadio2">Nữ</label>
                </div>
            <?php endif; ?>
            <?php if($person->gioi_tinh == 'nữ'): ?>
                <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" id="customRadio" name="gioi_tinh" value="nam" >
                <label class="custom-control-label" for="customRadio">Nam</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="customRadio2" name="gioi_tinh" value="nữ" checked>
                    <label class="custom-control-label" for="customRadio2">Nữ</label>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-group">
          <label for="sdt">SĐT</label>
          <input type="text" value="<?= $person->sdt; ?>" name="sdt" id="sdt" class="form-control">
        </div>

        <div class="form-group">
          <label for="chuc_vu">Chức vụ</label>
          <input type="text" value="<?= $person->chuc_vu; ?>" name="chuc_vu" id="chuc_vu" class="form-control">
        </div>

        <div class="form-group">
          <label for="ngay_sinh">Ngày sinh</label>
          <input type="date" value="<?= $person->ngay_sinh; ?>" name="ngay_sinh" id="ngay_sinh" class="form-control">
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" value="<?= $person->email; ?>" name="email" id="email" class="form-control">
        </div>

        <div class="form-group">
          <label for="dia_chi">Địa chỉ</label>
          <input type="text" value="<?= $person->dia_chi; ?>" name="dia_chi" id="dia_chi" class="form-control">
        </div>

        <div class="form-group">
          <label for="luong">Lương</label>
          <input type="text" value="<?= $person->luong; ?>" name="luong" id="luong" class="form-control">
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary">Cập nhật nhân viên</button>
        </div>
      </form>
    </div>
  </div>

<?php 
  include('includes/scripts.php');
  include('includes/footer.php');
?>