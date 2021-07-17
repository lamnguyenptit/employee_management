<?php
    session_start();
    require 'dbconfig.php';

    $check1= $_SESSION['username'];
    $check2= $_SESSION['password'];
    if($check1 != true && $check2 != true) {
      header("Location: login.php");
    }

    $message = '';

    $sql = 'SELECT * FROM admin WHERE username = :username';
    $statement = $conn->prepare($sql);
    $statement->execute([':username' => $check1]);
    $admin = $statement->fetchAll(PDO::FETCH_OBJ);

    if (isset ($_POST['oldPassWord']) && isset($_POST['newPassWord1']) && isset($_POST['newPassWord2'])) {
      $oldPassWord = $_POST['oldPassWord'];
      $hashedOldPassWord = md5($oldPassWord);
      $newPassWord1 = $_POST['newPassWord1'];
      $newPassWord2 = $_POST['newPassWord2'];
      $hashedNewPassWord = md5($newPassWord1);

      if ($check2 != $hashedOldPassWord) {
        $message = 'Mật khẩu cũ không đúng';
      }
      else if ($newPassWord1 != $newPassWord2) {
        $message = 'Mật khẩu mới không khớp';
      }
      else{
        $sql = 'UPDATE admin SET password = :hashedNewPassWord WHERE username = :username';
        $statement = $conn->prepare($sql);
        if ($statement->execute([':hashedNewPassWord' => $hashedNewPassWord, ':username' => $check1])) {
          $message = 'Cập nhật thành công!';
        }
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
      <h2>Đổi mật khẩu</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
      <div class="alert alert-success">
        <?= $message; ?>
      </div>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label for="oldPassWord">Nhập mật khẩu cũ</label>
          <input type="password" name="oldPassWord" id="oldPassWord" class="form-control">
        </div>

        <div class="form-group">
          <label for="newPassWord1">Nhập mật khẩu mới</label>
          <input type="password" name="newPassWord1" id="newPassWord1" class="form-control">
        </div>

        <div class="form-group">
          <label for="newPassWord2">Xác nhận mật khẩu mới</label>
          <input type="password" name="newPassWord2" id="newPassWord2" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
        </div>
      </form>
    </div>
  </div>

<?php 
  include('includes/scripts.php');
  include('includes/footer.php');
?>