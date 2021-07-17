<?php
    session_start();
    require 'dbconfig.php';

    $check1= $_SESSION['username'];
    $check2= $_SESSION['password'];
    if($check1 != true && $check2 != true) {
      header("Location: login.php");
    }

    $sql = 'SELECT * FROM admin WHERE username = :username';
    $statement = $conn->prepare($sql);
    $statement->execute([':username' => $check1]);
    $people = $statement->fetchAll(PDO::FETCH_OBJ);
?>

<?php 
    include('includes/header.php');
    include('includes/navbar.php');
?>
        
  <div class="container-fluid">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h4 align="center" class="m-0 font-weight-bold text-primary">Thông tin admin</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
            <tr>
              <th>ID</th>
              <th>TÊN TÀI KHOẢN</th>
              <th>TÊN</th>
              <th>SĐT</th>
              <th>EMAIL</th>
            </tr>
            <?php foreach($people as $person): ?>
              <tr>
                <td><?= $person->id; ?></td>            
                <td><?= $person->username; ?></td>
                <td><?= $person->ten; ?></td>
                <td><?= $person->sdt; ?></td>
                <td><?= $person->email; ?></td>
              </tr>
            <?php endforeach; ?>
          </table>
          <a href="update-admin.php?id=<?= $person->id ?>" class="btn btn-primary">Sửa thông tin</a>
        </div>
      </div>
    </div>

<?php 
  include('includes/scripts.php');
  include('includes/footer.php');
?>