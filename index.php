<?php
  session_start();
  require 'dbconfig.php';

  $check= $_SESSION['username'];
  $check1=$_SESSION['password'];
  if($check != true && $check1 != true)
  {
    // $messg = 'Invalid Username and Password';
    // echo "$messg";
    header("Location: login.php");
  }
?>

<?php 
    include('includes/header.php');
    include('includes/navbar.php');
?>

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Điều khiển</h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tổng số nhân viên</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php
                  require 'dbconfig.php';
                  $sql = "SELECT id FROM employee ORDER BY id";
                  $statement = $conn->prepare($sql);
                  $statement->execute();
                  $people = $statement->fetchAll(PDO::FETCH_OBJ);
                  $cout = 0;
                  foreach($people as $person):
                    $cout = $cout + 1;
                  endforeach;
                  echo '<h1>' ,$cout, '</h1>';
                ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Tổng số developer</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <?php
                    require 'dbconfig.php';
                    $sql = "SELECT chuc_vu FROM employee ORDER BY chuc_vu";
                    $statement = $conn->prepare($sql);
                    $statement->execute();
                    $people = $statement->fetchAll(PDO::FETCH_OBJ);
                    $cout = 0;
                    foreach($people as $person):
                      if ($person -> chuc_vu == 'Developer')
                        $cout++;
                    endforeach;
                    echo '<h1>' ,$cout, '</h1>';
                  ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-people-arrows fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tổng số tester</div>
              <div class="row no-gutters align-items-center">
                  <?php
                    require 'dbconfig.php';
                    $sql = "SELECT chuc_vu FROM employee ORDER BY chuc_vu";
                    $statement = $conn->prepare($sql);
                    $statement->execute();
                    $people = $statement->fetchAll(PDO::FETCH_OBJ);
                    $cout = 0;
                    foreach($people as $person):
                      if ($person -> chuc_vu == 'Tester')
                        $cout++;
                    endforeach;
                    echo '<h1>' ,$cout, '</h1>';
                  ?>
                <div class="col">
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>


<?php 
  include('includes/scripts.php');
  include('includes/footer.php');
?>