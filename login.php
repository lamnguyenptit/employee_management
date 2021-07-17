<?php
  session_start();
  require 'dbconfig.php';
  $message = '';

  if ( isset($_POST['username']) && isset($_POST['password']) ) {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $hashedPassword = md5($password);

    $stmt = $conn->prepare("SELECT * FROM admin");
    $stmt->execute();
    $result = $stmt->fetchAll();

    foreach ($result as $r) {
      if($username == $r["username"] && $hashedPassword == $r["password"]) {
          //echo 'You are successfully logged in.';
          $message = 'Bạn đã đăng nhập thành công';
          $_SESSION['username']=$username;
          $_SESSION['password']=$hashedPassword;

      //     if($_SESSION['email']== true && $_SESSION['password']== true)
      // {
      //   header("Location: index.php");
      // }
      // else
      // {
      //   $message = 'one field is not filled.';
      //   // header("Location: signin.php");

      // }

          header("Location: index.php");
      }
      else {
          $message = 'Sai tên đăng nhập hoặc mật khẩu';
        // echo 'Invalid Username and Password';
      }
    }
  }
?>

<!DOCTYPE html>
  <html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

  </head>

  <body class="bg-gradient-primary">

    <div class="container">

      <!-- Outer Row -->
      <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

          <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
              <!-- Nested Row within Card Body -->
              <div class="row">
                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                <div class="col-lg-6">
                  <div class="p-5">
                    <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                    </div>
                    <?php if(!empty($message)): ?>
                    <div class="alert alert-success">
                      <?= $message; ?>
                    </div>
                    <?php endif; ?>
                    <form class="user" method="post">
                      <div class="form-group">
                        <input type="username" name="username" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Tên đăng nhập">
                      </div>
                      <div class="form-group">
                        <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Mật khẩu">
                      </div>
                      <button type="submit" class="btn btn-primary btn-user btn-block">
                        Đăng nhập
                      </button>
                    <div class="text-center">
                      <a class="small" href="forgot-password.html">Quên mật khẩu?</a>
                    </div>
                    <div class="text-center">
                      <a class="small" href="register.html">Tạo tài khoản mới!</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

  </body>

</html>
