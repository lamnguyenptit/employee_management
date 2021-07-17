<?php
    session_start();
    require 'dbconfig.php';

    $check1= $_SESSION['username'];
    $check2= $_SESSION['password'];
    if($check1 != true && $check2 != true) {
    header("Location: login.php");
    }

    $message = '';

    $id = $_GET['id'];
    $sql = 'SELECT username, ten, sdt, email FROM admin WHERE id=:id';
    $statement = $conn->prepare($sql);
    $statement->execute([':id' => $id ]);
    $person = $statement->fetch(PDO::FETCH_OBJ);

    if (isset ($_POST['username']) && isset($_POST['ten']) && isset($_POST['sdt'])  && isset($_POST['email'])) {
        $username = $_POST['username'];
        $ten = $_POST['ten'];
        $sdt = $_POST['sdt'];
        $email = $_POST['email'];
        $sql = 'UPDATE admin SET username=:username, ten=:ten, sdt=:sdt, email=:email WHERE id=:id';
        $statement = $conn->prepare($sql);
        if ($statement->execute([':id' => $id, ':username' => $username, ':ten' => $ten, ':sdt' => $sdt, ':email' => $email])) {
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
            <h2>Cập nhật admin</h2>
            </div>
            <div class="card-body">
            <?php if(!empty($message)): ?>
                <div class="alert alert-success">
                <?= $message; ?>
                </div>
            <?php endif; ?>
            <form method="post">
                <div class="form-group">
                <label for="ten">Tên tài khoản</label>
                <input value="<?= $person->username; ?>" type="text" name="username" id="username" class="form-control">
                </div>

                <div class="form-group">
                <label for="chuc_vu">Tên admin</label>
                <input type="text" value="<?= $person->ten; ?>" name="ten" id="ten" class="form-control">
                </div>

                <div class="form-group">
                <label for="sdt">SĐT</label>
                <input type="text" value="<?= $person->sdt; ?>" name="sdt" id="sdt" class="form-control">
                </div>

                <div class="form-group">
                <label for="email">Email</label>
                <input type="email" value="<?= $person->email; ?>" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                <button type="submit" class="btn btn-primary">Cập nhật admin</button>
                </div>
            </form>
            </div>
        </div>

<?php 
  include('includes/scripts.php');
  include('includes/footer.php');
?>